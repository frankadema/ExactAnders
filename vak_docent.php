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
  //header
  include ("include/header.inc");
  ?>

  <!--content-->
  <div class="container">
    <?php
    //menu
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
          <?php
          //include tegelstructuur van specifieke docent uit database
          include ("include/vakkenDocent.inc");
          ?>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="col-lg-12">
            <h1>Vakken</h1>
            <p>
              In dit overzicht kan men algemene informatie over vakken inzien.<br />
              De vakken waar u op aangemeld bent zijn hieronder in tabelvorm weergegeven.<br /><br />

              Voor het toevoegen of verwijderen van vakken dient men contact op te nemen met de beheerder <i>beheerder@hondsrugcollege.nl</i>
            </p>


            <?php
            $docent_id = $_SESSION['docent'];

            $sql = "SELECT vak.vak_id, vak.vaknaam, vak.vakomschrijving
            FROM vak, vakdocent, docent
            WHERE docent.docent_id = vakdocent.docent_id
            AND vakdocent.vak_id = vak.vak_id
            AND docent.docent_id =  $docent_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0)
            {

            }
            else
            {
              echo "Probeer opnieuw";
            }

            echo "<table class='table table-hover'>";
            echo "<tr><td><h4>Vaknaam</h4></td><td><h4>Omschrijving</h4></td><td><h4>Vaknummer</h4></td></tr>";

            $vak_id = 0;
            while($row = $result->fetch_assoc())
            {
              $vak_id = $row['vak_id'];

              echo "<form action='vak_overzicht_aanpassen.php' method='post'>";
              echo "<tr><td>";
              echo $row['vaknaam'];
              echo "</td><td>";
              echo $row['vakomschrijving'];
              echo "  <input type='hidden' name='vak_id' value='$vak_id'>";
              echo "</td><td><input type='submit' name='submit' value='verder' class='btn btn-warning'></td></tr>";
              echo "<form>";
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
