let controller = "typeparcs";

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
    let fileFormat = ["TYPEPARC", "TYPEPARC_UPDATE"];
    let msg = "La structure du fichier est incorrect, Entêtes : ";
    if (Object.keys(dataFromExcelFile[0])[0] == fileFormat[0]) {
      if (operation == "update") {
        if (Object.keys(dataFromExcelFile[0])[1] != fileFormat[1]) {
          toastr.warning(msg + "TYPEPARC, TYPEPARC_UPDATE");
          return;
        }
      }
    } else {
      toastr.warning(msg + "TYPEPARC");
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
          let _typeparc_name = dataFromExcelFile[i]["TYPEPARC"] ?? "";
          let _typeparc_name_update =
            dataFromExcelFile[i]["TYPEPARC_UPDATE"] ?? "";
          // TODO: END

          const typeparc = new Typeparc();
          switch (operation) {
            case "add":
              typeparc.createOne({ name: _typeparc_name }).then((res) => {
                setConsole(res, _typeparc_name, "Ajouté");
              });
              break;
            case "update":
              typeparc
                .updateOne(
                  { by: "name", name: _typeparc_name },
                  { name: _typeparc_name_update }
                )
                .then((res) => {
                  setConsole(res, _typeparc_name, "Modifié");
                });
              break;
            case "delete":
              typeparc
                .deleteOne({ by: "name", name: _typeparc_name })
                .then((res) => {
                  setConsole(res, _typeparc_name, "Supprimé");
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
  get([], "typeparcs/getAll")
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
