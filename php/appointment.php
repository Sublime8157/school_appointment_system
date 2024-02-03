<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/apoint.css">
</head>
<body>


</body>
</html>

<?php
  session_start();
    include("connect.php");
    $date = $_POST['date'];
    $time = $_POST['time'];
    $status = $_POST['status'];
    $code = $_POST['code'];
    $idnumber = $_SESSION['idnumber'];
    echo "Time:" . $time;
    echo "<br>Code:" .$code;
    echo "<br>Status:" . $status;
    if (isset($_POST['submit_update'])) {
      $agenda = $_POST['appointment'];
      $document_request = $_POST['document_request'];
      $otherconern = $_POST['otherconcern'];


      $sqlcountdate = "SELECT COUNT(*) as count FROM schedules WHERE DateSched = '".$date."'";
      $resultcounddate = $connect->query($sqlcountdate);
      $rowdate = $resultcounddate->fetch_assoc();
      $count = $rowdate['count']; 

    
      
      

      $sql2 = "SELECT * FROM schedules WHERE IDNumber = $idnumber";
      $result = mysqli_query($connect, $sql2);
      $countresult = mysqli_query($connect, $sql2);

      
    


       if (mysqli_num_rows($result) >= 2) {
        echo "<script>       
        alert('Maximum of 2 appointments Only');
        window.location.href = 'student-ui.php';
    </script>";
      } else 
      
      {
       
        $sql = "INSERT INTO schedules (IDNumber, DateSched, Document, Document_Request, Other_Concern, TimeSched, CurrentStatus, Code) VALUES ('$idnumber','$date', '$agenda', '$document_request', '$otherconern','$time', '$status', '$code')";
        mysqli_query($connect, $sql);
        if (mysqli_affected_rows($connect) > 0) {
          echo "<div class='appear' id='appear'>
                                    <h6 style='text-align: center; font-size: 20px; margin: 0;'>Code: $code  </h6><br> <br>
                                    <img src='../images/logo.png' alt='school logo' width='70px;' height='60px;'>
                                    <h3 style='color: red;
                                                border-bottom: 1px solid black;
                                    '>
                                    Datemex College of St. Adeline
                                    </h3>
                                    <p align='left'> Your appointment was submitted, make sure to follow the guidelines; <br>
                                      <p>Bring School ID <br>
                                      Present the code given <br>
                                      Wear proper outfit <br>
                                      Please be on time <br>
                                    </p>
                                    <p 
                                    style=
                                    'color: white;
                                    background-color: #992e2e;
                                    padding: 2px 5px 2px 5px;
                                    border-radius: 10px;
                                    '>Take Note:</p>
                                    Student that will not follow the appointment time, will not be entertained
                                  </p> <br>
                                  <button name='cancel' id='cancel' style='    
                                  width: 150px;
                                  background: #0000ff8c;'> Understood </button> 
                                </div>

                                <script>
                               
                                  document.getElementById('cancel').addEventListener('click', function(){
                                     window.location.href = 'student-ui.php';
                                  });

                                </script>";
        } else {
            echo "Error: " . mysqli_error($connect);
        }

        mysqli_close($connect);
    }
  }
?>
 <form action="" method="post" id="form">
    <input type="hidden" name="idnumb" value="<?php echo $idnumber ?>">
    <input type="hidden" name="date" value="<?php echo $date; ?>">
    <select name='appointment' id='appointment'>
    <option value='2'> Payment Of Tuition </option>
    <option value='1'> Document Request </option>
    <option value='3'> Other Concern </option>
</select>

<div id="document_request_option" style="display: none;">
    <label for="document_type" style="text-align: center; margin-left: 50px;">Document Type:</label>  <br>
    <select name="document_request">
        <option value="0">  </option>
        <option value="1">Transcript of Records</option>
        <option value="2">Birth Certificate</option>
        <option value="3"> Diploma</option>
        <option value="4"> Certificate of Enrollment</option>
    </select>
</div>
<div id="other_concern" style="display: none;">
  <label for="otherconcern" style="text-align: center; margin-left: 65px;">Other Concern: </label> <br>
  <input type="text" name="otherconcern" style="    padding: 5px 0 5px 8px;
    width: 250px;
    border-radius: 10px;
    border: 1px solid #a78c8c;
    text-align: center;">
</div>
    <input type="hidden" name="time" value="<?php echo $time; ?>">
    <input type="hidden" name="status" value="<?php echo $status; ?>">
    <input type="hidden" name="code" value="<?php echo $code; ?>">
    <br><button type='submit' id='setappointment' name='submit_update' style='width: 250px;' value = 'no' onclick="return confirm('Are you sure?')">Confirm</button>
<br>
    <a href="student-ui.php" align="center" style="    text-decoration: none;
    
    padding: 3px 96px 3px 89px;
    border-radius: 5px;
    background-color: #5050ad;
    color: white;"> Go Back </a>
</form>

   
<script>
  var appointmentSelect = document.getElementById('appointment');
  var documentRequestOption = document.getElementById('document_request_option');
  var otherconcern = document.getElementById('other_concern');        
  appointmentSelect.addEventListener('change', function() {
    if (appointmentSelect.value === '1') {
  documentRequestOption.style.display = 'block';
  otherconcern.style.display = 'none';
} else if (appointmentSelect.value === '3') {
  otherconcern.style.display = 'block';
  documentRequestOption.style.display = 'none';
} else {
  documentRequestOption.style.display = 'none';
  otherconcern.style.display = 'none';
}
  });

  if (appointmentSelect.value === '1') {
    documentRequestOption.style.display = 'block';
  }
</script>

</body>
</html>
