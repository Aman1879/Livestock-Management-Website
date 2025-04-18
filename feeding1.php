<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feeding Cost Management</title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

  <!-- Feeding Cost Page -->
  <section id="feeding" class="page space-y-8 p-6">
    <h1 class="text-3xl font-bold text-gray-800">Feeding Cost Management</h1>

    <div class="bg-green-100 text-green-800 px-4 py-2 rounded hidden" id="feeding-success-alert">
      Feeding record saved successfully!
    </div>

    <!-- Add Feeding Record -->
    <div class="bg-white shadow rounded p-6 space-y-4">
      <h2 class="text-xl font-semibold text-gray-700">Add Feeding Record</h2>
      <form id="add-feeding-form" class="space-y-4">
        <div>
          <label for="feed-animal-id" class="block font-medium">Animal ID/Tag</label>
          <select id="feed-animal-id" class="mt-1 w-full p-2 border rounded" required>
            <option value="">Select Animal</option>
            <option value="A001">A001 - Holstein Cow</option>
            <option value="A002">A002 - Merino Sheep</option>
            <option value="A003">A003 - Yorkshire Pig</option>
          </select>
        </div>
        <div>
          <label for="feed-date" class="block font-medium">Date</label>
          <input type="date" id="feed-date" class="mt-1 w-full p-2 border rounded" required>
        </div>
        <div>
          <label for="feed-type" class="block font-medium">Feed Type</label>
          <input type="text" id="feed-type" class="mt-1 w-full p-2 border rounded" placeholder="e.g., Hay, Grain, Silage" required>
        </div>
        <div>
          <label for="feed-quantity" class="block font-medium">Quantity (kg)</label>
          <input type="number" id="feed-quantity" step="0.1" class="mt-1 w-full p-2 border rounded" required>
        </div>
        <div>
          <label for="feed-cost" class="block font-medium">Cost (₹)</label>
          <input type="number" id="feed-cost" step="0.01" class="mt-1 w-full p-2 border rounded" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save Record</button>
      </form>
    </div>

    <!-- Feeding Records Table -->
    <div class="bg-white shadow rounded p-6">
      <h2 class="text-xl font-semibold mb-4">Feeding Records List</h2>
      <div class="overflow-x-auto">
        <table class="w-full table-auto border border-gray-200 text-sm" id="feeding-table">
          <thead class="bg-gray-100 text-gray-700">
            <tr>
              <th class="px-4 py-2 border">Animal ID</th>
              <th class="px-4 py-2 border">Date</th>
              <th class="px-4 py-2 border">Feed Type</th>
              <th class="px-4 py-2 border">Quantity (kg)</th>
              <th class="px-4 py-2 border">Cost (₹)</th>
              <th class="px-4 py-2 border">Actions</th>
            </tr>
          </thead>
          <tbody id="feeding-records"></tbody>
        </table>
      </div>
    </div>
  </section>

  <script>
    const feedingForm = document.getElementById("add-feeding-form");
    const feedingTableBody = document.getElementById("feeding-records");
    const feedingSuccessAlert = document.getElementById("feeding-success-alert");

    let feedingRecords = [];

    feedingForm.addEventListener("submit", function (e) {
      e.preventDefault();

      const animalId = document.getElementById("feed-animal-id").value;
      const date = document.getElementById("feed-date").value;
      const type = document.getElementById("feed-type").value;
      const quantity = document.getElementById("feed-quantity").value;
      const cost = document.getElementById("feed-cost").value;

      const record = { animalId, date, type, quantity, cost };
      feedingRecords.push(record);
      renderFeedingTable();
      feedingForm.reset();

      feedingSuccessAlert.classList.remove("hidden");
      setTimeout(() => feedingSuccessAlert.classList.add("hidden"), 3000);
    });

    function renderFeedingTable() {
      feedingTableBody.innerHTML = "";

      feedingRecords.forEach((rec, index) => {
        const row = document.createElement("tr");
        row.className = "hover:bg-gray-50";

        row.innerHTML = `
          <td class="px-4 py-2 border">${rec.animalId}</td>
          <td class="px-4 py-2 border">${rec.date}</td>
          <td class="px-4 py-2 border">${rec.type}</td>
          <td class="px-4 py-2 border">${rec.quantity}</td>
          <td class="px-4 py-2 border">₹${parseFloat(rec.cost).toFixed(2)}</td>
          <td class="px-4 py-2 border space-x-2">
            <button class="text-blue-600 hover:text-blue-800" onclick="editFeedingRecord(${index})">Edit</button>
            <button class="text-red-600 hover:text-red-800" onclick="deleteFeedingRecord(${index})">Delete</button>
          </td>
        `;

        feedingTableBody.appendChild(row);
      });
    }

    function deleteFeedingRecord(index) {
      if (confirm("Are you sure you want to delete this record?")) {
        feedingRecords.splice(index, 1);
        renderFeedingTable();
      }
    }

    function editFeedingRecord(index) {
      const rec = feedingRecords[index];
      document.getElementById("feed-animal-id").value = rec.animalId;
      document.getElementById("feed-date").value = rec.date;
      document.getElementById("feed-type").value = rec.type;
      document.getElementById("feed-quantity").value = rec.quantity;
      document.getElementById("feed-cost").value = rec.cost;

      feedingRecords.splice(index, 1);
      renderFeedingTable();
    }
  </script>

</body>
</html>
