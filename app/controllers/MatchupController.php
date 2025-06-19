<?php
require_once __DIR__ . '/../models/Matchup.php';
require_once __DIR__ . '/../models/Set.php';
require_once __DIR__ . '/../models/Player.php';
require_once __DIR__ . '/../models/Team.php';
$matchupModel = new Matchup(); 
$setModel = new Set();
$playerModel = new Player();
$teamModel = new Team();
session_start();

// ------------------- GET requests -------------------
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $action = $_GET['action'] ?? 'list';

    switch ($action) {
        case 'generate':
            $team1_id = $_SESSION['team1_id'];
            $team2_id = $_SESSION['team2_id'];
            $ids = []; // array of newly generated matchup ids

            for ($ranking = 1; $ranking <= 7; $ranking++) {
                $player1 = $playerModel->getPlayerByTeamAndRanking($team1_id, $ranking);
                $player2 = $playerModel->getPlayerByTeamAndRanking($team2_id, $ranking);
                
                // Matchup generation
                $id = $matchupModel->create([
                    'player1_id' => $player1['id'],
                    'player2_id' => $player2['id'],
                    'player1_sets' => 0,
                    'player2_sets' => 0
                ]);

                // First set generation
                $setModel->create([
                    'matchup_id' => $id, // newly made match
                    'player1_games' => 0,
                    'player2_games' => 0
                ]);

                // First game generation
                

                $ids[] = $id;
            }
            $_SESSION['matchup_ids'] = $ids;

            header("Location: TeamController.php?action=list");
            break;
        
        case 'list':
            $team1 = $teamModel->getById($_SESSION['team1_id']);
            $team2 = $teamModel->getById($_SESSION['team2_id']);

            $ids = $_SESSION['matchup_ids'] ?? [];

            $matchups = array_map(function ($id) use ($matchupModel, $playerModel) {
                $matchup = $matchupModel->getById($id);
                // Add player names for displaying
                $player1 = $playerModel->getById($matchup['player1_id']);
                $player2 = $playerModel->getById($matchup['player2_id']);
                $matchup['player1_name'] = $player1['lname'] . ", " . $player1['fname'];
                $matchup['player2_name'] = $player2['lname'] . ", " . $player2['fname'];
                return $matchup;
            }, $ids);

            // var_dump($matchups);

            include('../views/matchups/list.php');
            break;

        case 'scorekeep': // show scorekeeping view
            include '../views/matchups/scorekeep.php';
            break;
    }
}