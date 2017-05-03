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
        <div class="row">
          <div class="col-lg-12">
          <div class="col-lg-12">

            <?php
            $leerling_id = $_SESSION['leerling'];
            $sql = "SELECT vak.vak_id, vak.vaknaam
                    FROM vakleerling, vak
                    WHERE vakleerling.vak_id = vak.vak_id
                    AND vakleerling.leerling_id = $leerling_id
                    AND vak.vak_id NOT IN (SELECT beoordeelvak.vak_id FROM beoordeelvak WHERE beoordeelvak.leerling_id = $leerling_id)
                    ";

            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {

            }
            else
            {
            echo "Alle docenten zijn tot nu toe beoordeeld";
            }
            ?>
            <h1>Beoordeel vak</h1>
<?php
if(isset($_POST['submit']))
{

  $feedback = $_POST['feedback'];
  $vak_id = $_POST['vak_id'];
  $feedback = $_POST['feedback'];
  $leerling_id = $_POST['leerling_id'];
  $cijfer = $_POST['cijfer'];

  if(empty($_POST['cijfer']) )
  {
    echo "er is iets fout gegaan probeer opnieuw";
  }
  else
  {
    $tijd = date("Y-m-d H:i:s");
    $sql2 = "INSERT INTO tech_ExactAnders.beoordeelvak (vak_id, leerling_id, feedback, datum, cijfer)
       VALUES ('$vak_id','$leerling_id','$feedback','$tijd','$cijfer')";
  if ($conn->query($sql2) === TRUE)
  {
    echo "New record created successfully";
  }
  else
  {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  }
}
?>
            <table class='table table-hover'>


            <tr><td><h4>Vak</h4></td><td><h4>Cijfer</h4></td><td><h4>Feedback</h4></td></tr>
                  <?php


                  while($row = $result->fetch_assoc())
                  {
                    ?>
                    <form action"<?php echo $_SERVER['PHP_SELF']; ?>" method='post'>

                    <tr>
                      <td>
                    <?php
                    echo $row['vaknaam'];
                    ?>
                    </td>
                    <td>
                      <input type='text' name='cijfer'>
                      <input type='hidden' name='vak_id' value='<?echo $row['vak_id']?>'>
                      <input type='hidden' name='leerling_id' value='<?echo $leerling_id;?>'>
                    </td>
                    <td>
                      <textarea class="form-control" name="feedback" rows="4" cols="25">Ik vindt dat vak: "<?php echo $row['vaknaam'];?>" ...</textarea>
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
        include ("include/footer.inc");
      ?>
  </body>
</html>
