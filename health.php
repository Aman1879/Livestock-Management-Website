<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Health Records</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-50 p-6">

  <!-- Health Records Page -->
  <section id="health" class="space-y-8 max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800">Health Records</h1>

    <!-- Success Alert -->
    <div class="bg-green-100 text-green-800 px-4 py-2 rounded hidden" id="health-success-alert">
      Health record saved successfully!
    </div>

    <!-- Add Health Record -->
    <div class="bg-white shadow rounded p-6 space-y-4">
      <h2 class="text-xl font-semibold text-gray-700">Add Health Record</h2>
      <form id="add-health-form" class="space-y-4">
        <div>
          <label class="block font-medium">Animal ID/Tag</label>
          <select id="health-animal-id" class="mt-1 w-full p-2 border rounded" required>
            <option value="">Select Animal</option>
            <option value="A001">A001 - Holstein Cow</option>
            <option value="A002">A002 - Merino Sheep</option>
            <option value="A003">A003 - Yorkshire Pig</option>
          </select>
        </div>
        <div>
          <label class="block font-medium">Date</label>
          <input type="date" id="health-date" class="mt-1 w-full p-2 border rounded" required>
        </div>
        <div>
          <label class="block font-medium">Record Type</label>
          <select id="health-type" class="mt-1 w-full p-2 border rounded" required>
            <option value="">Select Type</option>
            <option value="Vaccination">Vaccination</option>
            <option value="Treatment">Treatment</option>
            <option value="Checkup">Routine Checkup</option>
            <option value="Illness">Illness</option>
            <option value="Injury">Injury</option>
          </select>
        </div>
        <div>
          <label class="block font-medium">Description</label>
          <textarea id="health-description" rows="3" class="mt-1 w-full p-2 border rounded" required></textarea>
        </div>
        <div>
          <label class="block font-medium">Treatment/Medicine</label>
          <input type="text" id="health-treatment" class="mt-1 w-full p-2 border rounded">
        </div>
        <div>
          <label class="block font-medium">Cost</label>
          <input type="number" id="health-cost" step="0.01" class="mt-1 w-full p-2 border rounded">
        </div>
        <div>
          <label class="block font-medium">Next Follow-up Date</label>
          <input type="date" id="health-next-followup" class="mt-1 w-full p-2 border rounded">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save Record</button>
      </form>
    </div>

    <!-- Health Records Table -->
    <div class="bg-white shadow rounded p-6">
      <h2 class="text-xl font-semibold mb-4">Health Records List</h2>
      <div class="overflow-x-auto">
        <table class="w-full table-auto border border-gray-200 text-sm" id="health-table">
          <thead class="bg-gray-100 text-gray-700">
            <tr>
              <th class="px-4 py-2 border">Animal ID</th>
              <th class="px-4 py-2 border">Date</th>
              <th class="px-4 py-2 border">Type</th>
              <th class="px-4 py-2 border">Description</th>
              <th class="px-4 py-2 border">Treatment</th>
              <th class="px-4 py-2 border">Cost</th>
              <th class="px-4 py-2 border">Next Follow-up</th>
              <th class="px-4 py-2 border">Actions</th>
            </tr>
          </thead>
          <tbody id="health-tbody">
            <!-- Dynamic rows go here -->
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <script>
    const form = document.getElementById('add-health-form');
    const tbody = document.getElementById('health-tbody');
    const alertBox = document.getElementById('health-success-alert');
    let records = [];

    form.addEventListener('submit', function (e) {
      e.preventDefault();

      const record = {
        animalId: document.getElementById('health-animal-id').value,
        date: document.getElementById('health-date').value,
        type: document.getElementById('health-type').value,
        description: document.getElementById('health-description').value,
        treatment: document.getElementById('health-treatment').value || 'N/A',
        cost: document.getElementById('health-cost').value ? `₹${parseFloat(document.getElementById('health-cost').value).toFixed(2)}` : '₹0.00',
        nextFollowup: document.getElementById('health-next-followup').value || 'N/A'
      };

      records.push(record);
      renderTable();
      form.reset();
      alertBox.classList.remove('hidden');
      setTimeout(() => alertBox.classList.add('hidden'), 3000);
    });

    function renderTable() {
      tbody.innerHTML = '';
      records.forEach((rec, index) => {
        const row = document.createElement('tr');
        row.classList.add('hover:bg-gray-50');
        row.innerHTML = `
          <td class="px-4 py-2 border">${rec.animalId}</td>
          <td class="px-4 py-2 border">${rec.date}</td>
          <td class="px-4 py-2 border">${rec.type}</td>
          <td class="px-4 py-2 border">${rec.description}</td>
          <td class="px-4 py-2 border">${rec.treatment}</td>
          <td class="px-4 py-2 border">${rec.cost}</td>
          <td class="px-4 py-2 border">${rec.nextFollowup}</td>
          <td class="px-4 py-2 border space-x-2">
            <button class="text-red-600 hover:text-red-800" onclick="deleteRecord(${index})"><i class="fas fa-trash"></i></button>
          </td>
        `;
        tbody.appendChild(row);
      });
    }

    function deleteRecord(index) {
      if (confirm('Are you sure you want to delete this record?')) {
        records.splice(index, 1);
        renderTable();
      }
    }
  </script>

</body>
</html>
