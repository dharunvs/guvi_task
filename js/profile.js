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

$(esButton).click((e) => {
  e.preventDefault();
  if (esButton.value === "edit") {
    toggleState = !toggleState;
    setField(toggleState);
    esButton.value = "save";
    esButton.innerText = "Save";
  } else if (esButton.value === "save") {
    toggleState = !toggleState;
    setField(toggleState);
    esButton.value = "edit";
    esButton.innerText = "Edit";
  }
});

// $(saveButton).click((e) => {
//   e.preventDefault();

//   $.ajax({
//     url: "http://192.168.1.10:4444/php/register.php",
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
