<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard | Task Monitoring</title>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../Login/Login.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</head>

<body>
<?php
     // Start the session
     session_start();

     // Initialize an empty variable to store the username
     $username = '';
     $imageData = '';
 
     // Check if the username session exists
     if (isset($_SESSION['username'])) {
         // Retrieve the username from the session
         $username = $_SESSION['username'];
     }
     $conn = new PDO("mysql:host=localhost;dbname=taskmonitoring", "root", "");
     $conn = new PDO("mysql:host=localhost;dbname=taskmonitoring", "root", "");
     $query = "SELECT avatar FROM usercredential WHERE username = :username";
     $stmt = $conn->prepare($query);
     $stmt->bindParam(':username', $username);
     $stmt->execute();
     $result = $stmt->fetch(PDO::FETCH_ASSOC);
 
     // Save the image data if it exists
     if ($result && !empty($result['avatar'])) {
         $imageData = $result['avatar'];
     }

        include "../include/Usersidebar.php";
    ?>
  
</body>

</html>