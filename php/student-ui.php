<?php 
session_start();
include('connect.php');
$idnumber = $_SESSION['idnumber'];

$sql = "SELECT * FROM students WHERE IDNumber = $idnumber";
$result = $connect->query($sql);

$fname = "";
$lname = "";
$mname_initial = "";  
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $fname = $row['Firstname'];
        $lname = $row['Lastname'];
        $mname = $row['Middlename'];
        $mname_initial = strtoupper(substr($mname, 0, 1)) . ".";


        echo "<div class='header'><p><b>Welcome,</b> " . $fname . "<p></div>";
    }
} else {
    echo "Error: No records found.";
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
   <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
   <link rel="stylesheet" href="../css/student.css">
</head>
<body>
    
    <div class="nav-bar">
    <header style="margin: 12px; color: white; font-size: 10px;"><?php echo "$lname, $fname $mname_initial"?></header>
    <h3 style="color: white; font-size: 12px;">Datamex College of St. Adeline</h3>
        <div class="image">
        <img src="../images/logo.png" width="90px" height="70px" alt="Datamex Logo"> 
        </div>
        <hr>
        <div class="nav-bar-option">
            <button id='set-appoint' class="bg">Set Appointment</button>
            <button id='home'>Home</button> 
            <button id='prof'>Dashboard</button>           
            <button id='view-appoint'>Appointments</button>
            <button id='schedule'>School Announement </button>
            <button id='accounts'>Account</button>
            <a href="logout.php"> <button class='logout' style="text-align: center;">Logout</button></a>
        </div>
    </div>



    
        <div class="display-prof" id='display-prof' style="display: none;">
            <div class="display">
                <p>
                <?php 
                    
                    $sql1 = "SELECT COUNT(*) as count FROM schedules WHERE IDNumber = $idnumber AND CurrentStatus = 2";
                    $result1 = $connect->query($sql1);
                    $row1 = $result1->fetch_assoc();
                    $approvedcount = $row1['count'];

                    
                    $sql2 = "SELECT COUNT(*) as count FROM schedules WHERE IDNumber = $idnumber AND CurrentStatus = 1";
                    $result2 = $connect->query($sql2);
                    $row2 = $result2->fetch_assoc();
                    $pendingcount = $row2['count'];

                    
                    $total = $approvedcount + $pendingcount;

                    echo "<div class='pendingcount'> <b> Pending: </b> <br>" . $pendingcount . "</div>";
                    echo "<div class='approvedcount'> <b> Approved: </b> <br>" . $approvedcount . "</div>";
                    echo "<div class = 'Total'> <b> Total: </b> <br> " . $total . "</div>";
                   
                ?>

                </p>
            </div>
        </div>
   


        <div class="display-home" id='display-home'style="display: none;">
            <div class="display-home">
                <p>
                    <div class="home-header">
                        <header class='welcome-header'> WELCOME! </header>
                        <p class="header-info"> 
                            Welcome to Online Appointment System! 
                        </p>
                    </div>
                    
                    <div class="home-header1">
                        <header class='welcome-header1'> Goal! </header>
                        <p class="header-info1">  Online Appointment System! is System where you can set an appointment online before you go
                            to the school, the main goal of this system was to become more efficient for the student where they did not have to 
                            queue and waste a lot of time in school. You can just set a date your agenda your preffered date and time and thats all!
                        </p>
                    </div>

                        <div class="home-header2">
                            <header class='welcome-header'> Feedback! </header>
                            <p class="header-info       ">  
                                You can Help us improve our system by leaving a feedback!  
                                <br><br>
                            <button>Feedback</button>
                            </p>
                        </div>
                </p>    
            </div>

        </div>
    

   
        <div class="display-set-appoint" id='display-set-appoint' style="display: block; height: 90vh;">
            <div class="display">
                <p>
                <?php
                
                      date_default_timezone_set('Asia/Manila');

                      if (isset($_GET['year']) && isset($_GET['month'])) {
                        $year = $_GET['year'];
                        $month = $_GET['month'];
                      } else {
                        $year = date('Y');
                        $month = date('m');
                      }

                     
                        // create a calendar object for the current month
                        $calendar = new \DateTime("$year-$month-01");
                        $days_in_month = $calendar->format('t');

                        // create a table to display the calendar
                        echo "<table>\n";

                        // display the month and year as the table header with previous month and next month button
                        $prev_month = new \DateTime("$year-$month-01");
                        $prev_month->sub(new \DateInterval('P1M'));
                        $next_month = new \DateTime("$year-$month-01");
                        $next_month->add(new \DateInterval('P1M'));

                        echo "<thead>\n<tr>\n<th colspan=\"7\">
                        <a href=\"?year=" . $prev_month->format('Y') . "&month=" . $prev_month->format('m') . "\">Previous Month</a>
                        " . $calendar->format('F Y') . "
                        <a href=\"?year=" . $next_month->format('Y') . "&month=" . $next_month->format('m') . "\">Next Month</a>
                        </th>\n</tr>\n</thead>\n";
                
                        echo "<tbody>\n<tr>\n<th>Sun</th>\n<th>Mon</th>\n<th>Tue</th>\n<th>Wed</th>\n<th>Thu</th>\n<th>Fri</th>\n<th>Sat</th>\n</tr>\n";

                      
                        echo "<form id='calendar-form' action='' method='post'><tr>\n";
                        for ($day = 1; $day <= $days_in_month; $day++) {
                            $calendar = new \DateTime("$year-$month-$day");
                            $weekday = $calendar->format('w');

                            if ($weekday == 0) {
                              echo "<td style='min-width: 100px;'></td>\n";
                              continue;
                          }


                            // add a blank cell for days before the first day of the month
                            if ($day == 1) {
                                echo str_repeat("<td></td>\n", $weekday);
                            }

                       
                            $today = new \DateTime();
                            if ($calendar < $today) {
                                echo "<td class=\"past-day\">$day</td>\n";
                            } else {
                                echo "<td>$day<br>";
                                if ($calendar->format('Y-m-d') < date('Y-m-d')) {
                                    echo "<input type=\"text\" name=\"appointment\" disabled>";
                                    echo "<button disabled>Set Appointment</button>";
                                } else {
                                    // Get count of appointments on this date from the database
                                    $appointments_query = mysqli_query($connect, "SELECT COUNT(*) as appointment_count FROM schedules WHERE DateSched='" . $calendar->format('Y-m-d') . "'");
                                    $appointment_count = mysqli_fetch_assoc($appointments_query)['appointment_count'];
                                    
                                   
                                    
                                    if ($appointment_count >= 20) {
                                        // Date is fully booked
                                        echo "<button type='submit' id='setappointment' style='background-color: gray; cursor: default; width: 50px;'disabled>Fully Booked</button>";;
                                    } 
                                   
                                    else {
                                        // Date is not fully booked, display appointment form
                                        $letters = range('A', 'Z');
                                        $code_letters = $letters[rand(0,25)] . $letters[rand(0,25)] . $letters[rand(0,25)];
                                        $code_digit = rand(100, 999);
                                        $code = $code_letters . $code_digit;


                                        $sqlcounttime1 = "SELECT COUNT(*) as count FROM schedules WHERE TimeSched = 1";
                                        $resultcounttime1 = $connect->query($sqlcounttime1);
                                        $rowdate1 = $resultcounttime1->fetch_assoc();
                                        $count1 = $rowdate1['count'];
                                  
                                        $sqlcounttime2 = "SELECT COUNT(*) as count FROM schedules WHERE TimeSched = 2";
                                        $resultcounttime2 = $connect->query($sqlcounttime2);
                                        $rowdate2 = $resultcounttime2->fetch_assoc();
                                        $count2 = $rowdate2['count'];
                                  
                                        $sqlcounttime3 = "SELECT COUNT(*) as count FROM schedules WHERE TimeSched = 3";
                                        $resultcounttime3 = $connect->query($sqlcounttime3);
                                        $rowdate3 = $resultcounttime3->fetch_assoc();
                                        $count3 = $rowdate3['count'];
                                  
                                        $sqlcounttime4 = "SELECT COUNT(*) as count FROM schedules WHERE TimeSched = 4";
                                        $resultcounttime4 = $connect->query($sqlcounttime4);
                                        $rowdate4 = $resultcounttime4->fetch_assoc();
                                        $count4 = $rowdate4['count'];


                                        echo "<form action='appointment.php' method='post'>";
                                            echo "<input type='hidden' name='date' value='" . $calendar->format('Y-m-d') . "'>"; 
                                            echo "<select name='time' id='appointment'>
                                                    <option value='1'" . ($count1 >= 5 ? ' disabled' : '') . ">8:00AM - 10:00AM </option>
                                                    <option value='2'" . ($count2 >= 5 ? ' disabled' : '') . ">10:00AM - 12:00NN </option>
                                                    <option value='3'" . ($count3 >= 5 ? ' disabled' : '') . ">1:00PM - 3:00PM  </option>
                                                    <option value='4'" . ($count4 >= 5 ? ' disabled' : '') . ">3:00PM - 5:00PM  </option>
                                                  </select> <br>";

                                     
                                        echo "<input type='hidden' name='status' value='1'>  
                                              <input type='hidden' name='code' value='$code'>
                                               <button type='submit' id='setappointment' name='submit' style='width: 90px;' value = 'no' onclick=\"return confirm('Are you sure you want to set this appointment?')\">Set Appointment</button>";
                                              echo "</form>";
                                    }
                                }      
                                echo "</td>\n";
                            }
                            
                           
                            if ($weekday == 6) {
                                echo "</tr>\n<tr>\n";
                            }
                        }
                        echo str_repeat("<td></td>\n", 6 - $calendar->format('w'));
                        echo "</tr>\n";
                        ?>
                        </tr>
                        </tbody>
                        </table>
                       
                </p>
            </div>
        </div>
    
    
   
        <div class="display-view-appoint" id='display-view-appoint' style="display: none;">
        <h2 align="center">List of Appointment</h2>
            <div class="display">
                <p>
                    <?php include("appointments.php");?>
                </p>
            </div>
        </div>

    
        <div class="display-schedules" id='display-schedules' style="display: none;">
            <div class="display" style="display: flex; flex-direction: column; justify-content: center; align-items: center; max-width: 1000px; margin-left: 15%;">

            <h2 align="center">Announcements</h2>
              <?php 
                    $sql_announcement = "SELECT * FROM announcement";
                    $result_announcement = $connect->query($sql_announcement);
                          
                    $a_title = "";
                    $a_content = "";
                    if($result_announcement->num_rows > 0) {
                      while($row = $result_announcement->fetch_assoc()) {
                        $a_title = $row['title'];
                        $a_content = $row['content'];

                        echo " <div class='home-header'>
                        <header class='welcome-header' style='color: white; background-color: #684040;'> $a_title </header>
                        <p class='header-info' style='text-align: left;'> 
                            $a_content
                        </p>
                    </div>";
                      }
                    } else {
                      echo "<p> No Announcement Yet</p>";
                    }
              ?>
                <p>
               
                </p>
            </div>
        </div>

        <div class="display-accounts" id='display-accounts' style="display: none;">
          <h2 align="center">Update Account</h2>
            <div class="display">
                    <?php include("change_password.php");?>
                        <div class="container">
                            <form action="" method="post" name="change_password">
                                <label for="email" style="margin-right: 99px;">Email: </label>
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
                                <button type="submit" name="submitupdate" value="yes" onclick='return confirm("Are you sure you want to change your password?")'>Submit</button> 
                            </form>
                        </div>
                </div>
         </div>
              

<script src="../js/script1.js"></script>
</body>
</html>