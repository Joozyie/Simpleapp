function toggleEdit() {
    const noteTitleInput = document.getElementById("noteModalTitle");
    const noteContentTextarea = document.getElementById("noteModalContent");
    const editModalButton = document.getElementById("editModal");
    const datePosted = document.getElementById("datePosted");
    const editButtons = document.getElementById("edit-buttons");

    if (noteTitleInput && noteContentTextarea && editModalButton) {
        if (noteTitleInput.readOnly && noteContentTextarea.readOnly) {
            noteTitleInput.readOnly = false;
            noteContentTextarea.readOnly = false;
            datePosted.style.display = "none";
            editButtons.style.display = "";
            noteTitleInput.style.border = "";
            noteContentTextarea.style.border = "";
        } else {
            noteTitleInput.readOnly = true;
            noteContentTextarea.readOnly = true;
            datePosted.style.display = "";
            editButtons.style.display = "none";
            noteTitleInput.style.border = "none";
            noteContentTextarea.style.border = "none";
        }
    }
}

const editModalButton = document.getElementById("editModal");
if (editModalButton) {
    editModalButton.addEventListener("click", toggleEdit);
}


function viewNote(id) {
    $("#viewNoteModal").modal("show");
    
    let noteModalID = $("#noteID-" + id).text();
    let noteModalTitle = $("#noteTitle-" + id).text();
    let noteModalContent = $("#noteContent-" + id).text();
    let datePosted = $("#datePosted-" + id).text();

    console.log(datePosted);

    $("#noteModalID").val(noteModalID);
    $("#noteModalTitle").val(noteModalTitle);
    $("#noteModalContent").html(noteModalContent);
    $("#datePosted").html("Date Updated: " + datePosted);

}

function deleteNote(id) {
    if (confirm("Do you want to delete this note?")) {
        window.location = "deleteNote.php?note=" + id;
    }
}
