<?php
include "./connection.php";
 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query the database to check if the user exists
    $query = "SELECT * FROM usercredential WHERE username = :username";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verify the password
        if ($password === $user["password"]) {
            // Password is correct
            session_start();
            $_SESSION['username'] = $username;
    
            // Check the user role
            $role = $user["role"];
            if ($role === "admin") {
                // Redirect to the head admin dashboard
                header("Location: ../frontend/Head/Headdashboard.php");
                exit();
            } else {
                // Redirect to the normal user dashboard
                header("Location: ../frontend/Team/Userdashboard.php");
                exit();
            }
        } else {
            // Invalid password
            echo "Invalid password";
        }
    } else {
        // User does not exist
        echo "User not found";
    }
}
?>
