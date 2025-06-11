<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $team1_name = $_POST['team1_name'];
    $team2_name = $_POST['team2_name'];
    $team1_coach_fname = $_POST['team1_coach_fname'];
    $team2_coach_fname = $_POST['team2_coach_fname'];
    $team1_coach_lname = $_POST['team1_coach_lname'];
    $team2_coach_lname = $_POST['team2_coach_lname'];
    $team1_coach_email = $_POST['team1_coach_email'];
    $team2_coach_email = $_POST['team2_coach_email'];




    // prepared statement
    $stmt = $conn->prepare("INSERT INTO team (team_name, coach_fname, coach_lname, coach_email, coach_phone) 
                            VALUES (?, ?, ?, ?, ?, ?, ?");
}