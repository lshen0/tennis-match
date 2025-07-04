<!DOCTYPE html>
<html>

<head> 
    <link rel="stylesheet" href="../../includes/styles.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</head>

<body>
    <h1 class="title"> Edit player </h1>

    <div class="form-container">
        <form action="PlayerController.php" method="POST">
            <!-- Hidden input: id-->
            <input type="hidden" name="id" value="<?php echo $player['id']; ?>">

            <label for="fname">First Name</label>
            <input type="text" id="fname" name="fname" value="<?php echo $player['fname']; ?>"><br><br>
            <label for="lname">Last Name</label>
            <input type="text" id="lname" name="lname" value="<?php echo $player['lname']; ?>"><br><br>
            <label for="ranking">Ranking</label>
            <select name="ranking" id="ranking">   
                <!-- disable used rankings -->
                <?php for ($i = 1; $i <= 7; $i++): ?>
                    <?php
                        $selected = ($player['ranking'] == $i) ? 'selected' : '';
                        $disabled = (in_array($i, $used_rankings) && $player['ranking'] != $i) ? 'disabled' : ''; 
                    ?>
                    <option value="<?php echo $i; ?>" <?php echo $selected . ' ' . $disabled; ?>>
                        <?php echo $i; ?>
                    </option>
                <?php endfor; ?>
            </select><br><br>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="<?php echo $player['email'] ?? ''; ?>"><br><br>
            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone" value="<?php echo $player['phone'] ?? ''; ?>"><br><br>

            <div class="submit-container"> 
                <a href="../controllers/TeamController.php?action=list" class="cancel-button">Cancel</a>
                <input type="submit" value="Save Changes"> 
            </div>
        </form>
    </div>

</body>

</html>