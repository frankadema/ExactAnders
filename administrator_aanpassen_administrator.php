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

            <h1>Administrator aanpassen</h1>
            <?php
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

                $administrator_id = $_POST['administrator_id'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $email = $_POST['mail'];
                $password = $_POST['password'];
                $username = $_POST['username'];


                if(!empty($password))
                {
                  //salt password (username en email mogen niet veranderd worden tijdens gebruik van systeem)
                  $salt = "A_D_M_I_N_I_S_T_A_T_O_R-10#exactanders";
                  //salt password (username en email mogen niet veranderd worden tijdens gebruik van systeem)
                  $password = hash('sha256', $salt.$password);//sha256

                  $password = hash('sha256', $salt.$password);

                  $sql4 = "UPDATE administrator SET password = '$password' WHERE administrator.administrator_id = '$administrator_id'";

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


                //$sql3 = "INSERT INTO tech_ExactAnders.docent (firstname, lastname, email, password, username, startdatum, einddatum)
                // VALUES ('$firstname','$lastname','$email','$password','$username', '$startdatum', '$einddatum')";
                $sql3 = "UPDATE administrator SET username = '$username', firstname = '$firstname', lastname = '$lastname' WHERE administrator.administrator_id = '$administrator_id'";

                if ($conn->query($sql3) === TRUE)
                {
                  echo "record is aangepast aan database";
                }
                else
                {
                  echo"fout";
                  echo "Error: " . $sql . "<br>" . $conn->error;
                }


                $form_verstuurd++;

              }
            }

            if(isset($_POST['submit']))
            {

              $administrator_id = $_POST['submit'];
              $sql2 = "SELECT administrator.administrator_id, administrator.email, administrator.firstname, administrator.lastname, administrator.username
              FROM administrator
              WHERE administrator.administrator_id = $administrator_id";
              $result2 = $conn->query($sql2);

              if ($result2->num_rows > 0)
              {

              }
              else
              {
                echo "Probeer opnieuw!";
              }
              while($row2 = $result2->fetch_assoc())
              {


                ?>
                <form action='#' method='post'>
                  <table class='table table-hover'>
                    <input type="hidden" name="administrator_id" value="<?php echo $row2['administrator_id'] ?>">
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

            $sql = "SELECT administrator.administrator_id, administrator.firstname, administrator.lastname
            FROM administrator";
            $result = $conn->query($sql);

            if ($result->num_rows > 0)
            {

            }
            else
            {
              echo "Probeer opnieuw";
            }

            echo "<table class='table table-hover'>";

            echo "<form action='#' method='post'>";
            $vak_id = 0;
            while($row = $result->fetch_assoc())
            {
              $administrator_id = $row['administrator_id'];


              echo "<tr><td>";
              echo $row['firstname'];
              echo "</td><td>";
              echo $row['lastname'];
              echo "</td><td><input type='submit' name='submit' value='$administrator_id'></td></tr>";


            }
            echo "</form>";
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