<?php
require_once __DIR__ . '/../models/Team.php';
require_once __DIR__ . '/../models/Player.php';
$teamModel = new Team();
$playerModel = new Player();
session_start();

// TODO - data validation?

// ------------------- GET requests -------------------
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $action = $_GET['action'] ?? 'list';
    // echo "success 2";

    switch ($action) {
        case 'edit': // show edit form
            $id = (int) $_GET['id'];
            $player = $playerModel->getById($id);
            $players = $playerModel->getPlayersByTeamId($player['team_id']);
            $usedRankings = array_map(function ($p) {
                return $p['ranking'];
            }, $players);
            include '../views/players/edit.php';
            exit;
            break;
        case 'create': // show create form
            $team_id = (int) $_GET['team_id'];
            $players = $playerModel->getPlayersByTeamId($team_id);
            $usedRankings = array_map(function ($p) {
                return $p['ranking'];
            }, $players);
            include '../views/players/create.php';
            break;
        case 'list':
            include '../views/teams/list.php';
            break;
            

    }
}

// ------------------- POST requests -------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $action = $_POST['action'] ?? 'save';

    switch ($action) {
        case 'save':
            $id = $_POST['id'] ?? null;
            $data = [
                'fname' => $_POST['fname'] ?? '',
                'lname' => $_POST['lname'] ?? '',
                'ranking' => $_POST['ranking'] ?? null,
                'team_id' => $_POST['team_id'] ?? $playerModel->getById($id)['team_id'],
                'email' => $_POST['email'] ?? null,
                'phone' => $_POST['phone'] ?? null,
            ];

            if ($id) {
                $playerModel->update($id, $data); // UPDATE
            } else {
                $playerModel->create($data); // CREATE
            }

            header("Location: TeamController.php?action=list");
            break;
    }
}