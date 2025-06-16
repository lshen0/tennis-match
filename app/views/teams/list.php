<?php
require_once __DIR__ . '/../../models/Team.php';
require_once __DIR__ . '/../../models/Player.php';

$team1_id = 1;
$team2_id = 2;

// Initialize database accessor objects
$teamModel = new Team();
$playerModel = new Player();

// Get team and players information
$team1 = $teamModel->getById($team1_id);
$team2 = $teamModel->getById($team2_id);
$players_team1 = $playerModel->getPlayersByTeamId($team1_id);
$players_team2 = $playerModel->getPlayersByTeamId($team2_id);
// var_dump($players_team1);
// var_dump($players_team2);

?>

<!DOCTYPE HTML>
<html> 

<head> 
    <link rel="stylesheet" href="../../../includes/styles.css"> 
</head>

<body> 
    <table>
        <tr>
            <th class="title"><?php echo $team1['name']?></h1> </th>
            <th class="title"><?php echo $team2['name']?></h1> </th>
        </tr>
        <tr>
            <td> Coach: <?php echo $team1['coach_fname'] . ' ' . $team1['coach_lname'] . ', ' . $team1['coach_email'] ?></td>
            <td> Coach: <?php echo $team2['coach_fname'] . ' ' . $team2['coach_lname'] . ', ' . $team2['coach_email'] ?></td>
        </tr>
    </table>
</body>

</html>