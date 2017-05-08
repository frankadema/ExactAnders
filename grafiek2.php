<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Exact Anders</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Optional theme -->

  <link rel="stylesheet" href="css/bootstrap-theme.min.css" >
  <!--css exact anders-->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/normalize.css">
  <script src="js/moments.js"></script>
  <script src="js/Chart.bundle.js"></script><!--moet na moment.js voor uitlijning-->

</head>
  <body>
    <?php
      include ("include/header.inc");
    ?>

    <!--content-->
      <div class="container">
        <?php
          include ("include/menu.inc");
        ?>
        <div class="row content">
          <div class="col-lg-12 center">
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <h3>Henri Pragt</h3>
          <div class="col-lg-12">

<canvas id="lineChart" width="100%" height="100%"></canvas>

          </div>
        </div>
          <div class="col-lg-6">

            <div class="col-lg-12">

            </div>
            <div class="col-lg-12 ">
              <?php

              $sql = "SELECT beoordeeldocent.cijfer, beoordeeldocent.leerling_id, beoordeeldocent.feedback, beoordeeldocent.docent_id, leerling.firstname, leerling.lastname
                      FROM beoordeeldocent, docent, leerling
                      WHERE beoordeeldocent.docent_id = docent.docent_id
                      AND beoordeeldocent.leerling_id = leerling.leerling_id
                      AND beoordeeldocent.docent_id = 7";

              $result = $conn->query($sql);
              if ($result->num_rows > 0)
              {

              }
              else
              {
              echo "Alle docenten zijn tot nu toe beoordeeld";
              }
              $sql3 = "SELECT beoordeeldocent.cijfer, beoordeeldocent.leerling_id, beoordeeldocent.feedback, beoordeeldocent.docent_id, leerling.firstname, leerling.lastname
                      FROM beoordeeldocent, docent, leerling
                      WHERE beoordeeldocent.docent_id = docent.docent_id
                      AND beoordeeldocent.leerling_id = leerling.leerling_id
                      AND beoordeeldocent.docent_id = 7";

              $result3 = $conn->query($sql3);
              if ($result3->num_rows > 0)
              {

              }
              else
              {
              echo "Alle docenten zijn tot nu toe beoordeeld";
              }


              $sql2 = "SELECT beoordeeldocent.cijfer, beoordeeldocent.leerling_id, beoordeeldocent.feedback, beoordeeldocent.docent_id, leerling.firstname, leerling.lastname
                      FROM beoordeeldocent, docent, leerling
                      WHERE beoordeeldocent.docent_id = docent.docent_id
                      AND beoordeeldocent.leerling_id = leerling.leerling_id
                      AND beoordeeldocent.docent_id = 7";

              $result2 = $conn->query($sql2);
              if ($result2->num_rows > 0)
              {

              }
              else
              {
              echo "Alle docenten zijn tot nu toe beoordeeld";
              }


            while($row3 = $result3->fetch_assoc())
              {
                  echo "<h4>";
                  echo $row3['firstname'];
                  echo " ";
                    echo $row3['lastname'];
                    echo "</h4><br />";
                      echo $row3['feedback'];
                    echo "<hr>";
              }
?>
            </div>

          </div>

        </div>
      </div>
      <!--end content-->
      <?php
        include ("include/footer.inc");
      ?>



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

        labels:
        [
          <?php
          while($row = $result->fetch_assoc())
          {
             echo '"'.$row['firstname'].' '.$row['lastname'].'",';

          }
          ?>
        ],
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
                data:
                [
                  <?php
                  while($row2 = $result2->fetch_assoc())
                  {
                     echo $row2['cijfer'].',';

                  }
                  ?>
                //5.5, 5.6, 5.7, 8.1, 5.4, 2.1, 9.5
                ],
            }/*,
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
            }*/
        ]
    }
        });

        </script>
  </body>
</html>
