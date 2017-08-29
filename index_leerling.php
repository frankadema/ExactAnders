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

      $leerling_id = $_SESSION['leerling'];

      $sql = "SELECT leerling.firstname, leerling.lastname, leerling.email, leerling.username
      FROM leerling
      WHERE leerling.leerling_id = $leerling_id";
      $result = $conn->query($sql);
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
            <h1>Leerling</h1>

            <table class='table table-hover'>
              <?php
              while($row = $result->fetch_assoc())
              {
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $email= $row['email'];
                $username = $row['username'];


                ?>
                <tr>
                  <td>Gebruikersnaam</td>
                  <td>:</td>
                  <td><? echo $username;?></td>
                </tr>
                <tr>
                  <td>Voornaam</td>
                  <td>:</td>
                  <td><? echo $firstname;?></td>
                </tr>
                <tr>
                  <td>Achternaam</td>
                  <td>:</td>
                  <td><? echo $lastname;?></td>
                </tr>
                <tr>
                  <td>E-mailadres</td>
                  <td>:</td>
                  <td><? echo $email;?></td>
                </tr>

                <?php
              }
              ?>
            </table>

          </div>
        </div>
        <div class="col-lg-6">

          <div class="col-lg-12">
            <h1>Informatie</h1>
            <p>
              In het menu hierboven kunt u wijzigingen doorvoeren en gegevens uitlezen binnen Exact Anders.
            </p>
            <img src="https://learnbeat.nl/content/1-learnbeat/1-scholen/hondsrug-college/hondsrug-college.png"/>
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
