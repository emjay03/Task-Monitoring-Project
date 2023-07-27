<?php
include "../../backend/connection.php";
include "../include/Usersidebar.php";
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

</head>

<body>

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


      <div class="py-2"></div>
      <h1 class="text-2xl font-semibold py-2">Pending Task</h1>
      <div class=" grid  grid-cols-1 lg:grid-cols-3  w-full gap-4">


        <?php foreach ($result as $row) : ?>
          <?php if ($row['status'] === 'pending' && $row['user_id'] === $user_id) : ?>
            <?php $taskAssigned = true; // Set the flag to true 
            ?>
            <div class=" block w-full p-6 bg-yellow-100 border  rounded-lg    dark:bg-gray-800 dark:border-gray-700  ">
              <div class="flex justify-between gap-2 items-center">
                <div class="flex items-center gap-2">
                  <?php if ($row['avatar']) : ?>
                    <img class="w-7 h-7 rounded-full" src="data:image/jpeg;base64,<?php echo base64_encode($row['avatar']); ?>" alt="User Avatar" class="rounded-full w-16 h-16">
                  <?php else : ?>
                    <span>No Avatar</span>
                  <?php endif; ?>
                  <h5 class=" text-base font-semibold tracking-tight text-gray-900 dark:text-white"><?php echo $row['username']; ?></h5>
                </div>

                <p class="text-green-500 font-semibold underline"><?php echo $row['status'] ?></p>

              </div>
              <div class="py-2"></div>
              <p class="font-semibold text-red-500">Task Assigned: <span class="font-normal text-gray-700"> <?php echo date('Y, F j, g:i A', strtotime($row['date_time_taskassign'])); ?></span></p>

              <div class="py-2"></div>

              <p class="text-red-500 font-semibold">Subject: <span class="font-normal text-gray-700"><?php echo $row['subject']; ?></span></p>

              <div class="py-2"></div>

              <p class="font-semibold text-red-500">Task: <span class="font-normal text-gray-700"><?php echo $row['task']; ?></span></p>
              <div class="flex gap-2 py-3 ">


                <button data-modal-target="updateModal<?php echo $row['taskid']; ?>" data-modal-toggle="updateModal<?php echo $row['taskid']; ?>" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2  dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" type="button">
                  Accept</button>
              </div>

              <div id="updateModal<?php echo $row['taskid']; ?>" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-md max-h-full">
                  <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                      <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Task Acceptance Confirmation
                      </h3>
                      <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="updateModal<?php echo $row['taskid']; ?>">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                      </button>
                    </div>

                    <div class="p-6 space-y-6">


                      <form action="./Userdashboard.php" method="POST">
                        <div class="hidden">

                          <input name="update_taskid" value="<?php echo $row['taskid']; ?>">


                          <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subject</label>
                            <input type="text" id="update_subject" name="update_subject" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $row['subject'] ?>" />
                          </div>
                          <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Task</label>

                            <textarea type="text" rows="5" id="update_task" name="update_task" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><?php echo $row['task'] ?></textarea>
                          </div>
                          <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                            <input type="text" id="update_status" name="update_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="ongoing">
                          </div>

                          <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start</label>
                            <input type="datetime-local" id="phdatetime" name="updatedate_time_task_start" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                          </div>

                        </div>
                        <p>Are you sure you want to accept this task?</p>

                        <div class="flex items-center justify-end p-6 space-x-2 border-gray-200 rounded-b dark:border-gray-600">
                          <button data-modal-hide="updateModal<?php echo $row['taskid']; ?>" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No</button>
                          <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Yes</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>

        <?php if (!$taskAssigned) : ?>
          <h1>No task assigned right now.</h1>
        <?php endif; ?>
      </div>


      <div class="py-2"></div>
      <h1 class="text-2xl font-semibold py-3">Ongoing Task</h1>
      <div class=" grid  grid-cols-1 lg:grid-cols-3  w-full gap-4">

        <?php foreach ($result as $row) : ?>
          <?php if ($row['status'] === 'ongoing' && $row['user_id'] === $user_id) : ?>
            <?php $taskOngoing = true; // Set the flag to true 
            ?>
            <div class=" block w-full p-6 bg-green-100 border  rounded-lg    dark:bg-gray-800 dark:border-gray-700  ">
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
                  <p class="text-green-500 font-semibold underline"><?php echo $row['status'] ?></p>
                </div>

              </div>
              <div class="py-2"></div>
              <p class="font-semibold text-red-500">Task Start: <span class="text-gray-700 text-gray-700 font-normal"><?php echo date('Y, F j, g:i A', strtotime($row['date_time_task_start'])); ?></span></p>

              <div class="py-2"></div>
              <p class="font-semibold text-red-500">Subject: <span class="font-normal text-gray-700"><?php echo $row['subject']; ?></span></p>
              <div class="py-2"></div>


              <p class="font-semibold text-red-500 ">Task: <span class="font-normal text-gray-700"><?php echo $row['task']; ?></span></p>

              <div class="py-2"></div>



              <button data-modal-target="updateModal<?php echo $row['taskid']; ?>" data-modal-toggle="updateModal<?php echo $row['taskid']; ?>" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5    dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" type="button">
                Update</button>


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
                      <form action="./Userdashboard.php" method="POST">


                        <input type="hidden" name="update_taskid" value="<?php echo $row['taskid']; ?>">


                        <div class="mb-6">
                          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subject</label>
                          <input type="text" id="update_subject" name="update_subject" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $row['subject'] ?>" readonly>
                        </div>
                        <div class="mb-6">
                          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Task</label>

                          <textarea type="text" rows="5" id="update_task" name="update_task" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly><?php echo $row['task'] ?></textarea>
                        </div>
                        <div class="hidden mb-6">
                          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                          <input type="text" id="update_status" name="update_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="completed" readonly>
                        </div>


                        <div class="hidden mb-6">
                          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start</label>
                          <input type="datetime-local" name="updatedate_time_task_start" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $row['date_time_task_start'] ?>">
                        </div>
                        <div class="mb-6">
                          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End task</label>
                          <input type="datetime-local" name="updatedate_time_task_end" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <p>Are you sure you want to accept this task?</p>

                        <div class="flex items-center justify-end p-6 space-x-2 border-gray-200 rounded-b dark:border-gray-600">
                          <button data-modal-hide="updateModal<?php echo $row['taskid']; ?>" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No</button>
                          <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Yes</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>

        <?php if (!$taskOngoing) : ?>
          <h1>No ongoing task right now.</h1>
        <?php endif; ?>
      </div>

      <div class="py-2"></div>
      <h1 class="text-2xl font-semibold py-3">Completed Task</h1>
      <div class=" grid  grid-cols-1 lg:grid-cols-3  w-full gap-4">

        <?php foreach ($result as $row) : ?>
          <?php if ($row['status'] === 'completed' && $row['user_id'] === $user_id) : ?>
            <?php $taskOngoing = true; // Set the flag to true 
            ?>
            <div class=" block w-full p-6 bg-gray-200 border  rounded-lg    dark:bg-gray-800 dark:border-gray-700  ">
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
                  <p class="text-green-500 font-semibold underline"><?php echo $row['status'] ?></p>
                </div>

              </div>
              <div class="py-2"></div>

              <p class="font-semibold text-red-500">Task End: <span class="text-gray-700 font-normal"><?php echo date('Y, F j, g:i A', strtotime($row['date_time_task_end'])); ?></span></p>

              <div class="py-2"></div>

              <p class="font-semibold text-red-500">Subject: <span class="text-gray-700 font-normal"><?php echo $row['subject']; ?></span></p>

              <div class="py-2"></div>

              <p class="font-semibold text-red-500 ">Task: <span class="text-gray-700 font-normal"><?php echo $row['task']; ?></span></p>



              <div class="py-2"></div>

              <button data-modal-target="updateModal<?php echo $row['taskid']; ?>" data-modal-toggle="updateModal<?php echo $row['taskid']; ?>" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5  dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" type="button">
                Update</button>


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
                      <form action="./Userdashboard.php" method="POST">
                        <input type="hidden" name="update_taskid" value="<?php echo $row['taskid']; ?>">


                        <div class="mb-6">
                          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subjects</label>
                          <input type="text" id="update_subject" name="update_subject" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $row['subject'] ?>" disabled>
                        </div>
                        <div class="mb-6">
                          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Task</label>

                          <textarea type="text" rows="5" id="update_task" name="update_task" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled><?php echo $row['task'] ?></textarea>
                        </div>
                        <div class="mb-6">
                          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                          <input type="text" id="update_status" name="update_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="completed" disabled>
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
          <?php endif; ?>
        <?php endforeach; ?>

        <?php if (!$taskOngoing) : ?>
          <h1>No ongoing task right now.</h1>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <script>
    // Get the current date and time in UTC
    const currentDateTimeUTC = new Date();

    // Convert to Philippine Standard Time (PST) by adding 8 hours (8 hours ahead of UTC)
    const currentDateTimePST = new Date(currentDateTimeUTC.getTime() + 8 * 60 * 60 * 1000);

    // Format the PST date to the required input format (YYYY-MM-DDTHH:mm)
    const formattedDateTimePST = currentDateTimePST.toISOString().slice(0, 16);

    // Get all input fields of type "datetime-local"
    const datetimeFields = document.querySelectorAll('input[type="datetime-local"]');

    // Set the value of each datetime-local input field to the current date and time in PST
    datetimeFields.forEach((field) => {
      field.value = formattedDateTimePST;
    });
  </script>

</body>

</html>