$(document).ready(() => {
  $("#registerButton").click((e) => {
    e.preventDefault();
    var message = "";
    $.ajax({
      url: "http://localhost:4444/register.php",
      crossDomain: true,
      method: "post",
      data: $("#registerForm").serialize(),
      success: function (response) {
        console.log(typeof response);
        message = response;
        document.getElementById("email_check").innerText = response;
        console.log(response);
      },
    });
  });
});
