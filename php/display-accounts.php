<?php 

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
   <div id='update_list_appointments'><table id='data'>
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
     include("switchcases.php");

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
       <input type='text' name='id' value='{$row["ID"]}' readonly><br>
       <select name='currentstatus' id='status'>
           <option value='1'>Pending</option>
           <option value='2'>Approved</option>
           <option value='3'> Done </option>
           <option value='4'>Denied</option>
       </select><br>
       <button type='submit' name='submit_update' onclick='updateStatus({$row["ID"]})'>Submit</button>
   </form>
</div>
<script>
function updateStatus(id) {

var status = document.getElementById('status').value;
var con = confirm('Are you sure you want to update?');
if (con === true) {
   event.preventDefault();
 $.ajax({                      
   type: 'POST',
   url: 'update_status.php',
   data: {
     id: id,
     status: status
   },
   success: function(response) {
       update_appointments(response);
   },
   error: function(xhr, status, error) {
     console.log('An error occurred while updating the status.');
   }
 });
}
}


</script>

";               
}
   }

     
     
   echo "</table></div>";
?>


<?php 