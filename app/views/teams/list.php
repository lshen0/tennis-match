<!DOCTYPE HTML>
<html> 

<head> 
    <link rel="stylesheet" href="../../includes/styles.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <!-- TODO: factor this layout out into a partial team list layout to avoid code duplication? -->
</head>

<body> 
    <div class="container mt-5 text-center">
        <!-- Team 1 -->
        <table>
            <!-- Spacer row -->
            <tr style="height: 40px;"><td colspan="6"></td></tr>

            <tr>
                <th class="title" colspan="6">
                    <?php echo $team1['name']?> 
                </th>
            </tr>
            <tr>
                <td colspan="6"> 
                    <strong>Coach:</strong> <?php echo $team1['coach_fname'] . ' ' . $team1['coach_lname'] . ', ' . $team1['coach_email'] ?>
                </td>
            </tr>

            <!-- Headers --> 
            <tr>
                <th class="subtitle">Ranking</th>
                <th class="subtitle">Name</th>
                <th class="subtitle">Email</th>
                <th class="subtitle">Phone</th>
                <th class="subtitle">Action</th>
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
                            <div class="d-flex justify-content-center gap-2">
                                <a class="btn btn-success <?php echo $_SESSION['matchupsGenerated'] ? 'disabled' : ''; ?>" 
                                href="../controllers/PlayerController.php?action=edit&id=<?php echo $player['id']; ?>">EDIT</a>
                                <form action="../controllers/PlayerController.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?php echo $player['id']; ?>">
                                    <button type="submit" class="btn btn-danger <?php echo $_SESSION['matchupsGenerated'] ? 'disabled' : ''; ?>" 
                                    onclick="return confirm('Are you sure you want to delete this player?');">
                                        DELETE
                                    </button>
                                </form>
                            </div>
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
            <tr style="height: 60px;"><td colspan="6"></td></tr>
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
                    <strong>Coach:</strong> <?php echo $team2['coach_fname'] . ' ' . $team2['coach_lname'] . ', ' . $team2['coach_email'] ?>
                </td>
            </tr>

            <!-- Headers --> 
            <tr>
                <th class="subtitle">Ranking</th>
                <th class="subtitle">Name</th>
                <th class="subtitle">Email</th>
                <th class="subtitle">Phone</th>
                <th class="subtitle">Action</th>
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
                            <div class="d-flex justify-content-center gap-2">
                                <a class="btn btn-success <?php echo $_SESSION['matchupsGenerated'] ? 'disabled' : ''; ?>" 
                                href="../controllers/PlayerController.php?action=edit&id=<?php echo $player['id']; ?>">EDIT</a>
                                <form action="../controllers/PlayerController.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?php echo $player['id']; ?>">
                                    <button type="submit" class="btn btn-danger <?php echo $_SESSION['matchupsGenerated'] ? 'disabled' : ''; ?>" 
                                    onclick="return confirm('Are you sure you want to delete this player?');">
                                        DELETE
                                    </button>
                                </form>
                            </div>
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

    </div>

    <!-- Generate matchups button: only shown when all 14 players are in AND if not yet generated. Else, show view matchups button. -->
    <div class="submit-container">
        <?php
            if (count($players_team1) == 7 && count($players_team2) == 7): 
                if (!($_SESSION['matchupsGenerated'])): ?>
                <a href="../controllers/MatchupController.php?action=generate" class="generate-button" 
                    onclick="return confirm('Ready to generate matchups? This will pair players on opposite teams who share the same ranking. You CANNOT edit players after generating matchups!');">
                    Generate Matchups!
                </a>
            <?php else: ?>
                <a href="../controllers/MatchupController.php?action=list" class="generate-button" 
                    title="Matchups are generated by pairing players on opposite teams who share the same ranking.">
                    View Matchups!
                </a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    
</body>

</html>