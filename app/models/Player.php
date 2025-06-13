<?php 
require_once __DIR__ . 'Base.php';

/**
 * Defines a Player model.
 */
class Player extends Base {
	protected $table = 'player';

	/**
	 * Get players by team.
	 */
	public function getPlayersByTeam($team) {
		return $this->getAllByField($this->table, 'team', $team, 's');
	}

	/**
	 * Get players by rank.
	 */
	public function getPlayersByRank($rank) {
		return $this->getAllByField($this->table, 'rank', $rank, 'i');
	}

}

