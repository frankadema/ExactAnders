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

  if(isset($_GET["file-name"]))
  {
    echo "image uploaded successfully";
    echo '<img src="vak_documenten/'.$_GET["file-name"].'" />';
  }
  ?>

  <!--content-->
  <div class="container">
    <?php
    include ("include/menu.inc");

    if(empty($_SESSION['leerling']))
    {
      echo "Er iets fout gegaan, ga terug naar het begin scherm!";
    }
    else
    {



      $leerling_id = $_SESSION['leerling'];

      $_SESSION['vak_id'] = $_POST['submit'];
      $vak_id = $_SESSION['vak_id'];

      if(isset($_POST['submit9']))
      {

        $vak_id = $_POST['vak_id'];

        $nested = explode("_-_", $_POST['groep_id+vakhuiswerk_id']);
        $groep_id = $nested[0];
        $vakhuiswerk_id = $nested[1];

        $inlevermoment = $_POST['inlevermoment'];
        $beoordeling = $_POST['beoordeling'];
        //$leerling_id = $_SESSION['leerling'];

        if($_FILES["uploadedfile"]["name"] != '')//check if empty
        {
          $allowed_ext = array("pdf");//types
          $ext = end(explode(".", $_FILES["uploadedfile"]["name"]));//get uploaded file

          if(in_array($ext, $allowed_ext))//check if valid extension
          {
            if($_FILES["uploadedfile"]["size"] <50000000)//check image size 50000 beteken 500 kb
            {
              $name = $groep_id.'_'. $inlevermoment. '.' . $ext;   //rename
              $path = "groep_documenten/" . $name;    //image upload path
              move_uploaded_file($_FILES["uploadedfile"]["tmp_name"], $path);
              echo "file is online";

              //  echo $name;
            }
            else
            {
              echo '<script>alert("niet het juiste bestandsformaat groote")</script>';
            }
          }
          else
          {
            echo '<script>alert("niet het juiste bestandsformaat")</script>';
          }

        }
        else
        {
          echo '<script>alert("selecteer file")</script>';
        }

        $sql4 = "INSERT INTO tech_ExactAnders.vakhuiswerkleerling  (vakhuiswerk_id, groep_id, vak_id, inlevermoment, cijferleerling, urlleerling)
        VALUES ('$vakhuiswerk_id', '$groep_id', '$vak_id', '$inlevermoment', '$beoordeling', '$name')";
        if ($conn->query($sql4) === TRUE)
        {
          echo "New record created successfully";
        }
        else
        {
          echo "Error: " . $sql2 . "<br>" . $conn->error;
        }

      }

      if(isset($_POST['submit2']))
      {

        $vak_id = $_POST['vak_id'];
        $vakhuiswerk_id = $_POST['vakhuiswerk_id'];
        $inlevermoment = $_POST['inlevermoment'];
        $beoordeling = $_POST['beoordeling'];
        $leerling_id = $_SESSION['leerling'];

        if($_FILES["uploadedfile"]["name"] != '')//check if empty
        {
          $allowed_ext = array("pdf");//types
          $ext = end(explode(".", $_FILES["uploadedfile"]["name"]));//get uploaded file

          if(in_array($ext, $allowed_ext))//check if valid extension
          {
            if($_FILES["uploadedfile"]["size"] <50000000)//check image size 50000 beteken 500 kb
            {
              $name = $vakhuiswerk_id.'_'.$leerling_id.'_'. $inlevermoment. '.' . $ext;   //rename
              $path = "leerling_documenten/" . $name;    //image upload path
              move_uploaded_file($_FILES["uploadedfile"]["tmp_name"], $path);
              echo "file is online";

              //  echo $name;
            }
            else
            {
              echo '<script>alert("niet het juiste bestandsformaat groote")</script>';
            }
          }
          else
          {
            echo '<script>alert("niet het juiste bestandsformaat")</script>';
          }

        }
        else
        {
          echo '<script>alert("selecteer file")</script>';
        }

        $sql4 = "INSERT INTO tech_ExactAnders.vakhuiswerkleerling  (vakhuiswerk_id, leerling_id, vak_id, inlevermoment, cijferleerling, urlleerling)
        VALUES ('$vakhuiswerk_id', '$leerling_id', '$vak_id', '$inlevermoment', '$beoordeling', '$name')";
        if ($conn->query($sql4) === TRUE)
        {
          echo "New record created successfully";
        }
        else
        {
          echo "Error: " . $sql2 . "<br>" . $conn->error;
        }

      }



      $sql = "SELECT vak.vak_id, vak.vaknaam, vak.vakomschrijving
      FROM leerling, vak, vakleerling
      WHERE leerling.leerling_id = vakleerling.leerling_id
      AND vakleerling.vak_id = vak.vak_id
      AND vakleerling.leerling_id = $leerling_id
      AND vakleerling.vak_id = $vak_id";

      $result = $conn->query($sql);

      if ($result->num_rows > 0)
      {

      }
      else
      {
        echo "Probeer opnieuw";
      }
      $row = $result->fetch_assoc();


      ?>
      <div class="row">
        <div class="col-lg-12">
          <div class="col-lg-12">

            <h1><?php echo $row['vaknaam'];?></h1>

            <p>

              <?php echo $row['vakomschrijving'];?><br />


            </p>

          </div>

        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">

          <div class="col-lg-6">

            <h1>Voortgang vak</h1>
            <canvas id="lineChart" width="5%" height="5%"></canvas>

            <?php


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









            $sqlOpdrachtnaam3 = "SELECT vakhuiswerkleerling.cijferdocent
            FROM vakhuiswerkleerling, vakhuiswerk
            WHERE vakhuiswerk.vakhuiswerk_id = vakhuiswerkleerling.vakhuiswerk_id
            AND vakhuiswerkleerling.inlevermoment = 2
            AND vakhuiswerk.vak_id = $vak_id
            AND vakhuiswerkleerling.leerling_id = $leerling_id
            ";

            $resultOpdrachtnaam3 = $conn->query($sqlOpdrachtnaam3);
            if ($resultOpdrachtnaam3->num_rows > 0)
            {

            }
            else
            {
              echo "Alle docenten zijn tot nu toe beoordeeld";
            }

            $sqlOpdrachtnaam2 = "SELECT vakhuiswerkleerling.cijferleerling, vakhuiswerkleerling.cijferdocent
            FROM vakhuiswerkleerling, vakhuiswerk
            WHERE vakhuiswerk.vakhuiswerk_id = vakhuiswerkleerling.vakhuiswerk_id
            AND vakhuiswerkleerling.inlevermoment = 2
            AND vakhuiswerk.vak_id = $vak_id
            AND vakhuiswerkleerling.leerling_id = $leerling_id
            ";

            $resultOpdrachtnaam2 = $conn->query($sqlOpdrachtnaam2);
            if ($resultOpdrachtnaam2->num_rows > 0)
            {

            }
            else
            {
              echo "Alle docenten zijn tot nu toe beoordeeld";
            }

            $sqlOpdrachtnaam = "SELECT vakhuiswerk.Opdrachtnaam
            FROM vakhuiswerkleerling, vakhuiswerk
            WHERE vakhuiswerk.vakhuiswerk_id = vakhuiswerkleerling.vakhuiswerk_id
            AND vakhuiswerkleerling.inlevermoment = 2
            AND vakhuiswerk.vak_id = $vak_id
            AND vakhuiswerkleerling.leerling_id = $leerling_id
            ";

            $resultOpdrachtnaam = $conn->query($sqlOpdrachtnaam);
            if ($resultOpdrachtnaam->num_rows > 0)
            {

            }
            else
            {
              echo "Alle docenten zijn tot nu toe beoordeeld";
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
          <div class="col-lg-6">
            <?php
            $sql3 = "SELECT vakhuiswerk.vakhuiswerk_id, vakhuiswerk.Opdrachtnaam, vakhuiswerk.omschrijving, vakhuiswerk.duedate, vakhuiswerk.url
            FROM vakhuiswerk
            WHERE vakhuiswerk.vak_id = $vak_id";

            $result3 = $conn->query($sql3);

            if ($result3->num_rows > 0)
            {

            }
            else
            {
              echo "Probeer opnieuw";
            }

            ?>


            <h1>Uitgegeven opdrachten</h1>
            <table class='table table-hover'>

              <tr><td><h4>Opdrachtnaam</h4></td><td><h4>Inleverdatum</h4></td><td><h4>Open</h4></td></tr>
              <?php
              while($row3 = $result3->fetch_assoc())
              {
                ?>
                <tr>
                  <td>
                    <?php
                    echo $row3['Opdrachtnaam'];
                    ?>
                  </td>
                  <td>
                    <?php
                    echo $row3['duedate'];
                    ?>
                  </td>
                  <td>
                    <a href="vak_documenten/<?php echo $row3['url'];?>" target="_blank" class="btn btn-warning">
                      <?php

                      echo $row3['url'];
                      ?>
                    </a>

                  </td>
                </tr>
                <?php

              }
              ?>
            </table>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="col-lg-6">

            <h1>Huiswerk uploaden</h1>
            <?php

            $sql2 = "SELECT vakhuiswerk.vakhuiswerk_id, vakhuiswerk.Opdrachtnaam, vakhuiswerk.omschrijving, vakhuiswerk.duedate, vakhuiswerk.url
            FROM vakhuiswerk
            WHERE vakhuiswerk.vak_id = $vak_id";

            $result2 = $conn->query($sql2);

            if ($result2->num_rows > 0)
            {

            }
            else
            {
              echo "Probeer opnieuw!";
            }

            ?>


            <form enctype="multipart/form-data" <?php echo $_SERVER['PHP_SELF']; ?> method="POST">

              <table class='table table-hover'>
                <tr>
                  <td>Selecteer opdracht</td>
                  <td>:</td>
                  <td>
                    <select name="vakhuiswerk_id">
                      <?php
                      while($row2 = $result2->fetch_assoc())
                      {
                        echo "<option value='".$row2['vakhuiswerk_id']."'>".$row2['Opdrachtnaam']."</option>";

                      }
                      ?>
                    </select>
                    <!--<input type='text' name='opdrachtnaam'>-->

                  </td>
                </tr>
                <tr>
                  <td>Selecteer inlevermoment</td>
                  <td>:</td>
                  <td>
                    <select name="inlevermoment">
                      <option value="1">1e inlevermoment</option>
                      <option value="2">Definitief inleveren</option>
                    </select>
                    <!--<input type='text' name='opdrachtnaam'>-->

                  </td>
                </tr>
                <tr>
                  <td>Eigen cijfer beoordeling</td>
                  <td>:</td>
                  <td><input type='text' name='beoordeling' value="5.5">
                  </td>
                </tr>
                <tr>
                  <td>Bestand</td>
                  <td>:</td>
                  <td>
                    <input name="uploadedfile" type="file"/><br />
                    <input type="hidden" name="vak_id" value="<?php echo $vak_id?>">

                    <input type="submit" name="submit2" value="Upload Opdracht" /></td>
                  </tr>
                </table>
              </form>
            </div>
            <div class="col-lg-6">
              <h1>Overzicht documenten</h1>

              <?php

              $sql5 = "SELECT vakhuiswerk.Opdrachtnaam, vakhuiswerkleerling.urlleerling, vakhuiswerkleerling.feedback, vakhuiswerkleerling.urldocent, vakhuiswerkleerling.cijferleerling, vakhuiswerkleerling.cijferdocent
              FROM vakhuiswerkleerling, vakhuiswerk
              WHERE vakhuiswerkleerling.vakhuiswerk_id = vakhuiswerk.vakhuiswerk_id
              /*AND vakhuiswerkleerling.urldocent <> ''*/
              AND vakhuiswerkleerling.leerling_id = $leerling_id";
              $result5 = $conn->query($sql5);

              if ($result5->num_rows > 0)
              {

              }
              else
              {
                echo "Probeer opnieuw2";
              }
              ?>

              <table class='table table-hover'>
                <tr>
                  <td><h4>Opdrachtnaam</h4></td>
                  <td><h4>feedback inzien</h4></td>
                  <td><h4>Feedback</h4></td>
                  <td><h4>Leerling</h4></td>
                  <td><h4>Docent</h4></td>
                </tr>
                <?php
                while($row5 = $result5->fetch_assoc())
                {
                  //echo "<tr><td>".$row5['Opdrachtnaam']."</td><td><a href='leerling_documenten/".$row5['urlleerling']."'target="_blank"/>".$row5['urlleerling']."</a></td><td>".$row5['feedback']."</td><td>".$row5['cijferleerling']."</td><td>".$row5['cijferdocent']."</td></tr>";
                  echo "<tr>
                  <td>".$row5['Opdrachtnaam']."</td>
                  ";
                  if(empty($row5['urldocent']))
                  {
                    echo "<td>Geen document</td>";
                  }
                  else
                  {
                    echo"
                    <td><a href='leerling_documenten/".$row5['urldocent']."' target='_blank' class='btn btn-warning' >".$row5['urldocent']."</a></td>
                    ";
                  }
                  echo "
                  <td>".$row5['feedback']."</td>
                  <td>".$row5['cijferleerling']."</td>
                  <td>".$row5['cijferdocent']."</td>
                  </tr>";
                }
                ?>
              </table>


            </div>


          </div>
        </div>


        <div class="row">
          <div class="col-lg-12">
            <div class="col-lg-6">

              <h1>Groepsopdracht uploaden</h1>
              <?php
$leerling_id = $_SESSION['leerling'];
              /*$sql90 = "SELECT vakhuiswerk.vakhuiswerk_id, vakhuiswerk.Opdrachtnaam, vakhuiswerk.omschrijving, vakhuiswerk.duedate, vakhuiswerk.url
              FROM vakhuiswerk
              WHERE vakhuiswerk.vak_id = $vak_id";*/

              $sql90 = "SELECT vakhuiswerk.vakhuiswerk_id, vakhuiswerk.Opdrachtnaam, groepinfo.groepnaam, groepinfo.groep_id
              FROM groepinfo, vakhuiswerk
              WHERE vakhuiswerk.vakhuiswerk_id = groepinfo.vakhuiswerk_id
              AND groepinfo.leerling_leider = $leerling_id
              AND vakhuiswerk.vak_id = $vak_id";

              $result90 = $conn->query($sql90);

              if ($result90->num_rows > 0)
              {

              }
              else
              {
                echo "Probeer opnieuw!";
              }

              ?>


              <form enctype="multipart/form-data" <?php echo $_SERVER['PHP_SELF']; ?> method="POST">

                <table class='table table-hover'>
                  <tr>
                    <td>Selecteer opdracht</td>
                    <td>:</td>
                    <td>
                      <select name="groep_id+vakhuiswerk_id">
                        <?php
                        while($row90 = $result90->fetch_assoc())
                        {
                          echo "<option value='".$row90['groep_id']."_-_".$row90['vakhuiswerk_id']."'>".$row90['groepnaam']." - ".$row90['Opdrachtnaam']."</option>";

                        }
                        ?>
                      </select>
                      <!--<input type='text' name='opdrachtnaam'>-->

                    </td>
                  </tr>
                  <tr>
                    <td>Selecteer inlevermoment</td>
                    <td>:</td>
                    <td>
                      <select name="inlevermoment">
                        <option value="1">1e inlevermoment</option>
                        <option value="2">Definitief inleveren</option>
                      </select>
                      <!--<input type='text' name='opdrachtnaam'>-->

                    </td>
                  </tr>
                  <tr>
                    <td>Eigen groepscijfer beoordeling</td>
                    <td>:</td>
                    <td><input type='text' name='beoordeling' value="5.5">
                    </td>
                  </tr>
                  <tr>
                    <td>Bestand</td>
                    <td>:</td>
                    <td>
                      <input name="uploadedfile" type="file"/><br />
                      <input type="hidden" name="vak_id" value="<?php echo $vak_id?>">

                      <input type="submit" name="submit9" value="Upload Opdracht" /></td>
                    </tr>
                  </table>
                </form>
              </div>
              <div class="col-lg-6">
                <h1>Overzicht groepsdocumenten</h1>

                <?php

//NOG AANPASSEN TOT JUISTE FORMAT
                $sql80 = "
                SELECT groepinfo.groepnaam, vakhuiswerk.Opdrachtnaam, vakhuiswerkleerling.urlleerling, vakhuiswerkleerling.feedback, vakhuiswerkleerling.urldocent, vakhuiswerkleerling.cijferleerling, vakhuiswerkleerling.cijferdocent, vakhuiswerkleerling.inlevermoment, vakhuiswerkleerling.groep_id
                FROM vakhuiswerkleerling, vakhuiswerk, groepinfo, groep
                WHERE vakhuiswerkleerling.vakhuiswerk_id = vakhuiswerk.vakhuiswerk_id
                AND vakhuiswerkleerling.groep_id = groepinfo.groep_id
                AND groepinfo.groep_id = groep.groep_id
                AND groep.leerling_id = $leerling_id
                AND vakhuiswerkleerling.leerling_id = 0
";
                $result80 = $conn->query($sql80);

                if ($result80->num_rows > 0)
                {

                }
                else
                {
                  echo "Probeer opnieuw2";
                }
                ?>

                <table class='table table-hover'>
                  <tr>
                    <td><h4>Opdrachtnaam</h4></td>
                    <td><h4>feedback inzien</h4></td>
                    <td><h4>Feedback</h4></td>
                    <td><h4>Groep</h4></td>
                    <td><h4>Docent</h4></td>
                  </tr>
                  <?php
                  while($row80 = $result80->fetch_assoc())
                  {
                    //echo "<tr><td>".$row5['Opdrachtnaam']."</td><td><a href='leerling_documenten/".$row5['urlleerling']."'target="_blank"/>".$row5['urlleerling']."</a></td><td>".$row5['feedback']."</td><td>".$row5['cijferleerling']."</td><td>".$row5['cijferdocent']."</td></tr>";
                    echo "<tr>
                    <td>".$row80['groepnaam']." - ".$row80['Opdrachtnaam']."</td>
                    ";
                    if(empty($row80['urldocent']))
                    {
                      echo "<td>Geen document</td>";
                    }
                    else
                    {
                      echo"
                      <td><a href='groep_documenten/".$row80['urldocent']."' target='_blank' class='btn btn-warning' >".$row80['urldocent']."</a></td>
                      ";
                    }
                    echo "
                    <td>".$row80['feedback']."</td>
                    <td>".$row80['cijferleerling']."</td>
                    <td>".$row80['cijferdocent']."</td>
                    </tr>";
                  }
                  ?>
                </table>


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
