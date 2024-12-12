/************************ HTML ELEMENTS & VARIABLES  ************************** */
let formFile = $("#formFile");
let rowCounter = $("#rowCounter");
let btnRun = $("#btnRun");
let consoleAreaNOK = $("#consoleAreaNOK");
let consoleAreaOK = $("#consoleAreaOK");
let totalConsoleAreaNOK = $("#totalConsoleAreaNOK");
let totalConsoleAreaOK = $("#totalConsoleAreaOK");
let progBar = $(".progress-bar");
let loader = $("#loader");
let loaderTable = $("#loaderTable");
let totalOK = 0;
let totalNOK = 0;
const delay = 0;
//************************ INITIALIZATION  ************************** */
rowCounter.html(0);
totalConsoleAreaNOK.html(0);
totalConsoleAreaOK.html(0);
let dataFromExcelFile = {};
//************************ EVENTS  ************************** */
formFile.on("click", (e) => {
  consoleAreaOK.html("");
  consoleAreaNOK.html("");
  progBar.css("width", 0 + "%");
  progBar.html(0 + "%");
  resetFormFile();
});
formFile.on("cancel", () => {
  toastr.warning("Aucun fichier n'est chargé.");
  rowCounter.html(0);
  resetFormFile();
});
// get data from excel file and push it into variable dataFromExcelFile
formFile.on("change", async (e) => {
  await getDataFromExcelFile(e).then((res) => {
    // console.log(res);
    dataFromExcelFile = res;
    if (res.length > 0) {
      rowCounter.html(res.length);
      toastr.success(res.length + " Enregistrement chargés.");
    } else {
      toastr.warning("Aucun fichier n'est chargé.");
      rowCounter.html(0);
    }
  });
});
btnRun.on("click", async () => {
  consoleAreaNOK.html("");
  consoleAreaOK.html("");
  await run(dataFromExcelFile);
});
//************************ MESSAGES CONSOLE  ************************** */
function dangerMessage(title = "", message = "") {
  let txt = "<div class='callout callout-danger py-1 mb-1'>";
  txt += "<h6>" + title + "</h6>";
  txt += "<p class='text-danger'><i class='bi bi-patch-exclamation mr-2 '></i>";
  txt += message;
  txt += "</p>";
  txt += "</div>";
  return txt;
}
function successMessage(title = "", message = "") {
  let txt = "<div class='callout callout-success py-1 mb-1'>";
  txt += "<h6>" + title + "</h6>";
  txt += "<p class='text-success'><i class='bi bi-patch-check mr-2 '></i>";
  txt += message;
  txt += "</p>";
  txt += "</div>";
  return txt;
}
//************************ FUNCTIONS UTILS  ************************** */
function resetFormFile() {
  formFile.wrap("<form>").closest("form").get(0).reset();
  formFile.unwrap();
  formFile.wrap("<form>").closest("form").get(0).reset();
  formFile.unwrap();
}
async function get(params = [], url = "") {
  let URL = baseUrl + url;
  let i = 0;
  for (var param in params) {
    if (params.hasOwnProperty(param)) {
      if (i == 0) {
        URL += "?" + param + "=" + params[param];
      } else {
        URL += "&" + param + "=" + params[param];
      }
    }
    i++;
  }
  // console.log(URL);
  let promis = new Promise(function (resolve, reject) {
    setTimeout(() => {
      $.ajax({
        method: "GET",
        url: URL,
        success: function (res, status, xhr) {
          // console.log(res);
          // let result = JSON.parse(res);
          resolve(res);
        },
        error: function (xhr, status, err) {},
        complete: function () {},
      });
    }, delay);
  });
  return await promis;
}

async function post(data = [], url = "") {
  let URL = baseUrl + url;
  // console.log(URL);
  // console.log(data);
  let promis = new Promise(function (resolve, reject) {
    setTimeout(() => {
      $.ajax({
        method: "POST",
        url: URL,
        data: data,
        success: function (res, status, xhr) {
          // console.log(res);
          let result = {};
          try {
            result = JSON.parse(res);
          } catch (error) {
            result = { record: data, errors: { name: "n'existe pas." } };
          }
          resolve(result);
        },
        error: function (xhr, status, err) {},
        complete: function () {},
      });
    }, delay);
  });
  return await promis;
}

async function getDataFromExcelFile(e) {
  let jsonData = [];
  let promis = new Promise(function (resolve, reject) {
    setTimeout(async () => {
      if (e.target.files.length != 0) {
        const file = e.target.files[0];
        const data = await file.arrayBuffer();
        const workbook = XLSX.read(data);
        var first_ws = workbook.Sheets[workbook.SheetNames[0]];
        jsonData = XLSX.utils.sheet_to_json(first_ws);
      }
      resolve(jsonData);
    }, 0);
  });
  return await promis;
}
