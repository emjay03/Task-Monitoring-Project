 

function deleteTask(taskId) {
  if (confirm('Are you sure you want to delete this task assignment?')) {
    // Create an XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Set up a callback function to handle the response
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          // Request successful, do something with the response
          console.log(xhr.responseText);
        } else {
          // Request failed, show an error message
          console.error('Request failed. Status:', xhr.status);
        }
      }
    };

    // Open a GET request to the server-side script
    xhr.open('GET', './Headteamtaskassign.php?delete_taskid=' + taskId, true);

    // Send the request
    xhr.send();
  }
}


 
