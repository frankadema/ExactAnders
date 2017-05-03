<<<<<<< HEAD
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

        <div class="row">

          <div class="col-lg-12">

            <div class="col-lg-12">
              <h1>uitwerking</h1>
              <?php
              $temp = $_POST['submit'];
              echo $temp;
              ?>

              <table class='table table-hover'>
                <form enctype="multipart/form-data" <?php echo $_SERVER['PHP_SELF']; ?> method="POST">

              <tr>
              <td>Naam leerling</td>
              <td>:</td>
              <td><?php echo $_POST['firstname']." ". $_POST['lastname'];?>
               </td>
              </tr>
              <tr>
              <td>Opdracht cijfer leerling</td>
              <td>:</td>
              <td><?php echo $_POST['cijferleerling'];?>
               </td>
              </tr>
              <tr>
              <td>Cijfer docent</td>
              <td>:</td>
              <td><input type='text' name='opdrachtnaam'>
               </td>
              </tr>
              <tr>
              <td>Feedback</td>
              <td>:</td>
              <td><textarea rows="4" cols="50">
Alles is goed alleen een voldoende is het net niet :D
                </textarea>
               </td>
              </tr>
              <tr><td>Aangeleverde opdracht</td><td>:</td><td>           <a href="#" target="_blank" class="btn btn-warning">Downloaden</a>
</td></tr>
              <tr><td>Aangepaste opdracht</td><td>:</td><td>            <input name="uploadedfile" type="file"/>
</td></tr>
              <tr><td><td><td>            <input type="submit" name="submit2" value="Upload Feedback + Opdracht" class="btn btn-warning"/></td>
</td></tr></form></table>

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
=======
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

        <div class="row">

          <div class="col-lg-12">

            <div class="col-lg-12">
              <h1>uitwerking</h1>
              <?php
              $temp = $_POST['submit'];
              echo $temp;
              ?>

              <table class='table table-hover'>
                <form enctype="multipart/form-data" <?php echo $_SERVER['PHP_SELF']; ?> method="POST">

              <tr>
              <td>Naam leerling</td>
              <td>:</td>
              <td><?php echo $_POST['firstname']." ". $_POST['lastname'];?>
               </td>
              </tr>
              <tr>
              <td>Opdracht cijfer leerling</td>
              <td>:</td>
              <td><?php echo $_POST['cijferleerling'];?>
               </td>
              </tr>
              <tr>
              <td>Cijfer docent</td>
              <td>:</td>
              <td><input type='text' name='opdrachtnaam'>
               </td>
              </tr>
              <tr>
              <td>Feedback</td>
              <td>:</td>
              <td><textarea rows="4" cols="50">
Alles is goed alleen een voldoende is het net niet :D
                </textarea>
               </td>
              </tr>
              <tr><td>Aangeleverde opdracht</td><td>:</td><td>           <a href="#" target="_blank" class="btn btn-warning">Downloaden</a>
</td></tr>
              <tr><td>Aangepaste opdracht</td><td>:</td><td>            <input name="uploadedfile" type="file"/>
</td></tr>
              <tr><td><td><td>            <input type="submit" name="submit2" value="Upload Feedback + Opdracht" class="btn btn-warning"/></td>
</td></tr></form></table>

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
>>>>>>> origin/master
