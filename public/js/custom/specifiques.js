/************************ HTML ELEMENTS & VARIABLES  ************************** */
let typelubrifiantSelect = $("#typelubrifiant");
let typeparc = $("#typeparc");
let parcSelect = $("#parc");
let engin = $("#engin");
let du = $("#du");
let au = $("#au");
let btnCalculer = $("#btnCalculer");
let year = $("#year");
let evolutionOptions = $(".evolutionOptions");

/************************ INITIALIZATION  ************************** */
du.val(getDate(new Date()));
au.val(getDate(new Date()));

/************************ PROCESS  ************************** */
typeparc.on("change", async () => {
  const parc = new Parc();
  parc.findWhere({ typeparc: typeparc.val() }).then((res) => {
    // console.log(res);
    let txt = `
          <option value="">
              Parcs
          </option>`;
    for (let i = 0; i < res.length; i++) {
      txt += `
            <option value=${res[i].id}>
                ${res[i].name}
            </option>`;
    }
    parcSelect.html(txt);
  });
});
btnCalculer.on("click", () => {
  run();
});

du.css("display", "block");
au.css("display", "block");
year.css("display", "none");
evolutionOptions.on("click", (e) => {
  let option = e.target.value;
  if (option == "chart") {
    du.css("display", "none");
    au.css("display", "none");
    year.css("display", "block");
  } else {
    du.css("display", "block");
    au.css("display", "block");
    year.css("display", "none");
  }
});

/************************ FUNCTIONS  ************************** */

function run() {
  if (checkInputs()) {
    const specifiqueOptions = document.querySelector(
      "input[name=specifiqueOptions]:checked"
    );

    const evolutionOptions = document.querySelector(
      "input[name=evolutionOptions]:checked"
    );

    let specifiqueOpt = specifiqueOptions.value;
    let evolutionOpt = evolutionOptions.value;

    let row = {
      typelubrifiant: typelubrifiantSelect.val(),
      parc: parcSelect.val(),
      du: du.val(),
      au: au.val(),
    };
    const specifique = new Specifiques();

    // TABLEAU
    if (evolutionOpt == "table") {
      // BY PARC
      if (specifiqueOpt == "byparc") {
        btnCalculer.prop("disabled", true);
        loader.css("display", "block");
        setTimeout(() => {
          specifique
            .get("byparc", row)
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

      // BY ENGIN
      if (specifiqueOpt == "byengin") {
        btnCalculer.prop("disabled", true);
        loader.css("display", "block");
        setTimeout(() => {
          specifique
            .get("byengin", row)
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
    }

    // CHART
    if (evolutionOpt == "chart") {
      // BY PARC
      if (specifiqueOpt == "byparc") {
        var du_date = new Date($("#du").val());
        var du_day = du_date.getDate();
        var du_month = du_date.getMonth() + 1;
        var du_year = du_date.getFullYear();
        var year = $("#year option:selected").val();
        var t_lub = $("#typelubrifiant option:selected").text();
        var p = $("#parc option:selected").text();

        var dateNow = new Date();

        let textLabel = `${t_lub} ${p}`;

        btnCalculer.prop("disabled", true);
        loader.css("display", "block");
        setTimeout(() => {
          row.year = year;
          // console.log(row);
          specifique
            .get("getChart", row)
            .then((res) => {
              btnCalculer.prop("disabled", true);
              loader.css("display", "block");
              let r = JSON.parse(res);
              let response = r[0];
              let objs = r[1];
              // console.log(response);
              // console.log(objs);
              // console.log(response);
              $("#div_table").html("");

              let labelsValue = [
                "Jan.",
                "Fev.",
                "Mars.",
                "Avr.",
                "Mai.",
                "Juin.",
                "Juill.",
                "Août.",
                "Sep.",
                "Oct.",
                "Nov.",
                "Déc.",
              ];

              var Xlabels = [];

              if (year == dateNow.getFullYear()) {
                for (var i = 0; i < dateNow.getMonth() + 1; ++i) {
                  Xlabels.push(labelsValue[i]);
                }

                Xlabels[Xlabels.length - 1] =
                  Xlabels[Xlabels.length - 1] + year;
                // console.log(Xlabels);
              } else {
                Xlabels = labelsValue;
                Xlabels[Xlabels.length - 1] =
                  Xlabels[Xlabels.length - 1] + year;
              }

              if (myLineChart) myLineChart.destroy();
              myLineChart = new Chart(ctx, config);

              myLineChart.data.labels = Xlabels;
              myLineChart.options.plugins.title.text = [
                `${t_lub}`.toUpperCase(),
                `${p}`.toUpperCase(),
                `Au ${getDateFormated(dateNow)}`,
              ];
              // myLineChart.options.plugins.subtitle.text = ;

              myLineChart.data.datasets[0].data = response;
              myLineChart.data.datasets[0].label = `spécifique`.toUpperCase();

              myLineChart.data.datasets[1].data = objs;
              myLineChart.data.datasets[1].label = "Objectif".toUpperCase();

              myLineChart.update("active");
            })
            .then(() => {
              btnCalculer.prop("disabled", false);
              loader.css("display", "none");
            });
        }, delay);
      }

      // BY ENGIN
      if (specifiqueOpt == "byengin") {
        toastr.info("En cours de développement !!!.");
        $("#div_table").html("");
      }
    }
  }
}

function checkInputs() {
  let dataIsValid = true;
  if (typelubrifiantSelect.val().trim() == "" && dataIsValid) {
    toastr.warning("Veuillez choisir un type de lubrifiant.");
    dataIsValid = false;
  }

  if (parcSelect.val().trim() == "" && dataIsValid) {
    toastr.warning("Veuillez choisir un parc.");
    dataIsValid = false;
  }

  if (du.val().trim() == "" && dataIsValid) {
    toastr.warning("Veuillez choisir une date début.");
    dataIsValid = false;
  }
  if (au.val().trim() == "" && dataIsValid) {
    toastr.warning("Veuillez choisir une date fin.");
    dataIsValid = false;
  }

  const evolutionOptions = document.querySelector(
    "input[name=evolutionOptions]:checked"
  );
  if (evolutionOptions.value == "chart") {
    if (year.val().trim() == "" && dataIsValid) {
      toastr.warning("Veuillez choisir une année d'anaylse.");
      dataIsValid = false;
    }
  }

  return dataIsValid;
}

const ctx = document.getElementById("lineChart");
// Manually register the chartjs datalabels plugin
Chart.register(ChartDataLabels);
const config = {
  type: "line",
  data: {
    labels: [],
    datasets: [
      {
        label: "",
        data: [],
        borderWidth: 1,
      },
      {
        label: "",
        data: [],
        borderWidth: 1,
      },
    ],
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
    plugins: {
      title: {
        display: true,
        // position: "center",
        align: "center",
        // anchor: "start",
        color: "#85929E",
        text: "",
        font: {
          weight: "bold",
          size: 10,
        },
        padding: {
          bottom: 10,
        },
      },
      subtitle: {
        display: true,
        text: "",
        padding: {
          // bottom: 5,
        },
      },
      legend: {
        position: "bottom",
        align: "center",
      },
      datalabels: {
        // Position of the labels
        // (start, end, center, etc.)
        anchor: "end",
        // Alignment of the labels
        // (start, end, center, etc.)
        align: "end",
        // Color of the labels
        color: "#85929E",
        font: {
          weight: "bold",
        },
        formatter: function (value, context) {
          // Display the actual data value
          return value;
        },
      },
    },
  },
};

let myLineChart;
