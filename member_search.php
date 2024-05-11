<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>VIP Member - Search Members</title>
    <link rel="stylesheet" href="vip.css">
</head>
<body>
    <div class="container">
        <h1>VIP Member Search</h1>
        <h2>Search Data Form</h2>
        <form method="post" action="member_search.php">
            <fieldset>
                <legend>Member Search</legend>
                <div class="form-group">
                    <label for="lastname">Last Name:</label>
                    <input type="text" name="lastname" id="lastname">
                </div>
                <div class="form-group">
                    <input type="submit" value="Search for Member">
                </div>
                <p><a href="vip_member.html" >Go to VIP Member Homepage</a></p>
            </fieldset>
        </form>
        <hr>
        <?php
        if (isset($_POST["lastname"])) {
            $lname = trim($_POST["lastname"]);
            if (!empty($lname)) {
                // Include your database settings file
                require_once('settings.php');
                $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
                if (!$conn) {
                    echo "<p class=\"error\">Database connection failure</p>";
                } else {
                    $sql_table = "vipmembers";
                    $query = "SELECT member_id, firstname, lastname, email FROM $sql_table WHERE lastname LIKE '$lname%' ORDER BY lastname, firstname";
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
                            mysqli_free_result($result);
                        } else {
                            echo "<p class=\"info\">No members found.</p>";
                        }
                    }
                    mysqli_close($conn);
                }
            } else {
                echo "<p class=\"info\">Please enter a last name to search.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
