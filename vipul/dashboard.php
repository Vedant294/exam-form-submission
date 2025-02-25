<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gray-100">
    <?php
      include("./project/connection.php");
    ?>

          <?php 
                $id_code = $_SESSION['student'];

                // Fetch user data from the database
                $sql = "SELECT * FROM students WHERE id_code = ?";
                $stmt = $connect->prepare($sql);
                $stmt->bind_param("s", $id_code);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();
                
                // Set default profile image if none exists
                $profile_photo = !empty($user['profile_photo']) ? "uploads/" . $user['profile_photo'] : "default-profile.jpg";
                
                $stmt->close();
          ?>
    <!-- Navbar -->
    <nav class="bg-green-500 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <img src="./images/kdk-logo.png" alt="Logo" class="h-10 w-10"> 
                <span class="text-white text-lg font-bold">KDK COLLEGE OF ENGINEERING, NAGPUR</span>
            </div>
            <div class="hidden md:flex space-x-6 text-white">
                <a href="./dashboard.php" class="hover:underline">Dashboards</a>
                <a href="./payment.php" class="hover:underline">Pay Online</a>
                <a href="./feeReceipt.php" class="hover:underline">Fee Receipt</a>
                <a href="./examForm.php" class="hover:underline">Form Submission</a>
                <a href="./editprofile.php" class="block text-white hover:underline">Edit Profile</a>
            </div>
            <div class="flex items-center space-x-4">
                <button class="text-white focus:outline-none md:hidden" id="menu-toggle">
                    ☰
                </button>
                <div class="flex items-center space-x-2">
                    <?php
        
                      if(isset($_SESSION['student']))
                      {
                        $user = $_SESSION['student'];

                        echo '
                           <span class="text-white">'.$user.'</span>
                        ';

                        $query = "SELECT * from students where id_code='$user'";
                        $res = mysqli_query($connect,$query);

                        $row = mysqli_fetch_array($res);
                      }

                    ?>
        
                    <img src="<?php echo $profile_photo; ?>" alt="Profile" class="h-10 w-10 rounded-full">
                </div>
            </div>
        </div>
        <div class="hidden md:hidden flex-col bg-green-500 p-4 space-y-2" id="mobile-menu">
            <a href="./dashboard.php" class="block text-white hover:underline">Dashboards</a>
            <a href="./payment.php" class="block text-white hover:underline">Pay Online</a>
            <a href="./feeReceipt.php" class="block text-white hover:underline">Fee Receipt</a>
            <a href="./examForm.php" class="block text-white hover:underline">Form Submission</a>
            <a href="./editprofile.php" class="block text-white hover:underline">Edit Profile</a>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <ul
      id="mobile-menu"
      class="hidden bg-green-500 text-white text-center p-4 space-y-2 md:hidden"
    >
      <li><a href="./dashboard.php" class="block text-white hover:underline">Dashboards</a></li>
      <li><a href="./payment.php" class="block text-white hover:underline">Pay Online</a></li>
      <li><a href="./feeReceipt.php" class="block text-white hover:underline">Fee Receipt</a></li>
      <li><a href="./examForm.php" class="block text-white hover:underline">Form Submission</a></li>
      <li><a href="./editprofile.php" class="block text-white hover:underline">Edit Profile</a></li>
    </ul>

    <!-- Main Container -->
    <div class="flex flex-col md:flex-row p-6">
      <!-- Sidebar -->
      <div class="bg-white p-6 rounded-lg shadow-md w-full md:w-1/3 lg:w-1/4">
        <div class="flex flex-col items-center">
          <img
            src="<?php echo $profile_photo; ?>"
            alt="Profile Picture"
            class="rounded-full w-24 h-24"
          />
          <h2 class="mt-2 font-bold"><?php echo $row['fname']; ?></h2>
          <span class="bg-green-100 text-green-600 text-sm px-3 py-1 rounded-lg"
            ><?php echo $row['id_code']; ?></span
          >
        </div>
        <div class="mt-4">
          <h3 class="font-semibold">Details</h3>
          <p><strong>Enrollment No.:</strong> ID-<?php echo $row['id_code']; ?></p>
          <p><strong>Mobile No.:</strong> <?php echo $row['mob_no']; ?></p>
          <p><strong>Email ID:</strong> <?php echo $row['email']; ?></p>
          <p>
            <strong>Address:</strong> <?php echo $row['address']; ?>
          </p>
        </div>
      </div>

      <!-- Profile Section -->
      <div
        class="bg-white p-6 rounded-lg shadow-md w-full md:w-2/3 lg:w-3/4 mt-6 md:mt-0 md:ml-6"
      >
        <h2 class="font-bold text-lg border-b pb-2">Profile</h2>
        <div class="mt-4 space-y-3">
          <p><strong>Login ID:</strong> <?php echo $row['email']; ?></p>
          <p><strong>Password:</strong> ******</p>
          <p><strong>Student Name:</strong> <?php echo $row['fname']; ?></p>
          <p><strong>Date of Birth:</strong> <?php echo $row['dob']; ?></p>
          <p><strong>Aadhar No.:</strong> <?php echo $row['adhar_no']; ?></p>
          <p><strong>Mobile No.:</strong> <?php echo $row['mob_no']; ?></p>
          <p><strong>Email ID:</strong> <?php echo $row['email']; ?></p>
        </div>
      </div>
    </div>

    <script>
      document
        .getElementById("menu-btn")
        .addEventListener("click", function () {
          document.getElementById("mobile-menu").classList.toggle("hidden");
        });
    </script>
  </body>
</html>
