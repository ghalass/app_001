// PASSWORD TAB
let btnSavePassword = $("#btnSavePassword");
// let password = $("#password");
// let newPassword = $("#newPassword");
// let newPasswordConfirm = $("#newPasswordConfirm");
let btnResetPassword = $("#btnResetPassword");
// UPDATE TAB
let btnSaveChanges = $("#btnSaveChanges");
let btnDeleteAccount = $("#btnDeleteAccount");
// let user = $("#user");
// let UserIsActive = $("#UserIsActive");
// VARIABLES
let user_id = $("#user_id");

btnSavePassword.on("click", () => {
  let row = {
    password: $("#password").val(),
    newPassword: $("#newPassword").val(),
    newPasswordConfirm: $("#newPasswordConfirm").val(),
  };
  console.log(row);
});

btnResetPassword.on("click", () => {
  console.log("ResetPassword");
});

btnSaveChanges.on("click", () => {
  var active = $("#UserIsActive").is(":checked");
  let row = {
    id: $("#user_id").val(),
    firstname: $("#firstname").val(),
    lastname: $("#lastname").val(),
    job: $("#job").val(),
    role: $("#role").val(),
    active: active,
  };
  // console.log(row);
  loader.css("display", "block");
  setTimeout(async () => {
    const user = new User();
    user.updateOne({ by: "id", id: row.id }, row).then((res) => {
      console.log(res);
      location.reload();
    });
    loader.css("display", "none");
  }, delay);
  //
});

btnDeleteAccount.on("click", () => {
  loader.css("display", "block");
  setTimeout(async () => {
    const user = new User();
    user.deleteOne({ by: "id", id: user_id.val() }).then((res) => {
      // console.log(res);
      history.back();
    });
    loader.css("display", "none");
  }, delay);
  //
});
