<?php
require_once __DIR__ . '/../models/Matchup.php';
$matchupModel = new Matchup(); 
session_start();

// ------------------- GET requests -------------------
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $action = $_GET['action'];

    switch ($action) {
        case 'generate':
            $team1_id = $_SESSION['team1_id'];
            $team2_id = $_SESSION['team2_id'];
            echo $team1_id . " " . $team2_id;
    }
}