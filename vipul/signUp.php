

<?php

include("project/connection.php");

	if(isset($_POST['submit']))
	{
    $idcode = $_POST['idcode']; 
		$fname = $_POST['f_name'];
    $mname = $_POST['m_name'];
    $lname = $_POST['l_name'];
    $mnum = $_POST['mnum'];
		$email = $_POST['cemail'];
    $adhar = $_POST['anum'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];

		$password = $_POST['password'];
		$con_pass = $_POST['confirm_password'];

		$error = array();


		if($con_pass != $password)
		{
			$error['ac'] = "Both Password do not match";
		}

		//inserting value to the database
		if(count($error) == 0)
		{
      $sql = "INSERT into students(id_code,fname,mname,lname,mob_no,email,adhar_no,dob,address,password,date_reg) values($idcode,'$fname','$mname','$lname','$mnum','$email','$adhar','$dob','$address','$password',NOW())";
			
      $res = mysqli_query($connect,$sql);

			if($res)
			{
        echo "<script>alert('Success')</script>";
				// header("Location:teacher_login.php");
			}
			else
			{
				echo "<script>alert('Failed')</script>";
			}
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body
    class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-900 to-yellow-400"
  >
  <?php
  include("project/connection.php");
  ?>
    <div
      class="w-full max-w-3xl bg-white rounded-lg shadow-lg p-8 transform transition-all duration-500 hover:scale-105"
    >
      <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">
        Create a Student Account
      </h2>
      <p class="text-center text-gray-500 mb-6 uppercase font-semibold">
        KDK COLLEGE OF ENGINEERING NAGPUR
      </p>
      <form id="signupForm" class="space-y-5" method="POST">
        <div class="grid grid-cols-2 gap-4">
          <input
            type="text"
            name="f_name"
            placeholder="First Name"
            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500"
            required
          />
          <input
            type="text"
            name="m_name"
            placeholder="Middle Name"
            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500"
            required
          />
          <input
            type="text"
            name="l_name"
            placeholder="Last Name"
            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500"
            required
          />
          <input
            type="text"
            name="idcode"
            placeholder="ID Code"
            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500"
            required
          />
          <input
            type="tel"
            name="mnum"
            placeholder="Mobile No."
            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500"
            required
          />
          <input
            type="email"
            name="cemail"
            placeholder="College Email ID"
            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500"
            required
          />
          <input
            type="text"
            name="anum"
            placeholder="Aadhar No."
            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500"
            required
          />
          <input
            type="date"
            name="dob"
            placeholder="Date Of Birth"
            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500"
            required
          />
          <input
            type="text"
            name="address"
            placeholder="Address"
            class="col-span-2 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500"
            required
          />
          <input
            type="password"
            name="password"
            placeholder="Password"
            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500"
            required
          />
          <input
            type="password"
            name="confirm_password"
            placeholder="Confirm Password"
            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500"
            required
          />
        </div>
        <button
          type="submit" name="submit"
          class="w-full bg-gradient-to-r from-green-400 to-blue-500 hover:from-green-500 hover:to-blue-600 text-white font-bold py-3 px-4 rounded-lg shadow-md transform transition hover:scale-105"
        >
          Sign Up
        </button>


      </form>
      <div class="flex items-center my-4">
            <hr class="flex-grow border-t border-gray-300">
            <span class="mx-3 text-gray-500 text-sm">OR</span>
            <hr class="flex-grow border-t border-gray-300">
        </div>
<a href="./login.php">
      <button
          type="submit" name="submit"
          class="w-full bg-gradient-to-r from-green-400 to-blue-500 hover:from-green-500 hover:to-blue-600 text-white font-bold py-3 px-4 rounded-lg shadow-md transform transition hover:scale-105"
        >
          Login
        </button></a>
    </div>
  </body>
</html>
