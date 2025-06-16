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
	 * Get players by rank.
	 */
	public function getPlayersByRank($rank) {
		return $this->getAllByField('rank', $rank, 'i');
	}

}

