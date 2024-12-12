LoadTable();

function LoadTable() {
  $("#loaderTable").css("display", "block");
  get([], "typeorganes/getAll")
    .then((res) => {
      $("#div_table").html(res);
    })
    .then(() => {
      $("#loaderTable").css("display", "none");
    });
}
// $("#staticBackdrop").modal("show");
function getRow(data, op) {
  // console.log(data, op);
  resetFields();
  $("#operation").val(op);
  if (data !== null) {
    $("#id").val(data.id);
    $("#name").val(data.name);
  }
  $("#type_operation").removeClass("badge-info");
  $("#type_operation").removeClass("badge-success");
  $("#type_operation").removeClass("badge-warning");
  $("#type_operation").removeClass("badge-danger");

  $("#btnSubmit").removeClass("btn-outline-info");
  $("#btnSubmit").removeClass("btn-outline-success");
  $("#btnSubmit").removeClass("btn-outline-warning");
  $("#btnSubmit").removeClass("btn-outline-danger");

  // console.log(op);
  switch (op) {
    case "add":
      $("#type_operation").html("Ajout d'un nouveau");
      $("#type_operation").addClass("badge-success");
      $("#btnSubmit").addClass("btn-outline-success");
      $("#btnSubmit span").html("Ajouter");
      break;
    case "update":
      $("#type_operation").html("Modification");
      $("#type_operation").addClass("badge-warning");
      $("#btnSubmit").addClass("btn-outline-warning");
      $("#btnSubmit span").html("Modifier");
      break;
    case "delete":
      $("#type_operation").html("Suppression");
      $("#type_operation").addClass("badge-danger");
      $("#btnSubmit").addClass("btn-outline-danger");
      $("#btnSubmit span").html("Supprimer");
      break;
    default:
      break;
  }

  $("#staticBackdrop").modal("show");
}

$("form").submit(function (e) {
  e.preventDefault();
  let formData = getFormData($(this));
  console.log(formData);
  const typeorgane = new Typeorgane();
  const row = {
    id: formData.id,
    name: formData.name,
  };
  // console.log(row);
  switch (formData.operation) {
    case "add":
      typeorgane.createOne(row).then((res) => {
        notif(res, "Ajouté");
      });
      break;
    case "update":
      typeorgane.updateOne({ by: "id", id: row.id }, row).then((res) => {
        notif(res, "Modifié");
      });
      break;
    case "delete":
      typeorgane.deleteOne({ by: "id", id: row.id }).then((res) => {
        notif(res, "Supprimé");
      });
      break;
    default:
      toastr.error("Veuillez choisir une opération.");
      break;
  }
});

function notif(res, msg) {
  // console.log(res);
  var errors = "";
  let hasError = res["errors"].length != 0;
  if (hasError) {
    // has errors
    errors = res["errors"];
    setErrors(errors);
  } else {
    // no errors
    $("#staticBackdrop").modal("hide");
    toastr.success(`${msg} avec succès.`);
    setErrors();
    LoadTable();
  }
}

function resetFields() {
  $("form").trigger("reset");
  setErrors();
}
