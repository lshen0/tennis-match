<?php
require_once __DIR__ . '/../models/Matchup.php';
require_once __DIR__ . '/../models/Set.php';
require_once __DIR__ . '/../models/Game.php';
require_once __DIR__ . '/../models/Player.php';
require_once __DIR__ . '/../models/Team.php';
$matchupModel = new Matchup(); 
$setModel = new Set();
$gameModel = new Game();
$playerModel = new Player();
$teamModel = new Team();
session_start();

// ------------------- GET requests -------------------
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $action = $_GET['action'] ?? 'list';

    switch ($action) {
        case 'generate':
            if (isset($_SESSION['matchupsGenerated']) && $_SESSION['matchupsGenerated']) {
                echo "You have already generated matchups. Please return to the team view and reload.<br>";
                exit;
            }
            $team1_id = $_SESSION['team1_id'];
            $team2_id = $_SESSION['team2_id'];
            $matchup_ids = []; // array of newly generated matchup ids

            for ($ranking = 1; $ranking <= 7; $ranking++) {
                $player1 = $playerModel->getPlayerByTeamAndRanking($team1_id, $ranking);
                $player2 = $playerModel->getPlayerByTeamAndRanking($team2_id, $ranking);
                
                // Matchup generation
                $matchup_id = $matchupModel->create([
                    'player1_id' => $player1['id'],
                    'player2_id' => $player2['id'],
                    'player1_sets' => 0,
                    'player2_sets' => 0
                ]);

                // First set generation
                $set_id = $setModel->create([
                    'matchup_id' => $matchup_id, // newly made match
                    'player1_games' => 0,
                    'player2_games' => 0
                ]);

                // First game generation
                $gameModel->create([
                    'set_id' => $set_id, // newly made set
                    'player1_points' => 0,
                    'player2_points' => 0
                ]);

                $matchup_ids[] = $matchup_id;
            }
            $_SESSION['matchup_ids'] = $matchup_ids;
            $_SESSION['matchupsGenerated'] = true;

            header("Location: MatchupController.php?action=list");
            break;
        
        case 'list':
            $team1 = $teamModel->getById($_SESSION['team1_id']);
            $team2 = $teamModel->getById($_SESSION['team2_id']);

            $matchup_ids = $_SESSION['matchup_ids'] ?? [];
            // echo "ids " . var_dump($matchup_ids);

            $matchups = array_map(function ($id) use ($matchupModel, $playerModel, $setModel) {
                $matchup = $matchupModel->getById($id);
                // Add player names for displaying
                $player1 = $playerModel->getById($matchup['player1_id']);
                $player2 = $playerModel->getById($matchup['player2_id']);
                $matchup['player1_name'] = $player1['lname'] . ", " . $player1['fname'];
                $matchup['player2_name'] = $player2['lname'] . ", " . $player2['fname'];
                // Add sets and score
                $sets = $setModel->getSetsByMatchup($id);
                $scoreArray = [];
                foreach ($sets as $set) {
                    $scoreArray[] = $set['player1_games'] . "-" . $set['player2_games'];
                }
                $matchup['score'] = implode(", ", $scoreArray);
                return $matchup;
            }, $matchup_ids);

            // var_dump($matchups);

            include('../views/matchups/list.php');
            break;

        case 'scorekeep': // show scorekeeping view
            $id = $_GET['id']; // matchup id

            // TODO -- implement with SQL join?
            $matchup = $matchupModel->getById($id);
            $player1 = $playerModel->getById($matchup['player1_id']);
            $player2 = $playerModel->getById($matchup['player2_id']);
            $team1 = $teamModel->getById($_SESSION['team1_id']);
            $team2 = $teamModel->getById($_SESSION['team2_id']);
            $sets = $setModel->getSetsByMatchup($id);
            $current_set = end($sets);
            $games = $gameModel->getGamesBySet($current_set['id']);
            $current_game = end($games);

            function displayPoints(int $playerPoints, int $opponentPoints) {
                if ($playerPoints >= 3 && $opponentPoints >= 3) {
                    if ($playerPoints == $opponentPoints) {
                        return "40"; // Deuce, so both players display 40
                    } elseif ($playerPoints == $opponentPoints + 1) {
                        return "AD"; 
                    } elseif ($opponentPoints == $playerPoints + 1) {
                        return " ";
                    }
                } else {
                    switch ($playerPoints) {
                        case 0: return "0";
                        case 1: return "15";
                        case 2: return "30";
                        case 3: return "40";
                    }
                }
                
            }

            include '../views/matchups/scorekeep.php';
            break;
    }
}