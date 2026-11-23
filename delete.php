
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

// Check whether a matric number was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['matric'])) {

    $matric = $_POST['matric'];

    // Delete selected user
    $stmt = $conn->prepare(
        "DELETE FROM users WHERE matric = ?"
    );

    $stmt->bind_param("s", $matric);
    $stmt->execute();

    $stmt->close();
}

// Return to User Records page
$conn->close();

header("Location: users.php");
exit();
?>

