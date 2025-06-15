<?php
// Load environment variables
$env = parse_ini_file(__DIR__ . '/../../.env'); 

// Create connection to database -- TODO: check
$conn = new mysqli($env['DB_HOST'], $env['DB_USER'], $env['DB_PASS'], $env['DB_NAME']);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "connected successfully!";
}

//  $conn->close();
    

// /** 
//  * Helper for SQL queries to database
//  */
// function db_query($sql) {
//     global $conn;

//     if ($conn->query($sql) == TRUE) {
//         echo "Success!";
//     } else {
//         echo "Error: " . $sql . "<br>" . $conn->error;
//     }

//     $conn->close();
    // return $result;  
// }