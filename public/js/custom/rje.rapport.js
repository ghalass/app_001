/************************ HTML ELEMENTS & VARIABLES  ************************** */
let dateRje = $("#dateRje");
let loader = $("#loader");
let btnCalculer = $("#btnCalculer");
let delay = 500;
/************************ INITIALIZATION  ************************** */
dateRje.val(getDate(new Date()));
/************************ PROCESS  ************************** */
btnCalculer.on("click", () => {
  run();
});
/************************ FUNCTIONS  ************************** */
function run() {
  var dateRje_date = new Date(dateRje.val());
  var dateRje_day = dateRje_date.getDate();
  var dateRje_month = dateRje_date.getMonth() + 1;
  var dateRje_year = dateRje_date.getFullYear();

  let dateRJE_Formted = `${dateRje_year}-${dateRje_month}-${dateRje_day}`;
  //   console.log(dateRJE_Formted);

  const saisierje = new Saisierje();
  btnCalculer.prop("disabled", true);
  loader.css("display", "block");
  let row = { daterje: dateRJE_Formted };
  setTimeout(() => {
    saisierje
      .get("getRJE", row)
      .then((res) => {
        // console.log(res);
        $("#div_table").html(res);
      })
      .then(() => {
        btnCalculer.prop("disabled", false);
        loader.css("display", "none");
      });
  }, delay);
}
