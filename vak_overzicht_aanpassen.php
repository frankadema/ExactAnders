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
  //header
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
    $_SESSION['vak_id'] = $_POST['vak_id'];
    $vak_id = $_SESSION['vak_id'];
    //  $_SESSION['vak_id'] = $vak_id;
    //$vak_id = $_SESSION['vak_id'] ;

    if(isset($_POST['submit9']))
    {
      $groepsnaam = $_POST['groepsnaam'];
      $opdracht_id = $_POST['opdracht_id'];
      //  $vak_id = $_POST['vak_id'];
      $leider = $_POST['leider_id'];

      $sql12 = "INSERT INTO tech_ExactAnders.groepinfo  (vakhuiswerk_id, groepnaam, leerling_leider)
      VALUES ('$opdracht_id', '$groepsnaam', '$leider')";
      if ($conn->query($sql12) === TRUE)
      {
        $sql20 = "SELECT groep_id
        FROM groepinfo
        WHERE vakhuiswerk_id = $opdracht_id
        AND groepnaam = '$groepsnaam'
        AND leerling_leider = $leider";
        $result20 = $conn->query($sql20);

        if ($result20->num_rows > 0)
        {
          echo "done";
          $row20 = $result20->fetch_assoc();
          $groep_id = $row20['groep_id'];

          //echo $groep_id;


          foreach ($_POST['leerling_id'] as $id)
          {
            //echo $groep_id;

            $sql21 = "INSERT INTO tech_ExactAnders.groep (leerling_id, groep_id)
            VALUES ('$id','$groep_id')";

            if ($conn->query($sql21) === TRUE)
            {
              echo "Verwerkt";
            }
            else
            {
              //echo "Error: " . $sql21 . "<br>" . $conn->error;
            }
          }

        }
        else
        {
          //  echo "Error: " . $sql20 . "<br>" . $conn->error;
        }

      }
      else
      {
        //echo "Error: " . $sql12 . "<br>" . $conn->error;
      }

    }


    if(isset($_POST['submit4']))
    {

      $vak_id = $_POST['vak_id'];
      foreach ($_POST['leerling_id'] as $id)
      {


        $sql5 = "INSERT INTO tech_ExactAnders.vakleerling (leerling_id, vak_id)
        VALUES ('$id','$vak_id')";

        if ($conn->query($sql5) === TRUE)
        {
          echo "Verwerkt";
        }
        else
        {
        //  echo "Error: " . $sql5 . "<br>" . $conn->error;
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
      //echo "Probeer opnieuw1";
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
              <input type='submit' name='submit2' value='Aanpassen' class="btn btn-warning">

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
            //echo "Er is een fout opgetreden";
          }

          ?>
          <h1>Opdrachten aanmaken</h1>

          <form enctype="multipart/form-data" <?php echo $_SERVER['PHP_SELF']; ?> method="POST">

            <table class='table table-hover'>
              <tr>
                <td>Opdrachtnaam</td>
                <td>:</td>
                <td><input type='text' name='opdrachtnaam' class='form-control'>
                  <input type='hidden' name='vak_id' value='<?echo $_SESSION['vak_id']?>'>
                </td>
              </tr>
              <tr>
                <td>Inleveren voor:</td>
                <td>:</td>
                <td><input type='date' name='duedate' class='form-control'>
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

            }

            ?>


            <h1>Opdrachten Inzien</h1>
            <table class='table table-hover'>

              <tr><td><h4>Opdrachtnaam</h4></td><td><h4>Inleveren voor</h4></td><td><h4>Open</h4></td></tr>
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
                    $dateFormatDatabase =  strtotime($row7['duedate']);
                    $dateFormatEnd = date( 'd-m-Y', $dateFormatDatabase );
                    echo $dateFormatEnd;
                    ?>
                  </td>
                  <td>
                    <a href="vak_documenten/<?php echo $row7['url'];?>" target="_blank" class="btn btn-warning">
                      <?php
                      //inzien opdrachten docent uit database
                      echo "Bekijk opdracht";
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
            $sql6 = "SELECT vakhuiswerkleerling.inleverDatum, leerling.leerling_id, leerling.firstname, leerling.lastname, vakhuiswerk.Opdrachtnaam, vakhuiswerk.duedate, vakhuiswerkleerling.inlevermoment, vakhuiswerkleerling.cijferleerling, vakhuiswerkleerling.cijferdocent, vakhuiswerkleerling.urlleerling, vakhuiswerkleerling.urldocent, vakhuiswerkleerling.vakhuiswerkleerling_id, vakhuiswerkleerling.vakhuiswerk_id
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

            }

            ?>

            <h1>Opdrachten downloaden</h1>
            <table class='table table-hover'>
              <form action='vak_overzicht_aanpassen2.php' method='post'>
                <tr><td><h4>Leerling</h4></td><td><h4>Opdracht</h4></td><td><h4>Inleverdatum</h4></td><td><h4>Leerling</h4></td><td><h4>Docent</h4></td><td><h4>Moment</h4></td><td><h4>Te laat</h4></td>
                  <td><h4>Beoordeel</h4></td></tr>
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
                        <?php
                        $teLaat = "-";
                        if($row6['duedate'] < $row6['inleverDatum'])
                        {
                          echo "Ja";
                          $teLaat = "Ja";
                        }
                        else
                        {
                          echo "-";
                        }
                        ?>
                      </td>
                      <td>
                        <input type="hidden" name="firstname" value="<?php echo $row6['firstname'];?>">
                        <input type="hidden" name="leerling_id" value="<?php echo $row6['leerling_id'];?>">
                        <input type="hidden" name="lastname" value="<?php echo $row6['lastname'];?>">
                        <input type="hidden" name="inlevermoment" value="<?php echo $row6['inlevermoment'];?>">
                        <input type="hidden" name="cijferdocent" value="<?php echo $row6['cijferdocent']?>">
                        <input type="hidden" name="cijferleerling" value="<?php echo $row6['cijferleerling']?>">
                        <input type="hidden" name="opdrachtnaam" value="<?php echo $row6['opdrachtnaam']?>">
                        <input type="hidden" name="teLaat" value="<?php echo $teLaat;?>">
                        <input type="hidden" name="vakhuiswerk_id" value="<?php echo $row6['vakhuiswerk_id']?>">
                        <input type="hidden" name="vakhuiswerkleerling_id" value="<?php echo $row6['vakhuiswerkleerling_id'];?>">


                        <input type='submit' name='submit' value='Verder' class="btn btn-warning">

                      </td>
                    </tr>
                    <?php

                  }
                  ?>
                </form>
              </table>

              <?php
              $sql9 = "SELECT vakhuiswerkleerling.urlleerling, vakhuiswerkleerling.vakhuiswerk_id, groepinfo.groepnaam, groepinfo.groep_id, vakhuiswerk.Opdrachtnaam, vakhuiswerk.duedate, vakhuiswerkleerling.cijferleerling, vakhuiswerkleerling.cijferdocent, vakhuiswerkleerling.inlevermoment, vakhuiswerkleerling.vakhuiswerkleerling_id, vakhuiswerk.Opdrachtnaam, vakhuiswerkleerling.inleverDatum
              FROM groepinfo, vakhuiswerk, vakhuiswerkleerling
              WHERE groepinfo.vakhuiswerk_id = vakhuiswerk.vakhuiswerk_id
              AND vakhuiswerk.vakhuiswerk_id = vakhuiswerkleerling.vakhuiswerk_id
              AND vakhuiswerkleerling.leerling_id = 0
              AND vakhuiswerkleerling.vak_id = $vak_id";

              $result9 = $conn->query($sql9);

              if ($result9->num_rows > 0)
              {

              }
              else
              {

              }

              ?>
              <h1>Groepsopdrachten downloaden</h1>
              <table class='table table-hover'>
                <form action='vak_overzicht_aanpassen3.php' method='post'>
                  <tr><td><h4>Groepnaam</h4></td><td><h4>Opdracht</h4></td><td><h4>Inleverdatum</h4></td><td><h4>Groepscijfer</h4></td><td><h4>Docent</h4></td><td><h4>Moment</h4></td><td><h4>Te laat</h4></td>
                    <td><h4>Beoordeel</h4></td></tr>
                    <?php
                    while($row9 = $result9->fetch_assoc())
                    {
                      ?>
                      <tr>
                        <td>
                          <?php
                          echo $row9['groepnaam'];
                          ?>
                        </td>
                        <td>
                          <?php
                          echo $row9['Opdrachtnaam'];
                          ?>
                        </td>
                        <td>
                          <?php
                          //correct dateFormatEnd
                          $dateFormatDatabase1 =  strtotime($row9['inleverDatum']);
                          $dateFormatEnd1 = date( 'd-m-Y H:i:s', $dateFormatDatabase1 );
                          echo $dateFormatEnd1;

                          ?>
                        </td>
                        <td>
                          <?php
                          echo $row9['cijferleerling'];
                          ?>
                        </td>
                        <td>
                          <?php
                          echo $row9['cijferdocent'];
                          ?>
                        </td>
                        <td>
                          <?php
                          echo $row9['inlevermoment'];
                          ?>
                        </td>
                        <td>
                          <?php
                          $teLaat = "-";

                          if($row9['duedate'] < $row9['inleverDatum'])
                          {
                            echo "Ja";
                            $teLaat = "Ja";
                          }
                          else
                          {
                            echo "-";
                            $telaat = "-";
                          }

                          ?>
                        </td>

                      </td>
                      <td>

                        <input type="hidden" name="groep_id" value="<?php echo $row9['groep_id'];?>">

                        <input type="hidden" name="groepnaam" value="<?php echo $row9['groepnaam']?>">
                        <input type="hidden" name="inlevermoment" value="<?php echo $row9['inlevermoment'];?>">
                        <input type="hidden" name="cijferdocent" value="<?php echo $row9['cijferdocent']?>">
                        <input type="hidden" name="cijferleerling" value="<?php echo $row9['cijferleerling']?>">
                        <input type="hidden" name="opdrachtnaam" value="<?php echo $row9['opdrachtnaam']?>">
                        <input type="hidden" name="vakhuiswerk_id" value="<?php echo $row9['vakhuiswerk_id']?>">
                        <input type="hidden" name="teLaat" value="<?php echo $teLaat;?>">
                        <input type="hidden" name="vakhuiswerkleerling_id" value="<?php echo $row9['vakhuiswerkleerling_id'];?>">
                        <input type='submit' name='submit' value='Verder' class="btn btn-warning">

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
              <h1>Groepsopdrachten</h1>
              <?php

              $sql2 = "SELECT vakhuiswerk.vakhuiswerk_id, vakhuiswerk.Opdrachtnaam, vakhuiswerk.omschrijving, vakhuiswerk.duedate, vakhuiswerk.url
              FROM vakhuiswerk
              WHERE vakhuiswerk.vak_id = $vak_id";

              $result2 = $conn->query($sql2);

              if ($result2->num_rows > 0)
              {

              }
              else
              {

              }


              ?>
              <form <?php echo $_SERVER['PHP_SELF']; ?> method="POST">

                <table class='table table-hover'>
                  <tr>
                    <td>Groepsnaam</td>
                    <td><input type="text" name="groepsnaam" class="form-control"/></td>
                  </tr>
                  <tr>
                    <td>Opdracht</td>
                    <td>
                      <select name="opdracht_id" class="form-control">
                        <?php
                        while($row2 = $result2->fetch_assoc())
                        {
                          echo "<option value='".$row2['vakhuiswerk_id']."'>".$row2['Opdrachtnaam']."</option>";

                        }
                        ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td>Leerlingen</td>
                    <td>
                      <?php
                      $sql8 = "SELECT leerling.leerling_id, leerling.firstname, leerling.lastname
                      FROM leerling, vakleerling
                      WHERE leerling.leerling_id = vakleerling.leerling_id
                      AND vakleerling.vak_id = $vak_id";


                      $result8 = $conn->query($sql8);

                      if ($result8->num_rows > 0)
                      {

                      }
                      else
                      {
                        echo "Er zijn geen leerlingen meer";
                      }
                      ?>
                      <select class="form-control" name="leerling_id[]" multiple >
                        <?php
                        while($row8 = $result8->fetch_assoc())
                        {
                          echo "<option value='".$row8['leerling_id']."'>".$row8['firstname']." ".$row8['lastname']."</option>";

                        }
                        ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td>Leider</td>
                    <td>
                      <?php

                      $sql9 = "SELECT leerling.leerling_id, leerling.firstname, leerling.lastname
                      FROM leerling, vakleerling
                      WHERE leerling.leerling_id = vakleerling.leerling_id
                      AND vakleerling.vak_id = $vak_id";


                      $result9 = $conn->query($sql9);

                      if ($result9->num_rows > 0)
                      {

                      }
                      else
                      {
                        echo "Er zijn geen leerlingen meer";
                      }
                      ?>

                      <select name="leider_id" class="form-control" >
                        <?php
                        while($row9 = $result9->fetch_assoc())
                        {
                          echo "<option value='".$row9['leerling_id']."'>".$row9['firstname']." ".$row9['lastname']."</option>";

                        }
                        ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>
                      <input type="submit" name="submit9" value="Toevoegen" class="btn btn-warning" /></td>

                    </td>
                  </tr>
                  <input type='hidden' name='vak_id' value='<?echo $_SESSION['vak_id']?>'>
                </table>
              </form>
            </div>
            <div class="col-lg-6">
              <h1>Groepen</h1>
              <?php
              $vak_id = $_SESSION['vak_id'];


              $sql9 = "SELECT groepinfo.groep_id, groepinfo.groepnaam, leerling.firstname, leerling.lastname
              FROM groepinfo, leerling, vakhuiswerk
              WHERE groepinfo.leerling_leider = leerling.leerling_id
              AND groepinfo.vakhuiswerk_id = vakhuiswerk.vakhuiswerk_id
              AND vakhuiswerk.vak_id = $vak_id
              ORDER BY groepinfo.groep_id ASC";
              $result9 = $conn->query($sql9);

              if ($result9->num_rows > 0)
              {

              }
              else
              {
                echo "Geen leerlingen zijn toegevoegd";
              }

              ?>
              <table class='table table-hover'>
                <tr>
                  <td>Groep</td>
                  <td>Leider</td>
                </tr>

                <?php
                while($row9 = $result9->fetch_assoc())
                {
                  echo "<tr><td>";
                  echo $row9['groepnaam'];
                  echo "</td><td>";
                  echo $row9['firstname'].' '.$row9['lastname'];
                  echo "</td></tr>";
                }
                ?>
              </table>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="col-lg-6">
              <h1>Leerlingen toevoegen aan vak</h1>
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
                      <select class="form-control" name="leerling_id[]" multiple>
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
                          <input type="submit" name="submit4" value="Toevoegen" class="btn btn-warning" /></td>
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
