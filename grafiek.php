<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

<title></title>
</head>
<body>
  <style>
    h1
    {
      color: #d0661c;
    }
  </style>
  <h1>Wiksunde</h1>
  <div style="width: 501px">
    <canvas id="lineChart" width="100%" height="100%"></canvas>
  </div>
  <script src="js/moments.js"></script>
  <script src="js/Chart.bundle.js"></script><!--moet na moment.js voor uitlijning-->
  <script>


    // Any of the following formats may be used
    const CHART = document.getElementById("lineChart");

    var lineChart = new Chart(CHART, {
        type: 'bar',
        options: {

            scales: {
                yAxes: [{
                    ticks: {

                        min: 0,
                        max: 10

                    }
                }]
            }
        },

        data:{
    labels: ["Grafieken", "Tabellen", "Kwadraten", "Vergelijkingen", "De driehoek van Pascal", "Somregel", "Halveringstijde & verdubbelingstijd"],
    datasets: [
        {
            label: "Beoordeling leerling",
            backgroundColor: [
                '#007e00',
                '#007e00',
                '#007e00',
                '#007e00',
                '#007e00',
                '#007e00',
                '#007e00'
            ],
            borderColor: [
              '#FF0000',
              '#FF0000',
              '#FF0000',
              '#FF0000',
              '#FF0000',
              '#FF0000',
              '#FF0000'
            ],
            borderWidth: 1,
            data: [5.5, 5.6, 5.7, 8.1, 5.4, 2.1, 9.5],
        },
        {
            label: "Beoordeling docent",
            backgroundColor: [
              '#d0661c',
              '#d0661c',
              '#d0661c',
              '#d0661c',
              '#d0661c',
              '#d0661c',
              '#d0661c'
            ],
            borderColor: [
              '#FF0000',
              '#FF0000',
              '#FF0000',
              '#FF0000',
              '#FF0000',
              '#FF0000',
              '#FF0000'
            ],
            borderWidth: 1,
            data: [5.5, 7, 5.7, 4, 5.4, 2.1, 4],
        }
    ]
}
    });

    </script>

</body>
</html>
