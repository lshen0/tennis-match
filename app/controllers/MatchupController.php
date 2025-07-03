<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

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
            $previous_sets = array_slice($sets, 0, -1);
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

// ------------------- POST requests -------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? 'point';
    $player = $_POST['player']; // either 1 or 2
    $game_id = $_POST['game_id'];

    $current_game = $gameModel->getById($game_id);
    $set_id = $current_game['set_id'];
    $current_set = $setModel->getById($set_id);
    $matchup_id = $current_set['matchup_id'];
    $current_matchup = $matchupModel->getById($matchup_id);

    // If matchup is already finished, immediately send to scorekeeping page
    if (!empty($current_matchup['winner'])) {
        header("Location: MatchupController.php?action=scorekeep&id={$matchup_id}");
        exit;
    }

    switch ($action) {
        case 'point':
            if ($player == 1) {
                $gameModel->increment($game_id, 'player1_points');
            } elseif ($player == 2) {
                $gameModel->increment($game_id, 'player2_points');
            }

            // Get updated game
            $updated_game = $gameModel->getById($game_id);
            $player1_points = $updated_game['player1_points'];
            $player2_points = $updated_game['player2_points'];

            // Check if game is won
            if (($player1_points >= 4 || $player2_points >= 4) && abs($player1_points - $player2_points) >= 2) {
                $winner = ($player1_points > $player2_points) ? 1 : 2;
                $gameModel->update($game_id, ['winner' => $winner]);

                $col = ($winner === 1) ? 'player1_games' : 'player2_games';
                $setModel->increment($set_id, $col);

                $updated_set = $setModel->getById($set_id);
                $player1_games = $updated_set['player1_games'];
                $player2_games = $updated_set['player2_games'];

                // Check if set is complete
                if (($player1_games >= 6 || $player2_games >= 6) && abs($player1_games - $player2_games) >= 2) {
                    $set_winner = ($player1_games > $player2_games) ? 1 : 2;
                    $setModel->update($set_id, ['winner' => $set_winner]);

                    $col = ($set_winner === 1) ? 'player1_sets' : 'player2_sets';
                    $matchupModel->increment($matchup_id, $col);

                    $updated_matchup = $matchupModel->getById($matchup_id);
                    $player1_sets = $updated_matchup['player1_sets'];
                    $player2_sets = $updated_matchup['player2_sets'];

                    // Match over?
                    if ($player1_sets == 2 || $player2_sets == 2) {
                        $match_winner = ($player1_sets == 2) ? 1 : 2;
                        $matchupModel->update($matchup_id, ['winner' => $match_winner]);
                    } else {
                        // Create new set and game
                        $new_set_id = $setModel->create([
                            'matchup_id' => $matchup_id,
                            'player1_games' => 0,
                            'player2_games' => 0
                        ]);

                        $gameModel->create([
                            'set_id' => $new_set_id,
                            'player1_points' => 0,
                            'player2_points' => 0
                        ]);
                    }
                } else {
                    // Set still going — create next game in same set
                    $gameModel->create([
                        'set_id' => $set_id,
                        'player1_points' => 0,
                        'player2_points' => 0
                    ]);
                }
            }
            header("Location: MatchupController.php?action=scorekeep&id={$matchup_id}");
            break;
        }
}