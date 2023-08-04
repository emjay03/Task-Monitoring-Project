<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Team Monitoring</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="./Login.css">
</head>

<body class="h-screen border-2">


  <div class="h-full flex justify-center  items-center">
    <div class="max-w-[500px] w-full   p-5">
      <div class="py-2">
        <h1 class="text-3xl">Welcome back</h1>
        <p class="text-md">Welcomeback! Please enter your detail</p>
      </div>
      <div class="  p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 hidden" id="success-alert" role="alert">
  <span class="font-medium">Success alert!</span> Change a few things up and try submitting again.
</div>

<div class="  p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 hidden" id="failed-alert" role="alert">
  <span class="font-medium">Warning alert!</span> User ID or Password is incorrect
 </div>
      <form class=" max-w-[700px]" id="login-form">

        <div class="mb-6">
          <label for="email" class="block mb-2 text-sm font-medium text-gray-900  ">Email address</label>
          <input type="text" id="user_id" name="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="username" required>
        </div>
        <div class="mb-6">
          <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
          <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required>
        </div>

        <div class="flex items-start mb-6">
          <div class="flex items-center h-5">
            <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" required>
          </div>
          <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">I agree with the <a href="#" class="text-blue-600 hover:underline dark:text-blue-500">terms and conditions</a>.</label>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
      </form>
      <div id="response-message"></div>
      
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 
<script>
document.getElementById('login-form').addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent form submission

  const formData = new FormData(this);
  const url = "../../backend/connection.php"; // Replace this with the actual URL of your API

  fetch(url, {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams(formData),
  })
    .then(response => response.text())
    .then(data => {
      // Process the response data here
      document.getElementById('response-message').innerText = data;
      if (data === "success_admin" || data === "success_user") {
        // Redirect to the dashboard page after successful login
        window.location.href = "../../frontend/Head/Headdashboard.php"; // Replace this with the actual URL of your dashboard page
      }
    })
    .catch(error => {
      // Handle errors here
      document.getElementById('response-message').innerText = "Error: " + error.message;
    });
});

</script>
  

</body>

</html>