<!DOCTYPE HTML>
<html> 

<head> 
    <link rel="stylesheet" href="../../includes/styles.css"> 
</head>

<body> 
    <h2 class="title">All matchups</h2>

    <table>
        <!-- Headers -->
        <tr>
            <th class="subtitle">Ranking</th>
            <th class="subtitle"><?php echo $team1['name']; ?></th>
            <th class="subtitle"><?php echo $team2['name']; ?></th>
            <th class="subtitle">Current Score</th>
            <th class="subtitle">Action</th>
            <th class="subtitle">Winning Team</th>
        </tr>
        <?php for($i = 0; $i < 7; $i++): 
            $matchup = $matchups[$i]; ?>
        <tr>
            <td class="ranking-cell"><?php echo $i+1; ?></td>
            <td><?php echo $matchup['player1_name']; ?></td>
            <td><?php echo $matchup['player2_name']; ?></td>
            <td> CURR SCORE HERE </td>
            <td>
                <a href="../controllers/MatchupController.php?action=scorekeep&id=<?php echo $matchup['id']; ?>" class="edit-button">Scorekeep</a>
            </td>
            <td>
                <?php if ($matchup['winner']): 
                        echo $matchup['winner'];
                else:
                    echo "Match still ongoing!"; 
                endif; ?>
            </td>
        </tr> 
        <?php endfor; ?>
    </table>
</body>

</html>