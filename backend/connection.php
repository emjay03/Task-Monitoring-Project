<?php

//database_connection 
$servername = "localhost";
$username = "root";
$password = "";
$database = "taskmonitoring";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to the database successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

//check if the user exists in the database
//login conncetion 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_POST["user_id"];
    $password = $_POST["password"];

    // Query the database to check if the user exists
    $query = "SELECT * FROM usercredential WHERE user_id = :user_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verify the password
        if ($password === $user["password"]) {
            // Password is correct
            session_start();
            $_SESSION['user_id'] = $user_id;
    
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
