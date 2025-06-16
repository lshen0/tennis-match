<?php
require_once __DIR__ . '/../../models/Team.php';
require_once __DIR__ . '/../../models/Player.php';
session_start();

$team1_id = $_SESSION['team1_id'];
$team2_id = $_SESSION['team2_id'];
// echo $team1_id;
// echo $team2_id;

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

// Sort players by ranking
usort($players_team1, function ($a, $b) { return $a['ranking'] <=> $b['ranking']; });
usort($players_team2, function ($a, $b) { return $a['ranking'] <=> $b['ranking']; });

?>

<!DOCTYPE HTML>
<html> 

<head> 
    <link rel="stylesheet" href="../../../includes/styles.css"> 
</head>

<body> 
    <!-- Team 1 -->
    <table>
        <tr>
            <th class="title" colspan="3">
                <?php echo $team1['name']?> 
            </th>
        </tr>
        <tr>
            <td colspan="3"> 
                Coach: <?php echo $team1['coach_fname'] . ' ' . $team1['coach_lname'] . ', ' . $team1['coach_email'] ?>
            </td>
        </tr>

        <!-- Headers --> 
        <tr>
            <th class="subtitle">Ranking</th>
            <th class="subtitle">Name</th>
            <th class="subtitle">Action</th>
        </tr>

        <!-- Players -->
        <?php if (!empty($players_team1)): 
            foreach ($players_team1 as $player): ?>
                <tr>
                    <td class="ranking-cell"><?php echo $player['ranking']; ?></td>
                    <td><?php echo $player['lname'] . ', ' . $player['fname']; ?></td>
                    <td>
                        <a href="/tennis/app/views/players/edit.php?player_id=<?php echo $player['id']; ?>" class="edit-button">EDIT</a>
                    </td>
                </tr>
            <?php endforeach; 
        else: ?>
            <tr>
                <td colspan="3"> No players yet. Add one below! </td>
            </tr>
        <?php endif; ?>

        <!-- Add Player button (only if <7 players) -->
        <?php if (count($players_team1) < 7): ?>
            <tr>
                <td colspan="3">
                    <a href="/tennis/app/views/players/create.php?team_id=<?php echo $team1_id;?>" class="circle-button">+</a>
                </td>
            </tr>
        <?php endif; ?>

        <!-- Spacer row -->
        <tr style="height: 20px;"><td colspan="3"></td></tr>
    </table>


    <!-- Team 2 -->
    <table>
        <tr>
            <th class="title" colspan="3">
                <?php echo $team2['name']?> 
            </th>
        </tr>
        <tr>
            <td colspan="3"> 
                Coach: <?php echo $team2['coach_fname'] . ' ' . $team2['coach_lname'] . ', ' . $team2['coach_email'] ?>
            </td>
        </tr>

        <!-- Headers --> 
        <tr>
            <th class="subtitle">Ranking</th>
            <th class="subtitle">Name</th>
            <th class="subtitle">Action</th>
        </tr>

        <!-- Players -->
        <?php if (!empty($players_team2)): 
            foreach ($players_team2 as $player): ?>
                <tr>
                    <td class="ranking-cell"><?php echo $player['ranking']; ?></td>
                    <td><?php echo $player['lname'] . ', ' . $player['fname']; ?></td>
                    <td>
                        <a href="/tennis/app/views/players/edit.php?player_id=<?php echo $player['id']; ?>" class="edit-button">EDIT</a>
                    </td>
                </tr>
            <?php endforeach; 
        else: ?>
            <tr>
                <td colspan="3"> No players yet. Add one below! </td>
            </tr>
        <?php endif; ?>

        <!-- Add Player button (only if <7 players) -->
        <?php if (count($players_team2) < 7): ?>
            <tr>
                <td colspan="3">
                    <a href="/tennis/app/views/players/create.php?team_id=<?php echo $team2_id;?>" class="circle-button">+</a>
                </td>
            </tr>
        <?php endif; ?>
    </table>
</body>

</html>