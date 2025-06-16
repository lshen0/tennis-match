<?php
require_once __DIR__ . '/../models/Team.php';

// TODO - data validation?
if ($_SERVER["REQUEST_METHOD"] == "POST") { // CREATE
    echo "success 1";
    try {
        echo "success 1";
        $teamModel = new Team();
        echo "success 2";
        
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

        header("Location: ../views/teams/list.php");

    } catch (Exception $e) {
        echo "Error creating teams: " . $e->getMessage();
    }

}