<?php 
include("config.php");

if (isset($_GET['checklists'])) {
    $checklistID = $_GET['checklists'];

    try {
        $query = "DELETE FROM `checklists` WHERE `tbl_checklist_id` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $checklistID);
        $query_execute = $stmt->execute();

        if ($query_execute) {
            echo "
            <script>
                alert('Checklist Deleted Successfully!');
                window.location.href = 'http://localhost/simpleapp/checklists.php'; // Redirect to the appropriate page
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Failed to Delete Checklist!');
                window.location.href = 'http://localhost/simpleapp/checklists.php'; // Redirect to the appropriate page
            </script>
            ";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
