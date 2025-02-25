<?php
session_start();
include("project/connection.php");

// Ensure the user is logged in
if (!isset($_SESSION['student'])) {
    die("Unauthorized access.");
}

$user_id = $_SESSION['student'];

if (isset($_POST['login'])) {
    // Sanitize inputs
    $branch = mysqli_real_escape_string($connect, $_POST['branch']);
    $semester = mysqli_real_escape_string($connect, $_POST['semester']);
    $subjects = isset($_POST['subjects']) ? implode(", ", $_POST['subjects']) : "";
    $elective = isset($_POST['elective']) ? mysqli_real_escape_string($connect, $_POST['elective']) : "";

    // Prepare SQL statement
    $stmt = $connect->prepare("INSERT INTO exam_selections (id, branch, semester, subjects, elective) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $connect->error);
    }

    $stmt->bind_param("issss", $user_id, $branch, $semester, $subjects, $elective);

    if ($stmt->execute()) {
        echo "<script>alert('Exam subjects saved successfully.');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Submit Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gray-100 min-h-screen">
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
          <img src="./images/kdk-logo.png" alt="Logo" class="h-10 w-10" />
          <span class="text-white text-lg font-bold"
            >KDK COLLEGE OF ENGINEERING, NAGPUR</span
          >
        </div>
        <div class="hidden md:flex space-x-6 text-white">
          <a href="./dashboard.php" class="hover:underline">Dashboards</a>
          <a href="./payment.php" class="hover:underline">Pay Online</a>
          <a href="./feeReceipt.php" class="hover:underline">Fee Receipt</a>
          <a href="./examForm.php" class="hover:underline">Form Submission</a>
          <a href="./editprofile.php" class="hover:underline">Edit Profile</a>
        </div>
        <div class="flex items-center space-x-4">
          <button
            class="text-white focus:outline-none md:hidden"
            id="menu-toggle"
          >
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
      <div
        class="hidden md:hidden flex-col bg-green-500 p-4 space-y-2"
        id="mobile-menu"
      >
        <a href="./dashboard.php" class="block text-white hover:underline">Dashboards</a>
        <a href="./payment.php" class="block text-white hover:underline">Pay Online</a>
        <a href="./feeReceipt.php" class="block text-white hover:underline">Fee Receipt</a>
        <a href="./examForm.php" class="block text-white hover:underline">Form Submission</a>
        <a href="./editprofile.php" class="block text-white hover:underline">Edit Profile</a>
      </div>
    </nav>

    <!-- Form Section -->
    <div
      class="container mx-auto p-6 mt-6 bg-white shadow-lg rounded-lg max-w-2xl"
    >
      <h2 class="text-2xl font-bold text-center text-gray-800">
        Exam Subject Selection
      </h2>
      <form class="mt-4 space-y-4" method="POST">
            <div>
                <label class="block text-gray-600 font-medium">Select Branch:</label>
                <select id="branch" name="branch" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-green-500">
                    <option value="">-- Select Branch --</option>
                    <option value="cse">Computer Science & Engineering</option>
                    <option value="it">Information Technology</option>
                    <option value="ece">Electronics & Communication</option>
                    <option value="mech">Mechanical Engineering</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-600 font-medium">Select Semester:</label>
                <select id="semester" name="semester" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-green-500">
                    <option value="">-- Select Semester --</option>
                    <option value="1">Semester 1</option>
                    <option value="2">Semester 2</option>
                    <option value="3">Semester 3</option>
                    <option value="4">Semester 4</option>
                    <option value="5">Semester 5</option>
                    <option value="6">Semester 6</option>
                    <option value="7">Semester 7</option>
                    <option value="8">Semester 8</option>
                </select>
            </div>

            <div id="subjects-container">
                <label class="block text-gray-600 font-medium">Select Subjects:</label>
                <div id="subjects" class="space-y-2"></div>
            </div>

            <button type="submit" name="login" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-lg shadow-md">
                Submit
            </button>
        </form>
    </div>

    <script>
      const branchSubjects = {
        cse: {
          1: [
            "Mathematics I",
            "Applied Physics s",
            "Energy And Environment",
            "Engineering Graphics ",
            "Communication Skills",
            "Basics of Civil & Mechanical Engineering",
            "Applied Physics Lab",
            "Energy And Environment  Lab",
            "Engineering Graphics Lab",
            "Communication Skills Lab",
          ],
          2: [
            "Mathematics II",
            "Advanced Engineering Materials",
            "Applied Chemistry",
            "Computational Skills",
            "Basic Electrical Engineering",
            "Engineering Mechanics",
            "Advanced Engineering Materials Lab",
            "Applied Chemistry Lab ",
            "Computational Skills Lab",
            "Indian Culture And Constitution",
          ],
          3: [
            "Computer Architecture and Design System",
            "Object Oriented Programming with Java ",
            "Operating System",
            "Ethics in IT ",
            "Universal Human Values ",
            "Mathematics III",
            "Object Oriented Programming with Java Lab",
            "Operating System Lab",
            "Computer Workshop 1 Practical",
          ],
          4: [
            "Discrete Mathematics and Graph Theory",
            "Database Management System",
            "Data Structure And Program Design",
            "Computer Network",
            "System Programming",
            "Theory of Computation",
            "Database Management System Lab",
            "Data Structure And Program Design Lab",
          ],
          5: [
            "Artificial Intelligence",
            "Design and Analysis of Algorithm",
            "Software Engineering And management",
            "Effective Technical Communication",
            "Artificial Intelligence(Lab)",
            "Design and Analysis of Algorithm(Lab)",
            "Professional Skills 1 (Lab)",
            {
              electives: [
                "Data Warehouse And Mining",
                "Tcp/Ip",
                "Design Patterns",
              ],
            },
          ],
          6: [
            "Compiler Design",
            "Mini Project",
            "Economics of IT industry",
            "Intellectual Property Rights(Audit Course)",
            "Compiler Design - Lab",
            "Professional Skills Lab II",
            "Hardware Lab",

            {
              electives: [
                "Machine Learning ",
                "Internet of things",
                "Cluster and Cloud Computing",
              ],
            },
            {
              electives: [
                "Data Science ",
                "Distributed Operating Systems",
                "Human Computer Interaction",
              ],
            },
            {
              electives: [
                "Linux Fundamentals",
                "Android Application Development",
                "Blockchain Technologies",
              ],
            },
          ],
          7: [
            "Cryptography and Network Security",
            "Cryptography and Network Security (Lab)",
            {
              electives: [
                "Deep Learning",
                "Optimization TechniquesGaming Architecture",
                "Salesforce Technology",
              ],
              electives: [
                "Natural Language Processing",
                "Big Data Analysis",
                "Mobile Computing",
              ],
              electives: [
                "Python Programming",
                "JAVA Programming",
                "Basics of Database Management System",
              ],
            },
          ],
          8: [
            "Industry Project ",
            {
              electives: [
                "Social Networks",
                "Reinforcement Learning",
                "GPU Architecture and Programming",
              ],
              electives: [
                "Predictive Analysis-Regression and Classification",
                "Blockchain and Application",
                "Computer Vision",
              ],
            },
          ],
        },

        it: {
          1: ["Maths I", "Fundamentals of IT", "Programming Logic"],
          2: ["Maths II", "Java Programming", "Data Communication"],
          3: ["Web Development", "Computer Organization", "Database Concepts"],
          4: ["Software Engineering", "Operating Systems", "Computer Networks"],
          5: [
            "Cloud Computing",
            "AI & ML",
            { electives: ["Blockchain", "Cyber Security", "Data Science"] },
          ],
          6: [
            "Big Data",
            "Mobile Application Development",
            { electives: ["DevOps", "IoT", "AR/VR"] },
          ],
        },
      };

      document.getElementById("semester").addEventListener("change", function () {
            const branch = document.getElementById("branch").value;
            const sem = this.value;
            const subjectsDiv = document.getElementById("subjects");
            subjectsDiv.innerHTML = "";

            if (!branch) {
                alert("Select the branch first");
                return;
            }

            if (sem && branchSubjects[branch] && branchSubjects[branch][sem]) {
                branchSubjects[branch][sem].forEach((subject, index) => {
                    if (typeof subject === "string") {
                        subjectsDiv.innerHTML += `<div><input type="checkbox" name="subjects[]" value="${subject}" class="mr-2">${subject}</div>`;
                    } else if (subject.electives) {
                        subjectsDiv.innerHTML += `<div class="font-semibold mt-2">Elective Subjects (Select One)</div>`;
                        subject.electives.forEach((elective, i) => {
                            subjectsDiv.innerHTML += `<div><input type="radio" name="elective" value="${elective}" class="mr-2">${elective}</div>`;
                        });
                    }
                });
            }
        });

    </script>
  </body>
</html>
