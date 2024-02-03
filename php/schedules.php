<?php 
    include('connect.php');
    $sql = "SELECT * FROM schedules";
    $result = $connect->query($sql);
    
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
      h1 {
        margin-top: 10%;
        margin-bottom: 5%;
      }
      .update-status {
        display: flex;
        justify-content: center;
      }
      form {
        padding: 25px;
      }
      input {
        padding: 5px;
      }
      label {
        font-weight: bold;
      }
      select {
        width: 185px;
        text-align: center;
      }
      .btn {
        border: none;
        background-color: blue;
        padding: 5px 10px 5px 10px;
        color: white;
        width: 270px;
        cursor: pointer;
      }
      .btn:hover {
        opacity: 80%;
      }
      select {
    background-color: rgb(253 253 253);
    width: 190px;
    font-family: Arial, sans-serif;
    font-size: 16px;
    color:  (255, 204, 204);
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 5px;
    margin-bottom: 10px;
    cursor: pointer;
    text-align: center;
    margin-top: 10px;
  }
select:hover {
    color: white;
    background-color: #9898e5;
}
select option {
    background: white;
    color: rgb(111, 110, 110);
    cursor: pointer;
}
    header {
        font-size: 25px;
    }
    input:focus {
     outline: none;   
    }
    </style>
</head>
<body>
    <a href="admin.php">Back</a>
    <a href="admin.php" style="float: right;">Find Code</a>
    <h1 align="center">Appointment Schedules</h1>
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
          ";
      }
    }
    ?>
     </tr>
      </table>
      <hr>
      <header align="center" style="margin-top: 25px;">Update Status</header> 
      <div class="update-status">
      
            <form action="schedules.php" method="post">
                <div class="field input">   
                    <label for="username">Schedule ID</label>
                    <input type="text" name="ID" id="username"  autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="CurrentStatus" style="margin-right: 40px;">Email</label>
                   <select name="CurrentStatus" id="">
                    <option value="1">Pending</option>
                    <option value="2">Approved</option>
                    <option value="3">Done</option>
                    <option value="4">Denied</option>
                   </select>
                </div>

                
                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Update" required>
                </div>
            </form>
        </div>
      <?php 
               if(isset($_POST['submit'])){
              
                $status = $_POST['CurrentStatus'];
                $scheduleid = $_POST['ID'];

                $edit_query = mysqli_query($connect,"UPDATE schedules  SET CurrentStatus='$status' WHERE ID=$scheduleid ") or die("error occurred");

                if($edit_query){
                    echo "<p align='center'>Updated Succesfully</p>";
       
                }
               }else{

            
                $query = mysqli_query($connect,"SELECT*FROM schedules WHERE ID=$id ");

                while($result = mysqli_fetch_assoc($query)){
                    $idnumber = $result['IDNumber'];
                    $res_status = $result['Currentstatus'];
                }

            ?>
            
        </div>
        <?php } ?>
</body>
</html>