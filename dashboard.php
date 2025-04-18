<?php
session_start();
if (!isset($_SESSION["loggedin"])) {
    header("Location: login.php");
    exit;
}
$username = ucfirst($_SESSION["username"]);
$date = date("l, F j, Y");
$time = date("h:i A");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome <?= htmlspecialchars($username); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #f8fafc, #e0f7fa);
      overflow-x: hidden; /* Prevent horizontal scrolling */
      transition: all 0.3s ease-in-out;
    }
    .fadeInBox {
      display: none;
    }
    .gradient-box {
      background: linear-gradient(135deg, #a1c4fd, #c2e9fb);
    }
    .photo-grid img {
      transition: transform 0.3s;
    }
    .photo-grid img:hover {
      transform: scale(1.05);
    }

    /* Sidebar styles */
    #sidebar {
      transition: transform 0.3s ease-in-out;
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      width: 256px;
      background-color: #1f2937;
      color: white;
      transform: translateX(-100%);
      z-index: 50;
    }

    /* Content wrapper */
    #content-wrapper {
      transition: margin-left 0.3s ease-in-out;
      margin-left: 0;
      z-index: 1;
    }

    /* Move the content when sidebar opens */
    #content-wrapper.sidebar-open {
      margin-left: 256px; /* Same width as the sidebar */
    }

    /* Shift the header and content to the right when sidebar opens */
    body.sidebar-open {
      margin-left: 256px;
    }

    #sidebar.open {
      transform: translateX(0);
    }

    @media (max-width: 767px) {
      body.sidebar-open {
        margin-left: 0;
      }
    }
  </style>
</head>
<body class="min-h-screen">

<!-- Header -->
<header class="bg-gradient-to-r from-blue-500 to-blue-700 text-white py-5 px-8 shadow-lg flex flex-col md:flex-row md:justify-between items-center gap-4 md:gap-0 transition-all">
  <div class="flex items-center gap-4">
    <button id="toggleSidebar" class="bg-gray-800 hover:bg-gray-700 text-white p-2 rounded shadow-md transition">
      ☰ Menu
    </button>
    <div class="text-2xl font-bold">👋 Welcome, <span class="text-yellow-300"><?= $username ?></span></div>
  </div>
  <div class="text-sm">📅 <?= $date ?> | ⏰ <?= $time ?></div>
  <a href="logout.php" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-full text-sm font-medium transition duration-200">Logout</a>
</header>

<!-- Sidebar (slides from left) -->
<div id="sidebar" class="fixed top-0 left-0 h-full bg-gray-900 text-white z-50 shadow-lg">
  <div class="p-4 font-bold text-lg border-b border-gray-700">Dashboard Menu</div>
  <nav class="mt-4 space-y-2">
    <a href="animals.php" class="block py-2 px-6 hover:bg-gray-700">🐄 Animal Inventory</a>
    <a href="health.php" class="block py-2 px-6 hover:bg-gray-700">💉 Health Record</a>
    <a href="feeding1.php" class="block py-2 px-6 hover:bg-gray-700"> 💰Feeding Cost</a>
    <a href="report.php" class="block py-2 px-6 hover:bg-gray-700">📊 Report</a>
  </nav>
</div>

<!-- Content Wrapper -->
<div id="content-wrapper">

  <!-- Main Content -->
  <main class="max-w-7xl mx-auto p-6">
    <section class="fadeInBox space-y-8">

      <!-- Dashboard Metrics -->
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <div class="p-6 rounded-lg shadow gradient-box text-center text-gray-800">
          <h3>Total Animals</h3>
          <div class="text-3xl font-bold" id="total-animals">43</div>
        </div>
        <div class="p-6 rounded-lg shadow gradient-box text-center text-gray-800">
          <h3>Health Alerts</h3>
          <div class="text-3xl font-bold" id="health-alerts">4</div>
        </div>
        <div class="p-6 rounded-lg shadow gradient-box text-center text-gray-800">
          <h3>Feeding Today</h3>
          <div class="text-3xl font-bold" id="feeding-today">12</div>
        </div>
        <div class="p-6 rounded-lg shadow gradient-box text-center text-gray-800">
          <h3>Costs This Month</h3>
          <div class="text-3xl font-bold" id="monthly-costs">₹8,200</div>
        </div>
      </div>

      <!-- Species Chart -->
      <div class="bg-white p-6 rounded shadow">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold text-gray-800">Animal Distribution by Species</h2>
          <button id="toggle-species" class="bg-blue-500 text-white px-4 py-1 rounded">Click</button>
        </div>
        <div id="species-chart" class="grid grid-cols-5 text-center space-x-2">
          <div>
            <div class="w-20 h-20 mx-auto rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-xl">45%</div>
            <p class="mt-1">Cattle</p>
          </div>
          <div>
            <div class="w-16 h-16 mx-auto rounded-full bg-green-500 text-white flex items-center justify-center font-bold text-lg">25%</div>
            <p class="mt-1">Sheep</p>
          </div>
          <div>
            <div class="w-14 h-14 mx-auto rounded-full bg-yellow-500 text-white flex items-center justify-center font-bold text-lg">15%</div>
            <p class="mt-1">Pigs</p>
          </div>
          <div>
            <div class="w-12 h-12 mx-auto rounded-full bg-red-500 text-white flex items-center justify-center font-bold">10%</div>
            <p class="mt-1">Chickens</p>
          </div>
          <div>
            <div class="w-10 h-10 mx-auto rounded-full bg-purple-500 text-white flex items-center justify-center font-bold">5%</div>
            <p class="mt-1">Other</p>
          </div>
        </div>
      </div>

      <!-- Activities -->
      <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Recent Activities</h2>
        <div id="activity-list" class="space-y-2">
          <div class="text-sm p-2 bg-gray-50 rounded hover:bg-gray-100 transition">🐄 <strong>Today 10:30 AM</strong> - New cow added</div>
          <div class="text-sm p-2 bg-gray-50 rounded hover:bg-gray-100 transition">💉 <strong>Yesterday</strong> - Vaccination scheduled</div>
          <div class="text-sm p-2 bg-gray-50 rounded hover:bg-gray-100 transition">🍽️ <strong>Feb 15</strong> - Updated feeding</div>
          <div class="text-sm p-2 bg-gray-50 rounded hover:bg-gray-100 transition">🩺 <strong>Feb 14</strong> - Health check done</div>
        </div>
      </div>

      <!-- Owner Photos -->
      <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Meet the Owners</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 photo-grid">
          <div class="text-center">
            <img src="wh.jpg" alt="Owner 1" class="rounded-full w-24 h-24 mx-auto shadow">
            <p class="mt-2 text-sm font-semibold">Aman</p>
          </div>
          <div class="text-center">
            <img src="rudra.jpg" alt="Owner 2" class="rounded-full w-24 h-24 mx-auto shadow">
            <p class="mt-2 text-sm font-semibold">Rudrajeet</p>
          </div>
          <div class="text-center">
            <img src="p3.jpg" alt="Owner 3" class="rounded-full w-24 h-24 mx-auto shadow">
            <p class="mt-2 text-sm font-semibold">Suryakant</p>
          </div>
          <div class="text-center">
            <img src="unnat.jpg" alt="Owner 4" class="rounded-full w-24 h-24 mx-auto shadow">
            <p class="mt-2 text-sm font-semibold">Unnat</p>
          </div>
        </div>
      </div>

    </section>
  </main>
</div>

<!-- Footer -->
<footer class="bg-gray-800 text-white text-center p-4 mt-10">
  <p>📞 Contact: +91-6299211631 | 📧 Email: amanara13579@gmail.com</p>
  <p class="text-sm mt-1">© 2025 Apna Livestock. All rights reserved.</p>
</footer>

<!-- JavaScript -->
<script>


$(document).ready(function () {
  // Fade-in dashboard content
  $(".fadeInBox").fadeIn(1000);

  // Toggle the species chart visibility
  $("#toggle-species").click(function() {
    $("#species-chart").toggle(1000);  // This will toggle the display of the species chart
  });
});

  // Toggle sidebar and shift content
  const toggleBtn = document.getElementById("toggleSidebar");
  const sidebar = document.getElementById("sidebar");
  const contentWrapper = document.getElementById("content-wrapper");
  const body = document.body;

  toggleBtn.addEventListener("click", () => {
    // Toggle sidebar open/close
    sidebar.classList.toggle("open");
    contentWrapper.classList.toggle("sidebar-open");
    body.classList.toggle("sidebar-open"); // Move the entire page to the right
  });

  $(document).ready(function () {
    // Fade-in dashboard content
    $(".fadeInBox").fadeIn(1000);
  });
</script>

</body>
</html>
