<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Inventory Page</title>

    <!-- Link to Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Link to FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  
</head>

<body class="bg-gray-100">




<!-- Animal Inventory Page -->
<section id="animals" class="page space-y-8 px-4 py-6">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Animal Inventory</h1>

    <!-- Success Alert -->
    <div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded-lg shadow-md hidden" id="animal-success-alert">
        Operation completed successfully!
    </div>

    <!-- Add New Animal Section -->
    <div class="bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Add New Animal</h2>
        <form id="add-animal-form" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">ID/Tag Number</label>
                <input type="text" id="animal-id" class="w-full border p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Animal Type</label>
                <select id="animal-type" class="w-full border p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Select Type</option>
                    <option value="Cattle">Cattle</option>
                    <option value="Sheep">Sheep</option>
                    <option value="Goat">Goat</option>
                    <option value="Pig">Pig</option>
                    <option value="Chicken">Chicken</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Breed</label>
                <input type="text" id="animal-breed" class="w-full border p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Date of Birth/Acquisition</label>
                <input type="date" id="animal-dob" class="w-full border p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Gender</label>
                <select id="animal-gender" class="w-full border p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Weight (kg)</label>
                <input type="number" id="animal-weight" step="0.01" class="w-full border p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Notes</label>
                <textarea id="animal-notes" rows="3" class="w-full border p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition-all duration-300">Add Animal</button>
        </form>
    </div>

    <!-- Animal Inventory List Section -->
    <div class="bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Animal Inventory List</h2>
        <div class="overflow-x-auto rounded-lg shadow-md">
            <table class="min-w-full text-sm table-auto">
                <thead class="bg-blue-100 text-blue-700">
                    <tr>
                        <th class="p-4 border">ID/Tag</th>
                        <th class="p-4 border">Type</th>
                        <th class="p-4 border">Breed</th>
                        <th class="p-4 border">DOB/Acquired</th>
                        <th class="p-4 border">Gender</th>
                        <th class="p-4 border">Weight (kg)</th>
                        <th class="p-4 border">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-50">
                    <tr>
                        <td class="p-4 border">A001</td>
                        <td class="p-4 border">Cattle</td>
                        <td class="p-4 border">Holstein</td>
                        <td class="p-4 border">2020-04-15</td>
                        <td class="p-4 border">Female</td>
                        <td class="p-4 border">650</td>
                        <td class="p-4 border space-x-4">
                            <button class="text-blue-500 hover:text-blue-600 edit-btn" data-id="A001"><i class="fas fa-edit"></i> Edit</button>
                            <button class="text-red-500 hover:text-red-600 delete-btn" data-id="A001"><i class="fas fa-trash"></i> Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-4 border">A002</td>
                        <td class="p-4 border">Sheep</td>
                        <td class="p-4 border">Merino</td>
                        <td class="p-4 border">2021-02-10</td>
                        <td class="p-4 border">Male</td>
                        <td class="p-4 border">75</td>
                        <td class="p-4 border space-x-4">
                            <button class="text-blue-500 hover:text-blue-600 edit-btn" data-id="A002"><i class="fas fa-edit"></i> Edit</button>
                            <button class="text-red-500 hover:text-red-600 delete-btn" data-id="A002"><i class="fas fa-trash"></i> Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-4 border">A003</td>
                        <td class="p-4 border">Pig</td>
                        <td class="p-4 border">Yorkshire</td>
                        <td class="p-4 border">2021-07-22</td>
                        <td class="p-4 border">Female</td>
                        <td class="p-4 border">120</td>
                        <td class="p-4 border space-x-4">
                            <button class="text-blue-500 hover:text-blue-600 edit-btn" data-id="A003"><i class="fas fa-edit"></i> Edit</button>
                            <button class="text-red-500 hover:text-red-600 delete-btn" data-id="A003"><i class="fas fa-trash"></i> Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>


<script src="animal.js"></script>

    
</body>



</html>