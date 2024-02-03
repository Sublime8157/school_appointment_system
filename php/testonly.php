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
<?php 
                    $idnumber ="";
                    $sqlusers = "SELECT * FROM users 
                    INNER JOIN students ON users.IDNumber = students.IDNumber
                    WHERE Approval = 3";
       
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
                                <th> Full name </th> 
                            
                            </tr>";
                        while($row = $resultusers->fetch_assoc()) {
                            $id = $row['Id'];
                            $idnumber  = $row['IDNumber'];
                            $email = $row['Email'];
                            $password =  $row['Password'];
                            $idphoto = $row['IDPhoto'];
                            $approval = $row['Approval'];
                            $fname = $row['Firstname'];
                            $mname = $row['Middlename'];
                            $lname = $row['Lastname'];
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
                                <td> $fname $mname $lname </td>  
                            </tr>";
                        }
                        echo "</table>";

                     
                    }


                 
                    
                ?>
</body>
</html>