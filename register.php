<?php
include 'config.php';
session_start();

$username = $email = $password = $confirm_password = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    // Validate input
    if (empty($username)) $errors[] = "Username is required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format.";
    if ($password !== $confirm_password) $errors[] = "Passwords do not match.";

    if (empty($errors)) {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errors[] = "Email already registered.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user into DB
            $insert_stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $insert_stmt->bind_param("sss", $username, $email, $hashed_password);
            if ($insert_stmt->execute()) {
                $_SESSION['success'] = "Registration successful. Please log in.";
                header("Location: login.php");
                exit;
            } else {
                $errors[] = "Error in registration.";
            }
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<!-- Tailwind CSS Register Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="relative min-h-screen flex items-center justify-center bg-gray-100 overflow-hidden">

    <!-- 🔹 Background Video -->
    <video autoplay muted loop id="bg-video" class="absolute w-full h-full object-cover -z-10">
        <source src="v3.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- 🔹 Dark Overlay -->
    <div class="absolute inset-0 bg-black opacity-40 -z-10"></div>

    <!-- 🔹 Register Form -->
    <div id="register-box" class="hidden w-full max-w-md bg-gradient-to-br from-green-400 to-green-700 p-8 rounded shadow-lg backdrop-blur-md z-10 text-white">
        <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>

        <?php if (!empty($errors)): ?>
            <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
                <?php foreach ($errors as $e) echo "<p>$e</p>"; ?>
            </div>
        <?php endif; ?>

        <form method="POST" id="register-form">
            <input type="text" name="username" placeholder="Username" class="w-full p-2 mb-4 rounded text-gray-800" required>
            <input type="email" name="email" placeholder="Email" class="w-full p-2 mb-4 rounded text-gray-800" required>
            <input type="password" name="password" placeholder="Password" class="w-full p-2 mb-4 rounded text-gray-800" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" class="w-full p-2 mb-4 rounded text-gray-800" required>
            <button type="submit" class="w-full bg-white text-green-700 font-bold p-2 rounded hover:bg-gray-100 transition">Register</button>
        </form>

        <p class="mt-4 text-center text-sm text-white">
            Already have an account? <a href="login.php" class="underline text-white">Login</a>
        </p>
    </div>

    <!-- 🔹 jQuery Animation Script -->
    <script>
        $(document).ready(function () {
            $("#register-box").slideDown(800);

            $("#register-form").on("submit", function (e) {
                // Optional: Uncomment to animate on submit
                // $("#register-box").slideUp(400);
            });
        });
    </script>

</body>
</html>
