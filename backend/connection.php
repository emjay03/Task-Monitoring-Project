<?php

//database_connection 
$servername = "localhost";
$username = "root";
$password = "";
$database = "taskmonitoring";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

session_start();

$username = '';
$user_id = '';
$imageData = '';
$role = '';
$error_message = '';
$success_message='';
$taskAssigned = false;
$taskOngoing= false;
 
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}
 

//check if the user exists in the database
//login conncetion 
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["user_id"]) && isset($_POST["password"])) {
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

  

$query = "SELECT * FROM usercredential Where role='Documentation' OR role='Frontend' OR role='Backend'OR role='UI/UX Designer'OR role='Database Designer'OR role='QA Tester'OR role='Content Creator'OR role='Business Analyst'";
$stmt = $conn->prepare($query);
$stmt->execute();
$allUserData = $stmt->fetchAll(PDO::FETCH_ASSOC);


 
  //insert data to database 
 if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['action'])) {
        // Delete user by user_id
        if ($_POST['action'] === 'delete' && isset($_POST['user_id'])) {
            $user_id = $_POST['user_id'];

            // Perform the delete query
            $deleteQuery = "DELETE FROM usercredential WHERE user_id = :user_id";
            $deleteStmt = $conn->prepare($deleteQuery);
            $deleteStmt->bindParam(':user_id', $user_id);
            $deleteStmt->execute();

            header("Location: ./HeadTeammember.php");
            exit();
        }elseif ($_POST['action'] === 'update' && isset($_POST['user_id'])) {
            $user_id = $_POST['user_id'];

            // Update data in the database
            $username = $_POST['username'] ?? '';
            $password = $_POST['passwordupdate'] ?? ''; // Update the name of the textarea input
            $role = $_POST['roleupdate'] ?? ''; // Update the name of the textarea input

            // Check if the user wants to update the avatar
            $avatar = $_FILES['avatar']['tmp_name'] ?? '';
            $imageData = null;
            if (!empty($avatar)) {
                // Read the binary image data from the uploaded file
                $imageData = file_get_contents($avatar);
            }

            // Build the update query based on whether the user wants to update the avatar or not
            if (empty($imageData)) {
                $updateQuery = "UPDATE usercredential SET username = :username, password = :password, role = :role WHERE user_id = :user_id";
            } else {
                $updateQuery = "UPDATE usercredential SET username = :username, avatar = :avatar, password = :password, role = :role WHERE user_id = :user_id";
            }

            $updateuseracc = $conn->prepare($updateQuery);
            $updateuseracc->bindParam(':user_id', $user_id);
            $updateuseracc->bindParam(':username', $username);
            if (!empty($imageData)) {
                $updateuseracc->bindParam(':avatar', $imageData, PDO::PARAM_LOB); // Use PARAM_LOB to handle binary data
            }
            $updateuseracc->bindParam(':password', $password);
            $updateuseracc->bindParam(':role', $role);
            $updateuseracc->execute();

            header("Location: ./HeadTeammember.php");
            exit();
        }
    } else {
        // Insert data to database
        $user_id = $_POST['user_id'] ?? ''; // Empty value
        $avatar = $_FILES['avatar']['tmp_name'] ?? ''; // Empty value - get the temporary filename
        $username = $_POST['username'] ?? ''; // Empty value
        $password = $_POST['password'] ?? ''; // Empty value
        $role = $_POST['role'] ?? ''; // Empty value

        if (!empty($user_id)) {
            // Perform the file upload
            if (!empty($avatar)) {
                // Read the binary image data from the uploaded file
                $imageData = file_get_contents($avatar);
            } else {
                // Set a default image data if no avatar is uploaded
                $imageData = file_get_contents('default_avatar.jpg'); // Provide the path to your default avatar image
            }

            // Insert data into the database
            $insertQuery = "INSERT INTO usercredential (user_id, username, avatar, password, role) VALUES (:user_id, :username, :avatar, :password, :role)";
            $insertuseracc = $conn->prepare($insertQuery);
            $insertuseracc->bindParam(':user_id', $user_id);
            $insertuseracc->bindParam(':username', $username);
            $insertuseracc->bindParam(':avatar', $imageData, PDO::PARAM_LOB); // Use PARAM_LOB to handle binary data
            $insertuseracc->bindParam(':password', $password);
            $insertuseracc->bindParam(':role', $role);
            $insertuseracc->execute();

            header("Location: ./HeadTeammember.php");
            exit();
        }
    }
}

$query = "SELECT * FROM usercredential WHERE user_id = :user_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);


if ($result) {
    $user_id = $result['user_id'];
    $username = $result['username'];
    $roles = $result['role'];
}
if ($result && !empty($result['avatar'])) {
    $imageData = $result['avatar'];
}
//update data to database
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the required keys are present in $_POST array
    if (isset($_POST['updateusername'], $_POST['updatepassword'], $_POST['confirmpassword'])) {
        // Get other form data
        $updateusername = $_POST['updateusername'];
        $updatepassword = $_POST['updatepassword'];
        $confirmpassword = $_POST['confirmpassword'];

        // Check if avatar file was uploaded successfully
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $avatar = $_FILES['avatar']['tmp_name'];

            // Read the binary image data from the uploaded file
            $imageData = file_get_contents($avatar);

            // Prepare the update query with the image data
            $updatequery = "UPDATE usercredential SET username=:updateusername, avatar=:avatar_data, password=:updatepassword, confirmpassword=:confirmpassword WHERE user_id=:user_id";
            $updatestmt = $conn->prepare($updatequery);
            $updatestmt->bindParam(':updateusername', $updateusername);
            $updatestmt->bindParam(':avatar_data', $imageData, PDO::PARAM_LOB); // Use PARAM_LOB to handle binary data
            $updatestmt->bindParam(':updatepassword', $updatepassword);
            $updatestmt->bindParam(':confirmpassword', $confirmpassword);
            $updatestmt->bindParam(':user_id', $user_id);

            if ($updatestmt->execute()) {
                // The update was successful, set the success message
                $success_message = 'Update successful!';

                // Determine the redirect location based on the user's role
                if ($role === 'admin') {
                    header("Location: ../../frontend/Head/Headsetting.php");
                } else {
                    header("Location: ../../frontend/Team/Usersetting.php");
                }
                exit; // Important: Always exit after a redirect to prevent further execution of the script
            } else {
                $error_message = "Error updating data.";
            }
        } else {
            $error_message = "Error uploading the avatar.";
        }
    } else {
        $error_message = "Some data is missing.";
    }
}





  //insert data to database 
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userid = $_POST['userid'] ?? ''; // Empty value
    $taskid = $_POST['taskid'] ?? ''; // Empty value
    $subject = $_POST['subject'] ?? ''; // Empty value
    $task = $_POST['task'] ?? ''; // Empty value
    $role = $_POST['role'] ?? ''; // Empty value
    $status = $_POST['status'] ?? ''; // Empty value
    $date_time_taskassign = $_POST['date_time_taskassign'] ?? '';
    

    if (!empty($userid) )   {
      $insertQuery = "INSERT INTO taskassign (user_id,taskid, subject,task,role,status,date_time_taskassign) VALUES (:userid,:taskid, :subject,:task,:role,:status,:date_time_taskassign)";

      $insertStmt = $conn->prepare($insertQuery);
      $insertStmt->bindParam(':userid', $userid);
      $insertStmt->bindParam(':taskid', $taskid);
      $insertStmt->bindParam(':subject', $subject);
      $insertStmt->bindParam(':task', $task);
      $insertStmt->bindParam(':role', $role);
      $insertStmt->bindParam(':status', $status);
    $insertStmt->bindParam(':date_time_taskassign', $date_time_taskassign);
    
      $insertStmt->execute();
      header("Location: ./Headteamtaskassign.php");
      exit();
    }
  }

  
 
  //query for dropdown list 
  $credentialquery = "SELECT * FROM usercredential Where role='Documentation' OR role='Frontend' OR role='Backend'OR role='UI/UX Designer'OR role='Database Designer'OR role='QA Tester'OR role='Content Creator'OR role='Business Analyst'";
  $credentialstmt = $conn->prepare($credentialquery);
  $credentialstmt->execute();
  $credentialresult = $credentialstmt->fetchAll(PDO::FETCH_ASSOC);

  $query = "SELECT MAX(taskid) AS max_id FROM taskassign";
  try {
      $stmt = $conn->query($query);
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $maxID = $row['max_id'];
      // Extract the numeric part of the Task ID to use for auto-increment
      $currentNum = (int)substr($maxID, strlen("Task_"));
  } catch (PDOException $e) {
      die("Error: " . $e->getMessage());
  }
    //query select taskassign join usercredential where role is documentation or frontend
    $query = "SELECT taskassign.*,usercredential.avatar,usercredential.username
    FROM taskassign
   JOIN usercredential ON taskassign.user_id = usercredential.user_id
    WHERE taskassign.role='Documentation' OR taskassign.role='Frontend' OR taskassign.role='Backend'OR taskassign.role='UI/UX Designer'OR taskassign.role='Database Designer'OR taskassign.role='QA Tester'OR taskassign.role='Content Creator'OR taskassign.role='Business Analyst'";
   $stmt = $conn->prepare($query);
   $stmt->execute();
   $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

   
  //query delete for task assign where role is documentation and frontend
  if (isset($_GET['delete_taskid'])) {
    $taskid = $_GET['delete_taskid'];

    $deleteQuery = "DELETE FROM taskassign WHERE taskid=:taskid";
    $deleteStmt = $conn->prepare($deleteQuery);
    $deleteStmt->bindParam(':taskid', $taskid);
    $deleteStmt->execute();
    header("Location: ./Headteamtaskassign.php");
    exit();
  }
   


  

  if (isset($_POST['update_taskid']) ) {
    $taskid = $_POST['update_taskid'];
    $updatesubject = $_POST['update_subject'];
    $updatestatus = $_POST['update_status'];
    $updatedTask = $_POST['update_task'];
    $updatedate_time_task_start = $_POST['updatedate_time_task_start'];
    $updatedate_time_task_end = $_POST['updatedate_time_task_end'];
    


    // Perform the database update operation
    // Assuming you have a database connection established
    $updateQuery = "UPDATE taskassign SET subject=:subject,task=:task,status=:status,date_time_task_start=:date_time_task_start,date_time_task_end=:date_time_task_end WHERE taskid=:taskid";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bindParam(':subject', $updatesubject);
    $updateStmt->bindParam(':task', $updatedTask);
    $updateStmt->bindParam(':status', $updatestatus);
    $updateStmt->bindParam(':date_time_task_start', $updatedate_time_task_start);
    $updateStmt->bindParam(':date_time_task_end', $updatedate_time_task_end);
    $updateStmt->bindParam(':taskid', $taskid);
    $updateStmt->execute();

    // Redirect to the desired page after the update
      if ($roles ==='admin') {
                    header("Location: ./Headteamtaskassign.php");

                    
                } else {
                  
                    header("Location: ./Userdashboard.php");
                   
                }
  }

    
  
  $totalRowCount = 0; // Initialize the variable

  $countQuery = "SELECT COUNT(*) FROM taskassign where user_id = :user_id";
  $countStmt = $conn->prepare($countQuery);
  $countStmt->bindParam(':user_id', $user_id);
  if ($countStmt) {
      $countStmt->execute();
      $totalRowCount = $countStmt->fetchColumn();
  }
