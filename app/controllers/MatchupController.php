<?php
require_once __DIR__ . '/../models/Matchup.php';
require_once __DIR__ . '/../models/Player.php';
$matchupModel = new Matchup(); 
$playerModel = new Player();
session_start();

// ------------------- GET requests -------------------
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $action = $_GET['action'];

    switch ($action) {
        case 'generate':
            $team1_id = $_SESSION['team1_id'];
            $team2_id = $_SESSION['team2_id'];
            // echo $team1_id . " " . $team2_id;

            // guaranteed 7 players per team, or else generate matchup button is not shown on team/list
            for ($ranking = 1; $ranking <= 7; $ranking++) {
                $player1 = $playerModel->getPlayerByTeamAndRanking($team1_id, $ranking);
                $player2 = $playerModel->getPlayerByTeamAndRanking($team2_id, $ranking);
                
                $matchupModel->create([
                    'player1_id' => $player1['id'],
                    'player2_id' => $player2['id'],
                    'player1_sets' => 0,
                    'player2_sets' => 0
                ]);
            }
            include('../views/matchups/list.php');
            break;
    }
}