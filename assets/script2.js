document.addEventListener("DOMContentLoaded", function () {
    const editChecklistButton = document.getElementById("editChecklist");
    
    if (editChecklistButton) {
        editChecklistButton.addEventListener("click", toggleEditChecklist);
    }

    function toggleEditChecklist() {
        const checklistTitleInput = document.getElementById("checklistTitle");
        const checklistInput = document.getElementById("checklistInput");
        const checklistDatePosted = document.getElementById("checklistDatePosted");
        const editChecklistButtons = document.getElementById("edit-checklist-buttons");

        if (checklistTitleInput && checklistInput && checklistDatePosted && editChecklistButtons) {
            if (checklistTitleInput.readOnly && checklistInput.readOnly) {
                checklistTitleInput.readOnly = false;
                checklistInput.readOnly = false;
                checklistDatePosted.style.display = "none";
                editChecklistButtons.style.display = "";
                checklistTitleInput.style.border = "";
                checklistInput.style.border = "";
            } else {
                checklistTitleInput.readOnly = true;
                checklistInput.readOnly = true;
                checklistDatePosted.style.display = "";
                editChecklistButtons.style.display = "none";
                checklistTitleInput.style.border = "none";
                checklistInput.style.border = "none";
            }
        }
    }
function viewChecklist(id) {
    $("#editChecklistModal").modal("show");

    let checklistTitle = $("#checklistTitle-" + id).text();
    let checklistItems = $("#checklistContent-" + id).text();

    $("#editChecklistTitle").val(checklistTitle);
    $("#editChecklistInput").val(checklistItems);
    $("#editChecklistID").val(id);
}

function deleteChecklist(id) {
    if (confirm("Do you want to delete this checklist?")) {
        window.location = "deleteChecklist.php?checklists=" + id;
    }
}
});
