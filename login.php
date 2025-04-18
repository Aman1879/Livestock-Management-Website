<?php
include 'config.php';
session_start();

$email = $password = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $username, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $id;
            $_SESSION["username"] = $username;

            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found with that email.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- Tailwind CSS Login Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="relative min-h-screen flex items-center justify-center bg-gray-100 overflow-hidden">

    <!-- 🔹 Background Video -->
    <video autoplay muted loop id="bg-video" class="absolute w-full h-full object-cover -z-10">
        <source src="v2.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- 🔹 Dark Overlay -->
    <div class="absolute inset-0 bg-black opacity-40 -z-10"></div>

    <!-- 🔹 Login Form Container -->
    <div id="login-box" class="hidden w-full max-w-md bg-gradient-to-br from-green-200 to-green-700 p-8 rounded shadow-lg backdrop-blur-md z-10 text-white">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

        <?php if (!empty($_SESSION["success"])): ?>
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                <?= $_SESSION["success"]; unset($_SESSION["success"]); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="bg-red-100 text-red-800 p-2 rounded mb-4"><?= $error; ?></div>
        <?php endif; ?>

        <form method="POST" id="login-form">
            <input type="email" name="email" placeholder="Email" class="w-full p-2 mb-4 rounded text-gray-800" required>
            <input type="password" name="password" placeholder="Password" class="w-full p-2 mb-4 rounded text-gray-800" required>
            <button type="submit" class="w-full bg-white text-green-700 font-bold p-2 rounded hover:bg-gray-100 transition">Login</button>
        </form>

        <p class="mt-4 text-center text-sm text-white">
            Don't have an account? <a href="register.php" class="underline text-white">Register</a>
        </p>
    </div>

    <!-- 🔹 jQuery Animation Script -->
    <script>
        $(document).ready(function () {
            // Slide down form on page load
            $("#login-box").slideDown(800);

            // Optional: Slide up on form submission
            $("#login-form").on("submit", function (e) {
                $("#login-box").slideUp(400);
            });
        });
    </script>

</body>
</html>
