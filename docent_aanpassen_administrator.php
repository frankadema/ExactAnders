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

    if(empty($_SESSION['administrator']))
    {
      echo "Er iets fout gegaan, ga terug naar het begin scherm!";
    }
    else
    {
      ?>
      <div class="row content">
        <div class="col-lg-12 center">

          <h1>Docent aanpassen</h1>
          <?php
          //update record docent
          if(isset($_POST['submit2']))
          {
            if(empty($_POST['username']) OR empty($_POST['mail']) OR empty($_POST['firstname']) OR empty($_POST['lastname']) )
            {
              echo "<h3>Vul de gegevens compleet in </h3>";
              echo "<FORM><INPUT Type='button' VALUE='terug naar invoerscherm' onClick='history.go(-1);return true;'></FORM>";
              $form_verstuurd++;
            }
            else
            {

              $docent_id = $_POST['docent_id'];
              $firstname = $_POST['firstname'];
              $lastname = $_POST['lastname'];
              $email = $_POST['mail'];
              $password = $_POST['password'];
              $username = $_POST['username'];
              $startdatum = $_POST['startdatum'];
              $einddatum = $_POST['einddatum'];

              if(!empty($password))
              {
                //salt password (username en email mogen niet veranderd worden tijdens gebruik van systeem)
                $salt = "D_O_C_E_N_T-10#exactanders";
                //salt password (username en email mogen niet veranderd worden tijdens gebruik van systeem)
                $password = hash('sha256', $salt.$password);//sha256

                $password = hash('sha256', $salt.$password);

                $sql4 = "UPDATE docent SET password = '$password' WHERE docent.docent_id = '$docent_id'";

                if ($conn->query($sql4) === TRUE)
                {
                  echo "Wachtwoord is aangepast<br />";
                }
                else
                {
                  echo"fout";
                  echo "Error: " . $sql . "<br>" . $conn->error;
                }
              }

              $sql3 = "UPDATE docent SET username = '$username', firstname = '$firstname', lastname = '$lastname', startdatum = '$startdatum', einddatum = '$einddatum' WHERE docent.docent_id = '$docent_id'";

              if ($conn->query($sql3) === TRUE)
              {
                echo "record is aangepast aan database, u wordt terug getstuurd naar de startpagina";
                echo '<meta http-equiv="refresh" content="2;url=index.php">';              }
              else
              {
                echo"fout";
                echo "Error: " . $sql . "<br>" . $conn->error;
              }


              $form_verstuurd++;

            }
          }

          //fill selected docent
          if(isset($_POST['submit']))
          {

            $docent_id = $_POST['docent_id'];
            $sql2 = "SELECT docent.docent_id, docent.email,docent.firstname, docent.lastname, docent.username, docent.startdatum, docent.einddatum
            FROM docent
            WHERE docent.docent_id = $docent_id";
            $result2 = $conn->query($sql2);

            if ($result2->num_rows > 0)
            {

            }
            else
            {
              echo "Probeer opnieuw";
            }
            while($row2 = $result2->fetch_assoc())
            {


              ?>
              <form action='#' method='post'>
                <table class='table table-hover'>
                  <input type="hidden" name="docent_id" value="<?php echo $row2['docent_id'] ?>">
                  <tr>
                    <td>Gebruikersnaam</td>
                    <td>:</td>
                    <td><input type='text' name='username' value='<?php echo $row2['username']?>'></td>
                  </tr>
                  <tr>
                    <td>Evenueel nieuw wachtwoord</td>
                    <td>:</td>
                    <td><input type='password' name='password'></td>
                  </tr>
                  <tr>
                    <td>Voornaam</td>
                    <td>:</td>
                    <td><input type='text' name='firstname' value='<?php echo $row2['firstname']?>'></td>
                  </tr>
                  <tr>
                    <td>Achternaam</td>
                    <td>:</td>
                    <td><input type='text' name='lastname' value='<?php echo $row2['lastname']?>'></td>
                  </tr>
                  <tr>
                    <td>E-mailadres (Hondsrug College)</td>
                    <td>:</td>
                    <td><input type='text' name='mail' value='<?php echo $row2['email']?>'></td>
                  </tr>
                  <tr>
                    <td>Startdatum</td>
                    <td>:</td>
                    <td>
                      <input id='date' type='date' name='startdatum' value='<?php echo $row2['startdatum']?>'></td>
                    </tr>
                    <tr>
                      <td>
                        Einddatum of blokeerdatum<br />
                        <i>Na deze datum kan gebruiker systeem niet meer gebruiken</i>
                      </td>
                      <td>:</td>
                      <td><input id='date' type='date' name='einddatum' value='<?php echo $row2['einddatum']?>'></td></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td>
                        <input type='submit' name='submit2' value='aanpassen'>

                      </td>
                    </tr>
                  </table>

                </form>
                <?php
              }
            }

            //all docents
            $sql = "SELECT docent.docent_id, docent.firstname, docent.lastname, docent.startdatum, docent.einddatum
            FROM docent";
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
            //all users docent
            while($row = $result->fetch_assoc())
            {
              $docent_id = $row['docent_id'];

              echo "<form action='#' method='post'>";
              echo "<tr><td>";
              echo $row['firstname'];
              echo "</td><td>";
              echo $row['lastname'];
              echo "  <input type='hidden' name='docent_id' value='$docent_id'>";
              echo "</td><td><input type='submit' name='submit' value='verder' class='btn btn-warning'></td></tr>";
              echo "</form>";

            }

            echo "</table>";
            ?>
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
