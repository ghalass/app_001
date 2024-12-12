$("#du").on("change", () => {
  getFields();
});
$("#au").on("change", () => {
  getFields();
});
$("#typeparc").on("change", () => {
  getParcsByTypeparc($("#typeparc").val(), (engin = ""));
});

function getParcsByTypeparc(typeparc_id = "", engin = "") {
  let url = "parcs/findAllByTypeparc/";
  if (engin != "") {
    url = url + engin.parc.typeparc.id;
  } else if (typeparc_id != "") {
    url = url + typeparc_id;
  }
  if (engin == "" || typeparc_id == "") {
    $.ajax({
      method: "GET",
      url: url,
      beforeSend: function () {
        // console.log(recordData);
      },
      success: function (res, status, xhr) {
        $("#parc").html(res);
      },
      error: function (xhr, status, err) {
        console.log("error");
      },
      complete: function (xhr, status) {
        if (engin != "") {
          $("#parc").val(engin.parc.id);
        }
      },
    });
  } else {
    console.log("aucune params pour la func getParcsByTypeparc");
  }
}

$("#parc").on("change", () => {
  getFields();
});

function getFields() {
  $("#div_table").html("");
  var row = {};
  if ($("#du").val() != "") row.du = $("#du").val();
  if ($("#au").val() != "") row.au = $("#au").val();
  if ($("#parc").val() != "") row.parc = $("#parc").val();
  getVentilation(row);
}

getFields();

function getVentilation(row) {
  var url = "ventilations/getRepport";
  $.ajax({
    method: "POST",
    url: url,
    data: row,
    success: function (res, status, xhr) {
      // console.log(res);
      $("#div_table").html(res);
    },
    error: function (xhr, status, err) {
      console.log("error");
    },
    complete: function (xhr, status) {},
  });
}

$("#typelubrifiant").on("change", () => {
  getChart();
});

function getChart() {
  var row = {};
  if ($("#du").val() != "") row.du = $("#du").val();
  if ($("#au").val() != "") row.au = $("#au").val();
  if ($("#parc").val() != "") row.parc = $("#parc").val();
  if ($("#typelubrifiant").val() != "")
    row.typelubrifiant = $("#typelubrifiant").val();

  let selected_typelubrifiant = $("#typelubrifiant option:selected")
    .text()
    .trim();

  let selected_parc = $("#parc option:selected").text().trim();

  let isReadyForChart = true;
  if (
    row.du == undefined ||
    row.parc == undefined ||
    row.typelubrifiant == undefined
  )
    isReadyForChart = false;

  if (isReadyForChart) {
    var url = "ventilations/getChart";
    $.ajax({
      method: "POST",
      url: url,
      data: row,
      success: function (res, status, xhr) {
        response = JSON.parse(res);
        // console.log(res);
        // return;
        var areaChartData = {
          labels: [
            "Jan.",
            "Fev",
            "Mars",
            "Avr",
            "Mars",
            "Juin.",
            "Juill.",
            "Août.",
            "Sep.",
            "Oct.",
            "Nov.",
            "Déc.",
          ],
          datasets: [
            {
              label:
                "Spécifique : " + selected_typelubrifiant + " " + selected_parc,
              backgroundColor: "rgba(60,141,188,0.9)",
              borderColor: "rgba(60,141,188,0.8)",
              pointStyle: "circle",
              pointRadius: 5,
              pointHoverRadius: 10,
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: response,
            },
          ],
        };
        var areaChartOptions = {
          maintainAspectRatio: false,
          responsive: true,
          legend: {
            display: true,
          },
          scales: {
            xAxes: [
              {
                gridLines: {
                  display: true,
                },
              },
            ],
            yAxes: [
              {
                ticks: {
                  beginAtZero: true, // minimum value will be 0.
                },
                gridLines: {
                  display: true,
                },
              },
            ],
          },
        };
        //-------------
        //- LINE CHART -
        //--------------
        var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
        var lineChartOptions = $.extend(true, {}, areaChartOptions);
        var lineChartData = $.extend(true, {}, areaChartData);
        lineChartData.datasets[0].fill = false;
        lineChartOptions.datasetFill = false;

        new Chart(lineChartCanvas, {
          type: "line",
          data: lineChartData,
          options: lineChartOptions,
        });
      },
      error: function (xhr, status, err) {
        console.log("error");
      },
      complete: function (xhr, status) {},
    });
  }
}
