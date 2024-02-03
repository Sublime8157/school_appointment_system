<?php 
   session_start();

   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Login</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">
            <?php 
             
              include("connect.php");
              if(isset($_POST['submit'])){
                $email = mysqli_real_escape_string($connect,$_POST['email']);
                $password = mysqli_real_escape_string($connect,$_POST['password']);

                $result = mysqli_query($connect,"SELECT * FROM users WHERE Email='$email' AND Password='$password' ") or die("Select Error");
                $row = mysqli_fetch_assoc($result);

                if(is_array($row) && !empty($row)){
                    $_SESSION['valid'] = $row['Email'];
                    $_SESSION['idnumber'] = $row['IDNumber'];
                    $_SESSION['id'] = $row['Id'];
                    
                }else{
                    echo "<div class='message'>
                      <p>Wrong Username or Password</p>
                       </div> <br>";
                   echo "<a href='index.php'><button class='btn'>Go Back</button>";
         
                }
                if(isset($_SESSION['valid'])){
                    if($row['isAdmin'] == true) {
                        $_SESSION['admin'] = true;
                        header("location: ../Php/schooladmin.php");
                    } 
                    else if($row['isRegistrar'] == True ){
                        $_SESSION['registrar'] = true;
                       header("location: ../Php/registrar.php");
                    }

                    else if($row['Approval'] == 3 ){
                        
                        echo "The account is not yet Available";
                        echo "<a href='index.php'><button class='btn'>Go Back</button>";
                    }
                    else if($row['Approval'] == 4 ){
                        
                        echo "The account has been denied to registered  ";
                        echo "<a href='index.php'><button class='btn'>Go Back</button>";
                    }
                    else {
                        header("location: ../Php/student-ui.php");
                    }
                }
                
            }else
              {

            
            ?>
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>
                <input type="checkbox" name="show_password" id="show_password">
                    <label for="show_password" id="spassword">Show Password</label>
                    <br><br>
                    
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                
                    
                <div class="links">
                    Don't have account? <a href="register.php">Sign Up Now</a>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
      <script>

        const passwordInput = document.getElementById("password");
    const showPasswordCheckbox = document.getElementById("show_password");


    showPasswordCheckbox.addEventListener("change", function() {
       if (this.checked) {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }

    });

    passwordInput.addEventListener("input", function() {
        showPasswordCheckbox.checked = false;
    });

      </script>
</body>
</html>