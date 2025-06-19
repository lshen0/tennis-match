<?php 
require_once __DIR__ . '/Base.php';

/**
 * Defines a Game model.
 */
class Game extends Base {
	protected $table = 'game';

	/**
	 * Get game by set id.
	 */
	public function getGameBySet($set_id) {
		return $this->getAllByField('set_id', $game_id, 'i');
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
}

