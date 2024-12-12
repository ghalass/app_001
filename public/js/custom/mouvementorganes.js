LoadTable();
const organe = new Organe();
const engin = new Engin();
const mouvementorgane = new Mouvementorgane();

function LoadTable() {
  $("#loaderTable").css("display", "block");
  get([], "mouvementorganes/getAll")
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
  $("#operation").val(op);
  resetFields();
  if (data !== null) {
    $("#id").val(data.id);
    $("#organe").val(data.organe);

    $("#typeorgane").val(data.organe.typeorgane.id);
    $("#parc").val(data.organe.parc.id);

    engin
      .findWhere({
        parc: $("#parc").val(),
      })
      .then((res) => {
        let txt = `
    <option value=""></option>`;
        for (let i = 0; i < res.length; i++) {
          txt += `
      <option value=${res[i].id}>
          ${res[i].name}
      </option>`;
        }
        $("#engin").html(txt);
      })
      .then(() => {
        $("#engin").val(data.engin.id);
      });

    const row = {
      typeorgane: data.organe.typeorgane.id,
      parc: data.organe.parc.id,
    };
    // console.log(row);
    organe
      .findWhere(row)
      .then((res) => {
        // console.log(res);
        let txt = `
          <option value=""></option>`;
        for (let i = 0; i < res.length; i++) {
          txt += `
            <option value=${res[i].id}>
                ${res[i].name}
            </option>`;
        }
        $("#organe").html(txt);
      })
      .then(() => {
        $("#organe").val(data.organe.id);
      });

    $("#datemouvement").val(data.datemouvement);
    $("#causemouvement").val(data.causemouvement);
    $("#typemouvement").val(data.typemouvement);
    $("#constats").val(data.constats);
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
  const row = {
    id: formData.id,
    organe: formData.organe,
    engin: formData.engin,
    datemouvement: formData.datemouvement,
    causemouvement: formData.causemouvement,
    typemouvement: formData.typemouvement,
    constats: formData.constats,
  };
  // console.log(row);
  switch (formData.operation) {
    case "add":
      mouvementorgane.createOne(row).then((res) => {
        notif(res, "Ajouté");
      });
      break;
    case "update":
      mouvementorgane.updateOne({ by: "id", id: row.id }, row).then((res) => {
        notif(res, "Modifié");
      });
      break;
    case "delete":
      mouvementorgane.deleteOne({ by: "id", id: row.id }).then((res) => {
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

$("#parc").on("change", () => {
  engin
    .findWhere({
      parc: $("#parc").val(),
    })
    .then((res) => {
      let txt = `
    <option value=""></option>`;
      for (let i = 0; i < res.length; i++) {
        txt += `
      <option value=${res[i].id}>
          ${res[i].name}
      </option>`;
      }
      $("#engin").html(txt);
    });
  organe
    .findWhere({
      parc: $("#parc").val(),
    })
    .then((res) => {
      let txt = `
    <option value=""></option>`;
      for (let i = 0; i < res.length; i++) {
        txt += `
      <option value=${res[i].id}>
          ${res[i].name}
      </option>`;
      }
      $("#organe").html(txt);
    });
});

function resetFields() {
  $("#id").val("");
  $("#organe").val("");
  $("#engin").val("");
  $("#parc").val("");

  $("#organe").html(`<option value=""></option>`);
  $("#engin").html(`<option value=""></option>`);

  $("#datemouvement").val("");
  $("#causemouvement").val("");
  $("#typemouvement").val("");
  $("#typeorgane").val("");
  $("#constats").val("");
}
