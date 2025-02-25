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
    <!-- Navbar -->
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
                <a href="./editprofile.php" class="hover:underline">Edit Profile</a>
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
                    <img
                    src="<?php echo $profile_photo; ?>"
                    alt="Profile"
                    class="h-10 w-10 rounded-full"
                    />
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
      <li><a href="#" class="block">Dashboards</a></li>
      <li><a href="#" class="block">Pay Online</a></li>
      <li><a href="#" class="block">Fee Receipt</a></li>
      <li><a href="#" class="block">Form</a></li>
      <li><a href="#" class="block">Other</a></li>
      <li><a href="#" class="block">Report</a></li>
    </ul>

    <div class="p-6 bg-gray-50 rounded-lg shadow-md">
    <h2 class="text-lg font-semibold text-gray-700 mb-4">Admission Fee Receipt</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
            <thead>
                <tr class="bg-gray-200 text-gray-700 text-left">
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">VIEW</th>
                    <th class="px-4 py-2 border">RECEIPT NO.</th>
                    <th class="px-4 py-2 border">RECEIPT DATE</th>
                    <th class="px-4 py-2 border">SESSION</th>
                    <th class="px-4 py-2 border">YEAR</th>
                    <th class="px-4 py-2 border">TUITION FEE</th>
                    <th class="px-4 py-2 border">DEVELOPMENT FEE</th>
                    <th class="px-4 py-2 border">OTHER FEE</th>
                    <th class="px-4 py-2 border">TOTAL FEE</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-gray-700">
                    <td class="px-4 py-2 border">1</td>
                    <td class="px-4 py-2 border text-green-500 hover:underline cursor-pointer">View</td>
                    <td class="px-4 py-2 border">2024-2025/TY/974</td>
                    <td class="px-4 py-2 border">20-07-2024</td>
                    <td class="px-4 py-2 border">2024</td>
                    <td class="px-4 py-2 border">III Year</td>
                    <td class="px-4 py-2 border">0.00</td>
                    <td class="px-4 py-2 border">1000.00</td>
                    <td class="px-4 py-2 border">550.00</td>
                    <td class="px-4 py-2 border font-semibold">1550.00</td>
                </tr>
            </tbody>
        </table>
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
