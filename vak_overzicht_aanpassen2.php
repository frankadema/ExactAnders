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
              $id  = $_POST['id'];
              $leerling_id  = $_POST['leerling_id'];


              $vakhuiswerk_id = $_POST['vakhuiswerk_id'];
              $inlevermoment = $_POST['inlevermoment'];
              $leerling_id = $_POST['leerling_id'];


              //file upload
              if($_FILES["uploadedfile"]["name"] != '')//check if empty
              {
                $allowed_ext = array("pdf");//types
                $ext = end(explode(".", $_FILES["uploadedfile"]["name"]));//get uploaded file

                if(in_array($ext, $allowed_ext))//check if valid extension
                {
                  if($_FILES["uploadedfile"]["size"] <30000000)//check image size 50000 beteken 500 kb
                  {
                    $name = $vakhuiswerk_id.'_'.$leerling_id.'_'.$inlevermoment.'_docent.' . $ext;   //rename
                    $path = "leerling_documenten/" . $name;    //image upload path
                    move_uploaded_file($_FILES["uploadedfile"]["tmp_name"], $path);

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
              //database update
              $sql = "UPDATE vakhuiswerkleerling SET feedback = '$feedback', cijferdocent = '$cijferDocent', urldocent = '$name' WHERE vakhuiswerkleerling.vakhuiswerkleerling_id = $id";

              if ($conn->query($sql) === TRUE)
              {
                echo "Verwerkt in database, u wordt terug gestuurd naar de vakken pagina";
                echo "<meta http-equiv='refresh' content='3; url=vak_docent.php'>";
              }
              else
              {
                //echo "Error: " . $sql . "<br>" . $conn->error;
              }

            }?>
            <h1>Uitwerking</h1>
            <?php
            $vakhuiswerkleerling_id = $_POST['vakhuiswerkleerling_id'];

            ?>

            <table class='table table-hover'>
              <form enctype="multipart/form-data" <?php echo $_SERVER['PHP_SELF']; ?> method="POST">

                <tr>
                  <td>Naam</td>
                  <td>:</td>
                  <td><?php echo $_POST['firstname']." ". $_POST['lastname'];?>
                  </td>
                </tr>
                <tr>
                  <td>Opdracht cijfer leerling</td>
                  <td>:</td>
                  <td>
                    <?php

                    echo $_POST['cijferleerling'];
                    echo " Opdracht te laat ingeleverd: ";
                    echo $_POST['teLaat'];
                    ?>
                  </td>
                </tr>
                <tr>
                  <td>Cijfer docent</td>
                  <td>:</td>
                  <td>
                    <select name="cijferDocent" class='form-control'>
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
                  </td>
                </tr>
                <tr>
                  <td>Feedback</td>
                  <td>:</td>
                  <td><textarea rows="4" cols="50" class="form-control" name="feedback">Feedback
                  </textarea>
                </td>
              </tr>
              <tr>
                <td>Aangeleverde opdracht</td>
                <td>:</td>
                <td>
                  <?php


                  $sql2 = "SELECT vakhuiswerkleerling.urlleerling
                  FROM vakhuiswerkleerling
                  WHERE vakhuiswerkleerling.vakhuiswerkleerling_id = $vakhuiswerkleerling_id";

                  $result2 = $conn->query($sql2);


                  if ($result2->num_rows > 0)
                  {

                  }
                  else
                  {

                  }
                  while($row2 = $result2->fetch_assoc())
                  {
                    $document = $row2['urlleerling'];
                    echo'<a href="leerling_documenten/'.$document.'" target="_blank" class="btn btn-warning">Downloaden</a>';
                  }
                  ?>

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
                    <input type="hidden" name="id" value="<?php echo $vakhuiswerkleerling_id;?>">
                    <input type="hidden" name="vakhuiswerk_id" value="<?php echo $_POST['vakhuiswerk_id']?>">
                    <input type="hidden" name="leerling_id" value="<?php echo $_POST['leerling_id']?>">
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
