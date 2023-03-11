$(document).ready(() => {
  $("#loginButton").click((e) => {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "http://localhost:4444/php/login.php",
      crossDomain: true,
      data: $("#loginForm").serialize(),
      success: function (response) {
        console.log(response);
      },
    });
  });
});

// $(document).ready(function () {
//   $("#loginForm").validate({
//     rules: {
//       password: {
//         required: true,
//       },
//       email: {
//         required: true,
//         email: true,
//       },
//     },
//     messages: {
//       password: {
//         required: "Please enter your password",
//       },
//       email: "Please enter your email address",
//     },
//     submitHandler: submitForm,
//   });
// });

// function submitForm(e) {
//   e.preventDefault();
//   var data = $("#loginForm").serialize();
//   $.ajax({
//     type: "POST",
//     url: "http://localhost:4444/login.php?action=login",
//     data: data,
//     // beforeSend: function () {
//     //   $("#error").fadeOut();
//     //   $("#login_button").html(
//     //     '<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...'
//     //   );
//     // },
//     success: function (response) {
//       if ($.trim(response) === "1") {
//         console.log("dddd");
//         // $("#login-submit").html("Signing In ...");
//         setTimeout(' window.location.href = "profile.html"; ', 2000);
//       } else {
//         $("#email_check").fadeIn(1000, function () {
//           $("#email_check").html(response).show();
//         });
//       }
//     },
//   });
//   return false;
// }
