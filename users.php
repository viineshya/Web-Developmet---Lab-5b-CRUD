
<?php
// Start session
session_start();

// Check whether the user is logged in
if (!isset($_SESSION['matric'])) {
    header("Location: login.php");
    exit();
}

// Connect to database
$conn = new mysqli("localhost", "root", "", "Lab_5b");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve users
$sql = "SELECT matric, name, role FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Records</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="table-container">

        <h2>User Records</h2>
		
		<p>
			Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!
			<a href="logout.php">Logout</a>
        </p>

        <table class="user-table">

            <tr>
                <th>Matric</th>
                <th>Name</th>
                <th>Level</th>
                <th>Action</th>
            </tr>

            <?php
            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
            ?>

                <tr>
                    <td><?php echo htmlspecialchars($row['matric']); ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['role']); ?></td>

                    <td>
                        <a class="update-link"
                           href="update.php?matric=<?php echo urlencode($row['matric']); ?>">
                           Update
                        </a>

                        <form method="POST" action="delete.php"
                              class="delete-form"
                              onsubmit="return confirm('Are you sure you want to delete this user?');">

                            <input type="hidden" name="matric"
                                   value="<?php echo htmlspecialchars($row['matric']); ?>">

                            <button type="submit" class="delete-button">
                                Delete
                            </button>

                        </form>
                    </td>
                </tr>

            <?php
                }

            } else {
                echo "<tr><td colspan='4'>No users found.</td></tr>";
            }
            ?>

        </table>

    </div>

</body>
</html>

<?php
$conn->close();
?>
