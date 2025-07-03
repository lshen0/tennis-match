<?php 
require_once __DIR__ . '/Base.php';

/**
 * Defines a Set model.
 */
class Set extends Base {
	protected $table = '`set`';

	/**
	 * Get sets by matchup id.
	 */
	public function getSetsByMatchup($matchup_id) {
		return $this->getAllByField('matchup_id', $matchup_id, 'i');
	}

	/**
	 * Get sets by matchup id and winner number.
	 */
	public function getSetsByMatchupAndWinner($matchup_id, $winner) {
		$sql = "SELECT * FROM $this->table WHERE matchup_id = ? AND winner = ?";
		$stmt = $this->execute($sql, [$matchup_id, $winner], 'ii');
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC);
	}

	/**
	 * Increase a set score by one game for a particular player (identified as either 1 or 2).
	 */
	// public function incrementGamesForPlayer($id, $player_number) {
	// 	$col = $player_number == 1 ? 'player1_games' : 'player2_games';
	// 	$sql = "UPDATE $this->table SET $col = $col + 1 WHERE id = ?";
	// 	$this->execute($sql, [$id], 'i');
	// 	return true;
	// }

}