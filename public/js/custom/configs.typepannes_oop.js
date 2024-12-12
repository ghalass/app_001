let controller = "typepannes";

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
    let fileFormat = ["TYPEPANNE", "TYPEPANNE_UPDATE"];
    let msg = "La structure du fichier est incorrect, Entêtes : ";
    if (Object.keys(dataFromExcelFile[0])[0] == fileFormat[0]) {
      if (operation == "update") {
        if (Object.keys(dataFromExcelFile[0])[1] != fileFormat[1]) {
          toastr.warning(msg + "TYPEPANNE, TYPEPANNE_UPDATE");
          return;
        }
      }
    } else {
      toastr.warning(msg + "TYPEPANNE");
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
          let _typepanne_name = dataFromExcelFile[i]["TYPEPANNE"] ?? "";
          let _typepanne_name_update =
            dataFromExcelFile[i]["TYPEPANNE_UPDATE"] ?? "";
          // TODO: END

          const typepanne = new Typepanne();
          switch (operation) {
            case "add":
              typepanne.createOne({ name: _typepanne_name }).then((res) => {
                setConsole(res, _typepanne_name, "Ajouté");
              });
              break;
            case "update":
              typepanne
                .updateOne(
                  { by: "name", name: _typepanne_name },
                  { name: _typepanne_name_update }
                )
                .then((res) => {
                  setConsole(res, _typepanne_name, "Modifié");
                });
              break;
            case "delete":
              typepanne
                .deleteOne({ by: "name", name: _typepanne_name })
                .then((res) => {
                  setConsole(res, _typepanne_name, "Supprimé");
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
  get([], "typepannes/getAll")
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
    // console.log(errMsg);
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
