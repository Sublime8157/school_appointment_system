<?php

include('connect.php');
if (isset($_POST['id'])) {
  $id = $_POST['id'];

  // Remove the pending account from the database
  $sql = "DELETE  FROM users WHERE Id = '{$id}' AND Approval = 4";
  if ($connect->query($sql) === TRUE) {
    echo 'Success';
  } else {
    echo 'Error: ' . $connect->error;
  }
}
