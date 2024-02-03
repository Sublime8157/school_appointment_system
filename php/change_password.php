<?php 
$sqlusers = "SELECT * FROM users WHERE IDNumber = $idnumber";
$resultusers = $connect->query($sqlusers);
$userid = "";
$email = "";
$password = "";

if($resultusers->num_rows > 0 ) {
  while($row = $resultusers->fetch_assoc()) {
    $userid = $row['IDNumber'];
    $email = $row['Email'];
    $password = $row['Password'];
  }
}

if(isset($_POST['submitupdate'])) {
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];



  if($new_password != $confirm_password) {
      echo "<script> 
        alert('Password did not matched');


        document.getElementById('accounts').classList.add('bg');
        document.getElementById('set-appoint').classList.remove('bg');
        document.getElementById('display-set-appoint').style.display = 'none';
        document.getElementById('display-accounts').style.display = 'block';
      </script>
        ";
  } else {
      $sqlupdate = "UPDATE users SET Password = '$new_password' WHERE IDNumber = $idnumber";
      $connect->query($sqlupdate);
    echo "<div class='appear' id='appear'
      style='    
      top: 30%;
      left: 55%;
      transform: translate(-50%, -50%);
      font-size: 12px;
      '
    > Changing Successfull! 
    <br> <br>
        <button id='cancel' 
        style='    
        font-size: 15px;
        width: 150px;
        padding: 5px;'> Cancel 
        </button>  
    </div> 


    <script> 
    document.getElementById('cancel').addEventListener('click', function(){
      document.getElementById('appear').style.display = 'none';
  })

  document.getElementById('accounts').classList.add('bg');
  document.getElementById('set-appoint').classList.remove('bg');
  document.getElementById('display-set-appoint').style.display = 'none';
  document.getElementById('display-accounts').style.display = 'block';
    </script>
    ";  
  
  } 


}
?>