<?php
// Include your config.php file to establish a database connection
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['note_title'], $_POST['note_content'])) {
        $noteID = $_POST['tbl_note_id'];
        $noteTitle = $_POST['note_title'];
        $noteContent = $_POST['note_content'];
        $datePosted = date("Y-m-d H:i:s"); 

        try {
            $stmt = $conn->prepare("UPDATE `notes` SET `note_title` = ?, `note_content` = ?, `date_posted` = ? WHERE `tbl_note_id` = ?");

            $stmt->bind_param('sssi', $noteTitle, $noteContent, $datePosted, $noteID);

            $stmt->execute();

            echo "
            <script>
                alert('Updated Successfully!');
                window.location.href = 'http://localhost/simpleapp/notes.php';
            </script>
            ";
            exit();
        } catch (Exception $e) {
            echo 'Database Error: ' . $e->getMessage();
        }
    } else {
        echo "
        <script>
            alert('Please fill in both the title and content fields.');
            window.location.href = 'http://localhost/simpleapp/notes.php';
        </script>
        ";
    }
}
?>
