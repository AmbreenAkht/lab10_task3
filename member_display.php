<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>VIP Member - Display Members</title>
    <link rel="stylesheet" href="vip.css">
</head>
<body>
    <div class="container">
        <h1>VIP Member Display</h1>
        <?php
        // Include your database settings file
        require_once('settings.php');
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
        if (!$conn) {
            echo "<p>Database connection failure</p>";
        } else {
            $sql_table = "vipmembers";
            $query = "SELECT member_id, firstname, lastname FROM $sql_table ORDER BY lastname, firstname";
            $result = mysqli_query($conn, $query);
            if (!$result) {
                echo "<p>Something is wrong with the query: $query</p>";
            } else {
                echo "<table>";
                echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row["member_id"]}</td>";
                    echo "<td>{$row["firstname"]}</td>";
                    echo "<td>{$row["lastname"]}</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "<p><a href='vip_member.html'>Go to VIP Member Homepage</a></p>";
                mysqli_free_result($result);
            }
            mysqli_close($conn);
        }
        ?>
    </div>
</body>
</html>
