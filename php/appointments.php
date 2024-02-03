<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
                         echo "
                         <table>
                         <tr>
                         <th>ID</th>
                         <th>Agenda</th>
                         <th>Date Schedule</th>
                         <th>Time</th>
                         <th> Code </th>
                         <th>Student Number</th>
                         <th>Status</th> 
                         </tr>
                       
                         ";
                        
                        $sqlschedules  = "SELECT * FROM schedules WHERE IDNumber = $idnumber";
                        $resultschedules = $connect->query($sqlschedules);

                        if($resultschedules->num_rows > 0 ) {
                            while($row = $resultschedules->fetch_assoc()) {
                                $id = $row["ID"];
                                $agenda  = $row["Document"];
                                $date = $row["DateSched"];
                                $time = $row["TimeSched"];
                               
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
                               
                                
                                <tr>
                                  <td> ". $id . "</td>
                                  <td>". $agenda ."</td>
                                  <td>". $date ."</td>
                                  <td>". $time ."</td>
                                  <td> " .$code . "</td>                                
                                  <td>". $idnumber ."</td>
                                  <td>" . $status ."</td>
                                </tr> 
                              
                              ";
                               
                            }
                          }
                          echo "<table> </table>"
                    ?>
</body>
</html>