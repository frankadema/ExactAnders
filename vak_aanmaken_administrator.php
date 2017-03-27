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
            echo"<h1>Vak toevoegen</h1>";
            $form_verstuurd = 0;
            if(isset($_POST['submit']))
            {
              if(empty($_POST['vaknaam']) OR empty($_POST['vakomschrijving']) OR empty($_POST['docent_id']))
              {
                echo "<h3>Vul de gegevens compleet in </h3>";
                echo "<FORM><INPUT Type='button' VALUE='terug naar invoerscherm' onClick='history.go(-1);return true;'></FORM>";
                $form_verstuurd++;
              }
              else
              {

                    $vaknaam = $_POST['vaknaam'];
                    $vakomschrijving = $_POST['vakomschrijving'];
                    $docent_id = $_POST['docent_id'];



                    $sql = "INSERT INTO tech_ExactAnders.vak (vaknaam, vakomschrijving, docent_id)
                       VALUES ('$vaknaam','$vakomschrijving','$docent_id')";
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


            }

            ?>
            <form action"<?php echo $_SERVER['PHP_SELF']; ?>" method='post'>
            <?php
            if($form_verstuurd == 0)
            {
            echo "
               <table class='table table-hover'>
                  <tr>
                    <td>Vaknaam</td>
                    <td>:</td>
                    <td><input type='text' name='vaknaam'></td>
                  </tr><tr>
                    <td>Korte Omschrijving</td>
                    <td>:</td>
                    <td><input type='text' name='vakomschrijving'></td>
                  </tr>
                  <tr>
                    <td>Docent</td>
                    <td>:</td>
                    <td>";
                    ?>

<?php
$sql = "SELECT docent_id, firstname, lastname, username FROM docent";
$result = $conn->query($sql);

if ($result->num_rows > 0)
{
  echo "<select name='docent_id'>";
    // output data of each row
    while($row = $result->fetch_assoc())
    {
        //echo "id: " . $row["leerling_id"]. " - naam: " . $row["firstname"]. " " . $row["lastname"]. " ". $row['username']. "<br/>";
?>
        <option value='<?php echo $row['docent_id']?>'> <?php echo $row['firstname']?> &nbsp;<?php echo $row['lastname']?></option>;
<?php
    }
    echo "</select>";
}
else
{
    echo "Probeer opnieuw";
}
?>


                  <?php
                  echo "
                  </td>
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
