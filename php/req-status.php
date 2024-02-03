<?php 
  session_start();
  include ('connect.php');
  $user_id = $_SESSION['idnumber'];
  $sql = "SELECT * FROM schedules WHERE IDNumber = $user_id";
  $result  = $connect->query($sql);
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
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
     th {
      width: 180px;
        text-align: center;
        font-weight: bold;
     }
      td {
        width: 180px;
        text-align: center;
      }
    </style>
</head>
<body>
<a href="Homepage.php">Home</a>
            
    <?php
         $id = "";
         $document  = "";
         $date = "";
         $time = "";
         $code = "";
         $idnumber = "";
         $status = "";
        echo "
        <table>
        <tr>
        <th>ID</th>
        <th>Agenda</th>
        <th>Date Schedule</th>
        <th>Time</th>
        <th>Code</th>
        <th>Student Number</th>
        <th>Status</th> 
        </tr>
        </table>
        ";
        if($result->num_rows > 0 ) {
          while($row = $result->fetch_assoc()) {
            $id = $row["ID"];
            $agenda  = $row["Document"];
            $date = $row["DateSched"];
            $time = $row["TimeSched"];
            $code = $row["Code"];
            $idnumber = $row["IDNumber"];
            $status = $row["Currentstatus"];
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
              $status ="";
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
              $status = "No Current Request";
            }

            echo  "
            <table>
            <th>
              
            </th>
            <tr>
              
              <td> ". $id . "</td>
              <td>". $agenda ."</td>
              <td>". $date ."</td>
              <td>". $time ."</td>
              <td>". $code . "</td>
              <td>". $idnumber ."</td>
              <td>" . $status ."</td>
            </tr>
          </table> ";
          }
        }
    
    ?>
  
</body>
</html>