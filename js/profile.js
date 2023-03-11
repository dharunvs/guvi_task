$(document).ready(() => {
  // $.ajax({
  //   url: "http://localhost:8080/php/authState.php",
  //   crossDomain: true,
  //   type: "POST",
  //   data: JSON.stringify({ session_id: localStorage.getItem("session_id") }),
  //   success: function (res) {
  //     console.log(res);
  //     // if (!res) window.location.pathname = "/login.html";
  //     // else {
  //     //   window.location.pathname = "/profile.html";
  //     // }
  //   },
  //   error: function (data) {
  //     console.log(data);
  //   },
  // });
  let pr_fname = document.getElementById("pr_fname");
  let pr_lname = document.getElementById("pr_lname");
  let pr_email = document.getElementById("pr_email");
  let pr_age = document.getElementById("pr_age");
  let pr_dob = document.getElementById("pr_dob");
  let pr_phone = document.getElementById("pr_phone");
  let esButton = document.getElementById("edit_save_button");

  let logoutButton = document.getElementById("logoutButton");

  let pControl = document.getElementById("pControl");

  let toggleState = true;

  function setField(state) {
    pr_fname.disabled = state;
    pr_lname.disabled = state;
    pr_email.disabled = true;
    pr_age.disabled = state;
    pr_dob.disabled = state;
    pr_phone.disabled = state;
  }

  setField(toggleState);

  $.ajax({
    url: "http://localhost:8080/php/profile.php",
    crossDomain: true,
    type: "get",
    dataType: "json",
    success: function (res) {
      res.map((v, key) => {
        pr_fname.value = v["fname"];
        pr_lname.value = v["lname"];
        pr_email.value = v["email"];
        pr_age.value = v["age"];
        pr_dob.value = v["dob"];
        pr_phone.value = v["phone"];
      });
      console.log(res);
    },
    error: function (data) {
      console.log(data);
    },
  });
  $(esButton).click((e) => {
    e.preventDefault();
    if (esButton.value === "edit") {
      toggleState = !toggleState;
      setField(toggleState);
      esButton.value = "save";
      esButton.innerText = "Save";
    } else if (esButton.value === "save") {
      $.ajax({
        url: "http://localhost:8080/php/updateProfile.php",
        crossDomain: true,
        type: "post",
        data: $("#profileForm").serialize(),
        success: function (data) {
          console.log(data);
        },
      });
      toggleState = !toggleState;
      setField(toggleState);
      esButton.value = "edit";
      esButton.innerText = "Edit";
    }
  });

  $("#logoutButton").click(function () {
    $.ajax({
      url: "http://localhost:8080/php/logout.php",
      crossDomain: true,
      type: "get",
      success: function (data) {
        console.log(data);
        localStorage.clear();
        window.location.pathname = "/login.html";
      },
    });
  });
});
// $(saveButton).click((e) => {
//   e.preventDefault();

//   $.ajax({
//     url: "http://192.168.1.10:8080/php/register.php",
//     crossDomain: true,
//     method: "post",
//     data: $("#registerForm").serialize(),
//     success: function (response) {
//       console.log(typeof response);
//       message = response;
//       document.getElementById("echo").innerText = response;
//       console.log(response);
//       toggleState = !toggleState;
//       setField(toggleState);
//       $(pControl).html('<button id="edit_button">Edit</button>');
//     },
//   });

//   toggleState = !toggleState;
//   setField(toggleState);
//   $(pControl).html('<button id="edit_button">Edit</button>');
//   editButton = document.getElementById("edit_button");
//   saveButton = document.getElementById("save_button");
// });

// $(logoutButton).click(() => {
//   localStorage.clear();
//   window.location = "register.html";
// });
