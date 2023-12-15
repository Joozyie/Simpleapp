<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['checklist_title'], $_POST['checklists'])) {
        $checklistTitle = $_POST['checklist_title'];
        $checklistItems = implode(', ', $_POST['checklists']);
        $dateUploaded = date("Y-m-d H:i:s");

        try {
            $stmt = $conn->prepare("INSERT INTO checklists (checklist_title, checklist_content, date_posted) VALUES (?, ?, ?)");

            $stmt->bind_param('sss', $checklistTitle, $checklistItems, $dateUploaded);

            $stmt->execute();

            echo "
            <script>
                alert('Checklist Added Successfully!');
                window.location.href = 'http://localhost/simpleapp/checklists.php';
            </script>
            ";
            exit();
        } catch (mysqli_sql_exception $e) {
            echo 'Database Error: ' . $e->getMessage();
        }
    } else {
        echo "
        <script>
            alert('Please fill in both the checklist title and items.');
            window.location.href = 'http://localhost/simpleapp/checklists.php';
        </script>
        ";
    }
}
?>
