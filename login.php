
<?php
session_start();


// Connect to the database
$conn = new mysqli("localhost", "root", "", "Lab_5b");

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";

// Check whether the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get matric number and password
    $matric = trim($_POST['matric']);
    $password = $_POST['password'];

    // Retrieve user information from database
    $stmt = $conn->prepare(
        "SELECT matric, name, password, role FROM users WHERE matric = ?"
    );

    $stmt->bind_param("s", $matric);
    $stmt->execute();

    $result = $stmt->get_result();

    // Check whether the user exists
    if ($result->num_rows == 1) {

        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {

            // Store user information in session
            session_regenerate_id(true);
            $_SESSION['matric'] = $user['matric'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            // Redirect to users page
            header("Location: users.php");
            exit();

        } else {
            $error = "Invalid username or password, try login again.";
        }

    } else {
        $error = "Invalid username or password, try login again.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>

    <!-- Link to external CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="form-container">

        <h2>User Login</h2>

        <form method="POST" action="">

            <label>Matric:</label>
            <input type="text" name="matric" maxlength="10" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>

        </form>

        <!-- Display error message -->
        <?php if ($error != "") { ?>
            <p class="message error">
                <?php echo htmlspecialchars($error); ?>
            </p>
        <?php } ?>

        <p class="register-link">
            <a href="register.php">Register</a> here if you have not.
        </p>

    </div>

</body>
</html>
