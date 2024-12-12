LoadTable();

function LoadTable() {
  $("#loaderTable").css("display", "block");
  get([], "organes/getAll")
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
    $("#typeorgane").val(data.typeorgane.id);
    $("#parc").val(data.parc.id);
    $("#sn").val(data.sn);
    $("#marque").val(data.marque);
    $("#origine").val(data.origine);
    $("#fournisseur").val(data.fournisseur);
    $("#infos").val(data.infos);
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
  // console.log(formData);
  const organe = new Organe();
  const row = {
    id: formData.id,
    name: formData.name,
    typeorgane: formData.typeorgane,
    parc: formData.parc,
    sn: formData.sn,
    marque: formData.marque,
    origine: formData.origine,
    fournisseur: formData.fournisseur,
    infos: formData.infos,
  };
  // console.log(row);
  switch (formData.operation) {
    case "add":
      organe.createOne(row).then((res) => {
        notif(res, "Ajouté");
      });
      break;
    case "update":
      organe.updateOne({ by: "id", id: row.id }, row).then((res) => {
        notif(res, "Modifié");
      });
      break;
    case "delete":
      organe.deleteOne({ by: "id", id: row.id }).then((res) => {
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
  $("#id").val("");
  $("#name").val("");
  $("#typeorgane").val("");
  $("#parc").val("");
  $("#sn").val("");
  $("#marque").val("");
  $("#origine").val("");
  $("#fournisseur").val("");
  $("#infos").val("");
  $("form").trigger("reset");
  setErrors();
}
