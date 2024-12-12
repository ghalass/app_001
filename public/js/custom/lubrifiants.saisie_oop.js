let controller = "saisielubrifiants";

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
    let fileFormat = ["ENGIN", "LUBRIFIANT", "DU", "AU", "HRM", "QTE"];
    let msg = "La structure du fichier est incorrect, Entêtes : ";
    let dataHeader0 = Object.keys(dataFromExcelFile[0])[0];
    let dataHeader1 = Object.keys(dataFromExcelFile[0])[1];
    let dataHeader2 = Object.keys(dataFromExcelFile[0])[2];
    let dataHeader3 = Object.keys(dataFromExcelFile[0])[3];
    let dataHeader4 = Object.keys(dataFromExcelFile[0])[4];
    let dataHeader5 = Object.keys(dataFromExcelFile[0])[5];

    let fomatHeader0 = fileFormat[0];
    let fomatHeader1 = fileFormat[1];
    let fomatHeader2 = fileFormat[2];
    let fomatHeader3 = fileFormat[3];
    let fomatHeader4 = fileFormat[4];
    let fomatHeader5 = fileFormat[5];

    if (
      dataHeader0 != fomatHeader0 &&
      dataHeader1 != fomatHeader1 &&
      dataHeader2 != fomatHeader2 &&
      dataHeader3 != fomatHeader3 &&
      dataHeader4 != fomatHeader4 &&
      dataHeader5 != fomatHeader5
    ) {
      toastr.warning(msg + "ENGIN, LUBRIFIANT, DU, AU, HRM, QTE");
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
          let _engin_name = dataFromExcelFile[i]["ENGIN"] ?? "";
          let _lubrifiant_name = dataFromExcelFile[i]["LUBRIFIANT"] ?? "";
          let _du = dataFromExcelFile[i]["DU"] ?? "";
          let _au = dataFromExcelFile[i]["AU"] ?? "";
          let _hrm = dataFromExcelFile[i]["HRM"] ?? "";
          let _qte = dataFromExcelFile[i]["QTE"] ?? "";
          // TODO: END

          // convert dates to format yyyy-mm-dd
          _du = new Date(Date.UTC(0, 0, _du - 1))
            .toLocaleDateString("es-CL")
            .split("-")
            .reverse()
            .join("-");
          _au = new Date(Date.UTC(0, 0, _au - 1))
            .toLocaleDateString("es-CL")
            .split("-")
            .reverse()
            .join("-");

          const engin = new Engin();
          const saisielubrifiant = new Saisielubrifiant();
          const lubrifiant = new Lubrifiant();

          let engin_id = await engin
            .findWhere({ name: _engin_name })
            .then((res) => {
              let id = 0;
              if (res.length > 0) id = res[0].id;
              return id;
            });

          let saisie_id = await saisielubrifiant
            .findWhere({ engin: engin_id, du: _du, au: _au })
            .then((res) => {
              let id = 0;
              if (res.length > 0) id = res[0].id;
              return id;
            });

          let lubrifiant_id = await lubrifiant
            .findWhere({ name: _lubrifiant_name })
            .then((res) => {
              let id = 0;
              if (res.length > 0) id = res[0].id;
              return id;
            });

          const auth = new Auth();
          let connectedUser = await auth.get("getConnectedUser").then((res) => {
            // console.log(res);
            return JSON.parse(res);
          });

          let connectedUserId = connectedUser != null ? connectedUser.id : 1;

          switch (operation) {
            case "add":
              let row = {
                engin: engin_id,
                lubrifiant: lubrifiant_id,
                du: _du,
                au: _au,
                hrm: _hrm,
                qte: _qte,
                saisieby: connectedUserId,
                saisieAt: getDate(new Date()),
              };

              // console.log(row);
              saisielubrifiant.createOne(row).then((res) => {
                setConsole(res, _engin_name, "Ajouté");
              });
              break;
            case "update":
              let rowUpdate = {
                id: saisie_id,
                engin: engin_id,
                lubrifiant: lubrifiant_id,
                du: _du,
                au: _au,
                hrm: _hrm,
                qte: _qte,
                updateby: connectedUserId,
                updateAt: getDate(new Date()),
              };
              // console.log(rowUpdate);
              saisielubrifiant
                .updateOne({ by: "id", id: engin_id }, rowUpdate)
                .then((res) => {
                  setConsole(res, _engin_name, "Modifié");
                });
              break;
            case "delete":
              saisielubrifiant
                .deleteOne({ by: "id", id: saisie_id })
                .then((res) => {
                  setConsole(res, _engin_name, "Supprimé");
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
  get([], "saisielubrifiants/getAll")
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
