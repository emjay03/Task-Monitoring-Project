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
    $user_id = '';
    $imageData = '';

    // Check if the username session exists
    if (isset($_SESSION['user_id'])) {
        // Retrieve the username from the session
        $user_id = $_SESSION['user_id'];
    }

    $conn = new PDO("mysql:host=localhost;dbname=taskmonitoring", "root", "");
    $query = "SELECT avatar FROM usercredential WHERE user_id = :user_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Save the image data if it exists
    if ($result && !empty($result['avatar'])) {
        $imageData = $result['avatar'];
    }

    $query = "SELECT * FROM taskassign WHERE user_id = :user_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $totalRowCount = 0; // Initialize the variable

    $countQuery = "SELECT COUNT(*) FROM taskassign where user_id = :user_id";
    $countStmt = $conn->prepare($countQuery);
    $countStmt->bindParam(':user_id', $user_id);
    if ($countStmt) {
        $countStmt->execute();
        $totalRowCount = $countStmt->fetchColumn();
    }

    include "../include/Usersidebar.php";
?>

 
<div class="p-4 sm:ml-64">
    <div class="  p-4 w-full flex-row gap-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
          <li class="inline-flex items-center">
            <a href="./Headdashboard.php" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
              <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
              </svg>
              Home
            </a>
          </li>
          <li>
            <div class="flex items-center">
              <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
              </svg>
              <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Task Assign</a>
            </div>
          </li>

        </ol>
      </nav>
      <div class="py-2"></div>
    <div class=" taskTableContainer grid grid-cols-3 gap-4  ">
            
            <?php foreach ($tasks as $task) : ?>
            <div class="taskItem block w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                
                    <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?php echo $task['taskid']; ?></h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400"><?php echo $task['subject']; ?></p>
                    <div class="py-2"></div>
                    <p class="font-normal text-gray-700 dark:text-gray-400"><?php echo $task['task']; ?></p>
             
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

 
<script>
    // Function to update the task table using AJAX
    function updateTaskTable() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var taskTableContainer = document.querySelector(".taskTableContainer");

      // Clear existing task items
      while (taskTableContainer.firstChild) {
        taskTableContainer.firstChild.remove();
      }

      // Parse the response text as HTML
      var parser = new DOMParser();
      var responseDoc = parser.parseFromString(this.responseText, "text/html");

      // Get the task items from the parsed HTML
      var taskItems = responseDoc.querySelectorAll(".taskItem");

      // Append each task item to the task table container
      taskItems.forEach(function(taskItem) {
        taskTableContainer.appendChild(taskItem);
      });
    }
  };
  xhttp.open("GET", "./Userdashboard.php", true);
  xhttp.send();
}


updateTaskTable();
setInterval(updateTaskTable, 1000);


</script>
  
 
 
 
</body>

</html>