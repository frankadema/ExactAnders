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

      if(isset($_GET["file-name"]))
      {
        echo "image uploaded successfully";
        echo '<img src="vak_documenten/'.$_GET["file-name"].'" />';
      }
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

          $docent_id = $_SESSION['docent'];
/*
          if (empty($_SESSION['vak_id']))
          {
            $_SESSION['vak_id'] = $_POST['submit'];
          }
          $vak_id = $_SESSION['vak_id']*/
          //$vak_id   = $_POST['submit'];
          $_SESSION['vak_id'] = $_POST['submit'];
          $vak_id = $_SESSION['vak_id'];
        //  $_SESSION['vak_id'] = $vak_id;
          //$vak_id = $_SESSION['vak_id'] ;



          if(isset($_POST['submit4']))
          {

            $vak_id = $_POST['vak_id'];
            foreach ($_POST['leerling_id'] as $id)
            {


                $sql5 = "INSERT INTO tech_ExactAnders.vakleerling (leerling_id, vak_id)
                VALUES ('$id','$vak_id')";

              if ($conn->query($sql5) === TRUE)
              {
                echo "New record created successfully";
              }
              else
              {
                echo "Error: " . $sql5 . "<br>" . $conn->error;
              }
            }

          }


          if(isset($_POST['submit3']))
          {

            $vak_id = $_POST['vak_id'];
            $duedate =  $_POST['duedate'];
            $opdrachtnaam = $_POST['opdrachtnaam'];
            $opdrachomschrijving = $_POST['omschrijvingopdracht'];
            $docent_id = $_SESSION['docent'];
            //unieke waarde voor opslaan document
            $today = date("YmdHis");



            if($_FILES["uploadedfile"]["name"] != '')//check if empty
            {
              $allowed_ext = array("pdf");//types
              $ext = end(explode(".", $_FILES["uploadedfile"]["name"]));//get uploaded file

              if(in_array($ext, $allowed_ext))//check if valid extension
              {
                if($_FILES["uploadedfile"]["size"] <50000000)//check image size 50000 beteken 500 kb
                {
                  $name = $today.'*'.$opdrachtnaam . '.' . $ext;   //rename
                  $path = "vak_documenten/" . $name;    //image upload path
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

         $sql2 = "INSERT INTO tech_ExactAnders.vakhuiswerk  (vak_id, docent_id, opdrachtnaam, omschrijving, url, duedate)
            VALUES ('$vak_id', '$docent_id', '$opdrachtnaam', '$opdrachomschrijving', '$name', '$duedate')";
         if ($conn->query($sql2) === TRUE)
          {
            echo "New record created successfully";
          }
          else
          {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
          }

        }

          if(isset($_POST['submit2']))
          {
          $vakomschrijving = $_POST['omschrijving'];
          $vak_id = $_POST['vak_id'];
          $sql = "UPDATE vak SET vakomschrijving = '$vakomschrijving' WHERE vak.vak_id = $vak_id";
          if ($conn->query($sql) === TRUE)
          {
            echo "New record updated successfully";
          }
          else
          {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }


          $sql = "SELECT vak.vak_id, vak.vaknaam, vak.vakomschrijving
          FROM vak, vakdocent, docent
          WHERE docent.docent_id = vakdocent.docent_id
          AND vakdocent.vak_id = vak.vak_id
          AND docent.docent_id =  $docent_id
          AND vak.vak_id = $vak_id";
          $result = $conn->query($sql);

          if ($result->num_rows > 0)
          {

          }
          else
          {
          echo "Probeer opnieuw";
          }
          $row = $result->fetch_assoc();


        ?>
        <div class="row">
          <div class="col-lg-12">
          <div class="col-lg-12">

            <h1><?php echo $row['vaknaam'];?></h1>

            <p>

              <form action"<?php echo $_SERVER['PHP_SELF']; ?>" method='post'>


              <textarea class="form-control" name="omschrijving" rows="4" cols="100%"><?php echo $row['vakomschrijving'];?></textarea><br />
              <input type='hidden' name='vak_id' value='<?echo $_SESSION['vak_id']?>'>
              <input type='submit' name='submit2' value='Aanpassen'>

            </form>

            </p>

          </div>
        </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
          <div class="col-lg-6">
            <?php
                $sql3 = "SELECT vakhuiswerk.vakhuiswerk_id, vakhuiswerk.Opdrachtnaam, vakhuiswerk.omschrijving, vakhuiswerk.duedate, vakhuiswerk.url
                FROM vakhuiswerk
                WHERE vakhuiswerk.vak_id = $vak_id";

                $result3 = $conn->query($sql3);

                if ($result3->num_rows > 0)
                {

                }
                else
                {
                echo "Probeer opnieuw";
                }

            ?>
            <h1>Opdrachten uploaden</h1>

            <form enctype="multipart/form-data" <?php echo $_SERVER['PHP_SELF']; ?> method="POST">

            <table class='table table-hover'>
            <tr>
            <td>Opdrachtnaam</td>
            <td>:</td>
            <td><input type='text' name='opdrachtnaam'>
               <input type='hidden' name='vak_id' value='<?echo $_SESSION['vak_id']?>'>
             </td>
            </tr>
            <tr>
            <td>Inlevermoment</td>
            <td>:</td>
            <td><input type='text' name='duedate' value='yyyy-mm-dd'>
            </td>
          </tr>
            <tr>
            <td>Omschrijving</td>
            <td>:</td>
            <td><textarea class="form-control" name="omschrijvingopdracht" rows="4" cols="100%"></textarea><br />
            </td>
            </tr>
            <tr>
            <td>Bestand</td>
            <td>:</td>
            <td>
            <input name="uploadedfile" type="file"/><br />
            <input type="submit" name="submit3" value="Upload Opdracht" /></td>
            </tr>
            </table>
          </form>
          </div>
          <div class="col-lg-6">
            <?php
                $sql7 = "SELECT vakhuiswerk.vakhuiswerk_id, vakhuiswerk.Opdrachtnaam, vakhuiswerk.omschrijving, vakhuiswerk.duedate, vakhuiswerk.url
                FROM vakhuiswerk
                WHERE vakhuiswerk.vak_id = $vak_id";

                $result7 = $conn->query($sql3);

                if ($result7->num_rows > 0)
                {

                }
                else
                {
                echo "Probeer opnieuw";
                }

            ?>


            <h1>Opdrachten Inzien</h1>
            <table class='table table-hover'>

            <tr><td><h4>Opdrachtnaam</h4></td><td><h4>Inleverdatum</h4></td><td><h4>Open</h4></td></tr>
                  <?php
                  while($row7 = $result7->fetch_assoc())
                  {
                    ?>
                    <tr>
                      <td>
                    <?php
                    echo $row7['Opdrachtnaam'];
                    ?>
                    </td>
                    <td>
                    <?php
                    echo $row7['duedate'];
                    ?>
                    </td>
                    <td>
                      <a href="vak_documenten/<?php echo $row7['url'];?>" target="_blank" class="btn btn-warning">
                    <?php

                    echo $row7['url'];
                    ?>
                  </a>

                    </td>
                    </tr>
                    <?php

                  }
                  ?>
              </table>
          </div>
        </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
          <div class="col-lg-12">


            <?php
                $sql6 = "SELECT leerling.firstname, leerling.lastname, vakhuiswerk.Opdrachtnaam, vakhuiswerk.duedate, vakhuiswerkleerling.inlevermoment, vakhuiswerkleerling.cijferleerling, vakhuiswerkleerling.cijferdocent, vakhuiswerkleerling.urlleerling, vakhuiswerkleerling.urldocent, vakhuiswerkleerling.vakhuiswerkleerling_id
                        FROM vakhuiswerkleerling, leerling, vakhuiswerk
                        WHERE vakhuiswerkleerling.leerling_id = leerling.leerling_id
                        AND vakhuiswerk.vakhuiswerk_id = vakhuiswerkleerling.vakhuiswerk_id
                        AND vakhuiswerkleerling.vak_id =  $vak_id";

                $result6 = $conn->query($sql6);

                if ($result6->num_rows > 0)
                {

                }
                else
                {
                echo "Probeer opnieuw";
                }

            ?>

            <h1>Opdrachten downloaden</h1>
            <table class='table table-hover'>
              <form action='vak_overzicht_aanpassen2.php' method='post'>
<tr><td><h4>Leerling</h4></td><td><h4>Opdracht</h4></td><td><h4>uiterste inleverdatum</h4></td><td><h4>Leerling</h4></td><td><h4>Docent</h4></td><td><h4>Moment</h4></td><td><h4>Download</h4></td>
  <td><h4>Upload</h4></td></tr>
                  <?php
                  while($row6 = $result6->fetch_assoc())
                  {
                    ?>
                    <tr>
                      <td>
                    <?php
                    echo $row6['firstname']." ". $row6['lastname'];
                    ?>
                    </td>
                    <td>
                    <?php
                    echo $row6['Opdrachtnaam'];
                    ?>
                    </td>
                    <td>
                    <?php
                    echo $row6['duedate'];
                    ?>
                    </td>
                    <td>
                    <?php
                    echo $row6['cijferleerling'];
                    ?>
                    </td>
                    <td>
                    <?php
                    echo $row6['cijferdocent'];
                    ?>
                    </td>
                    <td>
                    <?php
                    echo $row6['inlevermoment'];
                    ?>
                    </td>

                    <td>
                      <a href="leerling_documenten/<?php echo $row6['urlleerling'];?>" target="_blank" class="btn btn-warning">
                    <?php

                    echo $row6['urlleerling'];
                    ?>
                  </a>

                    </td>
                    <td>
                      <input type="hidden" name="firstname" value="<?php echo $row6['firstname'];?>">
                      <input type="hidden" name="lastname" value="<?php echo $row6['lastname'];?>">
                      <input type="hidden" name="cijferdocent" value="<?php echo $row6['cijferdocent']?>">
                      <input type="hidden" name="cijferleerling" value="<?php echo $row6['cijferleerling']?>">
                      <input type="hidden" name="opdrachtnaam" value="<?php echo $row6['opdrachtnaam']?>">

                    <input type='submit' name='submit' value='<?php echo $row6['vakhuiswerkleerling_id'];?>' class="btn btn-warning">

                  </td>
                    </tr>
                    <?php

                  }
                  ?>
                </form>
              </table>
          </div>
        </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
          <div class="col-lg-6">
            <h1>Leerlingen toevoegen</h1>
            <?php

            $vak_id = $_SESSION['vak_id'];

            // query welke leerlingen laat zien welke nog niet op het vak zijn ingeschreven.
            $sql4 = "SELECT leerling.leerling_id, leerling.firstname, leerling.lastname
                    FROM leerling
                    WHERE leerling.leerling_id NOT IN
                    (
                      SELECT vakleerling.leerling_id
                      FROM vakleerling
                      WHERE vakleerling.vak_id = $vak_id

                    )";


            $result4 = $conn->query($sql4);

            if ($result4->num_rows > 0)
            {

            }
            else
            {
            echo "Er zijn geen leerlingen meer";
            }

            ?>


            <form <?php echo $_SERVER['PHP_SELF']; ?> method="POST">
                  <table class='table table-hover'>
              <tr>
                <td>
                  <select name="leerling_id[]" multiple>
                    <?php
                    while($row4 = $result4->fetch_assoc())
                    {
                      echo "<option value='".$row4['leerling_id']."'>".$row4['firstname']." ".$row4['lastname']."</option>";

                    }
                    ?>
                  </select>
                  <td>
                </tr>
                <tr>
                  <td>
                    <p>Voor meerdere leerlingen houdt de CTRL toest vast(windosws) of Command (Mac).</p>
                  </td>
                </tr>
                <tr>
                  <td>
                    <input type="submit" name="submit4" value="Toevoegen" /></td>
                  </td>
                </tr>
                <input type='hidden' name='vak_id' value='<?echo $_SESSION['vak_id']?>'>
              </table>
              </form>













          </div>
          <div class="col-lg-6">
            <h1>Volgende leerlingen</h1>
            <?php
              $vak_id = $_SESSION['vak_id'];


              $sql3 = "SELECT leerling.leerling_id, leerling.firstname, leerling.lastname
                      FROM leerling, vakleerling
                      WHERE leerling.leerling_id = vakleerling.leerling_id
                      AND vakleerling.vak_id = $vak_id";
              $result3 = $conn->query($sql3);

              if ($result3->num_rows > 0)
              {

              }
              else
              {
              echo "Geen leerlingen zijn toegevoegd";
              }

              ?>
              <table class='table table-hover'>
                <tr>
                  <td>Voornaam</td>
                  <td>Achternaam</td>
                </tr>

              <?php
              while($row3 = $result3->fetch_assoc())
              {
                echo "<tr><td>";
                echo $row3['firstname'];
                echo "</td><td>";
                echo $row3['lastname'];
                echo "</td></tr>";
              }
            ?>
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
