<?php 
require_once 'Base.php';

/**
 * Defines a Player model.
 */
class Player extends Base {
	private $table = 'player';

	public function createPlayer($data) {
		return $this->create($this->table, $data);
	}

	public function getPlayerById($id) {
		return $this->getById($this->table, $id);
	}

	public function getPlayersByTeam($team) {
		return $this->getAllByField($this->table, 'team', $team, 's');
	}

	public function getAllPlayers() {
		return $this->getAll($this->table);
	}

	public function updatePlayer($id, $data) {
		return $this->update($this->table, $id, $data);
	}

	public function deletePlayer($id) {
		return $this->delete($this->table, $id);
	}
}

