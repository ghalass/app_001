let controller = "lubrifiants";

/***************** */
async function run(dataFromExcelFile) {
  consoleAreaNOK.html("");
  progBar.css("width", 0 + "%");
  progBar.html(0 + "%");

  const crudIptions = document.querySelector("input[name=crudIptions]:checked");

  let operation = crudIptions.value;
  // console.log(operation);

  // check if file structure is correct
  let fileFormat = [
    "LUBRIFIANT",
    "TYPELUBRIFIANT",
    "LUBRIFIANT_UPDATE",
    "TYPELUBRIFIANT_UPDATE",
  ];
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
        toastr.warning(
          msg +
            "LUBRIFIANT, TYPELUBRIFIANT, LUBRIFIANT_UPDATE, TYPELUBRIFIANT_UPDATE"
        );
        return;
      }
    }
  } else {
    toastr.warning(msg + "LUBRIFIANT, TYPELUBRIFIANT");
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
        let _lubrifiant_name = dataFromExcelFile[i]["LUBRIFIANT"] ?? "";
        let _lubrifiant_name_update =
          dataFromExcelFile[i]["LUBRIFIANT_UPDATE"] ?? "";

        let _typelubrifiant_name = dataFromExcelFile[i]["TYPELUBRIFIANT"] ?? "";
        let _typelubrifiant_name_update =
          dataFromExcelFile[i]["TYPELUBRIFIANT_UPDATE"] ?? "";
        // TODO: END

        const typelubrifiant = new Typelubrifiant();
        const lubrifiant = new Lubrifiant();

        switch (operation) {
          case "add":
            let typelubrifiant_id = await typelubrifiant
              .findWhere({ name: _typelubrifiant_name })
              .then((res) => {
                let id = 0;
                if (res.length > 0) id = res[0].id;
                return id;
              });
            lubrifiant
              .createOne({
                name: _lubrifiant_name,
                typelubrifiant: typelubrifiant_id,
              })
              .then((res) => {
                setConsole(res, _lubrifiant_name, "Ajouté");
              });
            break;
          case "update":
            let typelubrifiant_id_update = await typelubrifiant
              .findWhere({ name: _typelubrifiant_name_update })
              .then((res) => {
                let id = 0;
                if (res.length > 0) id = res[0].id;
                return id;
              });
            lubrifiant
              .updateOne(
                { by: "name", name: _lubrifiant_name },
                {
                  name: _lubrifiant_name_update,
                  typelubrifiant: typelubrifiant_id_update,
                }
              )
              .then((res) => {
                setConsole(res, _lubrifiant_name, "Modifié");
              });
            break;
          case "delete":
            lubrifiant
              .deleteOne({ by: "name", name: _lubrifiant_name })
              .then((res) => {
                setConsole(res, _lubrifiant_name, "Supprimé");
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
}

LoadTable();

function LoadTable() {
  loaderTable.css("display", "block");
  get([], "lubrifiants/getAll")
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
