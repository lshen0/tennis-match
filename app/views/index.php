<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../includes/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4 text-center title">Assign teams</h1>

        <div class="mb-5"></div>
        
        <form action="../controllers/TeamController.php" method="POST">
            <div class="row">
                <!-- Team 1 -->
                <div class="col-md-6">
                    <h5>Team 1</h5>
                    <div class="mb-3">
                        <label for="team1-name" class="form-label">Team Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="team1-name" name="team1_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="team1-coach-fname" class="form-label">Coach First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="team1-coach-fname" name="team1_coach_fname" required>
                    </div>
                    <div class="mb-3">
                        <label for="team1-coach-lname" class="form-label">Coach Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="team1-coach-lname" name="team1_coach_lname" required>
                    </div>
                    <div class="mb-3">
                        <label for="team1-coach-email" class="form-label">Coach Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="team1-coach-email" name="team1_coach_email" required>
                    </div>
                    <div class="mb-3">
                        <label for="team1-coach-phone" class="form-label">Coach Phone <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control" id="team1-coach-phone" name="team1_coach_phone" required>
                    </div>
                </div>

                <!-- Team 2 -->
                <div class="col-md-6">
                    <h5>Team 2</h5>
                    <div class="mb-3">
                        <label for="team2-name" class="form-label">Team Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="team2-name" name="team2_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="team2-coach-fname" class="form-label">Coach First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="team2-coach-fname" name="team2_coach_fname" required>
                    </div>
                    <div class="mb-3">
                        <label for="team2-coach-lname" class="form-label">Coach Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="team2-coach-lname" name="team2_coach_lname" required>
                    </div>
                    <div class="mb-3">
                        <label for="team2-coach-email" class="form-label">Coach Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="team2-coach-email" name="team2_coach_email" required>
                    </div>
                    <div class="mb-3">
                        <label for="team2-coach-phone" class="form-label">Coach Phone <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control" id="team2-coach-phone" name="team2_coach_phone" required>
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success py-3" style="width: 150px;" onclick="return confirm('Ready to add these teams? You cannot edit teams after this point!')">
                    Add Teams
                </button>
            </div>
        </form>
    </div>
</body>
</html>