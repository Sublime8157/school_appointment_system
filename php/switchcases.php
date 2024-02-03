<?php 
 switch ($agenda) {
    case 1:
      $agenda = "Document Request";
      break;
    case 2:
      $agenda = "Payment of tuition";
      break;
      case 3:
        $agenda = "Other Concern";
      break;
      default:
      $agenda = "";
  }
  switch($time) {
    case 1: 
      $time = "8:00AM - 10:00AM";
      break;
    case 2:
      $time = "10:00AM - 12:00NN";
      break;
    case 3:
      $time = "1:00PM - 3:00PM";
      break;
    case 4:
      $time = "3:00PM - 5:00PM";
      break;
    default:
    $status ="";
  }
  switch($status) {
    case 1: 
      $status =  "<div style='background-color: yellow;'> Pending </div> ";
      break;
    case 2: 
      $status =  "<div class='approved'> Approved </div> ";
      break;
    case 3: 
      $status =  "<div class='done'> Done </div> ";
      break;
    case 4: 
    $status = "<div class='denied'> Denied </div> " ;
    break;
    default: 
    $status = "No Current Request";
  }

  switch ($year) {
      case 1: 
          $year = "1st Year";
          break;
      case 2:
          $year = "2nd Year";
          break;
      case 3:
          $year = "3rd Year";
          break;
      case 4: 
          $year = "4th Year";
          break;
      case 5:
          $year = "<p style='background-color: red; color: white; font-weight: bold;'> Almmuni</p>";
          break;
      default: 
          $year = "Undefined";
          break;
  }
  switch ($documentrequested) {
    case 1:
      $documentrequested = "Transcript of Records";
      break;
    case 2:
      $documentrequested = "Birth Certificate";
      break;
      case 3:
        $documentrequested = "Diploma";
      break;
      case 4:
        $documentrequested = "Certificate of Enrollment";
      break;

      default:
      $documentrequested = "";
  }
?>