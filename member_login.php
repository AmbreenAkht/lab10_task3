<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>VIP Member - Log-in</title>
    <link rel="stylesheet" href="vip.css">
</head>
<body>
    <div class="container">
        <h1>VIP Member Log-in</h1>
        <h2>Log-in Form</h2>
        <form method="post" action="member_login.php">
            <fieldset>
                <legend>Member Log-in</legend>
                <div class="form-group">
                    <label for="memId">Member ID:</label>
                    <input type="text" name="memId" id="memId" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name:</label>
                    <input type="text" name="lastname" id="lastname" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Log In">
                </div>
            </fieldset>
        </form>
        <hr>
        <?php
        if (isset($_POST["lastname"]) && isset($_POST["memId"])) {
            $lname = trim($_POST["lastname"]);
            $memId = trim($_POST["memId"]);
            if (!empty($lname) && !empty($memId)) {
                require_once('settings.php');
                $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
                if (!$conn) {
                    echo "<p class=\"error\">Database connection failure</p>";
                } else {
                    $sql_table = "vipmembers";
                    $query = "SELECT member_id, firstname, lastname, email FROM $sql_table WHERE member_id = '$memId' AND lastname = '$lname' ORDER BY lastname, firstname";
                    $result = mysqli_query($conn, $query);
                    if (!$result) {
                        echo "<p class=\"error\">Something is wrong with the query: $query</p>";
                    } else {
                        if (mysqli_num_rows($result) > 0) {
                            echo "<table>";
                            echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th></tr>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>{$row["member_id"]}</td>";
                                echo "<td>{$row["firstname"]}</td>";
                                echo "<td>{$row["lastname"]}</td>";
                                echo "<td>{$row["email"]}</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            echo "<p><a href='vip_member.html'>Go to VIP Member Homepage</a></p>";
                            mysqli_free_result($result);
                        } else {
                            echo "<p class=\"info\">Invalid member ID or last name.</p>";
                        }
                    }
                    mysqli_close($conn);
                }
            } else {
                echo "<p class=\"info\">Please enter both member ID and last name.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
