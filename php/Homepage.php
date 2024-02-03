<?php 
  session_start();
  include ('connect.php');
  $user_id = $_SESSION['id'];
  $sql = "SELECT * FROM users WHERE id = $user_id";
  $result  = $connect->query($sql);
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style2.css">
    <style>
      h1 {
        margin-right: 30%;
        padding-top: 18px;
      }
   ul {
  margin-left: 33%;
   }
 
      .acc-logo {
        padding: none;
        margin: none;
        height: auto;
      }
      .status {
        margin: none;
        padding: none;
      }
      .requesting {
        background-color: yellow;
        color: white;
        padding: 2px 5px 2px 5px;
        width: auto;
        text-align: center;
        border-radius: 25px;
      }
      .approved {
        border-radius: 25px;
        background-color: green;
        color: white;
        padding: 2px 5px 2px 5px;
        width: auto;
        text-align: center;
      }
      .done {
        border-radius: 25px;
        background-color: blue;
        color: white;
        padding: 2px 5px 2px 5px;
        width: auto;
        text-align: center;
      }
      .denied {
        border-radius: 25px;
        background-color: red;
        color: white;
        padding: 2px 5px 2px 5px;
        width: auto;
        text-align: center;
      }
     
    </style>
</head>
<body>
    <div class="header">
    <img src="logo.png" alt="Datemex Logo" widht="80px" height="80px">
    <h1> Datamex College of St. Adeline</h1>
    <i class="bi bi-person-circle"></i>
    <div class="acc-logo">
        <a href="edit.php">
          <?php
          
          $idnumber = "";
            if($result->num_rows > 0 ) {
              while($row = $result->fetch_assoc()) {
                $idnumber = $row["IDNumber"];
                echo $idnumber;
              }
            }
            $status = "";
            $sql2 = "SELECT * FROM schedules WHERE IDNumber = $idnumber";
            $result = $connect->query($sql2);
            if($result->num_rows > 0 ) {
              while($row = $result->fetch_assoc()) {
                $status = $row["Currentstatus"];
              }
            }
            switch($status) {
              case 1: 
                $status =  "<div class='requesting'> Pending </div> ";
                break;
              case 2: 
                $status =  "<div class='approved'> Approved </div> ";
                break;
              case 3: 
                $status =  "<div class='done'> Done </div> ";
                break;
              case 4: 
              $status = "<div class='denied'> Denied </div> " ;
              break;
              default: 
              $status = "<br> No Current Request";
            }

          ?>
    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
</svg>
</a>
<a href="req-status.php"><?php echo "  <div class='status'> <br> <br> <b> Current Request Status:</b> " . $status  . " </div>"; ?></a>

</div>

          </div>    
            
    <hr>
<br> <br>
<h3 align="center"> Online Appointment </h3>
<p id ="date" class="date"></p>
<form action="" method="post">
    <label for="documents">----------Agenda----------</label> <br>
      <select name="documents" id="documents" require>
          <option value="1"> Document Request </option>
          <option value="2"> Payment of Tuition</option>
          <option value="3"> Other Concern </option>
      </select> 
<br>
    <label for="date">----------Date----------</label> <br>
      <input type="date" id="date" name="date" class="sched-date" require> 
<br>
      <label for="time">----------Time----------</label> 
<br>
    <select name="time" id="time" class="time"require>
        <option value="1">8:00AM - 10:00AM </option>
        <option value="2">10:00AM - 12:00NN </option>
        <option value="3">1:00PM - 3:00PM </option>
        <option value="4">3:00PM - 5:00PM </option>
    </select> 
<br>
    <input type="button" class="gcode"value="Set A Schedule" onclick="generateCode()">
      <label for="code">Code:</label>
      <input type="text" id="code" name="code" style="border: none;"readonly require> 
<br> 
<br>
<select name="status" id="" style="display: none;">
  <option value="1">1</option>
</select>
<button class="btn btn-primary"type="submit">Submit</button>
<button type="reset" class="btn btn-secondary">Clear</button>
</form>
<div id="success-message" style="display: none;">
<?php 
  $agenda = $_POST["documents"];
  $time = $_POST["time"];
  switch ($agenda) {
    case 1:
      $agenda = "Document Request";
      break;
    case 2:
      $agenda = "Payment of tuition";
      break;
      case 3:
        $agenda = "Other Concern";
      break;
      default:
      $agenda = "";
  }
  switch($time) {
    case 1: 
      $time = "8:00AM - 10:00AM";
      break;
    case 2:
      $time = "10:00AM - 12:00NN";
      break;
    case 3:
      $time = "1:00PM - 3:00PM";
      break;
    case 4:
      $time = "3:00PM - 5:00PM";
      break;
    default:
    $time ="";
  }
  echo "<p>Your Request for " . $agenda . " on " . $time . " of " . $_POST["date"] . " was Submitted. We will update you shortly!</p> <br>";
?>
  <img src="success-icon.png" height="50px" width="60px" alt="Success" align="center"> <br> 
  <button id="close">Close</button>
</div>
<div id="error-message" style="display: none;">
  <p>Sorry the date you selected was fully booked</p> <br>
  <img src="error.png" height="120px" width="100px" alt="Success" align="center"> <br> 
  <button id="e-close">Close</button>
</div>
<div id="error2-message" style="display: none;">
  <p>Only 2 Appointment Per Day</p> <br>
  <img src="error.png" height="120px" width="100px" alt="Success" align="center"> <br> 
  <button id="error2-close">Close</button>
</div>
<?php 
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Document = $_POST['documents'];
    $Date  = $_POST['date'];
    $Time = $_POST['time'];
    $Code  = $_POST['code'];
    $status = $_POST['status'];
    $error = '';
    
    if (empty($Document)) {
        $error .= 'Please enter your Document . ';
    }
    if (empty($Date)) {
        $error .= 'Please enter your Date. ';
    }
    if (empty($Time)) {
        $error .= 'Please enter your Time. ';
    }
    if (empty($Code)) {
      $error .= 'Missing Code. ';
  }

    if ($error) {
        echo '<div class="alert alert-danger">' . $error . '</div>';
    }
    
    else {

    $sql2 = "SELECT COUNT(*) as count FROM schedules WHERE DateSched = '$Date'";
    $result = $connect->query($sql2);
    $row = $result->fetch_assoc();
    $count = $row['count']; 
    $max_appointments_per_day = 8;
    if ($count >= $max_appointments_per_day) {

      ?> 
      <script>
        const errorMessage = document.getElementById('error-message');
        errorMessage.style.display = 'block';
      </script>
      <?php
  } 
  
  else 
  {
    $sql2 = "SELECT * FROM schedules WHERE IDNumber = $idnumber";
    $result = mysqli_query($connect, $sql2);
    if (mysqli_num_rows($result) >= 2) {
      ?> <script>
      const error2Message = document.getElementById('error2-message');
      error2Message.style.display = 'block';
    </script>
  <?php  
    }
    else {
      $sql = "INSERT INTO schedules(Document, DateSched, TimeSched, Code, IDNumber, Currentstatus) VALUES('$Document','$Date','$Time','$Code','$idnumber','$status')";
    if(mysqli_query($connect, $sql)) {
      ?> <script>
      const successMessage = document.getElementById('success-message');
      successMessage.style.display = 'block';
      
    </script>
  <?php  
  
  }
      else {
        echo "Error:" .$sql . "<br>" . mysqli_error($connect);
      }
    }

    
    }
}
  }
  
?>
<footer>

</footer>
<script>
  var today = new Date();
  var options = { month: 'long', day: 'numeric', year: 'numeric' };
  var date = today.toLocaleDateString('en-US', options);
  var time = today.toLocaleTimeString();
  var dateTime = 'Today: ' + date;
  document.getElementById('date').innerHTML = dateTime;

  
    function generateCode() {
    const code = Math.floor(Math.random() * 900000) + 100000;
    document.getElementById("code").value = code; }

    document.getElementById("close").addEventListener("click", function(){
    successMessage.style.display = 'none';
    })
    document.getElementById("e-close").addEventListener("click", function(){
    errorMessage.style.display = 'none';
    })
    document.getElementById("error2-close").addEventListener("click", function(){
    error2Message.style.display = 'none';
    })
</script>
</body>
</html>