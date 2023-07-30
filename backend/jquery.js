//login.php ajax

$(document).ready(function () {
  $("#login-form").submit(function (event) {
    event.preventDefault();
    var formData = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "../../backend/connection.php",
      data: formData,
      success: function (response) {
        if (response === "success_admin") {
          $("#success-alert").removeClass("hidden");
          setTimeout(function () {
            window.location.href = "../Head/Headdashboard.php";
          }, 2000); // 2 seconds delay

          // Hide the success alert after 2 seconds
          setTimeout(function () {
            $("#success-alert").addClass("hidden");
          }, 2000);
        } else if (response === "success_user") {
          $("#success-alert").removeClass("hidden");
          setTimeout(function () {
            window.location.href = "../Team/Usersetting.php";
          }, 2000); // 2 seconds delay
        } else {
          $("#failed-alert").removeClass("hidden");
          setTimeout(function () {}, 2000);
          setTimeout(function () {
            $("#failed-alert").addClass("hidden");
          }, 2000); // 4 seconds delay (2 seconds to show the alert + 2 seconds to hide it)
        }
      },
      error: function (error) {
        // Handle any error that occurs during the AJAX request
        alert("An error occurred while processing your request.");
        console.log(error);
      },
    });
  });
});

//usersetting
$(document).ready(function () {
  $("#usersetting").submit(function (event) {
    event.preventDefault();
    var updatepassword = $("#updatepassword").val();
    var confirmpassword = $("#confirmpassword").val();
    if (updatepassword !== confirmpassword) {
      $("#errorupdate-alert").removeClass("hidden");
      return; // Prevent form submission
    }
    var formData = new FormData(this);

    $.ajax({
      type: "POST",
      url: "../../backend/connection.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        // Handle the server response here, based on your backend logic
        console.log(response); // You can log the response to the console for debugging

        if (response === "admin setting updated") {
          // The update was successful for an admin user, show a success message if needed

          // Redirect to the admin user setting page
          $("#successupdate-alert").removeClass("hidden");
          setTimeout(function () {
            window.location.href = "../../frontend/Head/Headsetting.php";
          }, 2000); // 2 seconds delay
        } else if (response === "user setting updated") {
          // The update was successful for a regular user, show a success message if needed

          // Redirect to the regular user setting page
          $("#successupdate-alert").removeClass("hidden");
          setTimeout(function () {
            window.location.href = "../../frontend/Team/Usersetting.php";
          }, 2000); // 2 seconds delay
        } else {
          // The update was not successful, show an error message
          $("#errorupdate-alert").removeClass("hidden");
        }
      },
      error: function (xhr, status, error) {
        // Handle any errors that occurred during the AJAX request
        alert("Error: " + error);
      },
    });
  });
});

function logout() {
  $.ajax({
    type: "GET",
    url: "../../backend/connection.php?action=logout",
    success: function (response) {
      window.location.href = "../../frontend/Login/Login.php";
    },
    error: function () {
      // This function is executed if there is an error with the AJAX request
      // Handle error, if any
      console.error("Logout failed.");
    },
  });
}

// Attach the logout function to the click event of the logout button
$(document).ready(function () {
  $("#logoutLink").click(function (e) {
    e.preventDefault();
    logout();
  });
});
