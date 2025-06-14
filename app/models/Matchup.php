<?php 
require_once __DIR__ . '/Base.php';

/**
 * Defines a Matchup model.
 */
class Matchup extends Base {
	protected $table = 'match';

	/**
	 * Get matchup by player id (player may be registered as either player 1 or player 2).
	 */
	public function getMatchupByPlayerId($playerId) {
		$sql = "SELECT * FROM $this->table WHERE player1_id = ? OR player2_id = ?";
		$stmt = $this->execute($sql, [$playerId, $playerId], 'ii');
		$result = $stmt->get_result();
		return $result->fetch_assoc();
	}

	/**
	 * Update matchup winner.
	 */
	public function updateMatchup($id, $data) {
		// For matchups, you may only edit the 'winner' field
		foreach (array_keys($data) as $key) {
			if (!in_array($key, ['winner'])) {
				throw new Exception("May only update 'winner' field");
			}
    	}

		return $this->update($id, $data);
	}
}

