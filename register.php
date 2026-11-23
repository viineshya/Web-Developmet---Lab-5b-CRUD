

<?php

// Connect to the database
$conn = new mysqli("localhost", "root", "", "Lab_5b");

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

// Check whether the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $matric = trim($_POST['matric']);
    $name = trim($_POST['name']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare(
        "INSERT INTO users (matric, name, password, role)
         VALUES (?, ?, ?, ?)"
    );

    $stmt->bind_param("ssss", $matric, $name, $hashedPassword, $role);

    if ($stmt->execute()) {
        $message = "Registration successful!";
    } else {
        $message = "Registration failed. Matric number may already exist.";
    }

    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>

    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="form-container">

        <h2>User Registration</h2>

        <form method="POST" action="">

            <label>Matric:</label>
            <input type="text" name="matric"
                   maxlength="10" required>

            <label>Name:</label>
            <input type="text" name="name"
                   maxlength="100" required>

            <label>Password:</label>
            <input type="password" name="password"
                   required>

            <label>Role:</label>
            <select name="role" required>
                <option value="">Please select</option>
                <option value="student">Student</option>
                <option value="lecturer">Lecturer</option>
            </select>

            <button type="submit">Register</button>

        </form>

        <!-- Display registration message -->
        <p class="message">
            <?php echo htmlspecialchars($message); ?>
        </p>

    </div>

</body>
</html>

<?php
$conn->close();
?>
