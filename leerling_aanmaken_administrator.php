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
        ?>
        <div class="row content">
          <div class="col-lg-12 center">
            <?php
            echo"<h1>Leerling toevoegen</h1>";
            $form_verstuurd = 0;
            if(isset($_POST['submit']))
            {
              if(empty($_POST['username']) OR empty($_POST['password']) OR empty($_POST['password2']) OR empty($_POST['mail']) OR empty($_POST['firstname']) OR empty($_POST['lastname']) )
              {
                echo "<h3>Vul de gegevens compleet in </h3>";
                echo "<FORM><INPUT Type='button' VALUE='terug naar invoerscherm' onClick='history.go(-1);return true;'></FORM>";
                $form_verstuurd++;
              }
              else
              {
                if($_POST['password'] === $_POST['password2'])
                {

                    $firstname = $_POST['firstname'];
                    $lastname = $_POST['lastname'];
                    $email = $_POST['mail'];
                    $password = $_POST['password'];
                    $username = $_POST['username'];
                    $startdatum = $_POST['startdatum'];
                    $einddatum = $_POST['einddatum'];

                    //salt password (username en email mogen niet veranderd worden tijdens gebruik van systeem)
                    $password = hash('sha256', $password);//sha256



                    $sql = "INSERT INTO tech_ExactAnders.leerling (firstname, lastname, email, password, username, startdatum, einddatum)
                       VALUES ('$firstname','$lastname','$email','$password','$username', '$startdatum', '$einddatum')";
                  if ($conn->query($sql) === TRUE)
                  {
                    echo "New record created successfully";
                  }
                  else
                  {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                  }


                  $form_verstuurd++;
                }
                else
                {
                  echo "Wachtwoord is verkeerd ingevuld";
                  echo "<FORM><INPUT Type='button' VALUE='terug naar invoerscherm' onClick='history.go(-1);return true;'></FORM>";
                }
              }


            }

            ?>
            <form action"<?php echo $_SERVER['PHP_SELF']; ?>" method='post'>
            <?php
            if($form_verstuurd == 0)
            {
            echo "
               <table class='table table-hover'>
                  <tr>
                    <td>Gebruikersnaam</td>
                    <td>:</td>
                    <td><input type='text' name='username'></td>
                  </tr>
                  <tr>
                    <td>Wachtwoord</td>
                    <td>:</td>
                    <td><input type='password' name='password'></td>
                  </tr>
                  <tr>
                    <td>Wachtwoord (herhalen)</td>
                    <td>:</td>
                    <td><input type='password' name='password2'></td>
                  </tr>
                  <tr>
                    <td>Voornaam</td>
                    <td>:</td>
                    <td><input type='text' name='firstname'></td>
                  </tr>
                  <tr>
                    <td>Achternaam</td>
                    <td>:</td>
                    <td><input type='text' name='lastname'></td>
                  </tr>
                  <tr>
                    <td>E-mailadres (Hondsrug College)</td>
                    <td>:</td>
                    <td><input type='text' name='mail' value='...@hondsrugcollege.nl'></td>
                  </tr>
                  <tr>
                    <td>Startdatum</td>
                    <td>:</td>
                    <td><input type='text' name='startdatum' placeholder='yyyy-mm-dd'></td>
                  </tr>
                  <tr>
                    <td>Einddatum</td>
                    <td>:</td>
                    <td><input type='text' name='einddatum' placeholder='yyyy-mm-dd'></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td>
                      <input type='submit' name='submit' value='verstuur'>
                      <input type='reset' name='reset' value='reset'>
                    </td>
                  </tr>
              </table>
            </form>
            ";
            }

          ?>
          </div>
        </div>
      </div>
      <!--end content-->
      <?php
        include ("include/footer.inc");
      ?>
  </body>
</html>
