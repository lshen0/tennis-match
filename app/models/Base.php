<?php 
require_once __DIR__ . '../config/db.php';

/**
 * Defines behavior common to all models.
 */
class Base {
    protected static $table_name; // defined in child classes
    protected static $table_pkey = 'id';

    /**
     * Get record by id (primary key)
     */
    public static function get($id) {
        $conn = db_connect();
        $table = static::$table_name;
        $pkey = static::$table_pkey;

        $stmt = $conn->prepare("SELECT * FROM {$table} WHERE {$pkey} = ?");
        $stmt->execute([$id]);
    }

    /**
     * Get record by specified field and value.
     */
    public static function getBy($id) {

    }
}

// get object
// create
// delete
// save -- go through each field in field_list