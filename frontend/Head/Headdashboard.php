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
        <div class="p-4 flex w-full flex-row  gap-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">

            <div class="w-[200px] p-6    bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="w-full px-5 flex flex-col justify-center items-center">
                    <svg class="w-10 h-10 mb-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm-2 3h4a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z" />
                    </svg>
                    <a href="#">
                        <h5 class=" text-2xl font-bold tracking-tight text-gray-900 dark:text-white">25</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Team member</p>

                </div>
            </div>
            <div class="max-w-sm p-6    bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="px-5 flex flex-col justify-center items-center">
                    <svg class="w-10 h-10 mb-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm-2 3h4a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z" />
                    </svg>
                    <a href="#">
                        <h5 class=" text-2xl font-bold tracking-tight text-gray-900 dark:text-white">25</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Assigned Task</p>

                </div>
            </div>
            <div class="max-w-sm p-6   bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex  px-5 flex-col justify-center items-center">
                    <svg class="w-10 h-10 mb-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm-2 3h4a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z" />
                    </svg>
                    <a href="#">
                        <h5 class=" text-2xl font-bold tracking-tight text-gray-900 dark:text-white">25</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">In Progress</p>

                </div>
            </div>
            <div class="max-w-sm p-6   bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex  px-5 flex-col justify-center items-center">
                    <svg class="w-10 h-10 mb-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm-2 3h4a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z" />
                    </svg>
                    <a href="#">
                        <h5 class=" text-2xl font-bold tracking-tight text-gray-900 dark:text-white">25</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Task Completed</p>

                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../backend/jquery.js"></script>

</body>

</html>