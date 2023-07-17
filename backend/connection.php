<?php

//database_connection 
$servername = "localhost";
$username = "root";
$password = "";
$database = "taskmonitoring";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
//session start userid 
session_start();
$user_id = '';
$username = '';
$imageData = '';
$role = '';

 
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
   
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
 

//Headteamtaskassign.php
//query select for usercredential avatar 
$query = "SELECT * FROM usercredential WHERE user_id = :user_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
if ($result && !empty($result['avatar'])) {
    $imageData = $result['avatar'];
}
if ($result) {
    $userid = $result['user_id'];
    $role = $result['role'];
    $username = $result['username'];
}


 //query for task assign where role is documentation and frontend
 $query = "SELECT taskassign.*,usercredential.avatar,usercredential.username
 FROM taskassign
JOIN usercredential ON taskassign.user_id = usercredential.user_id
 WHERE taskassign.role='Documentation' OR taskassign.role='Frontend'";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
//insert query table taskassign 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userid = $_POST['userid'] ?? ''; // Empty value
    $taskid = $_POST['taskid'] ?? ''; // Empty value
    $subject = $_POST['subject'] ?? ''; // Empty value
    $task = $_POST['task'] ?? ''; // Empty value
    $role = $_POST['role'] ?? ''; // Empty value
    $status = $_POST['status'] ?? ''; // Empty value
    if (!empty($userid) || !empty($subject) || !empty($task) || !empty($role) || !empty($status)) {
        $insertQuery = "INSERT INTO taskassign (user_id,taskid, subject,task,role,status) VALUES (:userid,:taskid, :subject,:task,:role,:status)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bindParam(':userid', $userid);
        $insertStmt->bindParam(':taskid', $taskid);
        $insertStmt->bindParam(':subject', $subject);
        $insertStmt->bindParam(':task', $task);
        $insertStmt->bindParam(':role', $role);
        $insertStmt->bindParam(':status', $status);
        $insertStmt->execute();
        header("Location: ./Headteamtaskassign.php");
        exit();
    }
}


 
 
//query for usercredential where role is documentation and frontend
$credentialquery = "SELECT * FROM usercredential WHERE role='Documentation' OR role='Frontend'";
$credentialstmt = $conn->prepare($credentialquery);
$credentialstmt->execute();
$credentialresult = $credentialstmt->fetchAll(PDO::FETCH_ASSOC);
    

//query delete for task assign where role is documentation and frontend
if (isset($_GET['delete_taskid'])) {
    $taskid = $_GET['delete_taskid'];

    $deleteQuery = "DELETE FROM taskassign WHERE taskid=:taskid";
    $deleteStmt = $conn->prepare($deleteQuery);
    $deleteStmt->bindParam(':taskid', $taskid);
    $deleteStmt->execute();
    header("Location:  ./Headteamtaskassign.php ");
    
    exit();
  }

 
//query update for task assign where role is documentation and frontend
if (isset($_POST['update_taskid']) && isset($_POST['update_task'])) {
    $taskid = $_POST['update_taskid'];
    $subject = $_POST['update_subject'];
    $updatedTask = $_POST['update_task'];
    $updatedStatus = $_POST['update_status'];
    $updateQuery = "UPDATE taskassign SET  subject=:subject,task=:task,status=:status WHERE taskid=:taskid";
    $updateStmt = $conn->prepare($updateQuery);

    $updateStmt->bindParam(':subject', $subject);
    $updateStmt->bindParam(':task', $updatedTask);
    $updateStmt->bindParam(':status', $updatedStatus);
    $updateStmt->bindParam(':taskid', $taskid);
    $updateStmt->execute();
    header("Location: ./Headteamtaskassign.php");
    exit();
}


//query count for task assign
$totalRowCount = 0; // Initialize the variable
$countQuery = "SELECT COUNT(*) FROM taskassign";
$countStmt = $conn->prepare($countQuery);
if ($countStmt) {
    $countStmt->execute();
    $totalRowCount = $countStmt->fetchColumn();
}


 //query update for usercredential
 if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $updateusername = $_POST['updateusername'];
    $updatepassword = $_POST['updatepassword'];
    $confirmpassword = $_POST['confirmpassword'];

    $avatar = $_FILES['avatar']['tmp_name'];

    if ($updatepassword === $confirmpassword) {
        $updatequery = "UPDATE usercredential SET username=:updateusername,avatar=:avatar,password=:updatepassword,confirmpassword=:confirmpassword WHERE user_id=:userid";
        $updatestmt = $conn->prepare($updatequery);
        $updatestmt->bindParam(':updateusername', $updateusername);
        $updatestmt->bindParam(':avatar', $avatar);
        $updatestmt->bindParam(':updatepassword', $updatepassword);
        $updatestmt->bindParam(':confirmpassword', $confirmpassword);
        $updatestmt->bindParam(':userid', $userid);
        $updatestmt->execute();

        //retrive the updated username and avatar
        $query = "SELECT * FROM usercredential WHERE user_id = :userid";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':userid', $userid);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $username = $result['username'];
            $imageData = $result['avatar'];
            // Update the session with the new username
            $_SESSION['username'] = $username;
        }

        exit(header("Location: ./Headsetting.php"));
    } else {
        echo "password not match";
    }



}
 
?>