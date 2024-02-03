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
  <link rel="stylesheet" href="student-style.css">
  <style>
    *{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: 'Poppins',sans-serif;
    transition: 0.3s;
            }
            .header {
                border: 1px solid #e7d9d9;
                background-color: white;
                box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.4);

            }
            h3 {
                padding: 25px;
                text-align: center;
            }
            img {
                margin: 0 25px 0 70px;
            }

            .bg {
                background-color: rgb(173, 140, 140);
            }
            .display {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 90vh;
                max-width: 100%;
            }
            p {
                font-size: 40px;
                text-align: center;
                padding: 5px;
            }
            .header {
                text-align: center;
            }
            h1 {
                padding: 5px;
            }

            .pendingappointment {
                background-color: #9c9cdf;
                color: white;
                padding: 25px;
                border-radius: 15px;
                font-size: 15px;
                text-align: center;
                margin: 2%;
                width: 200px;
            }
            .approvedappointment {
                background-color: #355a6e;
                color: white;
                padding: 25px;
                border-radius: 15px;
                font-size: 15px;
                text-align: center;
                width: 200px;
            }
            .activeacounts {
                background-color: #262640;
                color: white;
                padding: 25px;
                border-radius: 15px;
                font-size: 15px;
                text-align: center;
                width: 200px;
                margin: 2%;
            }
            .notactiveaccounts {
                background-color: #a2cd92;
                color: white;
                padding: 25px;
                border-radius: 15px;
                font-size: 15px;
                text-align: center;
                width: 200px;
                margin: 2%;
                height: 120px;
            }
            .display {
                max-width: 700px;
                margin-left: 400px;
                height: 50vh;
            }
            .totalaccounts {
                background-color: #870834;
                color: white;
                padding: 25px;
                border-radius: 15px;
                font-size: 15px;
                text-align: center;
                width: 200px;
                margin: 2%;
            }
            .totalappointments {
                background-color: #2e2ec5;
                color: white;
                padding: 25px;
                border-radius: 15px;
                font-size: 15px;
                text-align: center;
                width: 200px;
                margin: 2%;
            }

              table {
                border-collapse: collapse;
                width: 80%;
                text-align: center;
                font-size: 10px;
                margin-left: 15%;
              }
              th, td {
                border: 1px solid #ddd;
                text-align: left;
                padding: 2px;
                text-align: center;
              }
              th {
                background-color: #4CAF50;
                color: white;
                text-align: center;
              }
              tr {
                text-align: center;
              
              }
              .requesting {
                background-color: yellow;
              }
              .approved {
                background-color: green;
                color: white;
              }
              .done {
                background-color: blue;
                color: white;
              }
              .denied {
                background-color: red;
                color: white;
              }
            .edit {
                font-size: 9px;
                padding: 2px;
                width: 50px;
                background-color: blue;
            }
            .remove {
                font-size: 9px;
                padding: 2px;
                width: 50px;
            }
            .display-home {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 50vh;
                margin-left: 10%;
            }
            h2 {
                margin-left: 300px;
                padding: 25px 0 25px 0;
                border-bottom: 1px solid black;
                width: auto;
                margin-right: 500px;
                color: #cececf;
            }
            .edit-form {
              background-color: #f2f2f2;
              padding: 2020x;
              border-radius: 5px;
              width: 300px;
              margin: 0 auto;
              text-align: center;
              position: absolute;
              top: 50%;
              left: 50%;
              transform: translate(-50%, -50%);
              padding: 20px;
              border: 1px solid #95b6eb;
              margin-top: 5%;
              margin-left: 5%;
            }

            .edit-form label {
              display: inline-block;
              margin-bottom: 10px;
            }

            .edit-form input[type="text"],
            .edit-form select {
              padding: 5px;
              border-radius: 3px;
              border: 1px solid #ccc;
              margin-bottom: 15px;
              width: 100%;
              box-sizing: border-box;
            }

            .edit-form button[type="submit"] {
              background-color: #4CAF50;
              color: white;
              padding: 10px 20px;
              border: none;
              border-radius: 3px;
              cursor: pointer;
              font-size: 16px;
            }

            .edit-form button[type="submit"]:hover {
              background-color: #45a049;
            }


            .display-schedules .display table tr th  {
                min-width: 130px;
              padding: 10px 0 10px 0;
              max-width: 130px;
            }
            .display-schedules .display table {
                margin-left: 100px;
            }
            .active {
                background-color: yellow;
            }
            .notactive {
                background-color: red;
                color: white;
            }

            .editpending {
                padding: 5px;
                background-color: blue;
                color: white;
                font-size: 8px;
                width: 50px;
            }
            .removepending {
                padding: 5px;
                background-color: red;
                color: white;
                font-size: 8px;
                width: 60px;
            }
            label {
                font-size: 15px;
            }
            input {
                text-align: center;
            }
            select {
                text-align: center;
                cursor: pointer;
            }

            .display_pending_appointments table th { 
                min-width: 130px;
              padding: 10px 0 10px 0;
              font-size: 10px;
            }
            .display_pending_appointments table td {
              font-size: 10px;
            }

            .display-dashboard {
                display: flex;
                flex-direction: row;
                align-items: center;
                justify-content: center;
                  
            }
            .pending {
                background-color: yellow;
                color: black;
            }
            .searchid {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .display_pending_appointments table th { 
                min-width: 130px;
              padding: 10px 0 10px 0;
              font-size: 10px;
            }
            .display_pending_appointments table td {
              font-size: 10px;
            }
            .nav-bar-option {
              display: flex;
                justify-content: flex-start;
                flex-direction: column;
                align-items: center;
                height: 400px;
                text-align: left;
                align-content: center;
                flex-wrap: wrap;
                margin: 50px;
            }

            .nav-bar-option button {
                padding: 10px;
                border: none;
                background-color: #5c4242;
                color: #c7a7a7;
                cursor: pointer;
                width: 240px;
                border-radius: 5px;
                font-size: 15px;
                text-align: left;
            }

            .nav-bar-option button:hover {
                background-color: rgb(173, 140, 140);
                color: white;
            }

            .nav-bar-option .bg {
              background-color: rgb(173, 140, 140);
              color: white;
            }
            .logout {
                position: absolute;
                bottom: 0;
                margin: 0 0 8% 2%;
                left: 0;
                margin-: 5px;
                
              }

              .nav-bar-option button {
                padding: 5px;
                border: none;
                background-color: #5c4242;
                color: #c7a7a7;
                cursor: pointer;
                width: 240px;
                border-radius: 5px;
                font-size: 13px;
                text-align: left;
              }
              i {
                margin-right: 1%;
              }
              hr {
                text-align: center;
                width: 200px;
                margin-left: 25px;
                color: #fbbebe;
              }

  </style>
</head>
<body>
<?php
$searchQuery = $_POST["search"];

if(!empty($searchQuery)){
    $sql = "SELECT * FROM schedules 
    INNER JOIN students ON schedules.IDNumber = students.IDNumber
    WHERE Code = '$searchQuery'";
$result = mysqli_query($connect, $sql);
$id = "";
$document  = "";
$date = "";
$time = "";
$code = "";
$idnumber = "";
$status = "";
$html = "";
while($row = mysqli_fetch_assoc($result)) {
  $id = $row["ID"];
  $agenda  = $row["Document"];
  $date = $row["DateSched"];
  $time = $row["TimeSched"];
  $code = $row["Code"];
  $idnumber = $row["IDNumber"];
  $status = $row["Currentstatus"];
  $year = $row["Year"];
  $course = $row["Course"];
  $documentrequested = $row['Document_Request'];
  $otherconcern = $row['Other_Concern'];
  require("switchcases.php");
 
    $html = 
    "
    <table> 
        <tr> 
        <th>ID</th>
        <th>Agenda</th>
        <th> Document Requested </th>
        <th> Other Concern </th>
        <th>Date Schedule</th>
        <th>Time</th>
        <th>Code</th>
        <th>Student Number</th>
        <th> Year </th>
        <th> Course & Section </th>
        <th>Status</th> 
        <th colspan='2'> Action </th>
        </tr>
        <tr id='row-{$row["ID"]}'>
        <td>{$row["ID"]}</td>
        <td>$agenda</td>
        <td> $documentrequested</td>
        <td> $otherconcern</td>
        <td>{$row["DateSched"]}</td>
        <td>$time</td>
        <td>{$row["Code"]}</td>
        <td>{$row["IDNumber"]}</td>
        <td> $year </td> 
        <td> $course </td>
        <td>$status</td>
        <td>
            <button class='edit' onclick='openEditForm({$row["ID"]})'>Edit</button>
        </td>
        <td>
            <button class='remove' onclick='removeRow({$row["ID"]})'>Remove</button> <br>
        </td>
    </tr>";
    echo "<script>                      
           function openEditForm(rowId) {
               console.log('Edit row ' + rowId);
               var formId = 'edit-form-' + rowId;
               var editForms = document.getElementsByClassName('edit-form');
               for (var i = 0; i < editForms.length; i++) {
                   editForms[i].style.display = 'none';
               }
               document.getElementById(formId).style.display = 'block';
           }
       
           function removeRow(rowId) {
               console.log('Remove row ' + rowId);
               if (confirm('Are you sure you want to remove this row?')) {
                   var xhr = new XMLHttpRequest();
                   xhr.open('POST', 'remove-row.php');
                   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                   xhr.onload = function() {
                       if (xhr.status === 200 && xhr.responseText === 'success') {
                           var row = document.getElementById('row-' + rowId);
                           row.remove();
                       } else {
                           console.log('Error: ' + xhr.responseText);
                       }
                   };
                   xhr.send('id=' + rowId);
               }
           }
       </script>";

       echo "<div class='edit-form' style='display:none;' id='edit-form-{$row["ID"]}'>
       <form action='' method='post'>
           <input type='text' name='id' value='{$row["ID"]}'><br>
           <select name='currentstatus' id='status'>
               <option value='1'>Pending</option>
               <option value='2'>Approved</option>
               <option value='3'> Done </option>
               <option value='4'>Denied</option>
           </select><br>
           <button type='submit'
            name='submit_update'>Submit</button>      
       </form>
 </div>
 </table>";

}

echo $html;
}
else {
  
  $sqlschedules = "SELECT * FROM schedules 
  INNER JOIN students ON schedules.IDNumber = students.IDNumber";
  $result = $connect->query($sqlschedules);
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
     <th> Document Requested </th>
     <th> Other Concern </th>
     <th>Date Schedule</th>
     <th>Time</th>
     <th>Code</th>
     <th>Student Number</th>
     <th> Year </th> 
     <th> Course & Section </th>
     <th>Status</th> 
     <th colspan='2'> Action </th>
     </tr>
 
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
         $year = $row["Year"];
         $course = $row["Course"];
         $documentrequested = $row['Document_Request'];
         $otherconcern = $row['Other_Concern'];
          require("switchcases.php");
       
         

         echo "<tr id='row-{$row["ID"]}'>
         <td>{$row["ID"]}</td>
         <td>$agenda</td>
         <td> $documentrequested</td>
         <td> $otherconcern</td>
         <td>{$row["DateSched"]}</td>
         <td>$time</td>
         <td>{$row["Code"]}</td>
         <td>{$row["IDNumber"]}</td>
         <td> $year </td>
         <td> $course </td>
         <td>$status</td>
         <td>
             <button class='edit' onclick='openEditForm({$row["ID"]})'>Edit</button>
         </td>
         <td>
             <button class='remove' onclick='removeRow({$row["ID"]})'>Remove</button> <br>
         </td>
     </tr>";
     
     echo "<script>                      
         function openEditForm(rowId) {
             console.log('Edit row ' + rowId);
             var formId = 'edit-form-' + rowId;
             var editForms = document.getElementsByClassName('edit-form');
             for (var i = 0; i < editForms.length; i++) {
                 editForms[i].style.display = 'none';
             }
             document.getElementById(formId).style.display = 'block';
         }
     
         function removeRow(rowId) {
             console.log('Remove row ' + rowId);
             if (confirm('Are you sure you want to remove this row?')) {
                 var xhr = new XMLHttpRequest();
                 xhr.open('POST', 'remove-row.php');
                 xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                 xhr.onload = function() {
                     if (xhr.status === 200 && xhr.responseText === 'success') {
                         var row = document.getElementById('row-' + rowId);
                         row.remove();
                     } else {
                         console.log('Error: ' + xhr.responseText);
                     }
                 };
                 xhr.send('id=' + rowId);
             }
         }
     </script>";

     echo "<div class='edit-form' style='display:none;' id='edit-form-{$row["ID"]}'>
     <form action='' method='post'>
         <input type='text' name='id' value='{$row["ID"]}'><br>
         <select name='currentstatus' id='status'>
             <option value='1'>Pending</option>
             <option value='2'>Approved</option>
             <option value='3'> Done </option>
             <option value='4'>Denied</option>
         </select><br>
         <button type='submit'
          name='submit_update'>Submit</button>      
     </form>
</div>";


}
     }

       
       
     echo "</table>";
 
}
if(isset($_POST['submit_update']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
  $status = $_POST['currentstatus'];
  $appointmentid = $_POST['id'];
  $sqlupdatedtatus = mysqli_query($connect,"UPDATE schedules SET Currentstatus = '{$status}' WHERE Id= '{$appointmentid}' ") or die("error occurred");
                                              
  if($sqlupdatedtatus){
    echo "<script> alert('Updated Successfully!');
                document.getElementById('display-dashboard').style.display = 'none';
                document.getElementById('display-accounts').style.display = 'block';

                document.getElementById('viewaccounts').classList.add('bg');
                document.getElementById('dashboard').classList.remove('bg');
            </script>";        
  }
}
?>

</body>

</html>
