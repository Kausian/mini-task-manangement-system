const form = document.getElementById("task-form");
const titleInput = document.getElementById("title");
const descriptionInput = document.getElementById("description");
const priorityInput = document.getElementById("priority");
const validationMessage = document.getElementById("validation-message");
const submitBtn = document.getElementById("submit-btn");

form.addEventListener("submit", function (event) {
    const title = titleInput.value.trim();
    const description = descriptionInput.value.trim();
    const priority = priorityInput.value;

    let error = "";

    if (title === "" || description === "" || priority === "") {
        error = "All fields are required.";
    } else if (title.length < 3) {
        error = "Title must be at least 3 characters.";
    }

    if (error !== "") {
        event.preventDefault();
        validationMessage.textContent = error;
        validationMessage.classList.remove("hidden");
        return;
    }

    validationMessage.classList.add("hidden");
    submitBtn.disabled = true;
    submitBtn.textContent = "Adding...";
});

const searchInput = document.getElementById("search");
const taskRows = document.querySelectorAll(".task-row");
const noResults = document.getElementById("no-results");

searchInput.addEventListener("input", function () {
    const term = searchInput.value.trim().toLowerCase();
    let visibleCount = 0;

    taskRows.forEach(function (row) {
        const title = row.querySelector(".task-title").textContent.trim().toLowerCase();
        if (title.indexOf(term) !== -1) {
            row.classList.remove("hidden");
            visibleCount++;
        } else {
            row.classList.add("hidden");
        }
    });

    if (visibleCount === 0) {
        noResults.classList.remove("hidden");
    } else {
        noResults.classList.add("hidden");
    }
});
