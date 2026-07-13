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

// --- Search + client-side pagination ---

const searchInput = document.getElementById("search");
const noResults = document.getElementById("no-results");
const pagination = document.getElementById("pagination");

// All task rows on the page (turned into a real array so we can slice it)
const allTaskRows = Array.prototype.slice.call(document.querySelectorAll(".task-row"));

const tasksPerPage = 5;
let currentPage = 1;

// Rows that match the current search term (starts with every row)
let matchingRows = allTaskRows;

// Keep only the rows whose title contains the search term
function filterRows() {
    const term = searchInput.value.trim().toLowerCase();

    matchingRows = allTaskRows.filter(function (row) {
        const title = row.querySelector(".task-title").textContent.trim().toLowerCase();
        return title.indexOf(term) !== -1;
    });
}

// Show only the rows that belong on the current page
function showCurrentPage() {
    // Hide every task row first
    allTaskRows.forEach(function (row) {
        row.classList.add("hidden");
    });

    // Show the "No matching tasks found" row only when nothing matches
    if (matchingRows.length === 0) {
        noResults.classList.remove("hidden");
        return;
    }
    noResults.classList.add("hidden");

    // Work out which rows to show for the current page
    const start = (currentPage - 1) * tasksPerPage;
    const end = start + tasksPerPage;

    matchingRows.slice(start, end).forEach(function (row) {
        row.classList.remove("hidden");
    });
}

// Build the Previous / page numbers / Next buttons
function renderPagination() {
    pagination.innerHTML = "";

    const totalPages = Math.ceil(matchingRows.length / tasksPerPage);

    // No buttons needed when everything fits on one page
    if (totalPages <= 1) {
        return;
    }

    // Previous button
    const prevButton = document.createElement("button");
    prevButton.type = "button";
    prevButton.textContent = "Previous";
    prevButton.disabled = currentPage === 1;
    prevButton.addEventListener("click", function () {
        currentPage--;
        update();
    });
    pagination.appendChild(prevButton);

    // One button per page number
    for (let page = 1; page <= totalPages; page++) {
        const pageButton = document.createElement("button");
        pageButton.type = "button";
        pageButton.textContent = page;
        if (page === currentPage) {
            pageButton.classList.add("active");
        }
        pageButton.addEventListener("click", function () {
            currentPage = page;
            update();
        });
        pagination.appendChild(pageButton);
    }

    // Next button
    const nextButton = document.createElement("button");
    nextButton.type = "button";
    nextButton.textContent = "Next";
    nextButton.disabled = currentPage === totalPages;
    nextButton.addEventListener("click", function () {
        currentPage++;
        update();
    });
    pagination.appendChild(nextButton);
}

// Refresh the visible rows and the pagination buttons together
function update() {
    showCurrentPage();
    renderPagination();
}

// When the search changes: re-filter, go back to page 1, then refresh
if (searchInput) {
    searchInput.addEventListener("input", function () {
        filterRows();
        currentPage = 1;
        update();
    });
}

// First paint (only run when there are task rows to show)
if (allTaskRows.length > 0) {
    update();
}

// --- Dark mode toggle ---

const themeToggle = document.getElementById("theme-toggle");

// Turn dark mode on or off and update the button label
function applyTheme(theme) {
    if (theme === "dark") {
        document.body.classList.add("dark-mode");
        themeToggle.textContent = "Light Mode";
    } else {
        document.body.classList.remove("dark-mode");
        themeToggle.textContent = "Dark Mode";
    }
}

// Restore the theme saved from a previous visit
const savedTheme = localStorage.getItem("theme");
applyTheme(savedTheme === "dark" ? "dark" : "light");

// Switch theme on click and remember the choice
themeToggle.addEventListener("click", function () {
    const isDark = document.body.classList.contains("dark-mode");
    const newTheme = isDark ? "light" : "dark";
    applyTheme(newTheme);
    localStorage.setItem("theme", newTheme);
});
