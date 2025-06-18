<?php
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../../includes/styles.css">
</head>

<body>
    <h1 class="title"> Add player </h1>

    <div class="form-container">
        <form action="PlayerController.php" method="POST">
            <!-- Hidden input: team_id -->
            <input type="hidden" name="team_id" value="<?php echo $team_id; ?>">

            <label for="fname">First Name<span class="required">*</span></label>
            <input type="text" id="fname" name="fname" required><br><br>
            <label for="lname">Last Name<span class="required">*</span></label>
            <input type="text" id="lname" name="lname" required><br><br>
            <label for="ranking">Ranking<span class="required">*</span></label>
            <select name="ranking" id="ranking">   
                <!-- disable used rankings -->
                <?php for ($i = 1; $i <= 7; $i++): ?>
                    <option value="<?php echo $i; ?>" <?php echo in_array($i, $used_rankings) ? 'disabled' : ''; ?>>
                        <?php echo $i; ?>
                    </option>
                <?php endfor; ?>
            </select><br><br>
            <label for="email">Email</label>
            <input type="text" id="email" name="email"><br><br>
            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone"><br><br>

            <div class="submit-container"> 
                <a href="../controllers/TeamController.php?action=list" class="cancel-button">Cancel</a>
                <input type="submit" value="Add Player"> 
            </div>
        </form>
    </div>

<!-- in the function, create the player and then auto redirect back to player_list, cancel button brings you back to player_list -->

</body>
</html>