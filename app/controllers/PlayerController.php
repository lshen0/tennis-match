<?php
require_once __DIR__ . '/../models/Player.php';

// TODO - data validation?
if ($_SERVER["REQUEST_METHOD"] == "POST") { // CREATE
    try {
        $playerModel = new Player();
        
        $player_id = $playerModel->create([
            'fname' => $_POST['fname'],
            'lname' => $_POST['lname'],
            'team_id' => $_POST['team_id'],
            'ranking' => $_POST['ranking'],
            'email' => $_POST['email'] ?? null,
            'phone' => $_POST['phone'] ?? null
        ]);

        header("Location: ../views/teams/list.php");

    } catch (Exception $e) {
        echo "Error creating player: " . $e->getMessage();
    }

}