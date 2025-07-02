<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../../includes/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container mt-5" style="max-width:500px;">
        <h1 class="mb-4 text-center title">Add Player</h1>

        <form action="PlayerController.php" method="POST">
            <!-- Hidden input: team_id -->
            <input type="hidden" name="team_id" value="<?php echo $team_id; ?>">

            <div class="mb-3">
                <label for="fname" class="form-label">First Name<span class="text-danger">*</span></label>
                <input type="text" id="fname" name="fname" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="lname" class="form-label">Last Name<span class="text-danger">*</span></label>
                <input type="text" id="lname" name="lname" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="ranking" class="form-label">Ranking<span class="text-danger">*</span></label>
                <select name="ranking" id="ranking" class="form-select" required>
                    <!-- disable used rankings -->
                    <?php for ($i = 1; $i <= 7; $i++): ?>
                        <option value="<?php echo $i; ?>" <?php echo in_array($i, $used_rankings) ? 'disabled' : ''; ?>>
                            <?php echo $i; ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control">
            </div>

            <div class="d-flex justify-content-around">
                <a href="../controllers/TeamController.php?action=list" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-success">Add Player</button>
            </div>
        </form>
    </div>
</body>

</html>
