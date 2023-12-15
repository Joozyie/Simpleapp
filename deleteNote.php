<?php
include("config.php");

if (isset($_GET['note'])) {
    $note = $_GET['note'];

    try {

        $query = "DELETE FROM `notes` WHERE `tbl_note_id` = '$note'";
        $stmt = $conn->prepare($query);
        $query_execute = $stmt->execute();

        if ($query_execute) {
            echo "
            <script>
                alert('Note Deleted Successfully!');
                window.location.href = 'http://localhost/simpleapp/notes.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Failed to Delete Note!');
                window.location.href = 'http://localhost/simpleapp/notes.php';
            </script>
            ";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>