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

          <h1>Vak aanpassen</h1>
          <?php
          if(isset($_POST['submit2']))
          {
            if(empty($_POST['vaknaam']))
            {
              echo "Vul de gegevens compleet in.";
              echo "<FORM><INPUT Type='button' VALUE='terug naar invoerscherm' onClick='history.go(-1);return true;'></FORM>";
              $form_verstuurd++;
            }
            else
            {

              $vak_id = $_POST['vak_id'];
              $vaknaam = $_POST['vaknaam'];
              $vakomschrijving = $_POST['vakomschrijving'];
              $docent_id = $_POST['docent_id'];


              //$sql3 = "INSERT INTO tech_ExactAnders.docent (firstname, lastname, email, password, username, startdatum, einddatum)
              // VALUES ('$firstname','$lastname','$email','$password','$username', '$startdatum', '$einddatum')";
              $sql3 = "UPDATE vak SET vaknaam = '$vaknaam', vakomschrijving = '$vakomschrijving' WHERE vak.vak_id = '$vak_id'";

              if ($conn->query($sql3) === TRUE)
              {
                echo "Vak is aangepast aan database";
                //echo '<meta http-equiv="refresh" content="2;url=vak_aanpassen_administrator.php">';
              }
              else
              {
                echo"Er is iets fout gegaan, neem contact op met de administrator van dit systeem.";

                //  echo "Error: " . $sql . "<br>" . $conn->error;
              }

              $sql4 = "UPDATE vakdocent SET docent_id = '$docent_id' WHERE vakdocent.vak_id = '$vak_id'";

              if ($conn->query($sql4) === TRUE)
              {
                //echo "Vak is aangepast aan database";
                echo '<meta http-equiv="refresh" content="2;url=vak_aanpassen_administrator.php">';
              }
              else
              {
                echo"Er is iets fout gegaan, neem contact op met de administrator van dit systeem.";
                //echo "Error: " . $sql . "<br>" . $conn->error;
              }

              $form_verstuurd++;

            }
          }

          if(isset($_POST['submit']))
          {

            $vak_id = $_POST['vak_id'];
            $sql2 = "SELECT vak.vak_id, vak.vaknaam,vak.vakomschrijving, docent.firstname, docent.lastname, docent.docent_id
            FROM vak, vakdocent, docent
            WHERE vak.vak_id = vakdocent.vak_id
            AND vakdocent.docent_id = docent.docent_id
            AND vak.vak_id = $vak_id";
            $result2 = $conn->query($sql2);

            if ($result2->num_rows > 0)
            {

            }
            else
            {

            }
            while($row2 = $result2->fetch_assoc())
            {


              ?>
              <form action='#' method='post'>
                <table class='table table-hover'>
                  <input type="hidden" name="vak_id" value="<?php echo $row2['vak_id'] ?>">
                  <tr>
                    <td>Vaknaam</td>
                    <td>:</td>
                    <td><input type='text' name='vaknaam' value='<?php echo $row2['vaknaam']?>' class='form-control'></td>
                  </tr>

                  <td>vakomschrijving</td>
                  <td>:</td>
                  <td><textarea class="form-control" name="vakomschrijving" rows="4" cols="100%" class='form-control'><?php echo $row2['vakomschrijving'];?></textarea></td>
                </tr>
                <tr>
                  <td>Docent</td>
                  <td>:</td>
                  <td>
                    <?php
                    $notdocent = $row2['docent_id'];
                    $sql3 = "SELECT docent_id, firstname, lastname, username FROM docent WHERE NOT docent_id = $notdocent";
                    $result3 = $conn->query($sql3);

                    if ($result3->num_rows > 0)
                    {

                    }
                    else
                    {

                    }
                    ?>

                    <select name='docent_id' class='form-control'>";
                      <?php
                      while($row3 = $result3->fetch_assoc())
                      {
                        ?>
                        <option value='<?php echo $row3['docent_id']?>'> <?php echo $row3['firstname']?> &nbsp;<?php echo $row3['lastname']?></option>;
                        <?php
                      }
                      ?>
                      <option selected value='<?php echo $row2['docent_id']?>'> <?php echo $row2['firstname']?> &nbsp;<?php echo $row2['lastname']?></option>

                    </select>
                  </td>

                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td>
                    <input type='submit' name='submit2' value='aanpassen' class='btn btn-warning'>

                  </td>
                </tr>
              </table>

            </form>
            <?php
          }











        }

        $sql = "SELECT vak.vak_id, vak.vaknaam, vak.vakomschrijving, docent.firstname, docent.lastname
        FROM vak, vakdocent, docent
        WHERE vak.vak_id = vakdocent.vak_id
        AND vakdocent.docent_id = docent.docent_id
        ORDER BY vak.vaknaam ASC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0)
        {

        }
        else
        {
          
        }

        echo "<table class='table table-hover'>";

        $vak_id = 0;
        while($row = $result->fetch_assoc())
        {
          $vak_id = $row['vak_id'];
          echo "<form action='#' method='post'>";


          echo "<tr><td>";
          echo $row['vaknaam'];
          echo "</td><td>";
          echo $row['firstname']." ". $row['lastname'];
          echo "</td><td>";
          echo "  <input type='hidden' name='vak_id' value='$vak_id'>";
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
