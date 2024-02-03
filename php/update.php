

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('connect.php');


$id =815715;
$name = $_POST['name'];



$sql = "UPDATE users SET Password='$name' WHERE IDNumber = $id";
$result = mysqli_query($connect, $sql);
if (!$result) {
  echo json_encode(array('success' => false));
  die('Error updating record: ' . mysqli_error($connect));
}

echo json_encode(array('success' => true));

?>
