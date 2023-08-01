<?php
include "../../backend/connection.php";
include "../include/Headsidebar.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Head Dashboard | Task Monitoring</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../Login/Login.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</head>

<body>



    <div class="p-4 sm:ml-64">
        <div class="p-4  w-full    gap-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
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
              <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Overview</a>
            </div>
          </li>

        </ol>
      </nav>
        <div class="py-2"></div>
            <div class="flex grid grid-cols-4 gap-5 w-full">
                <div class="w-full p-6    bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="w-full px-5 flex flex-col justify-center items-center">
                        <svg class="w-10 h-10 mb-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm-2 3h4a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z" />
                        </svg>
                        <a href="#">
                            <h5 class=" text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?php echo $rowCount ?></h5>
                        </a>
                        <p class="mb-3 font-normal text-sm text-gray-700 dark:text-gray-400">Team members</p>

                    </div>
                </div>
                <div class="w-full p-6    bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="px-5 flex flex-col justify-center items-center">
                        <svg class="w-10 h-10 mb-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm-2 3h4a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z" />
                        </svg>
                        <a href="#">
                            <h5 class=" text-2xl font-bold tracking-tight text-gray-900 dark:text-white"> <?php echo $countResult[0]['pending_count'] ?></h5>
                        </a>
                        <p class="mb-3 font-normal text-sm text-gray-700 dark:text-gray-400">Pending Task</p>

                    </div>
                </div>
                <div class="w-full  p-6   bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex  px-5 flex-col justify-center items-center">
                        <svg class="w-10 h-10 mb-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm-2 3h4a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z" />
                        </svg>
                        <a href="#">
                            <h5 class=" text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?php echo $countResult[0]['ongoing_count'] ?></h5>
                        </a>
                        <p class="mb-3 font-normal text-sm text-gray-700 dark:text-gray-400">In Progress</p>

                    </div>
                </div>
                <div class="w-full p-6   bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex  px-5 flex-col justify-center items-center">
                        <svg class="w-10 h-10 mb-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm-2 3h4a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z" />
                        </svg>
                        <a href="#">
                            <h5 class=" text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?php echo $countResult[0]['completed_count'] ?></h5>
                        </a>
                        <p class="mb-3 font-normal text-sm text-gray-700 dark:text-gray-400">Task Completed</p>


                    </div>
                </div>
                <div>
                </div>






            </div>

            
      
    <div class="flex flex-row w-full gap-2">   
        
<div class="w-full relative overflow-x-auto">
<p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Members Online</p>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
  
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
            <th scope="col" class="px-6 py-3">
                    Avatar
                </th>
                <th scope="col" class="px-6 py-3">
                    Username
                </th>
                <th scope="col" class="px-6 py-3">
                  Status
                </th>
              
            </tr>
        </thead>
        <tbody>
        <?php foreach ($resultactive as $active): ?>
        <?php if ($active['user_status'] === 'online'): ?>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <td class="px-6 py-4">
            <img class="w-7 h-7 rounded-full" src="data:image/jpeg;base64,<?php echo base64_encode($active['avatar']); ?>" alt="User Avatar" class="rounded-full w-16 h-16">
                 </td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   <?php echo $active['username'] ?>    
                </th>
                <td class="px-6 py-4 text-green-700 font-semibold">
                  <?php echo $active['user_status'] ?>
                </td>
                
            </tr>
            <?php endif; ?>
            <?php endforeach; ?>
            <?php if (empty($resultactive) || !array_filter($resultactive, fn($user) => $user['user_status'] === 'online')): ?>
    <!-- Display a message when there are no 'online' users with the specified role -->
    <tr>
        <td colspan="4" class="text-center py-4">No 'online' users with the specified role found.</td>
    </tr>
<?php endif; ?>
        </tbody>
   
    </table>
</div>
 
<div class="w-full relative overflow-x-auto">
<p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Members Offline</p>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
  
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
            <th scope="col" class="px-6 py-3">
                    Avatar
                </th>
                <th scope="col" class="px-6 py-3">
                    Username
                </th>
                <th scope="col" class="px-6 py-3">
                  Status
                </th>
              
            </tr>
        </thead>
        <tbody>
        <?php foreach ($resultactive as $active): ?>
        <?php if ($active['user_status'] === 'offline'): ?>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <td class="px-6 py-4">
                <img class="w-7 h-7 rounded-full" src="data:image/jpeg;base64,<?php echo base64_encode($active['avatar']); ?>" alt="User Avatar" class="rounded-full w-16 h-16">
                </td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   <?php echo $active['username'] ?>    
                </th>
                <td class="px-6 py-4 text-red-700 font-semibold">
                  <?php echo $active['user_status'] ?>
                </td>
                
               
            </tr>
            <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
   
    </table>
</div>
 
</div>
 

     
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../backend/jquery.js"></script>
 
</body>

</html>