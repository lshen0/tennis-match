<?php 
require_once __DIR__ . '/Base.php';

/**
 * Defines a Game model.
 */
class Game extends Base {
	protected $table = 'game';

	/**
	 * Get set by game id.
	 */
	public function getGameBySet($game_id) {
		return $this->getAllByField('game_id', $game_id, 'i');
	}

	/**
	 * Get games by set id and winner number.
	 */
	public function getGamesBySetAndWinner($game_id, $winner) {
		$sql = "SELECT * FROM $this->table WHERE game_id = ? AND winner = ?";
		$stmt = $this->execute($sql, [$game_id, $winner], 'ii');
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC);
	}
}

