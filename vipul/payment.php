<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - KDK College</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-green-500 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <img src="./images/kdk-logo.png" alt="Logo" class="h-10 w-10"> 
                <span class="text-white text-lg font-bold">KDK COLLEGE OF ENGINEERING, NAGPUR</span>
            </div>
            <div class="hidden md:hidden flex-col bg-green-500 p-4 space-y-2" id="mobile-menu">
            <a href="./dashboard.php" class="block text-white hover:underline">Dashboards</a>
            <a href="./payment.php" class="block text-white hover:underline">Pay Online</a>
            <a href="./feeReceipt.php" class="block text-white hover:underline">Fee Receipt</a>
            <a href="./examForm.php" class="block text-white hover:underline">Form Submission</a>
            <a href="./editprofile.php" class="block text-white hover:underline">Edit Profile</a>
        </div>
            <div class="flex items-center space-x-4">
                <button class="text-white focus:outline-none md:hidden" id="menu-toggle">☰</button>
                <div class="flex items-center space-x-2">
                    <img src="<?php echo $profile_photo; ?>" alt="Profile" class="h-10 w-10 rounded-full">
                    <!-- <a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">Logout</a> -->
                </div>
            </div>
        </div>
        <div class="hidden md:hidden flex-col bg-green-500 p-4 space-y-2" id="mobile-menu">
            <a href="./dashboard.php" class="block text-white hover:underline">Dashboard</a>
            <a href="./payment.php" class="block text-white hover:underline">Pay Online</a>
            <a href="./feeReceipt.php" class="block text-white hover:underline">Fee Receipt</a>
            <a href="./examForm.php" class="block text-white hover:underline">Form Submission</a>
            <a href="./editprofile.php" class="block text-white hover:underline">Edit Profile</a>
        </div>
    </nav>

    <!-- Payment Section -->
    <div class="container mx-auto p-6 mt-10 max-w-lg bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold text-gray-700 text-center">Exam Fee Payment</h2>
        <p class="text-gray-600 text-center mt-2">Complete your payment using Razorpay</p>
        <div class="mt-6">
            <p class="text-lg font-semibold">Amount: <span class="text-green-600">₹1500</span></p>
        </div>
        <button id="pay-button" class="w-full bg-green-500 text-white py-2 mt-6 rounded-lg hover:bg-green-600 transition">Proceed to Pay</button>
    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.getElementById('pay-button').addEventListener('click', function () {
            var options = {
                "key": "YOUR_RAZORPAY_KEY", // Replace with your Razorpay key
                "amount": 150000, // Amount in paise (₹1500)
                "currency": "INR",
                "name": "KDK College",
                "description": "Exam Fee Payment",
                "image": "./images/kdk-logo.png",
                "handler": function (response) {
                    alert("Payment successful! Payment ID: " + response.razorpay_payment_id);
                    window.location.href = "./feeReceipt.php";
                },
                "prefill": {
                    "name": "Student Name",
                    "email": "student@example.com",
                    "contact": "9999999999"
                },
                "theme": {
                    "color": "#10B981"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
        });
    </script>
</body>
</html>
