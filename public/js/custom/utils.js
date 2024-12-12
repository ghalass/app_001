function getDate(date) {
  let val =
    date.getFullYear() +
    "-" +
    ("0" + (date.getMonth() + 1)).slice(-2) +
    "-" +
    ("0" + date.getDate()).slice(-2);
  return val;
}

function getDateFormated(date) {
  let val =
    ("0" + date.getDate()).slice(-2) +
    "-" +
    ("0" + (date.getMonth() + 1)).slice(-2) +
    "-" +
    date.getFullYear();
  return val;
}

function getFormData(form) {
  let formData = {};
  let inputs = form.serializeArray();
  $.each(inputs, function (i, input) {
    formData[input.name] = input.value;
  });
  return formData;
}

function setErrors(errors = []) {
  $("input").removeClass(" is-invalid ");
  $("select").removeClass(" is-invalid ");
  $("textarea").removeClass(" is-invalid ");
  $("div[id*='div_error_']").addClass("d-none");
  $("div[id*='div_error_'] span").html("");

  for (var k in errors) {
    if (errors.hasOwnProperty(k)) {
      //console.log(k, errors[k]);
      $("#" + k).addClass(" is-invalid ");
      $("#div_error_" + k).removeClass("d-none");
      $("#div_error_" + k + " span").html(errors[k]);
    }
  }
}
