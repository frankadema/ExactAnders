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
            <h1>Leerlinginfo</h1>
            <p>
              Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />Leerlinginfo<br />
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
