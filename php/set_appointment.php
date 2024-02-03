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
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $date = $_POST['date'];
        $appointment = $_POST['appointment'];
        // TODO: Store the appointment in a database or file.
        echo 'Appointment set for ' . $date;
      }
      
    
    ?>
</body>
</html>