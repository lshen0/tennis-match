<!DOCTYPE html>
<html>

<head> 
    <link rel="stylesheet" href="../../includes/styles.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</head>

<body>
    <!-- top section -->
    <table>
        <tr>
            <td> <?php echo $player1['lname']; ?> </td>
            <td> <?php echo $player2['lname']; ?> </td>
        </tr>
        <tr>
            <td> <?php echo $team1['name']; ?> </td>
            <td> <?php echo $team2['name']; ?> </td>
        </tr>
        <tr>
            <td> <?php echo displayPoints($current_game['player1_points'], $current_game['player2_points']); ?> </td>
            <td> <?php echo displayPoints($current_game['player2_points'], $current_game['player1_points']); ?> </td>
        </tr>
    </table>

</body>

</html>