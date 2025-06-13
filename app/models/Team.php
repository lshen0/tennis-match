<?php 
require_once 'Base.php';

/**
 * Defines a Team model.
 */
class Team extends Base {
	private $table = 'team';

	public function createTeam($data) {
		return $this->create($this->table, $data);
	}

	public function getTeamById($id) {
		return $this->getById($this->table, $id);
	}

	public function getAllTeams() {
		return $this->getAll($this->table);
	}

	public function updateTeam($id, $data) {
		return $this->update($this->table, $id, $data);
	}
}

