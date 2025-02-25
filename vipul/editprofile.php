<?php
session_start();
include("project/connection.php");

if (!isset($_SESSION['student'])) {
    die("Unauthorized access!");
}

$id_code = $_SESSION['student'];

if (isset($_POST['profileupdate'])) {
    $f_name = $_POST['f_name'];
    $m_name = $_POST['m_name'];
    $l_name = $_POST['l_name'];
    $mnum = $_POST['mnum'];
    $cemail = $_POST['cemail'];
    $anum = $_POST['anum'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : null;

    // Update query
    if ($password) {
        $sql = "UPDATE students SET fname = ?, mname = ?, lname = ?, mob_no = ?, email = ?, adhar_no = ?, dob = ?, address = ?, password = ? WHERE id_code = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("ssssssssss", $f_name, $m_name, $l_name, $mnum, $cemail, $anum, $dob, $address, $password, $id_code);
    } else {
        $sql = "UPDATE students SET fname = ?, mname = ?, lname = ?, mob_no = ?, email = ?, adhar_no = ?, dob = ?, address = ? WHERE id_code = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("sssssssss", $f_name, $m_name, $l_name, $mnum, $cemail, $anum, $dob, $address, $id_code);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Profile updated successfully!'); window.location.href='editprofile.php';</script>";
    } else {
        echo "<script>alert('Error updating profile!');</script>";
    }

    $stmt->close();
}


if (isset($_POST['updatephoto'])) {
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = "uploads/";
    
        // Ensure the upload directory exists
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Create the directory with full permissions
        }
    
        $file_tmp = $_FILES['profile_photo']['tmp_name'];
        $file_ext = pathinfo($_FILES['profile_photo']['name'], PATHINFO_EXTENSION);
        $file_name = $id_code . "_" . uniqid() . "." . $file_ext;
        $file_path = $upload_dir . $file_name;
    
        if (move_uploaded_file($file_tmp, $file_path)) {
            // Update the profile image path in the database
            $sql = "UPDATE students SET profile_photo = ? WHERE id_code = ?";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("ss", $file_name, $id_code);
    
            if ($stmt->execute()) {
                header("Location: editprofile.php?success=Profile photo updated");
            } else {
                echo "Database update failed.";
            }
    
            $stmt->close();
        } else {
            echo "Failed to move uploaded file.";
        }
    } else {
        echo "No file uploaded or upload error.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom Styles */
        .file-input::-webkit-file-upload-button {
            background-color: #22c55e;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .file-input::-webkit-file-upload-button:hover {
            background-color: #16a34a;
        }

        .profile-img-container {
            position: relative;
            display: inline-block;
            overflow: hidden;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .profile-img-container img {
            transition: transform 0.3s ease;
        }

        .profile-img-container:hover img {
            transform: scale(1.05);
        }
    </style>
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

        <!-- Desktop Navigation -->
        <div class="hidden md:flex space-x-6 text-white">
            <a href="./dashboard.php" class="hover:underline">Dashboard</a>
            <a href="./payment.php" class="hover:underline">Pay Online</a>
            <a href="./feeReceipt.php" class="hover:underline">Fee Receipt</a>
            <a href="./examForm.php" class="hover:underline">Form Submission</a>
            <a href="./editprofile.php" class="hover:underline">Edit Profile</a>
        </div>

        <div class="flex items-center space-x-4">
            <button class="text-white focus:outline-none md:hidden" id="menu-toggle">☰</button>
            <div class="flex items-center space-x-2">
                <?php
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                ?>

                <img src="<?php echo $profile_photo; ?>" alt="Profile" class="h-10 w-10 rounded-full">
                
                <!-- Logout Button -->
                <a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                    Logout
                </a>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div class="hidden md:hidden flex-col bg-green-500 p-4 space-y-2" id="mobile-menu">
        <a href="./dashboard.php" class="block text-white hover:underline">Dashboard</a>
        <a href="./payment.php" class="block text-white hover:underline">Pay Online</a>
        <a href="./feeReceipt.php" class="block text-white hover:underline">Fee Receipt</a>
        <a href="./examForm.php" class="block text-white hover:underline">Form Submission</a>
        <a href="./editprofile.php" class="block text-white hover:underline">Edit Profile</a>
        
        <!-- Mobile Logout Button -->
        <a href="logout.php" class="block bg-red-500 text-white text-center px-4 py-2 rounded-lg hover:bg-red-600 transition">
            Logout
        </a>
    </div>
</nav>


    <div class="container mx-auto my-10 p-6 bg-white shadow-lg rounded-lg">
        <?php

            $id_code = $_SESSION['student'];

            // Fetch existing student details
            $sql = "SELECT fname, mname, lname, mob_no, email, adhar_no, dob, address FROM students WHERE id_code = ?";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("s", $id_code);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if (!$user) {
                die("Student record not found!");
            }

            $stmt->close();
            $connect->close();
        ?>
        <h2 class="text-2xl font-bold mb-5">Edit Profile</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Section: Profile Update Form -->
            <form method="POST" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700">First Name</label>
                        <input type="text" name="f_name" value="<?= $user['fname'] ?>" class="w-full px-4 py-2 border rounded-lg" required />
                    </div>
                    <div>
                        <label class="block text-gray-700">Middle Name</label>
                        <input type="text" name="m_name" value="<?= $user['mname'] ?>" class="w-full px-4 py-2 border rounded-lg" required />
                    </div>
                    <div>
                        <label class="block text-gray-700">Last Name</label>
                        <input type="text" name="l_name" value="<?= $user['lname'] ?>" class="w-full px-4 py-2 border rounded-lg" required />
                    </div>
                    <div>
                        <label class="block text-gray-700">Mobile No.</label>
                        <input type="text" name="mnum" value="<?= $user['mob_no'] ?>" class="w-full px-4 py-2 border rounded-lg" required />
                    </div>
                    <div>
                        <label class="block text-gray-700">College Email ID</label>
                        <input type="email" name="cemail" value="<?= $user['email'] ?>" class="w-full px-4 py-2 border rounded-lg" required />
                    </div>
                    <div>
                        <label class="block text-gray-700">Aadhar No.</label>
                        <input type="text" name="anum" value="<?= $user['adhar_no'] ?>" class="w-full px-4 py-2 border rounded-lg" required />
                    </div>
                    <div>
                        <label class="block text-gray-700">Date of Birth</label>
                        <input type="date" name="dob" value="<?= $user['dob'] ?>" class="w-full px-4 py-2 border rounded-lg" required />
                    </div>
                    <div class="col-span-2">
                        <label class="block text-gray-700">Address</label>
                        <input type="text" name="address" value="<?= $user['address'] ?>" class="w-full px-4 py-2 border rounded-lg" required />
                    </div>
                </div>
                
                <!-- Password fields (optional update) -->
                <div>
                    <label class="block text-gray-700">New Password (Leave blank if unchanged)</label>
                    <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg" />
                </div>
                <div>
                    <label class="block text-gray-700">Confirm Password</label>
                    <input type="password" name="confirm_password" class="w-full px-4 py-2 border rounded-lg" />
                </div>
                
                <button type="submit" name="profileupdate" class="w-full bg-green-500 text-white py-2 rounded-lg">Update Profile</button>
            </form>

            <!-- Right Section: Profile Picture Upload -->
            <div class="lg:w-1/3 flex flex-col items-center">
                <h2 class="text-xl font-bold mb-4 text-gray-800">Profile Photo</h2>
                <div class="profile-img-container h-48 w-48 mb-4">
                    <img src="<?php echo $profile_photo; ?>" alt="Profile Photo" class="h-48 w-48 rounded-full border-4 border-gray-300 object-cover">
                </div>
                <form method="POST" enctype="multipart/form-data" class="flex flex-col items-center w-full">
                    <input type="file" name="profile_photo" class="file-input mt-2">
                    <button type="submit" name="updatephoto" class="bg-green-500 text-white px-6 py-2 rounded-lg mt-4 hover:bg-green-600">Update Photo</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
