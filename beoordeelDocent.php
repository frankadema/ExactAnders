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
    //sessie leerling
    if(empty($_SESSION['leerling']))
    {
      echo "Er iets fout gegaan, ga terug naar het begin scherm!";
    }
    else
    {
      ?>
      <div class="row">
        <div class="col-lg-12">
          <div class="col-lg-12">

            <?php
            //docenten tonen die lesgeven aan leerling
            $leerling_id = $_SESSION['leerling'];
            $sql = "SELECT docent.docent_id, docent.lastname
            FROM docent, vakdocent, vak, vakleerling, leerling
            WHERE docent.docent_id = vakdocent.docent_id
            AND vakdocent.vak_id = vak.vak_id
            AND vak.vak_id = vakleerling.vak_id
            AND vakleerling.leerling_id = leerling.leerling_id
            AND leerling.leerling_id = $leerling_id
            AND docent.docent_id NOT IN (SELECT beoordeeldocent.docent_id FROM beoordeeldocent WHERE beoordeeldocent.leerling_id = $leerling_id)
            GROUP BY docent.docent_id";

            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {

            }
            else
            {
              //als alle beoordelingen zijn ingevuld.
              echo "Er staat op dit moment geen beoordling klaar.";
            }
            ?>
            <h1>Beoordeel docent</h1>
            <?php
            if(isset($_POST['submit']))
            {

              $feedback = $_POST['feedback'];
              $docent_id = $_POST['docent_id'];
              $feedback = $_POST['feedback'];
              $leerling_id = $_POST['leerling_id'];
              $cijfer = $_POST['cijfer'];

              if(empty($_POST['cijfer']) )
              {
                echo "Er is iets fout gegaan probeer opnieuw";
              }
              else
              {
                $tijd = date("Y-m-d H:i:s");
                $sql2 = "INSERT INTO tech_ExactAnders.beoordeeldocent (docent_id, leerling_id, feedback, datum, cijfer)
                VALUES ('$docent_id','$leerling_id','$feedback','$tijd','$cijfer')";
                if ($conn->query($sql2) === TRUE)
                {
                  echo "Bedankt voor het opsturen.";
                  echo '<meta http-equiv="refresh" content="2;url=beoordeelDocent.php">';
                }
                else
                {
                  echo"Er is iets fout gegaan, neem contact op met de administrator van dit systeem.";
                //  echo "Error: " . $sql . "<br>" . $conn->error;
                }
              }
            }
            ?>
            <table class='table table-hover'>


              <tr><td><h4>Docent</h4></td><td><h4>Cijfer</h4></td><td><h4>Feedback</h4></td></tr>
              <?php

              //openstaande docenten zonder beoordeling.
              while($row = $result->fetch_assoc())
              {
                ?>
                <form action"<?php echo $_SERVER['PHP_SELF']; ?>" method='post'>

                  <tr>
                    <td>
                      <?php
                      echo $row['lastname'];
                      ?>
                    </td>
                    <td>
                      <select name="cijfer" class='form-control'>
                        <option value="1.0">1.0</option>
                        <option value="1.1">1.1</option>
                        <option value="1.2">1.2</option>
                        <option value="1.3">1.3</option>
                        <option value="1.4">1.4</option>
                        <option value="1.5">1.5</option>
                        <option value="1.6">1.6</option>
                        <option value="1.7">1.7</option>
                        <option value="1.8">1.8</option>
                        <option value="1.9">1.9</option>
                        <option value="2.0">2.0</option>
                        <option value="2.1">2.1</option>
                        <option value="2.2">2.2</option>
                        <option value="2.3">2.3</option>
                        <option value="2.4">2.4</option>
                        <option value="2.5">2.5</option>
                        <option value="2.6">2.6</option>
                        <option value="2.7">2.7</option>
                        <option value="2.8">2.8</option>
                        <option value="2.9">2.9</option>
                        <option value="3.0">3.0</option>
                        <option value="3.1">3.1</option>
                        <option value="3.2">3.2</option>
                        <option value="3.3">3.3</option>
                        <option value="3.4">3.4</option>
                        <option value="3.5">3.5</option>
                        <option value="3.6">3.6</option>
                        <option value="3.7">3.7</option>
                        <option value="3.8">3.8</option>
                        <option value="3.9">3.9</option>
                        <option value="4.0">4.0</option>
                        <option value="4.1">4.1</option>
                        <option value="4.2">4.2</option>
                        <option value="4.3">4.3</option>
                        <option value="4.4">4.4</option>
                        <option value="4.5">4.5</option>
                        <option value="4.6">4.6</option>
                        <option value="4.7">4.7</option>
                        <option value="4.8">4.8</option>
                        <option value="4.9">4.9</option>
                        <option value="5.0">5.0</option>
                        <option value="5.1">5.1</option>
                        <option value="5.2">5.2</option>
                        <option value="5.3">5.3</option>
                        <option value="5.4">5.4</option>
                        <option value="5.5">5.5</option>
                        <option value="5.6">5.6</option>
                        <option value="5.7">5.7</option>
                        <option value="5.8">5.8</option>
                        <option value="5.9">5.9</option>
                        <option value="6.0">6.0</option>
                        <option value="6.1">6.1</option>
                        <option value="6.2">6.2</option>
                        <option value="6.3">6.3</option>
                        <option value="6.4">6.4</option>
                        <option value="6.5">6.5</option>
                        <option value="6.6">6.6</option>
                        <option value="6.7">6.7</option>
                        <option value="6.8">6.8</option>
                        <option value="6.9">6.9</option>
                        <option value="7.0">7.0</option>
                        <option value="7.1">7.1</option>
                        <option value="7.2">7.2</option>
                        <option value="7.3">7.3</option>
                        <option value="7.4">7.4</option>
                        <option value="7.5">7.5</option>
                        <option value="7.6">7.6</option>
                        <option value="7.7">7.7</option>
                        <option value="7.8">7.8</option>
                        <option value="7.9">7.9</option>
                        <option value="8.0">8.0</option>
                        <option value="8.1">8.1</option>
                        <option value="8.2">8.2</option>
                        <option value="8.3">8.3</option>
                        <option value="8.4">8.4</option>
                        <option value="8.5">8.5</option>
                        <option value="8.6">8.6</option>
                        <option value="8.7">8.7</option>
                        <option value="8.8">8.8</option>
                        <option value="8.9">8.9</option>
                        <option value="9.0">9.0</option>
                        <option value="9.1">9.1</option>
                        <option value="9.2">9.2</option>
                        <option value="9.3">9.3</option>
                        <option value="9.4">9.4</option>
                        <option value="9.5">9.5</option>
                        <option value="9.6">9.6</option>
                        <option value="9.7">9.7</option>
                        <option value="9.8">9.8</option>
                        <option value="9.9">9.9</option>
                        <option value="10.0">10.0</option>
                      </select>
                      <input type='hidden' name='docent_id' value='<?echo $row['docent_id']?>'>
                      <input type='hidden' name='leerling_id' value='<?echo $leerling_id;?>'>
                    </td>
                    <td>
                      <textarea class="form-control" name="feedback" rows="4" cols="25">Ik vindt dat docent: "<?php echo $row['lastname'];?>" ...</textarea>
                    </td>
                    <td>
                      <input type='submit' name='submit' value='verstuur' class="btn btn-warning">
                    </form>

                  </td></tr>

                  <?php

                }
                ?>

              </table>
            </div>
          </div>

        </div>
        <?php
      }
      ?>
    </div>
    <!--end content-->
    <?php
    //footer
    include ("include/footer.inc");
    ?>
  </body>
  </html>
