<?php 
require_once __DIR__ . '/Base.php';

/**
 * Defines a Matchup model.
 */
class Matchup extends Base {
	protected $table = 'matchup';

	/**
	 * Get matchup by player id (player may be registered as either player 1 or player 2).
	 */
	public function getMatchupByPlayerId($player_id) {
		$sql = "SELECT * FROM $this->table WHERE player1_id = ? OR player2_id = ?";
		$stmt = $this->execute($sql, [$player_id, $player_id], 'ii');
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

	/**
	 * Increase a matchup score by one set for a particular player (identified as either 1 or 2).
	 */
	// public function incrementSetsForPlayer($id, $player_number) {
	// 	$col = $player_number == 1 ? 'player1_sets' : 'player2_sets';
	// 	$sql = "UPDATE $this->table SET $col = $col + 1 WHERE id = ?";
	// 	$this->execute($sql, [$id], 'i');
	// 	return true;
	// }
}

