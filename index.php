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
    include ("include/menu.inc");
    ?>
    <div class="row content">
      <div class="col-lg-12 center">
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <h1>Exact Anders</h1>
        <div class="col-lg-12">
          Log in via het menu om gebruik te kunnen maken van het systeem, lukt dit niet neem contact op met de beheerder van het systeem.<br />
          <i>beheerder@hondsrugcollege.nl</i>
        </div>
      </div>
      <div class="col-lg-6">
        <img src="images/hondsrug-college.png"/>
        <div class="col-lg-12">

        </div>
        <div class="col-lg-12 ">

        </div>

      </div>

    </div>
  </div>
  <!--end content-->
  <?php
  include ("include/footer.inc");
  ?>
</body>
</html>
