$(document).ready(() => {
  $("#registerButton").click((e) => {
    e.preventDefault();
    var message = "";
    $.ajax({
      url: "http://localhost:8080/php/register.php",
      crossDomain: true,
      method: "post",
      data: $("#registerForm").serialize(),
      success: function (response) {
        console.log(typeof response);
        message = response;
        document.getElementById("echo").innerText = response;
        console.log(response);
        window.location.pathname = "/login.html";
      },
    });
  });
});
