<div class="change_pass" id="changepass" style="display: none;">
<h2 align="center">Update Account</h2>
            <div class="display">
         
            <?php 
                      $sqlusers = "SELECT * FROM users WHERE isRegistrar = 1";
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
                        $sqlupdate = "UPDATE users SET Password = '$new_password' WHERE isRegistrar = 1";
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