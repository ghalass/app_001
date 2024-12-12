/************************ HTML ELEMENTS & VARIABLES  ************************** */
let dateRje = $("#dateRje");
let parc = $("#parc");
let loader = $("#loader");
let btnCalculer = $("#btnCalculer");
let delay = 500;
/************************ INITIALIZATION  ************************** */
// dateRje.val(getDate(new Date()));
/************************ PROCESS  ************************** */
btnCalculer.on("click", () => {
  if (parc.val() != "" && dateRje.val() != "") {
    run();
  } else {
    toastr.warning(`Veuillez choisir une date et un parc.`);
  }
});
/************************ FUNCTIONS  ************************** */
function run() {
  var dateRje_date = new Date(dateRje.val());
  var dateRje_day = dateRje_date.getDate();
  var dateRje_month = dateRje_date.getMonth() + 1;
  var dateRje_year = dateRje_date.getFullYear();

  const saisierje = new Saisierje();
  btnCalculer.prop("disabled", true);
  loader.css("display", "block");
  let row = {
    year: dateRje_year,
    month: dateRje_month,
    parc: parc.val(),
  };
  setTimeout(() => {
    saisierje
      .get("getAnalyseindisponibilite", row)
      .then((res) => {
        // console.log(res);
        // console.log(JSON.parse(res).rje);
        $("#div_table").html(res);
      })
      .then(() => {
        btnCalculer.prop("disabled", false);
        loader.css("display", "none");
      });
  }, delay);
}
