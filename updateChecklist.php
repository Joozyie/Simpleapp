<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tbl_checklist_id'], $_POST['checklist_title'], $_POST['checklist_items'])) {
        $checklistID = $_POST['tbl_checklist_id'];
        $checklistTitle = $_POST['checklist_title'];
        $checklistItems = $_POST['checklist_items'];

        try {
            $stmt = $conn->prepare("UPDATE `checklists` SET `checklist_title` = ?, `checklist_content` = ? WHERE `tbl_checklist_id` = ?");

            $stmt->bind_param('ssi', $checklistTitle, $checklistItems, $checklistID);

            $stmt->execute();

            echo "
            <script>
                alert('Checklist Updated Successfully!');
                window.location.href = 'http://localhost/simpleapp/checklists.php';
            </script>
            ";
            exit();
        } catch (Exception $e) {
            echo 'Database Error: ' . $e->getMessage();
        }
    } else {
        echo "
        <script>
            alert('Please fill in the checklist title and items.');
            window.location.href = 'http://localhost/simpleapp/checklists.php';
        </script>
        ";
    }
}
?>
