<?php 
   session_start();

   include("connect.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Change Profile</title>
    <style>
        img {
            padding-top: 10px;
            cursor: pointer;
        }
        .btn {
           margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <a href="homepage.php"><img src="logo.png" width="100px" height="80px" alt="Logo"></a>
        </div>

        <div class="right-links">
            <a href="index.php"> <button class="btn">Log Out</button> </a>
        </div>
    </div>
    <di v class="container">
        <div class="box form-box">
            <?php 
               if(isset($_POST['submit'])){
                $idnumber = $_POST['IDNumber'];
                $email = $_POST['email'];
                $id = $_SESSION['id'];

                $edit_query = mysqli_query($connect,"UPDATE users SET IDNumber='$idnumber', Email='$email' WHERE Id=$id ") or die("error occurred");

                if($edit_query){
                    echo "<div class='message'>
                    <p>Profile Updated!</p>
                </div> <br>";
              echo "<a href='homepage.php'><button class='btn'>Go Home</button>";
       
                }
               }else{

                $id = $_SESSION['id'];
                $query = mysqli_query($connect,"SELECT*FROM users WHERE Id=$id ");

                while($result = mysqli_fetch_assoc($query)){
                    $idnumber = $result['IDNumber'];
                    $res_Email = $result['Email'];
                }

            ?>

        </div>
        <?php } ?>
      </div>
</body>
</html>