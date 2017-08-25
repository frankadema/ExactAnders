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

</head>
<body>
  <?php
  include ("include/header.inc");
  ?>

  <!--content-->
  <div class="container">
    <?php
    include ("include/menu.inc");

    if(empty($_SESSION['administrator']))
    {
      echo "Er iets fout gegaan, ga terug naar het begin scherm!";
    }
    else
    {
      ?>
      <div class="row content">
        <div class="col-lg-12 center">
          <div class="col-lg-6">
            <h1>Vak beoordeling</h1>

            <!--<canvas id="lineChart" width="100%" height="100%"></canvas>-->


            <?php

            if(isset($_POST['submit']))
            {
              ?>
              <canvas id="lineChart" width="5%" height="5%"></canvas>

              <?php
              $vak_id =  $_POST['submit'];



              $sqlBeoordelenVak2 = "SELECT beoordeelvak.cijfer
              FROM beoordeelvak
              WHERE beoordeelvak.vak_id = $vak_id
              ";

              $resultBeoordelenVak2 = $conn->query($sqlBeoordelenVak2);
              if ($resultBeoordelenVak2->num_rows > 0)
              {

              }
              else
              {

              }

              $sqlBeoordelenVak = "SELECT beoordeelvak.leerling_id
              FROM beoordeelvak
              WHERE beoordeelvak.vak_id = $vak_id
              ";

              $resultBeoordelenVak = $conn->query($sqlBeoordelenVak);
              if ($resultBeoordelenVak->num_rows > 0)
              {

              }
              else
              {

              }

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
                    while($rowBeoordeelvak = $resultBeoordelenVak->fetch_assoc())
                    {
                      echo '"Leerling id : '.$rowBeoordeelvak['leerling_id'].'",';

                    }
                    ?>
                  ],
                  datasets: [
                    {

                      label: "Beoordeling",
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
                        while($rowBeoordeelvak2 = $resultBeoordelenVak2->fetch_assoc())
                        {
                          echo $rowBeoordeelvak2['cijfer'];
                          echo ",";

                        }
                        ?>
                        //  5.5, 5.6, 5.7, 8.1, 5.4, 2.1, 9.5
                      ],
                    }
                  ]
                }
              });

              </script>
              <?php
              $sqlBeoordelenVak3 = "SELECT beoordeelvak.feedback, beoordeelvak.leerling_id
              FROM beoordeelvak
              WHERE beoordeelvak.vak_id = $vak_id
              ";

              $resultBeoordelenVak3 = $conn->query($sqlBeoordelenVak3);
              if ($resultBeoordelenVak3->num_rows > 0)
              {

              }
              else
              {
                echo "Er zijn nog geen scores opgestuurd";
              }


              echo "<ul style='text-align:left'>";
              while($rowBeoordeelvak3 = $resultBeoordelenVak3->fetch_assoc())
              {
                echo "<li>Leerling: ";
                echo $rowBeoordeelvak3['leerling_id'];
                echo " - ";
                $text = $rowBeoordeelvak3['feedback'];
                $output = wordwrap($text,100, "<br />\n");
                echo $output;
                //echo $rowBeoordeelvak3['feedback'];
                echo "</li><br />";
              }
              echo "</ul>";
              ?>
            </div>
            <div class="col-lg-6">
              <h2>Vakken</h2>
              <?php
            }


            $sql = "SELECT vak.vak_id, vak.vaknaam, vak.vakomschrijving, docent.firstname, docent.lastname
            FROM vak, vakdocent, docent
            WHERE vak.vak_id = vakdocent.vak_id
            AND vakdocent.docent_id = docent.docent_id
            ORDER BY vak.vaknaam ASC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0)
            {

            }
            else
            {
              echo "Probeer opnieuw";
            }

            echo "<table class='table table-hover'>";

            echo "<form action='#' method='post'>";
            $vak_id = 0;
            while($row = $result->fetch_assoc())
            {
              $vak_id = $row['vak_id'];


              echo "<tr><td>";
              echo $row['vaknaam'];
              echo "</td><td>";
              echo $row['firstname']." ". $row['lastname'];
              echo "</td><td>";
              echo "</td><td><input type='submit' name='submit' value='$vak_id'></td></tr>";


            }
            echo "</form>";
            echo "</table>";
            ?>

          </div>
        </div>
      </div>
      <?php
    }
    ?>
  </div>
  <!--end content-->
  <?php
  include ("include/footer.inc");
  ?>
</body>
</html>
