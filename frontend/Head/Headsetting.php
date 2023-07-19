<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Head Profile | Task Monitoring</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../Login/Login.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
    <script></script>
</head>

<body>
    <?php

    include "../../backend/connection.php";

    include "../include/Headsidebar.php";
    ?>

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">

            <?php if ($error_message) : ?>
                <div id="MessageAlert" class="flex items-center p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 1a9 9 0 1 0 9 9A9 9 0 0 0 10 1zm-.18 15a1.49 1.49 0 0 1-.32-.04A1.5 1.5 0 0 1 8 14.68V10a1 1 0 0 1 2 0v4.68a1.5 1.5 0 0 1-1.32 1.48A1.49 1.49 0 0 1 9.82 16zM10 8a1 1 0 0 1-1-1V5a1 1 0 0 1 2 0v2a1 1 0 0 1-1 1z" />
                    </svg>
                    <span class="sr-only">Error</span>
                    <div>
                        <span class="font-medium">Error!</span> <?php echo $error_message; ?>
                    </div>
                </div>
            <?php endif; ?>



            <?php if ($success_message) : ?>
                <div id="MessageAlert" class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Success</span>
                    <div>
                        <span class="font-medium">Success alert!</span> <?php echo $success_message; ?>
                    </div>
                </div>
            <?php endif; ?>



            <form action="./Headsetting.php" method="POST" enctype="multipart/form-data">
                <div class="mb-6">
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                    <input type="text" id="userid" name="userid" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                    dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled value="<?php if (!empty($roles)) : echo $roles;
                                                                                            else : echo "role not found";
                                                                                            endif; ?>">
                </div>
                <div class="mb-6">
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User ID</label>
                    <input type="text" id="userid" name="userid" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                    dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled value="<?php if (!empty($user_id)) : echo $user_id;
                                                                                            else : echo "userid not found";
                                                                                            endif; ?>">
                </div>

                <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Avatar</label>
                <?php if (!empty($imageData)) : ?>
                    <!-- Display the image using the saved image data -->
                    <img class="w-8 h-8 rounded-full" src="data:image/jpeg;base64,<?php echo base64_encode($imageData); ?>" alt="Image">
                <?php else : ?>
                    <p>No image available</p>
                <?php endif; ?>


                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="multiple_files" id="avatar" name="avatar" type="file" multiple>

                <div class="mb-6">
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                    <input type="text" id="updateusername" name="updateusername" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php if (!empty($username)) : echo $username;
                                                                                                                                                                                                                                                                                                                                                                    else : echo "userid not found";
                                                                                                                                                                                                                                                                                                                                                                    endif; ?>">
                </div>
                <div class="mb-6">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input type="password" id="updatepassword" name="updatepassword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required placeholder="Enter your password">
                </div>
                <div class="mb-6">
                    <label for="confirmpassword" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                    <input type="password" id="confirmpassword" name="confirmpassword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Confirm password" required>
                </div>

                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
            </form>

        </div>
    </div>

    <script>
        setTimeout(function() {
            var MessageAlert = document.getElementById('MessageAlert');
            MessageAlert.style.transition = 'opacity 0.5s ease'; // Set the transition effect
            MessageAlert.style.opacity = '0'; // Fade out the element
            setTimeout(function() {
                MessageAlert.remove(); // Remove the element from the DOM after the transition
            }, 500); // Wait for the transition to complete before removing the element
        }, 4000);
    </script>
</body>

</html>