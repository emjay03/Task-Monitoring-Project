<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Team Monitoring</title>
  <script src="https://cdn.tailwindcss.com"></script>

 <link rel="stylesheet" href="./Login.css">
</head>

<body class="h-screen border-2">


<div class="h-full flex justify-center  items-center">
  <div class="max-w-[500px] w-full   p-5">
    <div class="py-2">
  <h1 class="text-3xl">Welcome back</h1>
  <p class="text-md">Welcomeback! Please enter your detail</p>
    </div>
<form class=" max-w-[700px]  "  action="../../backend/login.php" method="POST">
 
    <div class="mb-6">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
        <input type="text" id="username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="username" required>
    </div> 
    <div class="mb-6">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
        <input type="password" id="password"  name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required>
    </div> 
    
    <div class="flex items-start mb-6">
        <div class="flex items-center h-5">
        <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" required>
        </div>
        <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">I agree with the <a href="#" class="text-blue-600 hover:underline dark:text-blue-500">terms and conditions</a>.</label>
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>

  <!-- <form  action="../../backend/login.php" method="POST">
  <h1 class="text-xl">Welcome back</h1>
  <p>Welcomeback! Please enter your detail</p>
    <div class="form-group">
      <label>Username</label>
      <input type="text" class="form-control  " id="username" name="username" aria-describedby="emailHelp" placeholder="Enter email" required>

    </div>
    <div class="form-group">
    <label class="h6">Password</label>
      <input type="password" class="form-control  " id="password" name="password" placeholder="Password" required>
    </div>
    <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Remember me </label>
  </div>
    <div class="p-2"></div>
    <button  type="submit" class="btn w-100 ">Submit</button>
  </form> -->
</div>
</div>
</body>

</html>