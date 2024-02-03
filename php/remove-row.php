<?php
include ('connect.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    

    $sql = "DELETE FROM schedules WHERE ID = $id";
    $result = mysqli_query($connect, $sql);
    if ($result) {
        echo 'success';
    } else {
        echo 'error';
    }
}

?>
