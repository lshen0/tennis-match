<?php 
require_once __DIR__ . '/../config/db.php';

/**
 * Defines behavior common to all models.
 */
class Base {
    protected $conn;
    protected $table; // defined in child classes

    /** 
     * Constructor, stores connection. Inherited by all child classes.
     */
    public function __construct() {
        global $conn; // pulled from db.php
        $this->conn = $conn;
    }

    /**
     * Prepares and executes a SQL query, given an array of parameters and a string of types.
     */
    private function prepareAndExecute($sql, $params = [], $types = '') {
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die('Prepare failed: ' . $this->conn->error);
        }

        // Bind parameters to types if query has parameters
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        return $stmt;
    }

    /** 
     * Executes a SQL query.
     */
    protected function execute($sql, $params = [], $types = '') {
        return $this->prepareAndExecute($sql, $params, $types);
    }

    /**
     * Gets types of values in an array. Returns a string such as 'ssi'.
     */
    private function getTypes($params) {
        $types = '';

        foreach ($params as $param) {
            if (is_int($param)) {
                $types .= 'i';
            } elseif (is_double($param)) {
                $types .= 'd';
            } elseif (is_string($param)) {
                $types .= 's';
            }
        }

        return $types;
    }

    // ----------------------------------------- CREATE ---------------------------------------------------

    /**
     * Creates a new record in a table.
     * Example: Inserting the data [ 'name' => 'Nadal', 'rank' => 1 ] into the table 'players'
     *              is INSERT INTO players (name, rank) VALUES (?, ?)
     */
    public function create($data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $types = $this->getTypes(array_values($data)); 

        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
        $this->execute($sql, array_values($data), $types);

        // Return id of newly created record
        return $this->conn->insert_id; 

    }

    // ----------------------------------------- READ ---------------------------------------------------

    /**
     * Gets a record from a table by ID. Returns null if no record with that ID exists.
     */
    public function getById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->execute($sql, [$id], 'i');
        $result = $stmt->get_result();
        return $result->fetch_assoc();  
    }

    /**
     * Gets a record from a table by a specified field. Returns null if no records with that field value exist.
     */
    public function getAllByField($field, $value, $type) {
        $sql = "SELECT * FROM {$this->table} WHERE $field = ?";
        $stmt = $this->execute($sql, [$value], $type);
        $result = $stmt->get_result();
        return $result->fetch_all();  
    }

    /** 
     * Gets all records from a table.
     */
    public function getAll() {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->execute($sql);
        $result = $stmt->get_result();
        return $result->fetch_all();  
    }

    // ----------------------------------------- UPDATE ---------------------------------------------------

    /**
     * Updates a record in a table by id.
     * Example: Updating with the data [ 'name' => 'Nadal', 'rank' => 1 ] in the table 'players'
     *              is UPDATE players SET name = 'Nadal', rank = 1 INTO players (name, rank) VALUES (?, ?)
     */
    public function update($id, $data) {
        $set = implode(', ', array_map(function($col) { 
            return "$col = ?"; 
        }, array_keys($data)));  // 'name = ?, rank = ?'
        $types = $this->getTypes(array_values($data)) . 'i'; // WHERE id = ? is i
        $params = array_merge(array_values($data), [$id]);

        $sql = "UPDATE {$this->table} SET $set WHERE id = ?";
        return $this->execute($sql, $params, $types);
    }

    // For updating -- send a get request for that user to prepopulate, then check what changed???

    // ----------------------------------------- DELETE ---------------------------------------------------

    /**
     * Deletes a record in a table by id.
     */
    public function delete($id) {       
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        return $this->execute($sql, [$id], 'i');
    }
}