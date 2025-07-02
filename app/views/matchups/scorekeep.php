<!DOCTYPE html>
<html>

<head> 
    <link rel="stylesheet" href="../../includes/styles.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</head>

<body>    
    <div class="mb-5"></div>

    <!-- Tennis Court Image -->
    <div class="text-center">
        <img src="../../includes/court.jpg" style="max-width: 500px;" alt="Tennis court">
    </div>

    <div class="mb-5"></div>

    <!-- Current Game -->
    <div class="container text-center" style="max-width: 750px;">
        <!-- player names row -->
        <div class="row justify-content-center">
            <div class="col player-name">
                <?php echo $player1['lname']; ?> 
            </div>
            <div class="col">
                <!-- empty center cell -->
            </div>
            <div class="col player-name">
                <?php echo $player2['lname']; ?> 
            </div>
        </div>
        <!-- team row -->
        <div class="row justify-content-center">
            <div class="col team-name">
                <?php echo $team1['name']; ?> 
            </div>
            <div class="col team-name">
                Current game
            </div>
            <div class="col team-name">
                <?php echo $team2['name']; ?> 
            </div>
        </div>
        <!-- scores row -->
        <div class="row justify-content-center">
            <div class="col score">
                <?php echo displayPoints($current_game['player1_points'], $current_game['player2_points']); ?> 
            </div>
            <div class="col">
                <!-- empty center cell -->
            </div>
            <div class="col score">
                <?php echo displayPoints($current_game['player2_points'], $current_game['player1_points']);  ?> 
            </div>
        </div>
    </div>

    <div class="mb-5"></div>

    <!-- Total Match Score -->
    <table class="table align-middle mt-5 rounded-4" style="max-width: 750px;">
        <!-- Headers -->
        <tr class="table-light small">
            <th class="text-start">Player</th>
            <?php for ($i = 0; $i < count($sets)-1; $i++): ?>
                <th class="text-center"> <!-- empty header --> </th>
            <?php endfor; ?>
            <th class="text-end">Games</th>
            <th class="text-end">Points</th>
        </tr>
        <tbody class="table-group-divider">
        <!-- Player 1 -->
            <tr>
                <td class="text-start"><?php echo $player1['lname'] . ", " . $player1['fname']; ?></td>
                <!-- Game scores for previous sets -->
                <?php foreach ($previous_sets as $set): ?>
                    <td class="text-center"><?php echo $set['player1_games']; ?></td>
                <?php endforeach; ?>
                <!-- Game score for current set -->
                <td class="text-end"><?php echo $current_set['player1_games']; ?></td>
                <!-- Point score for current game -->
                <td class="text-end"><?php echo displayPoints($current_game['player1_points'], $current_game['player2_points']); ?></td>
            </tr>
        <!-- Player 2 -->
            <tr>
                <td class="text-start"><?php echo $player2['lname'] . ", " . $player2['fname']; ?></td>
                <!-- Game scores for previous sets -->
                <?php foreach ($previous_sets as $set): ?>
                    <td class="text-center"><?php echo $set['player2_games']; ?></td>
                <?php endforeach; ?>
                <!-- Game score for current set -->
                <td class="text-end"><?php echo $current_set['player2_games']; ?></td>
                <!-- Point score for current game -->
                <td class="text-end"><?php echo displayPoints($current_game['player2_points'], $current_game['player1_points']); ?></td>
            </tr>
        </tbody>
    </table>

    <div class="mb-5"></div>

    <!-- Scorekeeping Buttons -->
    <div class="container text-center" style="max-width: 750px;">
        <form action="MatchupController.php" method="POST" style="display:inline;"> 
            <input type="hidden" name="action" value="point">
            <input type="hidden" name="player" value="1">
            <input type="hidden" name="game_id" value="<?php echo $current_game['id']; ?>">
            <button type="submit" class="btn btn-success me-2 py-3" style="width: 300px;"> 
                Point for <?php echo $player1['lname']; ?>
            </button>
        </form>
        <form action="MatchupController.php" method="POST" style="display:inline;"> 
            <input type="hidden" name="action" value="point">
            <input type="hidden" name="player" value="2">
            <input type="hidden" name="game_id" value="<?php echo $current_game['id']; ?>">
            <button type="submit" class="btn btn-success me-2 py-3" style="width: 300px;"> 
                Point for <?php echo $player2['lname']; ?>
            </button>
        </form>
    </div>

    <div class="mb-5"></div>

    <!-- Return Button -->
    <div class="container text-center" style="max-width: 750px;">
        <a type="button" class="btn btn-secondary me-2 py-2" style="width: 200px;" href="MatchupController.php?action=list">
            Return to all matchups
        </a>
    </div>


</div>

</body>

</html>