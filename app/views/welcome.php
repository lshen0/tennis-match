<?php 
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../../includes/styles.css">
</head>

<body>
    <h1 class="title"> Assign a matchup </h1>

    <form action="../controllers/teams/MatchupController.php" method="POST"> 
        <table>
            <tr>
                <th>Team 1</th>
                <th>Team 2</th>
            </tr>
            <tr>
                <!-- Team 1 -->
                <td> 
                    <label for="team1-name">Team Name:</label>
                    <input type="text" id="team1-name" name="team1_name" required><br><br>
                    <label for="team1-coach-fname">Coach First Name:</label>
                    <input type="text" id="team1-coach-fname" name="team1_coach_fname" required><br><br>
                    <label for="team1-coach-lname">Coach Last Name:</label>
                    <input type="text" id="team1-coach-lname" name="team1_coach_lname" required><br><br>
                    <label for="team1-coach-email">Coach Email:</label>
                    <input type="text" id="team1-coach-email" name="team1_coach_email" required><br><br>
                    <label for="team1-coach-phone">Coach Phone:</label>
                    <input type="text" id="team1-coach-phone" name="team1_coach_phone" required><br><br>
                </td>
                <!-- Team 2 -->
                <td> 
                    <label for="team2-name">Team Name:</label>
                    <input type="text" id="team2-name" name="team2_name" required><br><br>
                    <label for="team2-coach-fname">Coach First Name:</label>
                    <input type="text" id="team2-coach-fname" name="team2_coach_fname" required><br><br>
                    <label for="team2-coach-lname">Coach Last Name:</label>
                    <input type="text" id="team2-coach-lname" name="team2_coach_lname" required><br><br>
                    <label for="team2-coach-email">Coach Email:</label>
                    <input type="text" id="team2-coach-email" name="team2_coach_email" required><br><br>
                    <label for="team2-coach-phone">Coach Phone:</label>
                    <input type="text" id="team2-coach-phone" name="team2_coach_phone" required><br><br>
                </td>
            </tr>
        </table>
        <div class="submit-container"> <input type="submit" value="Submit"> </div>
    </form>

</body>

</html>
