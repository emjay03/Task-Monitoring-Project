<?php
include "../../backend/connection.php";
include "../include/Headsidebar.php";



?>
<?php
// Basic function to generate a new user ID with the format "Mate_XX"
function generateUserId()
{
    $prefix = "Mate_";
    $numericPart = sprintf("%02d", rand(1, 99)); // Ensure a two-digit numeric part (e.g., 01, 02, ..., 99)
    return $prefix . $numericPart;
}

// Function to check if a user ID already exists in the database
function checkUserIdInDatabase($userId)
{
    // Your code to check if the user ID exists in the database.
    // Return true if it exists, false otherwise.
    // For this basic example, we will just return false to demonstrate the process.
    return false;
}

$generatedUserId = generateUserId();
while (checkUserIdInDatabase($generatedUserId)) {
    $generatedUserId = generateUserId();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Members | Task Monitoring</title>
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
            <div class="w-full  flex justify-between items-center">
            <button data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                Add
            </button>
            <div class="flex items-center">
    <label for="roleFilter" class="block text-sm font-medium text-gray-700">Select Role:</label>
    <select id="roleFilter" name="roleFilter" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        <option value="">All Roles</option>
        <?php
        // Extracting unique roles from $allUserData and displaying them as options
        $uniqueRoles = array_unique(array_column($allUserData, 'role'));
        foreach ($uniqueRoles as $role) {
            echo "<option value=\"" . $role . "\">" . $role . "</option>";
        }
        ?>
    </select>
</div>
            </div>
            <div class="py-2"></div>
            <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Add Member
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
                            <form action="./HeadTeammember.php" method="POST" enctype="multipart/form-data">
                                <div class="flex gap-2  w-full">
                                    <div class="mb-6   w-full">
                                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User ID</label>

                                        <input type="text" id="user_id" name="user_id" value="<?php echo $generatedUserId; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>


                                    </div>


                                    <div class="mb-6 w-full">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                                        <input type="text" id="username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    </div>
                                </div>
                                <div class="mb-6 w-full">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Avatar</label>

                                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="multiple_files" id="avatar" name="avatar" type="file" multiple>

                                </div>
                                <div class="mb-6 w-full ">
                                    <label for="taskid" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                    <div class="flex flex-row gap-2">
                                        <input type="text" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                        <button type="button" id="generatePasswordBtn" class="  px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg focus:ring-blue-500 focus:ring-offset-blue-200 focus:outline-none">
                                            Generate
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-6 w-full">
                                    <label for="taskid" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                                    <select id="role" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected>Choose a Role</option>
                                        <option value="Frontend">Frontend</option>
                                        <option value="Backend">Backend</option>
                                        <option value="UI/UX Designer">UI/UX Designer</option>
                                        <option value="Database Designer">Database Designer</option>
                                        <option value="QA Tester">Quality Assuarance Tester</option>
                                        <option value="Documentation">Documentation</option>
                                        <option value="Content Creator">Content Creator</option>
                                        <option value="Businsess Analyst">Business Analyst</option>
                                    </select>
                                </div>


                                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

                                </div>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
      

            <div class="grid grid-cols-1 lg:grid-cols-3  gap-4"  id="userGrid">

                <?php foreach ($allUserData as $userData) : ?>

                <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 user-card" data-role="<?php echo $userData['role']; ?>">

                        <div class="flex flex-col items-center pb-10 py-4">
                            <?php if ($userData['avatar']) : ?>
                                <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="data:image/jpeg;base64,<?php echo base64_encode($userData['avatar']); ?>" alt="User Avatar" class="rounded-full w-16 h-16">
                            <?php else : ?>
                                <span>No Avatar</span>
                            <?php endif; ?>

                            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white"><?php echo $userData['username']; ?></h5>
                            <span class="text-sm text-gray-500 dark:text-gray-400"><?php echo $userData['role'] ?></span>
                            <div class="flex mt-4 space-x-3 md:mt-6">



                                <a href="#" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" type="button" onclick="deleteuser('<?php echo $userData['user_id']; ?>')">Delete</a>
                                <button data-modal-target="updateuserdata<?php echo $userData['user_id']; ?>" data-modal-toggle="updateuserdata<?php echo $userData['user_id']; ?>" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" type="button">
                                    Update</button>


                                    <div id="updateuserdata<?php echo $userData['user_id']; ?>" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
              <div class="relative w-full max-w-2xl max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                  <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                      Update Task
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="updateuserdata<?php echo $userData['user_id']; ?>">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                      </svg>
                      <span class="sr-only">Close modal</span>
                    </button>
                  </div>
                  <div class="p-6 space-y-6">
                  <form action="./HeadTeammember.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="update"> <!-- Add a hidden field to indicate the action as "update" -->

    <input type="hidden" name="user_id" value="<?php echo $userData['user_id']; ?>">
    
    <div class="mb-6">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">username</label>
        <input type="text" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $userData['username'] ?>">
    </div>

    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="avatar" name="avatar" type="file" multiple>

    <div class="mb-6">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
        <textarea type="text" rows="5" name="passwordupdate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><?php echo $userData['password'] ?></textarea>
    </div>

    <div class="mb-6">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
        <textarea type="text" rows="5" name="roleupdate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><?php echo $userData['role'] ?></textarea>
    </div>

    <div class="flex items-center justify-end p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
    </div>
</form>
                  </div>
                </div>
              </div>
                            </div>
                        </div>
                    </div>
            </div>




        <?php endforeach; ?>
        </div>
    </div>
    </div>
    </div>

    <script>
        function deleteuser(user_id) {
            if (confirm('Are you sure you want to delete this user?')) {
                // Create an XMLHttpRequest object
                var xhr = new XMLHttpRequest();

                // Set up a callback function to handle the response
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            // Request successful, reload the page after successful deletion
                            location.reload();
                        } else {
                            // Request failed, show an error message
                            console.error('Request failed. Status:', xhr.status);
                        }
                    }
                };

                // Open a POST request to the server-side script
                xhr.open('POST', './HeadTeammember.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                // Send the user_id as POST data
                xhr.send('action=delete&user_id=' + user_id);
            }
        }
        // Function to generate a random password
        const generateRandomPassword = (length) => Array.from({
            length
        }, () => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+'.charAt(Math.floor(Math.random() * 74))).join('');

        // Function to set the generated password in the input field
        const setGeneratedPassword = () => document.getElementById('password').value = generateRandomPassword(12);

        // Event listener for the "Generate Password" button click
        document.getElementById('generatePasswordBtn').addEventListener('click', setGeneratedPassword);



          // JavaScript code to handle role filtering
    const roleFilter = document.getElementById('roleFilter');
    const userGrid = document.getElementById('userGrid');

    roleFilter.addEventListener('change', (event) => {
        const selectedRole = event.target.value;
        const userCards = userGrid.querySelectorAll('.user-card');

        userCards.forEach((card) => {
            const userRole = card.dataset.role;

            if (selectedRole === '' || userRole === selectedRole) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
    </script>
</body>

</html>