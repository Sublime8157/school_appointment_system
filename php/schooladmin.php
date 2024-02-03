<?php 
session_start();
include('../php/connect.php');
if(!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: ../php/index.php');
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   <link rel="stylesheet" href="../css/student-style.css">
   <link rel="stylesheet" href="../css/admin.css">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
   <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
   <style>
  
    

   </style>
</head>
<body>
    <div class="nav-bar" style="position: fixed;">
    <h3 style="color: white;  text-align: left; padding: 10px 0 25px 10px; font-size: 10px;">Administrator</h3>
        <div class="image">
        <img src="../images/logo.png" width="90px" height="70px" alt="Datamex Logo" style="    margin-bottom: 15%;"> 
        </div>
        <hr>
        <div class="nav-bar-option">
            <button id='dashboard' class="bg">Dash Board</button>
            <button id='viewaccounts'> Appointments</button> 
            <button id='viewschedules'>Users</button>
            <button id='announce'>Announce</button>
            
            <button id='feedbacks'>Feedbacks</button>
             <button id='changepassbtn'>Account</button>
           
            <a href="logout.php"> <button class='logout' style="text-align: center;">Logout</button></a>
        </div>
</div>
    

<div class="header">
            <h1 align="center">Welcome back, Administrator</h1>
        </div>
        <div class="display-dashboard" id='display-dashboard' style="display: block; max-height: 50vh;     margin-left: 5%;">
          <h2> Dashboard </h2>
            <div class="display">
               
                <p>
                <script>
                    function updateDashboard() {
                            var xhr = new XMLHttpRequest();
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState === 4 && xhr.status === 200) {
                                var data = JSON.parse(xhr.responseText);
                                document.getElementById("count-pending").innerHTML = data.countpending;
                                document.getElementById("count-approved").innerHTML = data.countapproved;
                                document.getElementById("count-active-accounts").innerHTML = data.countactiveaccounts;
                                document.getElementById("count-not-active-accounts").innerHTML = data.countnotactiveaccounts;
                                document.getElementById("count-pending-accounts").innerHTML = data.countpendingaccounts;
                                document.getElementById("count-total-appointments").innerHTML = data.totalappointments;
                                document.getElementById("count-total-accounts").innerHTML = data.totalaccounts;
                                document.getElementById("count-denied-accounts").innerHTML = data.deniedaccounts;
                                document.getElementById("count-denied-appointments").innerHTML = data.deniedappointments;
                                }
                            };
                            xhr.open("GET", "update_dashboard.php", true);
                            xhr.send();
                            }

                            // Call the updateDashboard function on page load and set an interval to update the dashboard every 30 seconds
                            updateDashboard();
                            setInterval(updateDashboard, 3000);
                </script>
                <div id="dashboard-container" style="height: 20vh;">
                    <div class='display-dashboard' style="margin: 0 0 15% 0;">
                        <div class='pendingappointment'> <b>Pending Appointments:</b> <br> <span id="count-pending"></span></div>
                        <div class='approvedappointment'> <b>Approved Appointments:</b> <br> <span id="count-approved"></span></div>
                        <div class='totalappointments'> <b> Denied Appointments:</b> <br> <span id="count-denied-appointments"></span></div>
                        <div class='totalappointments'> <b>Total Appointments:</b> <br> <span id="count-total-appointments"></span></div>
                    </div>
                    <div class='display-dashboard' style="margin: 0;">
                        <div class='activeacounts'> <b>Active<br> Acounts </b><br> <span id="count-active-accounts"></span></div>                       
                        <div class='notactiveaccounts' style='background-color: #74678b;'> <b>Not Active Acounts</b> <br> <span id="count-not-active-accounts"></span></div>
                        <div class='notactiveaccounts' style='background-color: #6d7399;'> <b>Pending  Acounts</b> <br> <span id="count-pending-accounts"></span></div>
                        <div class='totalaccounts' style='background-color: #605a5a;'> <b>Denied <br> Accounts </b><br> <span id="count-denied-accounts"></span></div>
                        <div class='totalaccounts' style='background-color: #a7a7a7;'> <b>Total <br> Accounts </b><br> <span id="count-total-accounts"></span></div>
                    </div>
                 </div>
                </p>
            </div>
        </div>  
        
   
   


        <div class="display-accounts" id='display-accounts'style="display: none;">
            <div class="display-appointments">
                <h2 style="margin-left: 15%;">Appointments</h2>
                <p>
                <form action="" method="POST">
                    <div class="search" style="float: right;
                        float: right;
                         margin: 0 60px 20px 0;">
                   <input type="text" id="search" class="search" name="search" onkeyup="filterData()" placeholder="Search Code...." style="    
                   text-align: left;
                    padding: 5px;
                ">
                   </div>
               </form> 
               
                    
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
               <script>
               
                function update_appointments() {
                        $.ajax({
                            url: 'reload_appointment.php',
                            type: 'GET',
                            success: function(response) {
                                console.log("hello");
                                $('#update_list_appointments').html(response); // Update the content of the table container with the table HTML.
                            },
                            error: function(xhr, status, error) {
                                console.log(error); // Log any errors to the console.
                            }
                        });
                    }

                                         
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
                 
                   function filterData(){
                       let searchQuery = document.getElementById("search").value;
                       let xhr = new XMLHttpRequest();
                       xhr.open("POST", "filter_data.php");
                       xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                       xhr.onreadystatechange = function() {
                           if(this.readyState == 4 && this.status == 200) {
                               document.getElementById("data").innerHTML = this.responseText;
                           }
                       };
                       xhr.send("search=" + searchQuery);
           
           
                   }
               </script>
                </p>    
                </p>    
            </div>

        </div>
    

   
        <div class="display-schedules" id='display-schedules' style="display: none;">
        <h2 style="margin-left: 25%;">Accounts</h2>
               
        <form action="" method="POST">
  <div class="search" style="float: right; margin: 0 60px 20px 0;">
    <input type="text" id="searchusers" class="search" name="searchusers" onkeyup="filterUsers()" placeholder="Search ID Number...." style="text-align: left; padding: 5px;">
  </div>
</form> 

            <div class="display">
                
                <p>
                   
                <?php 
                    $sqlusers = "SELECT * FROM users WHERE isAdmin = 0 AND isRegistrar = 0";
                    $resultusers = $connect->query($sqlusers);
                    if($resultusers->num_rows > 0 ) {
                        echo "<table id='table-container'>
                            <tr>
                                <th>ID</th>
                                <th>ID Number</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>ID Photo</th>
                                <th>Status</th>
                                <th> Remove </th>
                            </tr>";
                        while($row = $resultusers->fetch_assoc()) {
                            $id = $row['Id'];
                            $idnumber  = $row['IDNumber'];
                            $email = $row['Email'];
                            $password =  $row['Password'];
                            $idphoto = $row['IDPhoto'];
                            $approval = $row['Approval'];
                            switch ($approval) {
                                case 1:
                                    $approval = "<div style='font-weight: bold; color: white; background-color: #8b8b58;'> Active </div>";
                                    break;
                                case 2:
                                    $approval = "<p style='background-color: #0b978a; color: white;  font-size: 8px;'> Not Active </p>";
                                    break;
                                case 3: 
                                    $approval = "<p style='    background-color: #d7511e;
                                    color: white;
                                    font-size: 8px;
                                    font-weight: bold;'> Pending </p>";
                                    break;
                                case 4:
                                    $approval = "<p style='background-color: red; color: white; font-size: 8px;'> Denied </div>";
                                    break;
                                default:
                                    $approval = "";
                                    break;
                            }
                            
                            $image_data = base64_encode($idphoto);
                            $image_src = "data:image/jpeg;base64,$image_data";
                            echo "<tr>
                                <td> $id </td>
                                <td> $idnumber </td>
                                <td> $email </td>
                                <td> $password </td>
                                <td> <img src='$image_src' alt='ID Photo' width='50px' height='50px'> </td>
                                <td> $approval </td>
                                <td><button class='removepending'> Remove </button></td>
                            </tr>";
                        }
                        echo "</table>";
                    }
                ?>
<script>

    function sample_display() {
       // Get all remove buttons
const removeButtons = document.querySelectorAll('.removepending');
// Add click event listener to each remove button
removeButtons.forEach(button => {
  button.addEventListener('click', (event) => {
    // Prevent form submission
    event.preventDefault();
    // Get the ID of the pending account to be removed
    const id = button.parentElement.parentElement.firstElementChild.textContent;
    // Show confirmation dialog
    if (confirm(`Are you sure you want to remove the pending account with ID ${id}?`)) {
      // Send AJAX request to remove the pending account
      const xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            // Remove the row from the table
            const row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
          } else {
            alert(`Error occurred: ${xhr.statusText}`);
          }
        }
      };
      xhr.open('POST', 'remove_pending_row.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.send(`id=${id}`);
    }
  });
});
    }
// Get all remove buttons
const removeButtons = document.querySelectorAll('.removepending');
// Add click event listener to each remove button
removeButtons.forEach(button => {
  button.addEventListener('click', (event) => {
    // Prevent form submission
    event.preventDefault();
    // Get the ID of the pending account to be removed
    const id = button.parentElement.parentElement.firstElementChild.textContent;
    // Show confirmation dialog
    if (confirm(`Are you sure you want to remove the pending account with ID ${id}?`)) {
      // Send AJAX request to remove the pending account
      const xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            // Remove the row from the table
            const row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
          } else {
            alert(`Error occurred: ${xhr.statusText}`);
          }
        }
      };
      xhr.open('POST', 'remove_pending_row.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.send(`id=${id}`);
    }
  });
});


function filterUsers() {
      let searchQuery = document.getElementById("searchusers").value;
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "filter_users_admin.php");
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("table-container").innerHTML = this.responseText;
        }
      };
      xhr.send("searchusers=" + searchQuery);
    }


</script>





                </p>
            </div>
        </div>
    
        <div class="set-announce" id='set-announce' style="display: none; height: 50vh;">
          
        
          
            <div class="display">
               
                <p>
                <div class="container" style="margin-top: 40%;">
        <div class="box form-box">
        <div class="date" style="    
        display: flex;
        padding: 8px;
        justify-content: flex-end; 
        padding: 8px;
        font-size: 12px;">
            <?php $date_today = date("Y-m-d");
            echo "<b> Today: </b> &nbsp;" . $date_today;
            ?>
        </div>
            <header> Announcement </header>
    <form action="" method="post" name="announce">
        <div class="field input">
        <label for="announcement-title">Announcement Title</label> <br>
        <input type="text" name="announcement-title" style="width: 400px">
        </div>

        <div class="field input">
        <label for="announcement-content">Announcement Content</label> <br>
        <textarea name="announcement-content"  cols="54" rows="10"></textarea>
        </div>

        <div class="field">
        <button type="submit" name="submit-btn" value="yes" onclick="return confirm('Are you sure you want to submit?')" style="width: 400px;">Submit</button>
        </div>
    </form>
    </div>
    </div>
        <?php 
    if(isset($_POST["submit-btn"]) && $_POST["submit-btn"]){
        $announcement_title = $_POST["announcement-title"];
        $announcement_content = $_POST["announcement-content"];

        $sql = "INSERT INTO announcement (title,content) VALUES ('" . $announcement_title ."', '" . $announcement_content . "')";

        if($connect->query($sql)) {
            echo "<div class='result' id='result'>Announcement Has been Posted!<br><button id='cancel'>Cancel</div>";

            echo "<script> 
                    document.getElementById('set-announce').style.display = 'block';
                    document.getElementById('display-dashboard').style.display = 'none';

                    document.getElementById('announce').classList.add('bg');
                    document.getElementById('dashboard').classList.remove('bg');

                    document.getElementById('cancel').addEventListener('click', function(){
                        document.getElementById('result').style.display = 'none';
                    });
            </script>"; 
        }
        else {
            echo "There might be an error";
        }
    }

    ?>
                </p>
            </div>
      </div>
     
      <div class="display-feedbacks" id='display-feedbacks' style="display: none;">
            <div class="display" style="   
             display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            max-width: 1000px;
            margin-left: 15%;">

            <h2 align="center">Feedbacks</h2>
              <?php 
                  $sql_announcement = "SELECT * FROM feedbacks";
                  $result_announcement = $connect->query($sql_announcement);
                         
                  $name = "";
                  $a_content = "";
                  if($result_announcement->num_rows > 0) {
                    while($row = $result_announcement->fetch_assoc()) {
                      $name = $row['Firstname'];
                      $a_content = $row['Content'];
                      $date_announced = $row['Feedback_Date'];

                      echo " <div class='home-header'>
                      <header class='welcome-header' style='color: white; background-color: #36295e;'> $name 
                        <div class='date' style='float: right; margin-right: 5%;'> $date_announced </div>
                      </header>
                      <p class='header-info' style='text-align: left;'> 
                          $a_content
                      </p>
                  </div>";
                    }
                  } else {
                    echo "<p> No Feedbacks Yet</p>";
                  }
            



              ?>
                <p>
               
                </p>
            </div>
        </div>
       
       <div class="change_pass" id="changepass" style="display: none;">
<h2 align="center">Update Account</h2>
            <div class="display">
         
            <?php 
                      $sqlusers = "SELECT * FROM users WHERE isAdmin = 1";
                      $resultusers = $connect->query($sqlusers);
                     
                      $email = "";
                      $password = "";

                      if($resultusers->num_rows > 0 ) {
                        while($row = $resultusers->fetch_assoc()) {
                         
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


                              document.getElementById('changepassbtn').classList.add('bg');
                              document.getElementById('dashboard').classList.remove('bg');
                              document.getElementById('display-dashboard').style.display = 'none';
                              document.getElementById('changepass').style.display = 'block';
                            </script>
                              ";
                      }else {
                        $sqlupdate = "UPDATE users SET Password = '$new_password' WHERE isAdmin = 1";
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

                    document.getElementById('changepassbtn').classList.add('bg');
                    document.getElementById('dashboard').classList.remove('bg');
                    document.getElementById('display-dashboard').style.display = 'none';
                    document.getElementById('changepass').style.display = 'block';
                      </script>
                      ";  
                    
                    } 



                    }
                      ?>
            <div class="container">
                        <form action="" method="post" name="change_password" style="    
                        border: 1px solid white;
                        padding: 50px;
                        background: white;
                        margin-top: 15%;
                        box-shadow: 5px 5px 15px 10px #dbdbed;
                        border-radius: 15px;">
                            <label for="email" style="margin: 0 90px 0 10px;">Email: </label>
                            <input type="text" name="email" value="<?php echo $email; ?>">  
                            <br><br>

                            <label for="new_password" style="margin: 0 25px 0 5px;">New Password:</label>
                            <input type="password" name="new_password" id="password" required>  
                            <br><br>

                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" name="confirm_password" id="confirm_password" required>
                            <br>

                            <input type="checkbox" name="show_password" id="show_password">
                            <label for="show_password" id="spassword">Show Password</label>
                            <br><br>
                            <button type="submit" style="margin-left: 14%;"name="submitupdate" value="yes" onclick='return confirm("Are you sure you want to change your password?")'>Submit</button> 
                        </form>
              </div>
</div>
</div>
<script>
   
   const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirm_password");
    const showPasswordCheckbox = document.getElementById("show_password");

    const inputPassword = [passwordInput, confirmPasswordInput];

    showPasswordCheckbox.addEventListener("change", function() {
        if (this.checked) {
            for (let i = 0; i < inputPassword.length; i++) {
                inputPassword[i].type = "text";
            }
        } else {
            for (let i = 0; i < inputPassword.length; i++) {
                inputPassword[i].type = "password";
            }
        }
    });

    passwordInput.addEventListener("input", function() {
        showPasswordCheckbox.checked = false;
    });



        const displaydashboard  = document.getElementById('display-dashboard');
        const buttondashboard = document.getElementById('dashboard');

        const viewaccounts = document.getElementById('display-accounts');
        const viewaccountbutton = document.getElementById('viewaccounts')

        const appointments = document.getElementById('display-schedules');
        const appointmentsbutton = document.getElementById('viewschedules');

        const setannounce = document.getElementById('set-announce');
        const announce = document.getElementById('announce');

        const feedbacks = document.getElementById('display-feedbacks');
        const feedbackbutton = document.getElementById('feedbacks');

        
        const changepass = document.getElementById('changepass');
        const changepassbtn = document.getElementById('changepassbtn');

         changepassbtn.addEventListener("click", function(){
          displaydashboard.style.display = 'none';  
            viewaccounts.style.display  = 'none';
            appointments.style.display = 'none';
            setannounce.style.display = 'none';
            feedbacks.style.display = 'none';
              changepass.style.display = 'block';

            changepassbtn.classList.add('bg');
            feedbackbutton.classList.remove('bg');
            announce.classList.remove('bg'); 
            buttondashboard.classList.remove('bg');
            viewaccountbutton.classList.remove('bg');
            appointmentsbutton.classList.remove('bg');
        });


        buttondashboard.addEventListener("click", function(){
            displaydashboard.style.display = 'block';  
            viewaccounts.style.display  = 'none';
            appointments.style.display = 'none';
            setannounce.style.display = 'none';
            feedbacks.style.display = 'none';
              changepass.style.display = 'none';

            changepassbtn.classList.remove('bg');
            feedbackbutton.classList.remove('bg');
            announce.classList.remove('bg'); 
            buttondashboard.classList.add('bg');
            viewaccountbutton.classList.remove('bg');
            appointmentsbutton.classList.remove('bg');
        });

        viewaccountbutton.addEventListener("click", function(){
            displaydashboard.style.display = 'none';  
            viewaccounts.style.display  = 'block';
            appointments.style.display = 'none';
            setannounce.style.display = 'none';
            feedbacks.style.display = 'none';
            changepass.style.display = 'none';

            changepassbtn.classList.remove('bg');
            feedbackbutton.classList.remove('bg');
            announce.classList.remove('bg'); 
            buttondashboard.classList.remove('bg');
            viewaccountbutton.classList.add('bg');
            appointmentsbutton.classList.remove('bg');
        });

        appointmentsbutton.addEventListener("click", function(){
            displaydashboard.style.display = 'none';  
            viewaccounts.style.display  = 'none';
            appointments.style.display = 'block';
            setannounce.style.display = 'none';
            feedbacks.style.display = 'none';
            changepass.style.display = 'none';

            changepassbtn.classList.remove('bg');
            feedbackbutton.classList.remove('bg');
            announce.classList.remove('bg'); 
            buttondashboard.classList.remove('bg');
            viewaccountbutton.classList.remove('bg');
            appointmentsbutton.classList.add('bg');
        });

        announce.addEventListener("click", function(){
            displaydashboard.style.display = 'none';  
            viewaccounts.style.display  = 'none';
            appointments.style.display = 'none';
            setannounce.style.display = 'block';
            feedbacks.style.display = 'none';
            changepass.style.display = 'none';

            changepassbtn.classList.remove('bg');
            feedbackbutton.classList.remove('bg');
            announce.classList.add('bg'); 
            buttondashboard.classList.remove('bg');
            viewaccountbutton.classList.remove('bg');
            appointmentsbutton.classList.remove('bg');
        });

        feedbackbutton.addEventListener("click", function(){
            displaydashboard.style.display = 'none';  
            viewaccounts.style.display  = 'none';
            appointments.style.display = 'none';
            setannounce.style.display = 'none';
            feedbacks.style.display = 'block';
            changepass.style.display = 'none';

            changepassbtn.classList.remove('bg');
            feedbackbutton.classList.add('bg');
            announce.classList.remove('bg'); 
            buttondashboard.classList.remove('bg');
            viewaccountbutton.classList.remove('bg');
            appointmentsbutton.classList.remove('bg');
        });

        


        



        
     



      
    </script>
</body>
</html>
</body>
</html>