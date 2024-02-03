<?php 
  include("connect.php");

  if(isset($_POST['submit'])){
    $idnumber = $_POST['idnumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $idphoto = $_FILES['idphoto']['name'];
    $idphoto_tmp = $_FILES['idphoto']['tmp_name'];
    $idphoto_data = addslashes(file_get_contents($_FILES['idphoto']['tmp_name']));
    $approval = $_POST['approval'];

    $verify_query = mysqli_query($connect,"SELECT * FROM students WHERE IDNumber='$idnumber'");

    if(mysqli_num_rows($verify_query) == 0){
      echo "<div class='message'>
              <p>Make sure you have entered a correct <br> Student ID Number.</p>
            </div> <br>";
      
    } else {
      $verify_query = mysqli_query($connect,"SELECT * FROM users WHERE IDNumber='$idnumber'");
      if(mysqli_num_rows($verify_query) != 0 ){
        echo "<div class='message'>
                <p>This Student Number is already Registered.</p>
              </div> <br>";
        
      } else {
        mysqli_query($connect,"INSERT INTO users(IDNumber,Email,Password,IDPhoto,Approval) VALUES('$idnumber','$email','$password','$idphoto_data','$approval')") or die("Error Occured");
        echo "<div class='message'>
                <p>Registration is Submited Your Registered! <br> Account Will Be Available Within 3-5 Working Days</p>
              </div> <br>
              ";
              echo "<a href='index.php'><button class='btn' style='align: center;'> Go Back</button></a>";


      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=o, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Register</title>
</head>
<body>
  <div class="container">
    <div class="box form-box">
      <header>Sign Up</header>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="field input">
          <label for="idnumber">Student ID Number</label>
          <input type="text" name="idnumber" id="idnumber" autocomplete="off" required>
        </div>
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
        <div class="field input">
          <label for="idphoto">ID Photo</label>
          <input type="file" name="idphoto" id="idphoto" accept="image/*" required>
        </div>
        <div class="field">
          <input type="submit" class="btn" name="submit" value="Register" required>
        </div>
        <input type="hidden" value="3" name="approval">
      </form>
      Already Have an Account? <a href="../php/index.php">Login </a>
    </div>
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
