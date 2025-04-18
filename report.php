<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Smart Farm Reports</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- jQuery CDN -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>
<body class="bg-gray-100 font-sans">

  <!-- Header -->
  <header class="bg-gradient-to-r from-blue-700 to-blue-400 text-white p-8 rounded-b-3xl shadow-md text-center">
    <h1 class="text-4xl font-bold animate__animated animate__fadeInDown">📊 Smart Farm Reports Dashboard</h1>
    <p class="mt-2 text-lg">Monitor, Analyze, and Take Action</p>
  </header>

  <!-- Main Content -->
  <main class="max-w-5xl mx-auto p-6 space-y-10">

    <!-- Report Form -->
    <section class="bg-white p-6 rounded-xl shadow-md animate__animated animate__fadeInUp">
      <h2 class="text-2xl font-semibold mb-4">Generate Report</h2>
      <form id="generate-report-form" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <label for="report-type" class="block text-sm font-medium text-gray-700 mb-1">Report Type</label>
          <select id="report-type" class="w-full border border-gray-300 rounded-md px-3 py-2">
            <option value="">Select Type</option>
            <option value="daily">Daily</option>
            <option value="weekly">Weekly</option>
            <option value="monthly">Monthly</option>
          </select>
        </div>
        <div>
          <label for="report-date-from" class="block text-sm font-medium text-gray-700 mb-1">From</label>
          <input type="date" id="report-date-from" class="w-full border border-gray-300 rounded-md px-3 py-2" />
        </div>
        <div>
          <label for="report-date-to" class="block text-sm font-medium text-gray-700 mb-1">To</label>
          <input type="date" id="report-date-to" class="w-full border border-gray-300 rounded-md px-3 py-2" />
        </div>
        <div class="md:col-span-3 flex justify-center mt-4">
          <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-300 shadow-md">
            Generate
          </button>
        </div>
      </form>
    </section>

    <!-- Reports Table -->
    <section class="bg-white p-6 rounded-xl shadow-md animate__animated animate__fadeInUp animate__delay-1s">
      <h2 class="text-2xl font-semibold mb-4">Recent Reports</h2>
      <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-700">
          <thead class="bg-gray-100 text-gray-700 font-semibold uppercase text-xs">
            <tr>
              <th class="px-4 py-2">Report Name</th>
              <th class="px-4 py-2">Generated On</th>
              <th class="px-4 py-2">Type</th>
              <th class="px-4 py-2">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y">
            <tr class="hover:bg-blue-50 transition duration-200 ease-in-out">
              <td class="px-4 py-3">Weekly Climate Report</td>
              <td class="px-4 py-3">2025-04-16</td>
              <td class="px-4 py-3">Weekly</td>
              <td class="px-4 py-3 flex space-x-4">
                <button class="text-blue-600 hover:text-blue-800"><i class="fas fa-eye"></i></button>
                <button class="text-green-600 hover:text-green-800"><i class="fas fa-download"></i></button>
              </td>
            </tr>
            <tr class="hover:bg-blue-50 transition duration-200 ease-in-out">
              <td class="px-4 py-3">Daily Soil Report</td>
              <td class="px-4 py-3">2025-04-17</td>
              <td class="px-4 py-3">Daily</td>
              <td class="px-4 py-3 flex space-x-4">
                <button class="text-blue-600 hover:text-blue-800"><i class="fas fa-eye"></i></button>
                <button class="text-green-600 hover:text-green-800"><i class="fas fa-download"></i></button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <!-- Confirmation Modal -->
  <div id="confirm-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded-xl shadow-2xl w-full max-w-md transform transition-all scale-95 hover:scale-100">
      <h3 class="text-xl font-bold mb-2" id="modal-title">Confirm Action</h3>
      <p class="mb-4 text-gray-700" id="modal-message">Are you sure you want to proceed?</p>
      <div class="flex justify-end space-x-4">
        <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400" id="modal-cancel-btn">Cancel</button>
        <button class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700" id="modal-confirm-btn">Confirm</button>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    $(document).ready(function () {
      $("#generate-report-form").on("submit", function (e) {
        e.preventDefault();

        const type = $("#report-type").val();
        const from = $("#report-date-from").val();
        const to = $("#report-date-to").val();

        if (type && from && to) {
          alert(`Report Generated:\nType: ${type}\nFrom: ${from}\nTo: ${to}`);
        } else {
          alert("Please fill in all fields.");
        }
      });

      $(".close-modal, #modal-cancel-btn").on("click", function () {
        $("#confirm-modal").fadeOut();
      });

      $("#modal-confirm-btn").on("click", function () {
        alert("Action Confirmed!");
        $("#confirm-modal").fadeOut();
      });

      $(".fa-download").on("click", function () {
        $("#modal-title").text("Download Report");
        $("#modal-message").text("Do you want to download this report?");
        $("#confirm-modal").fadeIn();
      });

      $(".fa-eye").on("click", function () {
        $("#modal-title").text("View Report");
        $("#modal-message").text("Do you want to view this report?");
        $("#confirm-modal").fadeIn();
      });
    });
  </script>
</body>
</html>
