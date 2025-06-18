<?php 
require_once __DIR__ . '/Base.php';

/**
 * Defines a Player model.
 */
class Player extends Base {
	protected $table = 'player';

	/**
	 * Get players by team.
	 */
	public function getPlayersByTeamId($team_id) {
		return $this->getAllByField('team_id', $team_id, 'i');
	}

	/**
	 * Get a player by a particular team and ranking.
	 */
	public function getPlayerByTeamAndRanking($team_id, $ranking) {
		$sql = "SELECT * FROM $this->table WHERE team_id = ? AND ranking = ?";
		$stmt = $this->execute($sql, [$team_id, $ranking], 'ii');
		$result = $stmt->get_result();
		return $result->fetch_assoc();
	}

}

