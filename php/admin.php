
<?php 
include('connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style4.css">
    <style>
        input[type="text"] {
            padding: 5px;
        }
        #display-output {
            display: none;
        }
        #none {
          position: absolute;
          top: 0;
          margin-top: 10%;
          
        }

    </style>
</head>
<body>
    <a href="schedules.php">Schedules</a>
    <a href="logout.php" style="float: right;">Logout</a>
    <div class="container">
    <form method="post">
        <label for="code">Find Code:</label> 
        <hr>
        <input type="text" name="code"> <br>
        <button type="submit" id="find">Find</button>
    </form>
   
    <?php 

    if(isset($_POST["code"])) {
        $code = $_POST["code"];
        if(empty($code)) {
            echo "<div id='none'>Please input the code</div>";
        }
        else {
        $sql = "SELECT * FROM schedules WHERE Code = $code";
        $result = $connect->query($sql);

        
        if($result->num_rows > 0 ) {
            while($row = $result->fetch_assoc()) {
                $agenda = $row['Document'];
                $time = $row['TimeSched'];
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
                echo "<div id='display-output' class='output'> <b> Agenda: </b>  " .$agenda .
                     "<br> <b>  Date Scheduled: </b> <br>" . $row['DateSched'] .   
                     "<br> <b> Time Scheduled: </b> <br>".  $time . 
                     "<br> <b> Student ID Number: </b> <br>" . $row['IDNumber'] 
                     ;
             ?> 
             <script>
                const displayoutput = document.getElementById("display-output");
                displayoutput.style.display = 'block';
                </script>
                <br>
                 <button id='close'>Close</button>
                 </div>
             <?php 
            }
        }
        else {
            echo "<div id = 'none' >No Request 
           </div>";

        }
            
        }
    }
    ?>
    
   
    <script>
        document.getElementById('close').addEventListener("click", function(){
        displayoutput.style.display = 'none';
        })
    </script>
</body>
</html>
