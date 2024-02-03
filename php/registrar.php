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
</head>
<body>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   <link rel="stylesheet" href="../css/student-style.css">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <link rel="stylesheet" href="../css/registrar.css">
</head>
<body>
    
    <div class="nav-bar">
    <h3 style="color: white;  text-align: left; padding: 10px 0 25px 10px; font-size: 10px;"><i style='font-size:10px; color: #05d105; margin-right: 3%;'  class='fas'>&#xf406;</i>Registrar</h3>
       
    <h3 style="color: white;" style="   ">School Registrar</h3>
        <div class="image">
        <img src="../images/logo.png" width="90px" height="70px" alt="Datamex Logo" style="margin-bottom: 10%;"> 
        </div>
        <hr>
        <div class="nav-bar-option">
            <button id='dashboard' class="bg">Dash Board</button>
            <button id='viewaccounts'> Appointments</button> 
            <button id='viewschedules'>Users</button>
            <button id ='pendingaccounts'>Pending Users </button>
            <button id='changepassbtn'>Account</button>
            <a href="logout.php"> <button class='logout' style="text-align: center;">Logout</button></a>
        </div>
</div>
    

       <div class="header">
            <h1 align="center">Welcome back, Registrar</h1>
        </div>
        <div class="display-dashboard" id='display-dashboard' style="display: block;">
          <h2> Dashboard </h2>
        
          
            <div class="display">
               
                <p>
                   <?php 
                        
                        $sqlcountpending = "SELECT COUNT(*) FROM schedules WHERE Currentstatus = 1";                      
                        $resultcountpending = mysqli_query($connect, $sqlcountpending);                     
                        $countpending = mysqli_fetch_array($resultcountpending)[0];

                        $sqlcountapproved = "SELECT COUNT(*) FROM schedules WHERE Currentstatus = 2";                      
                        $resultcountapproved = mysqli_query($connect, $sqlcountapproved);                     
                        $countapproved = mysqli_fetch_array($resultcountapproved)[0];

                        $sqlcountactiveaccounts = "SELECT COUNT(*) FROM users WHERE Approval = 1";
                        $resultactiveaccount = mysqli_query($connect, $sqlcountactiveaccounts);
                        $countactiveaccounts = mysqli_fetch_array($resultactiveaccount)[0];

                        $sqlcountnotactiveaccounts = "SELECT COUNT(*) FROM users WHERE Approval = 2";
                        $resultnotactiveaccount = mysqli_query($connect, $sqlcountnotactiveaccounts);
                        $countnotactiveaccounts = mysqli_fetch_array($resultnotactiveaccount)[0];

                        $sql_pending_accounts = "SELECT COUNT(*) FROM users WHERE Approval = 3";
                        $result_pending_accounts = mysqli_query($connect, $sql_pending_accounts);
                        $count_pending_accounts = mysqli_fetch_array($result_pending_accounts)[0];

                        $totalaccounts = $countactiveaccounts + $countnotactiveaccounts + $count_pending_accounts;
                        $totalappointments = $countpending + $countapproved;
                        echo "<div class='pendingappointment'> <b>Pending Appointments:</b> <br>" . $countpending . "</div>";
                        echo "<div class='approvedappointment'> <b>Approved Appointments:</b> <br>" . $countapproved . "</div>";
                        echo "<div class='totalappointments'> <b>Total Appointments:</b> <br>" . $totalappointments . "</div>";
                        echo "</div>";
                        echo "<div class='display-dashboard' style='margin: 0 0 0 15%;'>";
                        echo "<div class='activeacounts'> <b>Active Acounts </b><br>" . $countactiveaccounts . "</div>";                       
                        echo "<div class='notactiveaccounts'> <b>Not Active Acounts</b> <br>" . $countnotactiveaccounts . "</div>";
                        echo "<div class='notactiveaccounts'> <b>Pending  Acounts</b> <br>" . $count_pending_accounts . "</div>";
                        echo "<div class='totalaccounts'> <b>Total Accounts </b><br>" . $totalaccounts . "</div>";
                        echo "</div>";


                        


                   ?>
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
               <?php include("../php/display-accounts.php");   
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
              <?php include("../php/script.php")?>
                </p>    
                </p>    
            </div>

        </div>
        

      
           

   
        <div class="display-schedules" id='display-schedules' style="display: none;">
        <h2 style="margin-left: 25%;">Accounts</h2>
            <div class="display">
                
                <p>
                <?php 
                    $idnumber ="";
                    $sqlusers = "SELECT * FROM users WHERE isAdmin = 0 AND isRegistrar = 0";
                    $resultusers = $connect->query($sqlusers);
                    if($resultusers->num_rows > 0 ) {
                        echo "<table>
                            <tr>
                                <th>ID</th>
                                <th>ID Number</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>ID Photo</th>
                                <th>Status</th>
                            
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
                                    $status = "<div class='active' style='background-color: green;'> Active </div>";
                                    break;
                                case 2:
                                    $status = "<div class='notactive'> Not Active </div>";
                                    break;
                                case 3:                                       
                                     $status = "<div class='pending'> Pending </div>";
                                    break;
                                case 4:
                                     $status = "<div class='denied'> Denied </div>";
                                     break;
                                default:
                                    $status = "";
                            }
                            
                            $image_data = base64_encode($idphoto);
                            $image_src = "data:image/jpeg;base64,$image_data";
                            echo "<tr>
                                <td> $id </td>
                                <td> $idnumber </td>
                                <td> $email </td>
                                <td> $password </td>
                                <td> <img src='$image_src' alt='ID Photo' width='50px' height='50px'> </td>
                                <td> $status </td>
                            </tr>";
                        }
                        echo "</table>";

                     
                    }


                 
                    
                ?>
               
                </p>
            </div>
        </div>
    
   <div class="display_pending_appointments" id="display_pending_appointments" style="display: none;">
   <h2 style="margin-left: 25%;">Pending Accounts</h2>
    <div class="display">
        <p>
           
        <?php 
 $sqlpendingaccounts = "SELECT * FROM users 
 INNER JOIN students ON users.IDNumber = students.IDNumber
 WHERE Approval = 3";
$resultpendingaccounts = $connect->query($sqlpendingaccounts);
if($resultpendingaccounts->num_rows > 0 ) {
    echo "<table>
        <tr> 
            <th> Id </th>
            <th> ID Number </th>
            <th> Email </th> 
            <th> Password </th> 
            <th> ID Photo </th>
            <th> Full Name </th>
            <th> Action </th>
            <th> Status </th>
        </tr>";
    while($row = $resultpendingaccounts->fetch_assoc()) {
        $id = $row['Id'];
        $idnumber = $row['IDNumber'];
        $email = $row['Email'];
        $password = $row['Password'];
        $idphoto = $row['IDPhoto'];
        $approval = $row['Approval'];
        $image_data = base64_encode($idphoto);
        $image_src = "data:image/jpeg;base64,$image_data";
        $fname = $row['Firstname'];
        $mname = $row['Middlename'];
        $lname = $row['Lastname'];
        
        switch($approval) {
            case 3: 
                $approval = "<div class='pending'> Pending </div> ";
                break;
            default: 
                $approval = "";
                break;
        }
        echo "<tr>
            <td>  $id </td>
            <td> $idnumber </td>
            <td> $email </td>
            <td> $password </td>
            <td> <img src='$image_src' alt='ID Photo' width='50px' height='50px'> </td>
            <td> $fname $mname $lname </td>
            <td>
                <button class='editpending' data-id='$id'> Edit </button>
                <form class='edit-form' data-id='$id' method='post' style='display: none;' name='editform'>
                <label for='id'> ID: </label>
                    <input type='text' name='id' value='$id' />
                <label for='approval'> Approval </label>
                    <select name='approval'>
                        <option value='3'>Pending</option>
                        <option value='1'>Approved</option>
                        <option value ='4'> Denied </option>
                    </select>
                    <button type='submit' name='submit' onclick='return confirm(\"Are you sure you want to update this record?\");'>Save</button>
                    <button type='button' class='cancel-btn'>Cancel</button>
                </form>
            </td>
            <td> $approval  </td> 
         
        </tr>";
        if(isset($_POST['submit']) && $_POST['id'] == $id){
            $approval = $_POST['approval'];
            $pendingid = $_POST['id'];
            
            
            $sqlupdatepending = mysqli_query($connect,"UPDATE users SET Approval = '{$approval}' WHERE Id= '{$pendingid}' ") or die("error occurred");                                                   
            if($sqlupdatepending){
                echo "<p class='result' style='font-size: 15px;'>Updated Successfully!</p>";        
                echo "<script> alert('Update successful!'); </script>";
            }

            else {
                echo "Error Occured";
            }

        }
        
        
    }

   
                
} else {
    echo "0 Result";
}

echo "</table>"

?>
 


<script>
            var editButtons = document.querySelectorAll('.editpending');
            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');
                    var form = document.querySelector('.edit-form[data-id="' + id + '"]');
                    form.style.display = 'block';
                    this.style.display = 'none';
                });
            });



            var cancelButtons = document.querySelectorAll('.cancel-btn');
            cancelButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var form = this.parentNode;
                    var id = form.getAttribute('data-id');
                    var editButton = document.querySelector('.editpending[data-id="' + id + '"]');
                    form.style.display = 'none';
                    editButton.style.display = 'inline-block';
                });
            });
</script>


        </p>
    </div>
   </div>
      

   <div class="change_pass" id="changepass" style="display: none;">
<h2 align="center">Update Account</h2>
            <div class="display">
         
            <?php include("changepass.php"); ?>
                      
            <div class="container">
                        <form action="" method="post" name="change_password" style="    
                        border: 1px solid white;
                        padding: 50px;
                        background: white;
                        margin-top: 15%;
                        box-shadow: 5px 5px 15px 10px #dbdbed;
                        border-radius: 15px;">
                            <label for="email" style="margin-right: 90px;">Email: </label>
                            <input type="text" name="email" value="<?php echo $email; ?>">  
                            <br><br>

                            <label for="new_password" style="margin-right: 25px;">New Password:</label>
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
       
<script src="../js/script2.js"></script>
</body>
</html>
</body>
</html>