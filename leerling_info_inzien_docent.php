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

    if(empty($_SESSION['docent']))
    {
      echo "Er iets fout gegaan, ga terug naar het begin scherm!";
    }
    else
    {
      ?>
      <div class="row content">
        <div class="col-lg-12 center">
          <div class="col-lg-6">
            <h1>Leerling overzicht</h1>

            <!--<canvas id="lineChart" width="100%" height="100%"></canvas>-->


            <?php

            if(isset($_POST['submit2']))
            {
              ?>
              <canvas id="lineChart" width="5%" height="5%"></canvas>

              <?php
              //$vak_id =  $_POST['vak_id'];
              $vak_id = $_POST['vak_id'];
              $docent_id = $_SESSION['docent'];
              $leerling_id =  $_POST['leerling_id'];



              ?>
              <canvas id="lineChart" width="5%" height="5%"></canvas>

              <?php


              $sql3 = "SELECT vakhuiswerk.Opdrachtnaam, vakhuiswerkleerling.cijferleerling, vakhuiswerkleerling.cijferdocent, vakhuiswerkleerling.feedback, vakhuiswerkleerling.urldocent, vakhuiswerkleerling.leerling_id, vakhuiswerkleerling.groep_id
              FROM vakhuiswerk, vakhuiswerkleerling
              WHERE vakhuiswerk.vakhuiswerk_id = vakhuiswerkleerling.vakhuiswerk_id
              AND vakhuiswerkleerling.inlevermoment = 2
              AND vakhuiswerkleerling.vak_id = $vak_id
              AND vakhuiswerkleerling.leerling_id = $leerling_id


              UNION

              SELECT vakhuiswerk.Opdrachtnaam, vakhuiswerkleerling.cijferleerling, vakhuiswerkleerling.cijferdocent, vakhuiswerkleerling.feedback, vakhuiswerkleerling.urldocent, vakhuiswerkleerling.leerling_id, vakhuiswerkleerling.groep_id
              FROM vakhuiswerk, vakhuiswerkleerling, groepinfo, groep
              WHERE vakhuiswerk.vakhuiswerk_id = vakhuiswerkleerling.vakhuiswerk_id
              AND groepinfo.groep_id = groep.groep_id
              AND vakhuiswerkleerling.vak_id = $vak_id
              AND groep.groep_id = vakhuiswerkleerling.groep_id
              AND vakhuiswerkleerling.inlevermoment = 2
              AND groep.leerling_id = $leerling_id
              ";

              $result3 = $conn->query($sql3);
              if ($result3->num_rows > 0)
              {

                while($rowBeoordeelvak3 = $result3->fetch_assoc())
                {
                  echo "<ul style='text-align:left'>";
                  echo "<li>Opdrachtnaam: ";
                  echo $rowBeoordeelvak3['Opdrachtnaam'];
                  echo " </li><li> ";
                  $link = $rowBeoordeelvak3['urldocent'];
                  if($rowBeoordeelvak3['leerling_id'] == 0)
                  {
                    echo "<a href='groep_documenten/$link' target='_blank' class='btn btn-warning'>Open document</a>";
                  }
                  else
                  {
                    echo "<a href='leerling_documenten/$link' target='_blank' class='btn btn-warning'>Open document</a>";
                  }


                  echo " </li><li> ";
                  $text = $rowBeoordeelvak3['feedback'];
                  $output = wordwrap($text, 100, "<br />\n");
                  echo $output;
                  //echo $rowBeoordeelvak3['feedback'];
                  echo "</li>";
                  echo "</ul>";
                }

              }
              else
              {
                echo "-";
              }









              $sqlOpdrachtnaam3 = "SELECT vakhuiswerkleerling.cijferdocent
              FROM vakhuiswerkleerling, vak
              WHERE vakhuiswerkleerling.leerling_id = $leerling_id
              AND vak.vak_id = $vak_id
              AND vakhuiswerkleerling.inlevermoment = 2

              UNION ALL

              SELECT vakhuiswerkleerling.cijferdocent
              FROM vakhuiswerkleerling, groep, groepinfo, vakhuiswerk
              WHERE vakhuiswerk.vakhuiswerk_id = vakhuiswerkleerling.vakhuiswerk_id
              AND vakhuiswerkleerling.inlevermoment = 2
              AND vakhuiswerk.vak_id = $vak_id
              AND vakhuiswerkleerling.groep_id = groep.groep_id
              AND groep.groep_id = groepinfo.groep_id
              AND groepinfo.vakhuiswerk_id = vakhuiswerkleerling.vakhuiswerk_id
              AND groep.leerling_id = $leerling_id
              ";

              $resultOpdrachtnaam3 = $conn->query($sqlOpdrachtnaam3);
              if ($resultOpdrachtnaam3->num_rows > 0)
              {

              }
              else
              {
                echo "-";
              }

              $sqlOpdrachtnaam2 = "SELECT vakhuiswerkleerling.cijferleerling
              FROM vakhuiswerkleerling, vak
              WHERE vakhuiswerkleerling.leerling_id = $leerling_id
              AND vak.vak_id = $vak_id
              AND vakhuiswerkleerling.inlevermoment = 2

              UNION ALL

              SELECT vakhuiswerkleerling.cijferleerling
              FROM vakhuiswerkleerling, groep, groepinfo, vakhuiswerk
              WHERE vakhuiswerk.vakhuiswerk_id = vakhuiswerkleerling.vakhuiswerk_id
              AND vakhuiswerkleerling.inlevermoment = 2
              AND vakhuiswerk.vak_id = $vak_id
              AND vakhuiswerkleerling.groep_id = groep.groep_id
              AND groep.groep_id = groepinfo.groep_id
              AND groepinfo.vakhuiswerk_id = vakhuiswerkleerling.vakhuiswerk_id
              AND groep.leerling_id = $leerling_id
              ";

              $resultOpdrachtnaam2 = $conn->query($sqlOpdrachtnaam2);
              if ($resultOpdrachtnaam2->num_rows > 0)
              {

              }
              else
              {
                echo "-";
              }

              $sqlOpdrachtnaam = "SELECT vakhuiswerk.Opdrachtnaam
              FROM vakhuiswerkleerling, vakhuiswerk
              WHERE vakhuiswerk.vakhuiswerk_id = vakhuiswerkleerling.vakhuiswerk_id
              AND vakhuiswerkleerling.inlevermoment = 2
              AND vakhuiswerk.vak_id = $vak_id
              AND vakhuiswerkleerling.leerling_id = $leerling_id

              UNION ALL

              SELECT vakhuiswerk.Opdrachtnaam
              FROM vakhuiswerkleerling, groep, groepinfo, vakhuiswerk
              WHERE vakhuiswerk.vakhuiswerk_id = vakhuiswerkleerling.vakhuiswerk_id
              AND vakhuiswerkleerling.inlevermoment = 2
              AND vakhuiswerk.vak_id = $vak_id
              AND vakhuiswerkleerling.groep_id = groep.groep_id
              AND groep.groep_id = groepinfo.groep_id
              AND groepinfo.vakhuiswerk_id = vakhuiswerkleerling.vakhuiswerk_id
              AND groep.leerling_id = $leerling_id
              ";

              $resultOpdrachtnaam = $conn->query($sqlOpdrachtnaam);
              if ($resultOpdrachtnaam->num_rows > 0)
              {

              }
              else
              {
                echo "-";
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
                    while($rowOpdrachtnaam = $resultOpdrachtnaam->fetch_assoc())
                    {
                      echo '"'.$rowOpdrachtnaam['Opdrachtnaam'].'",';

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
                        while($rowOpdrachtnaam2 = $resultOpdrachtnaam2->fetch_assoc())
                        {
                          echo $rowOpdrachtnaam2['cijferleerling'];
                          echo ",";

                        }
                        ?>
                        //  5.5, 5.6, 5.7, 8.1, 5.4, 2.1, 9.5
                      ],
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
                      data:
                      [
                        <?php
                        while($rowOpdrachtnaam3 = $resultOpdrachtnaam3->fetch_assoc())
                        {
                          echo $rowOpdrachtnaam3['cijferdocent'];
                          echo ",";

                        }
                        ?>
                        //5.5, 7, 5.7, 4, 5.4, 2.1, 4
                      ],
                    }
                  ]
                }
              });

              </script>
            </div>
            <?php
          }
          ?>

          <?php


          if(isset($_POST['submit']))
          {
            // leerlingnummer
            $leerling_id = $_POST['leerling_id'];
            //docent
            $docent_id = $_SESSION['docent'];



            //keuze voor vakken die docent en leerling gelijk hebben
            $sql9 = "SELECT vak.vaknaam, vak.vak_id, leerling.firstname, leerling.lastname
            FROM leerling, vakleerling, vak
            WHERE leerling.leerling_id = vakleerling.leerling_id
            AND vakleerling.vak_id = vak.vak_id
            AND leerling.leerling_id = $leerling_id";

            $result9 = $conn->query($sql9);

            if ($result9->num_rows > 0)
            {

              echo "<table class='table table-hover'>";

              //$vak_id = 0;
              while($row9 = $result9->fetch_assoc())
              {
                //$leerling_id9 = $row9['leerling_id'];

                echo "<form action='#' method='post'>";

                echo "<tr>";
                $vak_id =  $row9['vak_id'];
                echo "<td>";
                echo $row9['firstname']." ".$row9['lastname']." - ".$row9['vaknaam'];
                echo "</td><td>";
                echo "<input type='hidden' name='leerling_id' value=$leerling_id>";
                echo "<input type='hidden' name='vak_id' value=$vak_id>";
                echo "</td><td><input type='submit' name='submit2' value='verder' class='btn btn-warning'></td></tr>";
                echo "</form>";

              }

              echo "</table>";
            }
            else
            {
              echo "Probeer opnieuw1";
            }

          }













          $sql = "SELECT leerling.leerling_id, leerling.firstname, leerling.lastname, vak.vaknaam, vak.vak_id
          FROM vakleerling, leerling, vak, docent, vakdocent
          WHERE leerling.leerling_id =vakleerling.leerling_id
          AND vakleerling.vak_id = vak.vak_id
          AND vak.vak_id = vakdocent.vak_id
          AND vakdocent.docent_id = 10
          GROUP BY leerling.firstname, leerling.lastname
          ORDER BY leerling.firstname, leerling.lastname ASC

          ";
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
            $leerling_id = $row['leerling_id'];
            //$vak_id = $row['vak_id'];
            echo "<form action='#' method='post'>";

            echo "<tr>";
            //echo $row['vaknaam'];
            echo "<td>";
            echo $row['firstname']." ". $row['lastname'];
            echo "</td><td>";
            echo "  <input type='hidden' name='leerling_id' value='$leerling_id'>";
            //echo "  <input type='hidden' name='vak_id' value='$vak_id'>";

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
include ("include/footer.inc");
?>
</body>
</html>
