<?php
require_once __DIR__ . '/../models/Team.php';
require_once __DIR__ . '/../models/Player.php';
$teamModel = new Team();
$playerModel = new Player();
session_start();

// TODO - data validation

// ------------------- POST requests -------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $action = $_POST['action'] ?? 'save';

    switch ($action) {
        case 'save':
            $team1_id = $teamModel->create([
                'name' => $_POST['team1_name'],
                'coach_fname' => $_POST['team1_coach_fname'],
                'coach_lname' => $_POST['team1_coach_lname'],
                'coach_email' => $_POST['team1_coach_email'],
                'coach_phone' => $_POST['team1_coach_phone']
            ]);

            $team2_id = $teamModel->create([
                'name' => $_POST['team2_name'],
                'coach_fname' => $_POST['team2_coach_fname'],
                'coach_lname' => $_POST['team2_coach_lname'],
                'coach_email' => $_POST['team2_coach_email'],
                'coach_phone' => $_POST['team2_coach_phone']
            ]);

            $_SESSION['team1_id'] = $team1_id;
            $_SESSION['team2_id'] = $team2_id;

            header("Location: TeamController.php?action=list");
            break;
    }
}


// ------------------- POST requests -------------------
if ($_SERVER["REQUEST_METHOD"] == "GET") { 
    $action = $_GET['action'] ?? '';

    switch ($action) {
        case 'list':
            $team1_id = $_SESSION['team1_id'];
            $team2_id = $_SESSION['team2_id'];

            $team1 = $teamModel->getById($team1_id);
            $team2 = $teamModel->getById($team2_id);
            $players_team1 = $playerModel->getPlayersByTeamId($team1_id) ?? [];
            $players_team2 = $playerModel->getPlayersByTeamId($team2_id) ?? [];

            // Sort players by ranking
            usort($players_team1, function ($a, $b) { return $a['ranking'] <=> $b['ranking']; });
            usort($players_team2, function ($a, $b) { return $a['ranking'] <=> $b['ranking']; });

            include('../views/teams/list.php');
            break;

    }
}