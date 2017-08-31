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
  //include header
  include ("include/header.inc");
  ?>

  <!--content-->
  <div class="container">
    <?php
    //indlcue menu
    include ("include/menu.inc");
    //sessie check
    if(empty($_SESSION['leerling']))
    {
      echo "Er iets fout gegaan, ga terug naar het begin scherm!";
    }
    else
    {
      ?>
      <div class="row content">
        <div class="col-lg-12 center">
          <?php
          include ("include/vakkenLeerling.inc");
          ?>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="col-lg-12">
            <h1>Vakken die leerling volgt:</h1>
            <?php
            $leerling_id = $_SESSION['leerling'];
            $sql = "SELECT vak.vak_id, vak.vaknaam
            FROM leerling, vak, vakleerling
            WHERE leerling.leerling_id = vakleerling.leerling_id
            AND vakleerling.vak_id = vak.vak_id
            AND vakleerling.leerling_id = $leerling_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0)
            {

            }
            else
            {
              echo "Probeer opnieuw";
            }
            echo "<table class='table table-hover'>";
            echo "<tr><td><h4>Vaknaam</h4></td><td></td></tr>";

            $vak_id = 0;
            //output gegevens uit database
            while($row = $result->fetch_assoc())
            {
              echo "<form action='vak_overzicht_inzien_leerling.php' method='post'>";
              $vak_id = $row['vak_id'];
              echo "<tr><td>";
              echo $row['vaknaam'];

              echo "  <input type='hidden' name='vak_id' value='$vak_id'>";
              echo "</td><td><input type='submit' name='submit' value='verder' class='btn btn-warning'></td></tr>";
              echo "</form>";

            }

            echo "</table>"


            ?>
            <p>
            </p>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="col-lg-12 ">
            <h1>Belangrijke punten</h1>
            <p>
              Lever altijd de opdrachten online aan<br />
              Voer groepsopdrachten als groep uit en niet individueel<br />
            </p>
          </div>

        </div>

      </div>
      <?php
    }
    ?>
  </div>
  <!--end content-->
  <?php
  //footer end
  include ("include/footer.inc");
  ?>
</body>
</html>
