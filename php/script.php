<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
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
</body>
</html>