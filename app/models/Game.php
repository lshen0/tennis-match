<?php 
require_once __DIR__ . '/Base.php';

/**
 * Defines a Game model.
 */
class Game extends Base {
	protected $table = 'game';

	/**
	 * Get games by set id.
	 */
	public function getGamesBySet($set_id) {
		return $this->getAllByField('set_id', $set_id, 'i');
	}

	/**
	 * Get games by set id and winner number.
	 */
	public function getGamesBySetAndWinner($set_id, $winner) {
		$sql = "SELECT * FROM $this->table WHERE set_id = ? AND winner = ?";
		$stmt = $this->execute($sql, [$set_id, $winner], 'ii');
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC);
	}

	/**
	 * Increase a game score by one point for a particular player (identified as either 1 or 2).
	 */
	// public function incrementPointsForPlayer($id, $player_number) {
	// 	$col = $player_number == 1 ? 'player1_points' : 'player2_points';
	// 	$sql = "UPDATE $this->table SET $col = $col + 1 WHERE id = ?";
	// 	$this->execute($sql, [$id], 'i');
	// 	return true;
	// }
}