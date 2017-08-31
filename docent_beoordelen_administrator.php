<!DOCTYPE html>
<?php
//  Frank Adema
//  Student Stenden Emmen
//  frank.adema@student.stenden.com
//  leerlingnummer: 277665
//  Jaar: 2017
//  Afstudeeropdracht Exact Anders

?>
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
            <h1>Docent beoordeling</h1>
            <?php

            if(isset($_POST['submit']))
            {
              //grafiek opzeten
              ?>
              <canvas id="lineChart" width="5%" height="5%"></canvas>

              <?php
              $docent_id =  $_POST['docent_id'];

              $sqlBeoordelenDocent2 = "SELECT beoordeeldocent.cijfer
              FROM beoordeeldocent
              WHERE beoordeeldocent.docent_id = $docent_id
              ";

              $resultBeoordelenDocent2 = $conn->query($sqlBeoordelenDocent2);
              if ($resultBeoordelenDocent2->num_rows > 0)
              {

              }
              else
              {

              }

              $sqlBeoordelenDocent = "SELECT beoordeeldocent.leerling_id
              FROM beoordeeldocent
              WHERE beoordeeldocent.docent_id = $docent_id
              ";

              $resultBeoordelenDocent = $conn->query($sqlBeoordelenDocent);
              if ($resultBeoordelenDocent->num_rows > 0)
              {

              }
              else
              {

              }

              $sqlCount = "SELECT COUNT(beoordeeldocent.leerling_id) AS count
              FROM beoordeeldocent
              WHERE beoordeeldocent.docent_id = $docent_id
              ";

              $resultCount = $conn->query($sqlCount);
              if ($resultCount->num_rows > 0)
              {

              }
              else
              {

              }
              while($rowCount = $resultCount->fetch_assoc())
              {
                $rowCounter = $rowCount['count'];

              }

              ?>
              <script>

              // opbouw brafiek
              const CHART = document.getElementById("lineChart");

              var lineChart = new Chart(CHART,
                {
                  type: 'bar',
                  options: {

                    scales:
                    {
                      yAxes: [
                        {
                          ticks:
                          {
                            min: 0,
                            max: 10
                          }
                        }]
                      }
                    },
                    data:
                    {
                      labels:
                      [
                        <?php
                        while($rowBeoordeeldocent = $resultBeoordelenDocent->fetch_assoc())
                        {
                          echo '"Leerling id : '.$rowBeoordeeldocent['leerling_id'].'",';
                        }
                        ?>
                      ],
                      datasets: [
                        {
                          label: "Beoordeling",
                          backgroundColor:
                          [
                            <?php
                            for($teller = 1; $teller <= $rowCounter; $teller++)
                            {
                              ?>
                              '#007e00',
                              <?php
                            }
                            ?>
                          ],
                          borderColor:
                          [
                            <?php
                            for($teller = 1; $teller <= $rowCounter; $teller++)
                            {
                              ?>
                              '#FF0000',
                              <?php
                            }
                            ?>
                          ],
                          borderWidth: 1,
                          data:
                          [
                            <?php
                            while($rowBeoordeeldocent2 = $resultBeoordelenDocent2->fetch_assoc())
                            {
                              echo $rowBeoordeeldocent2['cijfer'];
                              echo ",";

                            }
                            ?>
                          ],
                        }
                      ]
                    }
                  });

                  </script>
                  <?php

                  $sqlBeoordelenDocent3 = "SELECT beoordeeldocent.feedback, beoordeeldocent.leerling_id
                  FROM beoordeeldocent
                  WHERE beoordeeldocent.docent_id = $docent_id
                  ";

                  $resultBeoordelenDocent3 = $conn->query($sqlBeoordelenDocent3);
                  if ($resultBeoordelenDocent3->num_rows > 0)
                  {
                    //als er scores zijn ga door
                  }
                  else
                  {
                    echo "Er zijn nog geen scores opgestuurd";
                  }


                  echo "<ul style='text-align:left'>";
                  //beoordelingen anoniem weergeven.
                  while($rowBeoordeelvak3 = $resultBeoordelenDocent3->fetch_assoc())
                  {
                    echo "<li>Leerling: ";
                    echo $rowBeoordeelvak3['leerling_id'];
                    echo " - ";
                    $text = $rowBeoordeelvak3['feedback'];
                    $output = wordwrap($text, 100, "<br />\n");
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


                $sql = "SELECT docent.firstname, docent.lastname, docent.docent_id FROM docent ORDER BY docent.firstname, docent.lastname ASC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0)
                {

                }
                else
                {
                  echo "Probeer opnieuw";
                }

                echo "<table class='table table-hover'>";

                $vak_id = 0;
                while($row = $result->fetch_assoc())
                {
                  //variable
                  $vak_id = $row['vak_id'];
                  $docent_id = $row['docent_id'];
                  //form
                  echo "<form action='#' method='post'>";
                  echo "<tr><td>";
                  echo "</td><td>";
                  echo $row['firstname']." ". $row['lastname'];
                  echo "</td><td>";
                  echo " <input type='hidden' name='docent_id' value='$docent_id'>";
                  echo "</td><td><input type='submit' name='submit' value='verder' class='btn btn-warning'></td></tr>";
                  echo "</form>";
                }

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
      //footer
      include ("include/footer.inc");
      ?>
    </body>
    </html>
