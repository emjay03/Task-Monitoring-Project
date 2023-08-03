<?php
  include "../../backend/connection.php";
 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Head Task Assign | Task Monitoring</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../Login/Login.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
  <script src="../taskmonitoring.js"></script>
</head>

<body>



<?php
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
                    <input type="text" id="taskid" name="taskid" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                  </div>
                </div>
                <div class="mb-6 w-full">
                  <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subject</label>
                  <input type="text" id="subject" name="subject" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="mb-6">
                  <label   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Task</label>
                  <textarea rows="4" type="text" id="task" name="task" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
                </div>
                <div class="mb-6">
                  <label   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                  <input type="text" id="role" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

                <div class="mb-6">
                  <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                  <input type="text" id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="pending" readonly>
                </div>
                <div class="mb-6">
                  <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date task assign</label>
                  <input type="datetime-local" id="date_time_taskassign" name="date_time_taskassign" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </div>
              </form>
            </div>


          </div>
        </div>
      </div>

      <div class="taskTableContainer grid  grid-cols-1 lg:grid-cols-3  w-full gap-4">

        <?php foreach ($result as $row) : ?>

          <div class=" taskItem  block w-full p-6 bg-yellow-100 border  rounded-lg    dark:bg-gray-800 dark:border-gray-700  ">
            <div class="flex justify-between gap-2 items-center">
              <div class="flex items-center gap-2">
                <?php if ($row['avatar']) : ?>
                  <img class="w-7 h-7 rounded-full" src="data:image/jpeg;base64,<?php echo base64_encode($row['avatar']); ?>" alt="User Avatar" class="rounded-full w-16 h-16">
                <?php else : ?>
                  <span>No Avatar</span>
                <?php endif; ?>
                <h5 class=" text-base font-semibold tracking-tight text-gray-900 dark:text-white"><?php echo $row['username']; ?></h5>
              </div>
              <div>
                <p class="text-green-500 text-semibold"><?php echo $row['status'] ?></p>
              </div>
            </div>
            <div class=" py-3">

              <p class=" font-bold text-gray-700"><?php echo $row['subject']; ?></p>
            </div>


            <p class="font-normal text-gray-700 dark:text-gray-400 mb-3"><?php echo $row['task']; ?></p>
            <div class="flex gap-2">
              <button class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" type="button" onclick="deleteTask('<?php echo $row['taskid']; ?>')">Delete</button>



              <button data-modal-target="updateModal<?php echo $row['taskid']; ?>" data-modal-toggle="updateModal<?php echo $row['taskid']; ?>" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" type="button">
                Update</button>
            </div>

            <div id="updateModal<?php echo $row['taskid']; ?>" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
              <div class="relative w-full max-w-2xl max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                  <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                      Update Task
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="updateModal<?php echo $row['taskid']; ?>">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                      </svg>
                      <span class="sr-only">Close modal</span>
                    </button>
                  </div>
                  <div class="p-6 space-y-6">
                    <form action="./Headteamtaskassign.php" method="POST">
                      <input type="hidden" name="update_taskid" value="<?php echo $row['taskid']; ?>">


                      <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subject</label>
                        <input type="text" id="update_subject" name="update_subject" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $row['subject'] ?>">
                      </div>
                      <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Task</label>

                        <textarea type="text" rows="5" id="update_task" name="update_task" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><?php echo $row['task'] ?></textarea>
                      </div>
                      <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <input type="text" id="update_status" name="update_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $row['status'] ?>">
                      </div>



                      <div class="flex items-center justify-end p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="updateModal<?php echo $row['taskid']; ?>" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>



    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../backend/jquery.js"></script>
  <script>
    // Get references to the user ID dropdown and role input field
    const useridDropdown = document.getElementById('userid');
    const roleInput = document.getElementById('role');

    // Add event listener to the user ID dropdown
    useridDropdown.addEventListener('change', function() {
      // Get the selected option value
      const selectedUserId = useridDropdown.value;

      // Iterate over the credential result options
      <?php foreach ($credentialresult as $row) : ?>
        <?php echo "if (selectedUserId === '{$row['user_id']}') { roleInput.value = '{$row['role']}'; }"; ?>
      <?php endforeach; ?>
    });

    document.getElementById("taskid").addEventListener("focus", function () {
    const prefix = "Task_";
    let currentValue = this.value.trim();

    if (!currentValue.startsWith(prefix)) {
      // Generate the next Task ID based on the highest existing ID
      const nextNum = <?php echo $currentNum + 1; ?>;
      this.value = `${prefix}${nextNum.toString().padStart(2, "0")}`;
    }
  });
  </script>
</body>

</html>