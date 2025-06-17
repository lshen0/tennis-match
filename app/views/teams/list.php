<!DOCTYPE HTML>
<html> 

<head> 
    <link rel="stylesheet" href="../../includes/styles.css"> 
    <!-- TODO: factor this layout out into a partial team list layout to avoid code duplication -->
</head>

<body> 
    <!-- Team 1 -->
    <table>
        <tr>
            <th class="title" colspan="6">
                <?php echo $team1['name']?> 
            </th>
        </tr>
        <tr>
            <td colspan="6"> 
                Coach: <?php echo $team1['coach_fname'] . ' ' . $team1['coach_lname'] . ', ' . $team1['coach_email'] ?>
            </td>
        </tr>

        <!-- Headers --> 
        <tr>
            <th class="subtitle">Ranking</th>
            <th class="subtitle">Name</th>
            <th class="subtitle">Email</th>
            <th class="subtitle">Phone</th>
            <th class="subtitle" colspan=2>Action</th>
        </tr>

        <!-- Players -->
        <?php if (!empty($players_team1)): 
            foreach ($players_team1 as $player): ?>
                <tr>
                    <td class="ranking-cell"><?php echo $player['ranking']; ?></td>
                    <td><?php echo $player['lname'] . ', ' . $player['fname']; ?></td>
                    <td><?php echo $player['email']; ?></td>
                    <td><?php echo $player['phone']; ?></td>
                    <td>
                        <a href="../controllers/PlayerController.php?action=edit&id=<?php echo $player['id']; ?>" class="edit-button">EDIT</a>
                    </td>
                    <td>
                        <form action="../controllers/PlayerController.php" method="POST" style="display:inline;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?php echo $player['id']; ?>">
                            <button type="submit" class="edit-button" onclick="return confirm('Are you sure you want to delete this player?');">
                                DELETE
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; 
        else: ?>
            <tr>
                <td colspan="6"> No players yet. Add one below! </td>
            </tr>
        <?php endif; ?>

        <!-- Add Player button (only if <7 players) -->
        <?php if (count($players_team1) < 7): ?>
            <tr>
                <td colspan="6">
                    <a href="../controllers/PlayerController.php?action=create&team_id=<?php echo $team1_id;?>" class="circle-button">+</a>
                </td>
            </tr>
        <?php endif; ?>

        <!-- Spacer row -->
        <tr style="height: 20px;"><td colspan="6"></td></tr>
    </table>


    <!-- Team 2 -->
    <table>
        <tr>
            <th class="title" colspan="6">
                <?php echo $team2['name']?> 
            </th>
        </tr>
        <tr>
            <td colspan="6"> 
                Coach: <?php echo $team2['coach_fname'] . ' ' . $team2['coach_lname'] . ', ' . $team2['coach_email'] ?>
            </td>
        </tr>

        <!-- Headers --> 
        <tr>
            <th class="subtitle">Ranking</th>
            <th class="subtitle">Name</th>
            <th class="subtitle">Email</th>
            <th class="subtitle">Phone</th>
            <th class="subtitle" colspan=2>Action</th>
        </tr>

        <!-- Players -->
        <?php if (!empty($players_team2)): 
            foreach ($players_team2 as $player): ?>
                <tr>
                    <td class="ranking-cell"><?php echo $player['ranking']; ?></td>
                    <td><?php echo $player['lname'] . ', ' . $player['fname']; ?></td>
                    <td><?php echo $player['email']; ?></td>
                    <td><?php echo $player['phone']; ?></td>
                    <td>
                        <a href="../controllers/PlayerController.php?action=edit&id=<?php echo $player['id']; ?>" class="edit-button">EDIT</a>
                    </td>
                    <td>
                        <form action="../controllers/PlayerController.php" method="POST" style="display:inline;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?php echo $player['id']; ?>">
                            <button type="submit" class="edit-button" onclick="return confirm('Are you sure you want to delete this player?');">
                                DELETE
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; 
        else: ?>
            <tr>
                <td colspan="6"> No players yet. Add one below! </td>
            </tr>
        <?php endif; ?>

        <!-- Add Player button (only if <7 players) -->
        <?php if (count($players_team2) < 7): ?>
            <tr>
                <td colspan="6">
                    <a href="../controllers/PlayerController.php?action=create&team_id=<?php echo $team2_id;?>" class="circle-button">+</a>
                </td>
            </tr>
        <?php endif; ?>

        <!-- Spacer row -->
        <tr style="height: 20px;"><td colspan="6"></td></tr>
    </table>

    <!-- Generate matchups button: only shown when all 14 players are in -->
    <div class="submit-container">
        <?php
            if (count($players_team1) == 7 && count($players_team2) == 7): ?>
                <a href="../controllers/MatchupController.php?action=generate" class="generate-button" 
                    title="Matchups are generated by pairing players on opposite teams who share the same ranking.">
                    Generate Matchups!
                </a>
        <?php endif; ?>
    </div>
    
</body>

</html>