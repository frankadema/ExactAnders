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

        if(empty($_SESSION['leerling']))
        {
          echo "Er iets fout gegaan, ga terug naar het begin scherm!";
        }
        else
        {
        ?>
        <div class="row content">
          <div class="col-lg-12 center">
            <img src="images/green.png"/><img src="images/orange.png"/><img src="images/blue.png"/><img src="images/green.png"/><br /><img src="images/orange.png"/>
            <img src="images/blue.png"/><img src="images/green.png"/><img src="images/orange.png"/><img src="images/blue.png"/><img src="images/green.png"/>
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
            echo "<tr><td><h4>Vaknaam</h4></td><td><h4>Vaknummer</h4></td></tr>";
            echo "<form action='vak_overzicht_inzien_leerling.php' method='post'>";
            $vak_id = 0;
                        while($row = $result->fetch_assoc())
                        {
                          $vak_id = $row['vak_id'];

                        //  echo "<input type='hidden' name='vak_id' value='$vak_id'>";
                          echo "<tr><td>";
                          echo $row['vaknaam'];
                          echo "</td><td><input type='submit' name='submit' value='$vak_id'></td></tr>";


                        }
                                      echo "<form>";
            echo "</table>"


            ?>
            <p>
            </p>
          </div>
        </div>
          <div class="col-lg-6">

            <div class="col-lg-12">
              <h1>Grafiek</h1>
              <img src="images/grafiek.png"/>
            </div>
            <div class="col-lg-12 ">
              <h1>belangrijke punten</h1>
              <p>
                belangrijke punten<br />belangrijke punten<br />belangrijke punten<br />belangrijke punten<br />belangrijke punten<br />



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
        include ("include/footer.inc");
      ?>
  </body>
</html>
