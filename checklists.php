<?php 
include("config.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Journal</title>

    <link rel="stylesheet" href="assets\checklist.css"> 

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light ">
        <a class="navbar-brand ml-4" href="#">My Journal</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ml-4" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="" data-toggle="modal" data-target="#addChecklistModal">Add Checklist</a>
            </div>
            <div class="navbar-nav ml-auto">
                <a href="home.php" class="nav-link">Home</a>
                <a href="notes.php" class="nav-link">Notes</a>
            </div>
        </div>
    </nav>

    <div class="modal fade mt-5" id="addChecklistModal" tabindex="-1" aria-labelledby="addChecklist" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addChecklist">Add Checklist</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="addChecklist.php" method="POST">
                        <div class="form-group">
                            <label for="checklistTitle">Checklist Title</label>
                            <input type="text" class="form-control" id="checklistTitle" name="checklist_title">
                        </div>
                        <div class="form-group">
                            <label for="checklistInput">Checklist Items</label>
                            <input type="text" class="form-control" id="checklistInput" name="checklistInput" placeholder="Enter checklist item" onkeydown="if (event.keyCode == 13) addChecklistItem()">
                            <button type="button" class="btn btn-secondary mt-2" onclick="addChecklistItem()">Add Item</button>
                            <div id="checklistItems"></div>
                            <input type="hidden" name="checklists[]" id="checklistHidden">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-dark">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="main row">

    <?php
        $stmt = $conn->prepare("SELECT * FROM `checklists`");
        $stmt->execute();
        $result = $stmt->get_result();

        foreach ($result as $row) {
            $checklistID = isset($row["tbl_checklist_id"]) ? $row["tbl_checklist_id"] : null;
            $checklistTitle = isset($row["checklist_title"]) ? $row["checklist_title"] : null;
            $checklistContent = isset($row["checklist_content"]) ? $row["checklist_content"] : null;
        ?>

        <div class="checklist-container">
            <button type="button" class="btn float-right mt-2 mr-2" id="deleteModal">
                <i class="fa-solid fa-x" onclick="deleteChecklist(<?= $checklistID ?>)"></i>
            </button>
            <div class="checklist-content">
            <p id="checklistID-<?= $checklistID ?>" hidden><?= $checklistID ?></p>
                <p id="checklistTitle-<?= $checklistID ?>"><?= $checklistTitle ?></p>
                <p id="checklistContent-<?= $checklistID ?>" hidden><?= $checklistContent ?></p>

        <ul>
            <?php
            $items = explode(',', $checklistContent);
            foreach ($items as $item) {
                echo "<li>$item</li>";
            }
            ?>
        </ul>
        </div>
    </div>

    <?php 
}
?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

<script>
    function addChecklistItem() {
        const checklistInput = document.getElementById("checklistInput").value;

        if (checklistInput.trim() !== "") {
            const listItem = document.createElement("li");
            listItem.textContent = checklistInput;

            const checklistItems = document.getElementById("checklistItems");
            checklistItems.appendChild(listItem);

            updateHiddenChecklist();
            
            document.getElementById("checklistInput").value = "";
        }
    }

    function updateHiddenChecklist() {
        const checklistItems = document.getElementById("checklistItems").getElementsByTagName("li");

        const itemsArray = [];

        for (let i = 0; i < checklistItems.length; i++) {
            itemsArray.push(checklistItems[i].textContent);
        }
        document.getElementById("checklistHidden").value = itemsArray.join(",");
    }

    function deleteChecklist(id) {
    if (confirm("Do you want to delete this checklist?")) {
        window.location = "deleteChecklist.php?checklists=" + id;
    }
}

function editChecklist(id) {
    $("#editChecklistModal").modal("show");

    let checklistTitle = $("#checklistTitle-" + id).text();
    let checklistItems = $("#checklistContent-" + id).text();

    $("#editChecklistTitle").val(checklistTitle);
    $("#editChecklistInput").val(checklistItems);
    $("#editChecklistID").val(id);
}

</script>


<script src="assets\script2.js"></script>
</body>
</html>
