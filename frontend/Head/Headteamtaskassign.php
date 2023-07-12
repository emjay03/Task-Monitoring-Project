<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Head Task Assign | Task Monitoring</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../Login/Login.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</head>

<body>
  <?php
  session_start();  

  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
  }
  $conn = new PDO("mysql:host=localhost;dbname=taskmonitoring", "root", "");
  
    $query = "SELECT * FROM usercredential WHERE username = :username";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && !empty($result['avatar'])) {
        $imageData = $result['avatar'];
    }
  

  //insert data to database 
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userid = $_POST['userid'] ?? ''; // Empty value
    $taskid = $_POST['taskid'] ?? ''; // Empty value
    $subject = $_POST['subject'] ?? ''; // Empty value
    $task = $_POST['task'] ?? ''; // Empty value
    $role = $_POST['role'] ?? ''; // Empty value
    $status = $_POST['status'] ?? ''; // Empty value

    if (!empty($userid) || !empty($subject)) {
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


  //query for task assign where role is documentation and frontend
  $query = "SELECT * FROM taskassign WHERE role='Documentation' OR role='Frontend'";
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
  
  if (isset($_POST['update_taskid']) && isset($_POST['update_task'])) {
    $taskid = $_POST['update_taskid'];
    $updatedTask = $_POST['update_task'];
  
    $updateQuery = "UPDATE taskassign SET task=:task WHERE taskid=:taskid";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bindParam(':task', $updatedTask);
    $updateStmt->bindParam(':taskid', $taskid);
    $updateStmt->execute();
    header("Location: ./Headteamtaskassign.php");
    exit();
  }

  if (isset($_POST['taskid'])) {
    // Generate the task ID
    $prefix = "Task_";
    $query = "SELECT MAX(RIGHT(taskid, 2)) AS max_id FROM taskassign";
    $result = $conn->query($query)->fetch(PDO::FETCH_ASSOC);
    $max_id = $result['max_id'];
    $next_id = str_pad((intval($max_id) + 1), 2, '0', STR_PAD_LEFT);
    $taskid = $prefix . $next_id;
  
    // Retrieve other form values
    $taskid = $_POST['taskid'];
  }
  include "../include/Headsidebar.php";
  ?>






  <div class="p-4 sm:ml-64">
    <div class="p-4 w-full flex-row  gap-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">



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


      <!-- Modal toggle -->
      <div class="py-2"></div>
      <button data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
        Add
      </button>
      <div class="py-2"></div>
      <!-- Main modal -->
      <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                Task Assign
              </h3>
              <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
              </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
              <form action="./Headteamtaskassign.php" method="POST">
                <div class="flex gap-2  w-full">
                  <div class="mb-6   w-full">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User ID</label>

                    <select id="userid" name="userid" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <?php foreach ($credentialresult as $row) : ?>
    <option value="<?php echo $row['user_id']; ?>"><?php echo $row['user_id']; ?></option>
  <?php endforeach; ?>
                    </select>


                  </div>
                

                  <div class="mb-6 w-full">
    <label for="taskid" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Task ID</label>
    <input type="text" id="taskid" name="taskid" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   required >
  </div>
                </div>
                <div class="mb-6 w-full">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subject</label>
                    <input type="text" id="subject" name="subject" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                  </div>
                <div class="mb-6">
                  <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Task</label>
                  <textarea rows="4" type="text" id="task" name="task" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
                </div>
                <div class="mb-6">
                  <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                  <input type="text" id="role" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>

                <div class="mb-6">
                  <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                  <input type="text" id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </div>
              </form>
            </div>


          </div>
        </div>
      </div>

      <div class="grid grid-cols-3 w-full gap-4  ">
        <?php foreach ($result as $row) : ?>
          <div class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
           <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?php echo $row['user_id']; ?></h5>
           <p class="font-normal text-gray-700 dark:text-gray-400"><?php echo $row['taskid']; ?></p> 
           <p class="font-normal text-gray-700 dark:text-gray-400"><?php echo $row['subject']; ?></p>
           <p class="font-normal text-gray-700 dark:text-gray-400"><?php echo $row['task']; ?></p>
            <form action="./Headteamtaskassign.php" method="GET">
        <input type="hidden" name="delete_taskid" value="<?php echo $row['taskid']; ?>">
        <button type="submit" onclick="return confirm('Are you sure you want to delete this task assignment?')">Delete</button>
      </form>

      <!-- Modal toggle -->
<button data-modal-target="updateModal" data-modal-toggle="updateModal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
  Toggle modal
</button>

<!-- Main modal -->
<div id="updateModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Terms of Service
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="updateModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
            <form action="./Headteamtaskassign.php" method="POST">
        <input type="text" name="update_taskid" value="<?php echo $row['taskid']; ?>">
        <div class="mb-6 w-full">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subject</label>
                    <input type="text" id="update_task" name="udpate_task" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $row['task']; ?>">
                  </div>
 

        <button type="submit">Update</button>
      </form>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="updateModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                <button data-modal-hide="updateModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
            </div>
        </div>
    </div>
</div>
      
   


          </div>
         
        <?php endforeach; ?>
      </div>





    </div>
  </div>
  <script>
  const userIdDropdown = document.getElementById('userid');
  const roleInput = document.getElementById('role');

  userIdDropdown.addEventListener('change', () => {
    const selectedUserId = userIdDropdown.value;
    // Find the corresponding credential for the selected user ID
    const selectedCredential = <?php echo json_encode($credentialresult); ?>.find(row => row.user_id === selectedUserId);

    if (selectedCredential) {
      // Set the role input field value based on the selected credential
      roleInput.value = selectedCredential.role;
    } else {
      // If no credential found, clear the role input field
      roleInput.value = '';
    }
  });
</script>
</body>

</html>