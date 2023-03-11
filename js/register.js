$(document).ready(() => {
  $("#registerButton").click((e) => {
    e.preventDefault();
    var message = "";
    $.ajax({
      url: "http://192.168.1.10:4444/php/register.php",
      crossDomain: true,
      method: "post",
      data: $("#registerForm").serialize(),
      success: function (response) {
        console.log(typeof response);
        message = response;
        document.getElementById("echo").innerText = response;
        console.log(response);
      },
    });
  });
});
