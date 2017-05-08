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
            echo "Probeer opnieuw";
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
    echo "er is iets fout gegaan probeer opnieuw";
  }
  else
  {
    $tijd = date("Y-m-d H:i:s");
    $sql2 = "INSERT INTO tech_ExactAnders.beoordeeldocent (docent_id, leerling_id, feedback, datum, cijfer)
       VALUES ('$docent_id','$leerling_id','$feedback','$tijd','$cijfer')";
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


            <tr><td><h4>Docent</h4></td><td><h4>Cijfer</h4></td><td><h4>Feedback</h4></td></tr>
                  <?php


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
                      <input type='text' name='cijfer'>
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
        include ("include/footer.inc");
      ?>
  </body>
</html>
