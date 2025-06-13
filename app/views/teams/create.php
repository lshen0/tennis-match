<?php

// require_once "../../../";

echo "hello";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $team1_name = $_POST['team1_name'];
    // $team2_name = $_POST['team2_name'];
    // $team1_coach_fname = $_POST['team1_coach_fname'];
    // $team2_coach_fname = $_POST['team2_coach_fname'];
    // $team1_coach_lname = $_POST['team1_coach_lname'];
    // $team2_coach_lname = $_POST['team2_coach_lname'];
    // $team1_coach_email = $_POST['team1_coach_email'];
    // $team2_coach_email = $_POST['team2_coach_email'];
    // $team1_coach_phone = $_POST['team1_coach_phone'];
    // $team2_coach_phone = $_POST['team2_coach_phone'];

    // prepared statement
    $stmt = $conn->prepare("INSERT INTO team 
                            (team_name, coach_fname, coach_lname, coach_email, coach_phone) 
                            VALUES (?, ?, ?, ?, ?, ?, ?");
    $stmt->bind_param("sssss", $name, $coach_fname, $coach_lname, $coach_email, $coach_phone);

    // Team 1
    $name = $_POST['team1_name'];
    $coach_fname = $_POST['team1_coach_fname'];
    $coach_lname = $_POST['team1_coach_lname'];
    $coach_email = $_POST['team1_coach_email'];
    $coach_phone = $_POST['team1_coach_phone'];
    $stmt->execute();

    // Team 2
    $name = $_POST['team2_name'];
    $coach_fname = $_POST['team2_coach_fname'];
    $coach_lname = $_POST['team2_coach_lname'];
    $coach_email = $_POST['team2_coach_email'];
    $coach_phone = $_POST['team2_coach_phone'];
    $stmt->execute();

    echo "New records created successfully";

    $stmt->close();
    $conn->close();

}