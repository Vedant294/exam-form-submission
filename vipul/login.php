
<?php

session_start();

include("project/connection.php");

if(isset($_POST['login']))
{
	$ename = $_POST['email'];
	$pass = $_POST['password'];

	if(empty($ename))
	{
		echo "<script>alert('Enter Username')</script>";
	}
	elseif (empty($pass)) 
	{
		echo "<script>alert('Enter Password')</script>";
	}

  $error = array();

		$sql = "SELECT * from students where email='$ename' and password='$pass'";

		$res = mysqli_query($connect,$sql);

    $row = mysqli_fetch_array($res);

		if(mysqli_num_rows($res) == 1)
		{
			header("Location: dashboard.php");

			$_SESSION['student'] = $row['id_code'];
		}
		else
		{
			echo "<script>alert('Invalid Account')</script>";
		}
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-900 to-yellow-400">
  
  <?php
    include("project/connection.php");
  ?>

  <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
      <h2 class="text-2xl font-semibold text-center text-gray-700">Sign In</h2>
      <p class="text-center text-gray-500 mb-4">KDK COLLEGE OF ENGINEERING NAGPUR</p>

      <form id="loginForm" class="space-y-4" method="POST">
        <div>
          <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
          <input
            type="email"
            name="email"
            id="email"
            class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
          />
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
          <input
            type="password"
            name="password"
            id="password"
            class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
          />
        </div>

        <button type="submit" name="login" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg">
          Sign In
        </button>
        
      </form>

      <div class="flex items-center my-4">
            <hr class="flex-grow border-t border-gray-300">
            <span class="mx-3 text-gray-500 text-sm">OR</span>
            <hr class="flex-grow border-t border-gray-300">
        </div>
      <a href="./signUp.php"><button type="submit" name="login" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg">
          Sign Up
        </button></a>
    </div>
  </body>
</html>
