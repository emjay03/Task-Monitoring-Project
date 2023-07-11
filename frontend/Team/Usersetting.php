<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile | Task Monitoring</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../Login/Login.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</head>

<body>
    <?php

    session_start();
    //retrive data from database
    $username = '';
    $userid = '';
    $imageData = '';
    $role = '';

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    }
    $conn = new PDO("mysql:host=localhost;dbname=taskmonitoring", "root", "");
    $query = "SELECT * FROM usercredential WHERE username = :username";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($result) {
        $userid = $result['user_id'];
        $role = $result['role'];
    }
    if ($result && !empty($result['avatar'])) {
        $imageData = $result['avatar'];
    }
    //update data to database
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $updateusername = $_POST['updateusername'];
        $updatepassword = $_POST['updatepassword'];
        $confirmpassword = $_POST['confirmpassword'];

        $avatar = $_FILES['avatar']['tmp_name'];

        if ($updatepassword === $confirmpassword) {
            $updatequery = "UPDATE usercredential SET username=:updateusername,avatar=:avatar,password=:updatepassword,confirmpassword=:confirmpassword WHERE user_id=:userid";
            $updatestmt = $conn->prepare($updatequery);
            $updatestmt->bindParam(':updateusername', $updateusername);
            $updatestmt->bindParam(':avatar', $avatar);
            $updatestmt->bindParam(':updatepassword', $updatepassword);
            $updatestmt->bindParam(':confirmpassword', $confirmpassword);
            $updatestmt->bindParam(':userid', $userid);
            $updatestmt->execute();

            // Retrieve the updated data from the database
            $query = "SELECT * FROM usercredential WHERE user_id = :userid";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':userid', $userid);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $username = $result['username'];
                $imageData = $result['avatar'];
                // Update the session with the new username
                $_SESSION['username'] = $username;
            }

            exit(header("Location: ./Usersetting.php"));
        } else {
            echo "password not match";
        }
    }

    include "../include/Usersidebar.php";
    ?>

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <form action="./Usersetting.php" method="POST" enctype="multipart/form-data">
                <div class="mb-6">
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                    <input type="text" id="userid" name="userid" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                    dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled value="<?php if (!empty($role)) : echo $role;
                                                                                            else : echo "userid not found";
                                                                                            endif; ?>">
                </div>
                <div class="mb-6">
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User ID</label>
                    <input type="text" id="userid" name="userid" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                    dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled value="<?php if (!empty($userid)) : echo $userid;
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
                                                                                                                                                                                                                                                                                                                                                                    else : echo "username not found";
                                                                                                                                                                                                                                                                                                                                                                    endif; ?>" required>
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

</body>

</html>