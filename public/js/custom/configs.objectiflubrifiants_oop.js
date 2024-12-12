let controller = "objectiflubrifiants";

/***************** */
async function run(dataFromExcelFile) {
  if (dataFromExcelFile.length != undefined) {
    consoleAreaNOK.html("");
    progBar.css("width", 0 + "%");
    progBar.html(0 + "%");

    const crudIptions = document.querySelector(
      "input[name=crudIptions]:checked"
    );

    let operation = crudIptions.value;
    // console.log(operation);

    // check if file structure is correct
    let fileFormat = ["PARC", "TYPELUBRIFIANT", "ANNEE", "OBJECTIF"];
    let msg = "La structure du fichier est incorrect, Entêtes : ";
    let dataHeader0 = Object.keys(dataFromExcelFile[0])[0];
    let dataHeader1 = Object.keys(dataFromExcelFile[0])[1];
    let dataHeader2 = Object.keys(dataFromExcelFile[0])[2];
    let dataHeader3 = Object.keys(dataFromExcelFile[0])[3];

    let fomatHeader0 = fileFormat[0];
    let fomatHeader1 = fileFormat[1];
    let fomatHeader2 = fileFormat[2];
    let fomatHeader3 = fileFormat[3];

    if (dataHeader0 == fomatHeader0 && dataHeader1 == fomatHeader1) {
      if (operation == "update") {
        if (dataHeader2 != fomatHeader2 && dataHeader3 != fomatHeader3) {
          toastr.warning(msg + "PARC, TYPELUBRIFIANT, ANNEE, OBJECTIF");
          return;
        }
      }
    } else {
      toastr.warning(msg + "PARC, TYPELUBRIFIANT, ANNEE, OBJECTIF");
      return;
    }

    setTimeout(async () => {
      let dataLength = dataFromExcelFile.length;
      if (dataLength > 0) {
        loader.css("display", "block");
        $("#card").find("*").prop("disabled", true);
        toastr.info("Traitement lancé.");
        totalOK = 0;
        totalNOK = 0;
        totalConsoleAreaOK.html(totalOK + " / " + dataFromExcelFile.length);
        totalConsoleAreaNOK.html(totalNOK + " / " + dataFromExcelFile.length);

        for (let i = 0; i < dataLength; i++) {
          let percent = (100 * (i + 1)) / dataLength;
          progBar.css("width", Math.round(percent) + "%");
          progBar.html(Math.round(percent) + "%");

          // TODO: START
          let _parc_name = dataFromExcelFile[i]["PARC"] ?? "";
          let _typelubrifiant_name =
            dataFromExcelFile[i]["TYPELUBRIFIANT"] ?? "";
          let _annee = dataFromExcelFile[i]["ANNEE"] ?? "";
          let _objectif = dataFromExcelFile[i]["OBJECTIF"] ?? "";
          // TODO: END

          const parc = new Parc();
          const typelubrifiant = new Typelubrifiant();
          const objectiflubrifiant = new Objectiflubrifiant();

          let parc_id = await parc
            .findWhere({ name: _parc_name })
            .then((res) => {
              let id = 0;
              if (res.length > 0) id = res[0].id;
              return id;
            });

          let typelubrifiant_id = await typelubrifiant
            .findWhere({
              name: _typelubrifiant_name,
            })
            .then((res) => {
              let id = 0;
              if (res.length > 0) id = res[0].id;
              return id;
            });

          let objectif_id = await objectiflubrifiant
            .findWhere({
              typelubrifiant: _typelubrifiant_name,
              parc: _parc_name,
              annee: _annee,
            })
            .then((res) => {
              let id = 0;
              if (res.length > 0) id = res[0].id;
              return id;
            });

          switch (operation) {
            case "add":
              let rowAdd = {
                parc: parc_id,
                typelubrifiant: typelubrifiant_id,
                annee: _annee,
                obj: _objectif,
              };
              console.log(rowAdd);
              objectiflubrifiant.createOne(rowAdd).then((res) => {
                setConsole(
                  res,
                  `${_typelubrifiant_name} ${_parc_name}`,
                  "Ajouté"
                );
              });
              break;
            case "update":
              objectiflubrifiant
                .updateOne(
                  { by: "id", id: objectif_id },
                  {
                    parc: _parc_name,
                    typelubrifiant: typelubrifiant_id,
                    annee: _annee,
                    obj: _objectif,
                  }
                )
                .then((res) => {
                  setConsole(res, _typelubrifiant_name, "Modifié");
                });
              break;
            case "delete":
              objectiflubrifiant
                .deleteOne({ by: "id", id: objectif_id })
                .then((res) => {
                  setConsole(res, _typelubrifiant_name, "Supprimé");
                });
              break;
            default:
              toastr.error("Veuillez choisir une opération.");
              break;
          }
        }
        loader.css("display", "none");
        $("#card").find("*").prop("disabled", false);
        toastr.info("Traitement terminé.");

        LoadTable();
      } else {
        toastr.warning("Aucun enregistrement n'est chargé.");
      }
    }, delay);
  } else {
    toastr.warning("Aucun enregistrement n'est chargé.");
  }
}

LoadTable();

function LoadTable() {
  loaderTable.css("display", "block");
  get([], "objectiflubrifiants/getAll")
    .then((res) => {
      $("#div_table").html(res);
    })
    .then(() => {
      loaderTable.css("display", "none");
    });
}

function setConsole(res, title, crud) {
  // console.log(res);
  if (res.errors.length != 0) {
    // has errors
    let errMsg = "";
    for (let err in res.errors) {
      errMsg += res.errors[err];
    }
    console.log(errMsg);
    setError(title, errMsg);
  } else {
    // no errors
    setSuccess(title, crud);
  }
}
function setError(title, msg) {
  consoleAreaNOK.append(dangerMessage(title, msg));
  totalNOK++;
  totalConsoleAreaNOK.html(totalNOK + " / " + dataFromExcelFile.length);
  consoleAreaNOK.scrollTop(consoleAreaNOK[0].scrollHeight);
}
function setSuccess(title, msg) {
  consoleAreaOK.append(successMessage(title, msg));
  totalOK++;
  totalConsoleAreaOK.html(totalOK + " / " + dataFromExcelFile.length);
  consoleAreaOK.scrollTop(consoleAreaOK[0].scrollHeight);
}
