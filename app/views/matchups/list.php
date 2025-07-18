<!DOCTYPE HTML>
<html> 

<head> 
    <link rel="stylesheet" href="../../includes/styles.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</head>

<body>     
    <div class="container mt-5">

        <h2 class="title">All matchups</h2>

        <table class="table table-borderless align-middle text-center w-auto" style="table-layout:auto; max-width: 1200px;">
            <!-- Headers -->
            <tr style="height: 50px;">
                <th class="subtitle">Ranking</th>
                <th class="subtitle"><?php echo $team1['name']; ?></th>
                <th class="subtitle"><?php echo $team2['name']; ?></th>
                <th class="subtitle">Score</th>
                <th class="subtitle">Action</th>
                <th class="subtitle">Winning Team</th>
            </tr>
            <?php for($i = 0; $i < 7; $i++): 
                $matchup = $matchups[$i]; ?>
            <tr style="height: 60px;" class="align-middle">
                <td class="ranking-cell"><?php echo $i+1; ?></td>
                <td><?php echo $matchup['player1_name']; ?></td>
                <td><?php echo $matchup['player2_name']; ?></td>
                <td><?php echo $matchup['score'] ?? "-"; ?></td>
                <td>
                    <a type="button" class="btn btn-success" href="../controllers/MatchupController.php?action=scorekeep&id=<?php echo $matchup['id']; ?>">
                        Scorekeep
                    </a>
                </td>
                <td>
                    <?php if ($matchup['winner'] == '1'): 
                            echo $team1['name'];
                    elseif ($matchup['winner'] == '2'):
                        echo $team2['name'];
                    else:
                        echo "Match still ongoing!"; 
                    endif; ?>
                </td>
            </tr> 
            <?php endfor; ?>
        </table>
    </div>

    <?php 
    $allMatchupsComplete = true;
    $team1_wins = 0;
    $team2_wins = 0;
    // Count wins for each team; maintain flag if if any winner is null
    foreach ($matchups as $matchup) {
        if (empty ($matchup['winner']) ) {
            $allMatchupsComplete = false;
        } elseif ($matchup['winner'] == 1) {
            $team1_wins++;
        } elseif ($matchup['winner'] == 2) {
            $team2_wins++;
        }
    }

    if ($allMatchupsComplete):
        $winner = ($team1_wins > $team2_wins) ? $team1['name'] : $team2['name']; ?>
        <div class="container text-center mt-4">
            <div class="alert alert-success py-3">
                <h6 class="mb-0">All matchups complete!</h6>
            <h4 class="mt-2">Winning Team: <strong><?php echo $winner; ?></strong></h4>
            <p class="mt-2">
                <?php echo "{$team1['name']}: {$team1_wins} wins | {$team2['name']}: {$team2_wins} wins"; ?>
            </p>
            </div>
        </div>
    <?php endif; ?>

</body>

</html>