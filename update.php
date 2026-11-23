
<?php
// Start session
session_start();

// Check login session
if (!isset($_SESSION['matric'])) {
    header("Location: login.php");
    exit();
}

// Connect to database
$conn = new mysqli("localhost", "root", "", "Lab_5b");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
$matric = "";

// Check if the update form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $matric = $_POST['matric'];
    $name = trim($_POST['name']);
    $role = $_POST['role'];

    // Update user information
    $stmt = $conn->prepare(
        "UPDATE users SET name = ?, role = ? WHERE matric = ?"
    );

    $stmt->bind_param("sss", $name, $role, $matric);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();

        header("Location: users.php");
        exit();
    } else {
        $message = "Update failed. Please try again.";
        $stmt->close();
    }

} else {

    // Get matric number from URL
    $matric = $_GET['matric'] ?? '';

    // Retrieve selected user
    $stmt = $conn->prepare(
        "SELECT matric, name, role FROM users WHERE matric = ?"
    );

    $stmt->bind_param("s", $matric);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
    } else {
        $stmt->close();
        $conn->close();
        die("User not found.");
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="form-container">

        <h2>Update User</h2>

        <form method="POST" action="update.php">

            <label>Matric:</label>
            <input type="text" name="matric"
                   value="<?php echo htmlspecialchars($user['matric'] ?? $matric); ?>"
                   readonly>

            <label>Name:</label>
            <input type="text" name="name"
                   value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>"
                   maxlength="100" required>

            <label>Access Level:</label>
            <select name="role" required>
                <option value="student"
                    <?php if (($user['role'] ?? '') == 'student') echo 'selected'; ?>>
                    student
                </option>

                <option value="lecturer"
                    <?php if (($user['role'] ?? '') == 'lecturer') echo 'selected'; ?>>
                    lecturer
                </option>
            </select>

            <button type="submit">Update</button>

            <p class="cancel-link">
                <a href="users.php">Cancel</a>
            </p>

        </form>

        <p class="message error">
            <?php echo htmlspecialchars($message); ?>
        </p>

    </div>

</body>
</html>

<?php
$conn->close();
?>
