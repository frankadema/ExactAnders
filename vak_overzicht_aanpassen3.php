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

            <?php
            if(isset($_POST['submit2']))
            {

              $feedback = $_POST['feedback'];
              $cijferDocent = $_POST['cijferDocent'];
              $groep_id  = $_POST['groep_id'];
              $leerling_id  = $_POST['leerling_id'];

              $vakhuiswerk_id = $_POST['vakhuiswerk_id'];
              $inlevermoment = $_POST['inlevermoment'];
              $leerling_id = $_POST['leerling_id'];

              //unieke waarde voor opslaan document
              //$today = date("YmdHis");



              if($_FILES["uploadedfile"]["name"] != '')//check if empty
              {
                $allowed_ext = array("pdf");//types
                $ext = end(explode(".", $_FILES["uploadedfile"]["name"]));//get uploaded file

                if(in_array($ext, $allowed_ext))//check if valid extension
                {
                  if($_FILES["uploadedfile"]["size"] <50000000)//check image size 50000 beteken 500 kb
                  {
                    $name = $vakhuiswerk_id.'_'.$groep_id.'_'.$inlevermoment.'_docent.' . $ext;   //rename
                    $path = "groep_documenten/" . $name;    //image upload path
                    move_uploaded_file($_FILES["uploadedfile"]["tmp_name"], $path);
                    echo "file is online";

                    //  echo $name;
                  }
                  else
                  {
                    echo '<script>alert("niet het juiste bestandsformaat groote")</script>';
                  }
                }
                else
                {
                  echo '<script>alert("niet het juiste bestandsformaat")</script>';
                }

              }
              else
              {
                echo '<script>alert("selecteer file")</script>';
              }

              $sql = "UPDATE vakhuiswerkleerling SET feedback = '$feedback', cijferdocent = '$cijferDocent', urldocent = '$name' WHERE groep_id = $groep_id";
              /*
              $sql2 = "INSERT INTO tech_ExactAnders.vakhuiswerk  (vak_id, docent_id, opdrachtnaam, omschrijving, url, duedate)
              VALUES ('$vak_id', '$docent_id', '$opdrachtnaam', '$opdrachomschrijving', '$name', '$duedate')";
              */
              if ($conn->query($sql) === TRUE)
              {
              echo "New record updated successfully";
            }
            else
            {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }

        }?>
        <h1>Uitwerking</h1>
        <?php

        ?>

        <table class='table table-hover'>
          <form enctype="multipart/form-data" <?php echo $_SERVER['PHP_SELF']; ?> method="POST">

            <tr>
              <td>Naam</td>
              <td>:</td>
              <td><?php echo $_POST['groepnaam'];?>
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
              <td><input type='text' name='cijferDocent'>
              </td>
            </tr>
            <tr>
              <td>Feedback</td>
              <td>:</td>
              <td><textarea rows="4" cols="50" class="form-control" name="feedback">Alles is goed alleen een voldoende is het net niet :D
              </textarea>
            </td>
          </tr>
          <tr>
            <td>Aangeleverde opdracht</td>
            <td>:</td>
            <td>           <a href="#" target="_blank" class="btn btn-warning">Downloaden</a>
          </td>
        </tr>
          <tr>
            <td>Aangepaste opdracht</td>
            <td>:</td>
            <td><input name="uploadedfile" type="file"/>
          </td>
        </tr>
          <tr>
            <td><td>
              <td>

                <input type="hidden" name="vakhuiswerk_id" value="<?php echo $_POST['vakhuiswerk_id']?>">
                <input type="hidden" name="groep_id" value="<?php echo $_POST['groep_id']?>">
                <input type="hidden" name="inlevermoment" value="<?php echo $_POST['inlevermoment']?>">
                <input type="submit" name="submit2" value="Upload Feedback + Opdracht" class="btn btn-warning"/></td>
          </td>
        </tr>
      </form>
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
