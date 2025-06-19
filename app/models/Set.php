<?php 
require_once __DIR__ . '/Base.php';

/**
 * Defines a Set model.
 */
class Set extends Base {
	protected $table = '`set`';

	/**
	 * Get set by matchup id.
	 */
	public function getSetByMatchup($matchup_id) {
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
}

