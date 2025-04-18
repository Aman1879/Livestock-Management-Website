document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("add-animal-form");
    const alertBox = document.getElementById("animal-success-alert");
    const tableBody = document.querySelector("tbody");
    
    let isEditing = false;
    let currentEditId = null;

    // Helper: show success message
    function showSuccessMessage(message = "Operation completed successfully!") {
        alertBox.textContent = message;
        alertBox.classList.remove("hidden");
        setTimeout(() => {
            alertBox.classList.add("hidden");
        }, 2000);
    }

    // Helper: create table row
    function createTableRow(animal) {
        const tr = document.createElement("tr");
        tr.innerHTML = `
            <td class="p-4 border">${animal.id}</td>
            <td class="p-4 border">${animal.type}</td>
            <td class="p-4 border">${animal.breed}</td>
            <td class="p-4 border">${animal.dob}</td>
            <td class="p-4 border">${animal.gender}</td>
            <td class="p-4 border">${animal.weight}</td>
            <td class="p-4 border space-x-4">
                <button class="text-blue-500 hover:text-blue-600 edit-btn" data-id="${animal.id}"><i class="fas fa-edit"></i> Edit</button>
                <button class="text-red-500 hover:text-red-600 delete-btn" data-id="${animal.id}"><i class="fas fa-trash"></i> Delete</button>
            </td>
        `;
        tableBody.appendChild(tr);
    }

    // Helper: get form data
    function getFormData() {
        return {
            id: document.getElementById("animal-id").value.trim(),
            type: document.getElementById("animal-type").value,
            breed: document.getElementById("animal-breed").value.trim(),
            dob: document.getElementById("animal-dob").value,
            gender: document.getElementById("animal-gender").value,
            weight: parseFloat(document.getElementById("animal-weight").value).toFixed(2),
            notes: document.getElementById("animal-notes").value.trim(),
        };
    }

    // Helper: reset form
    function resetForm() {
        form.reset();
        isEditing = false;
        currentEditId = null;
        form.querySelector("button[type='submit']").textContent = "Add Animal";
    }

    // Handle form submission
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        const animal = getFormData();

        if (isEditing) {
            // Edit existing row
            const rows = tableBody.querySelectorAll("tr");
            rows.forEach(row => {
                if (row.children[0].textContent === currentEditId) {
                    row.children[0].textContent = animal.id;
                    row.children[1].textContent = animal.type;
                    row.children[2].textContent = animal.breed;
                    row.children[3].textContent = animal.dob;
                    row.children[4].textContent = animal.gender;
                    row.children[5].textContent = animal.weight;
                    row.children[6].innerHTML = `
                        <button class="text-blue-500 hover:text-blue-600 edit-btn" data-id="${animal.id}"><i class="fas fa-edit"></i> Edit</button>
                        <button class="text-red-500 hover:text-red-600 delete-btn" data-id="${animal.id}"><i class="fas fa-trash"></i> Delete</button>
                    `;
                }
            });
            showSuccessMessage("Animal updated successfully!");
        } else {
            // Add new row
            createTableRow(animal);
            showSuccessMessage("Animal added successfully!");
        }

        resetForm();
    });

    // Event delegation for Edit and Delete buttons
    tableBody.addEventListener("click", (e) => {
        if (e.target.closest(".edit-btn")) {
            const row = e.target.closest("tr");
            const cells = row.children;

            document.getElementById("animal-id").value = cells[0].textContent;
            document.getElementById("animal-type").value = cells[1].textContent;
            document.getElementById("animal-breed").value = cells[2].textContent;
            document.getElementById("animal-dob").value = cells[3].textContent;
            document.getElementById("animal-gender").value = cells[4].textContent;
            document.getElementById("animal-weight").value = cells[5].textContent;
            // Notes are not displayed in the table, so skip it

            isEditing = true;
            currentEditId = cells[0].textContent;
            form.querySelector("button[type='submit']").textContent = "Update Animal";
        }

        if (e.target.closest(".delete-btn")) {
            const row = e.target.closest("tr");
            const id = e.target.closest(".delete-btn").dataset.id;
            if (confirm(`Are you sure you want to delete animal ID: ${id}?`)) {
                row.remove();
                showSuccessMessage("Animal deleted successfully!");
            }
        }
    });
});
