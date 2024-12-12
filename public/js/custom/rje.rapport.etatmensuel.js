/************************ HTML ELEMENTS & VARIABLES  ************************** */
let dateRje = $("#dateRje");
let loader = $("#loader");
let btnCalculer = $("#btnCalculer");
let delay = 500;
/************************ INITIALIZATION  ************************** */
// dateRje.val(getDate(new Date("Y-m")));
/************************ PROCESS  ************************** */
btnCalculer.on("click", () => {
  if (dateRje.val() != "") {
    run();
  } else {
    toastr.warning(`Veuillez choisir une date.`);
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
  let row = { year: dateRje_year, month: dateRje_month };
  setTimeout(() => {
    saisierje
      .get("getEtatMensuel", row)
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
