<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../../includes/styles.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script> -->
</head>

<body>
    <h1 class="title"> Assign teams </h1>
    
    <form action="../controllers/TeamController.php" method="POST"> 
        <table>
            <tr>
                <th>Team 1</th>
                <th>Team 2</th>
            </tr>
            <tr>
                <!-- Team 1 -->
                <td class="field"> 
                    <label for="team1-name">Team Name<span class="required">*</span></label>
                    <input type="text" id="team1-name" name="team1_name" required><br><br>
                    <label for="team1-coach-fname">Coach First Name<span class="required">*</span></label>
                    <input type="text" id="team1-coach-fname" name="team1_coach_fname" required><br><br>
                    <label for="team1-coach-lname">Coach Last Name<span class="required">*</span></label>
                    <input type="text" id="team1-coach-lname" name="team1_coach_lname" required><br><br>
                    <label for="team1-coach-email">Coach Email<span class="required">*</span></label>
                    <input type="text" id="team1-coach-email" name="team1_coach_email" required><br><br>
                    <label for="team1-coach-phone">Coach Phone<span class="required">*</span></label>
                    <input type="text" id="team1-coach-phone" name="team1_coach_phone" required><br><br>
                </td>
                <!-- Team 2 -->
                <td class="field"> 
                    <label for="team2-name">Team Name<span class="required">*</span></label>
                    <input type="text" id="team2-name" name="team2_name" required><br><br>
                    <label for="team2-coach-fname">Coach First Name<span class="required">*</span></label>
                    <input type="text" id="team2-coach-fname" name="team2_coach_fname" required><br><br>
                    <label for="team2-coach-lname">Coach Last Name<span class="required">*</span></label>
                    <input type="text" id="team2-coach-lname" name="team2_coach_lname" required><br><br>
                    <label for="team2-coach-email">Coach Email<span class="required">*</span></label>
                    <input type="text" id="team2-coach-email" name="team2_coach_email" required><br><br>
                    <label for="team2-coach-phone">Coach Phone<span class="required">*</span></label>
                    <input type="text" id="team2-coach-phone" name="team2_coach_phone" required><br><br>
                </td>
            </tr>
        </table>
        <div class="submit-container"> 
            <input type="submit" value="Add Teams"> 
        </div>
    </form>

</body>

</html>
