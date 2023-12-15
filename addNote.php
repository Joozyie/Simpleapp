<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['note_title'], $_POST['note_content'])) {
        $noteTitle = $_POST['note_title'];
        $noteContent = $_POST['note_content'];
        $dateUploaded = date("Y-m-d H:i:s"); 

        try {
            $stmt = $conn->prepare("INSERT INTO notes (note_title, note_content, date_posted) VALUES (?, ?, ?)");

            $stmt->bind_param('sss', $noteTitle, $noteContent, $dateUploaded);

            $stmt->execute();

            echo "
            <script>
                alert('Added Successfully!');
                window.location.href = 'http://localhost/simpleapp/notes.php';
            </script>
            ";
            exit();
        } catch (mysqli_sql_exception $e) {
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
