const addProjectBtn = document.getElementById("addProjectBtn");
const modal = document.getElementById("projectModal");
const closeModalBtn = document.getElementById("closeModal");
const projectForm = document.getElementById("projectForm");
const modalTitle = document.getElementById("modalTitle");
const projectId = document.getElementById("projectId");
const title = document.getElementById("title");
const description = document.getElementById("description");
const dateFinished = document.getElementById("date_finished");

// Open Add Modal
addProjectBtn.addEventListener("click", () => {
    modal.style.display = "flex";
    modalTitle.textContent = "Add Project";
    projectForm.reset();
    projectId.value = '';
});

// Close Modal
closeModalBtn.addEventListener("click", () => {
    modal.style.display = "none";
});

// Open Edit Modal
document.querySelectorAll('.editBtn').forEach(btn => {
    btn.addEventListener('click', () => {
        modal.style.display = "flex";
        modalTitle.textContent = "Edit Project";
        projectForm.action = "edit_project.php";
        projectId.value = btn.dataset.id;
        title.value = btn.dataset.title;
        description.value = btn.dataset.description;
        dateFinished.value = btn.dataset.date;
    });
});
