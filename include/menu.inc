<?php
//  Frank Adema
//  Student Stenden Emmen
//  frank.adema@student.stenden.com
//  leerlingnummer: 277665
//  Jaar: 2017
//  Afstudeeropdracht Exact Anders

//connectie met database opzetten
include ("include/connect.inc");
?>
<!--menu-->
<div class="row">
  <div class="col-lg-12">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

        </div>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <?php
            //gebruiker = docent + eigen menustructuur
            //check als sessie van docent gevuld is
            if(!empty($_SESSION['docent']))
            {
              ?>
              <li><a href="index_docent.php">Startpagina</a></li>
              <li class="dropdown">
                <a href="vak_docent.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Vakken<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="vak_docent.php">Vakken</a></li>

                </ul>
              </li>
              <li><a href="leerling_info_inzien_docent.php">Leerlingen</a></li>
              <?php
            }
            //gebruiker = leerling + eigen menustructuur
            //check als sessie van leerling gevuld is
            if(!empty($_SESSION['leerling']))
            {
              ?>
              <li><a href="index_leerling.php">Startpagina</a></li>
              <!--<li><a href="#">Voortgang</a></li>-->
              <li><a href="vakken_leerling.php">Vakken</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Beoordelen<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="beoordeelDocent.php">Docenten</a></li>
                  <li><a href="beoordeelVak.php">Vakken</a></li>
                </ul>
              </li>
              <?php
            }
            //gebruiker = administrator + eigen menustructuur
            //check als sessie van administrator gevuld is
            if(!empty($_SESSION['administrator']))
            {
              ?>
              <li><a href="index_administrator.php">Startpagina</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Docent<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="docent_aanmaken_administrator.php">Aanmaken</a></li>
                  <li><a href="docent_aanpassen_administrator.php">Wijzigen</a></li>
                  <!--<li><a href="docent_verwijderen_administrator.php   ">Verwijderen</a></li>-->
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Leerling<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="leerling_aanmaken_administrator.php">Aanmaken</a></li>
                  <li><a href="leerling_aanpassen_administrator.php">Wijzigen</a></li>

                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administrator<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="administrator_aanmaken_administrator.php">Aanmaken</a></li>
                  <li><a href="administrator_aanpassen_administrator.php">Wijzigen</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Vakken<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="vak_aanmaken_administrator.php">Aanmaken</a></li>
                  <li><a href="vak_aanpassen_administrator.php">Wijzigen</a></li>

                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Beoordelingen<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="docent_beoordelen_administrator.php">Docent</a></li>
                  <li><a href="vak_beoordelen_administrator.php">Vak</a></li>
                </ul>
              </li>
              <?php
            }

            //gebruiker = geen van allen ingelogd, basispagina + eigen menustructuur
            // in dit menu kan worden ingelogd als leerling, docent en administrator.
            // leerling inloggen gaat verder op regel:       169
            // docent inloggen gaat verder op regel:         203
            // administrator inloggen gaat verder op regel:  238

            //check als sessies nog leeg zijn
            if(empty($_SESSION['docent'] || $_SESSION['leerling'] || $_SESSION['administrator']))
            {
              ?>
              <li>
                <form method="post"  action"<?php echo $_SERVER['PHP_SELF']; ?>" class="navbar-form navbar-left" role="login">
                  <div class="form-group">
                    <input type="text" class="form-control" name="username" id="username" placeholder="Gebruikersnaam">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Wachtwoord">

                    <select name="usertype" class="form-control" id="type">
                      <option value="1">Leerling</option>
                      <option value="2">Docent</option>
                      <option value="3">Overig</option>
                    </select>
                  </div>
                  <button type="submit" name="submit" class="btn btn-default">Verder</button>
                </form>
              </li>
              <?php
            }
            //Als leerling, docent of administrator zijn ingelogd keuze geven om uit te loggen.
            if(!empty($_SESSION['docent']) || !empty($_SESSION['leerling']) || !empty($_SESSION['administrator']))
            {
              //Als op knop uitloggen is geklikt wordt de sessie geleegd en is het niet meer mogelijk om zonder opnieuw in te loggen gebruik te kunnen maken van het systeem.
              if(isset($_POST['uitloggen']))
              {
                //sessie opheven
                session_destroy();
                //doorsturen naar startpagina van Exact Anders.
                /*header( "refresh:1;url=index.php" );
                header( "refresh:0;url=index.php" );*/
                ?>
                <script language="javascript">
                window.location.href = "index.php"
                </script>
                <?php
              }
              ?>
              <form method="post" action"<?php echo $_SERVER['PHP_SELF']; ?>" class="navbar-form navbar-left" role="login">
                <button type="submit" name="uitloggen" class="btn btn-default">Uitloggen</button>
              </form>
              <?php
            }
            ?>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </div>
</div>
<!--menu-end-->

<?php
//als er een gebruikersnaam + wachtwoord + gebruikersrol wordt ingevoerd en gekozen worden hier de keuzmomenten uitgevoerd voor leerling, docent en administrator.
if(isset($_POST['submit']))
{
  //als gebruiker leerling is
  $type = $_POST['usertype'];
  if($type == 1)
  {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $salt = "L_E_E_R_L_I_N_G-10#exactanders";
    //salt password (username en email mogen niet veranderd worden tijdens gebruik van systeem)
    $password = hash('sha256', $salt.$password);//sha256
    // dubbele hash om het kraken van wachtwoord te minimaliseren.
    $password = hash('sha256', $salt.$password);


    $sql = "SELECT leerling_id, firstname, lastname, username FROM leerling WHERE username = '$username' AND password = '$password' AND DATEDIFF(einddatum, CURRENT_DATE()) >0 AND DATEDIFF(CURRENT_DATE(), startdatum) >=0 LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
      //output
      while($row = $result->fetch_assoc())
      {
        echo "U wordt doorgestuurd.";
        //sessie leerling vullen.
        $_SESSION['leerling'] = $row['leerling_id'];
        //doorsturen.
        header( "refresh:0;url=index_leerling.php" );
      }
    }
    else
    {
      //als inloggen niet werkt
      echo "Probeer opnieuw of neem contact op met de administrator van dit systeem.";
    }
  }

  //als gebruiker docent is
  if($type == 2)
  {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $salt = "D_O_C_E_N_T-10#exactanders";
    //salt password (username en email mogen niet veranderd worden tijdens gebruik van systeem)
    $password = hash('sha256', $salt.$password);//sha256
    // dubbele hash om het kraken van wachtwoord te minimaliseren.
    $password = hash('sha256', $salt.$password);

    $sql = "SELECT docent_id, firstname, lastname, username FROM docent WHERE username = '$username' AND password = '$password' AND DATEDIFF(einddatum, CURRENT_DATE()) >0 AND DATEDIFF(CURRENT_DATE(), startdatum) >=0 LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
      // output d
      while($row = $result->fetch_assoc())
      {
        echo "U wordt doorgestuurd.";
        //sessie docent vullen.
        $_SESSION['docent'] = $row['docent_id'];
        //doorsturen
        header( "refresh:0;url=index_docent.php" );

      }
    }
    else
    {
      //als inloggen niet lukt.
      echo "Probeer opnieuw of neem contact op met de administrator van dit systeem.";
    }
  }

  //als gebruiker administrator is
  if($type == 3)
  {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $salt = "A_D_M_I_N_I_S_T_A_T_O_R-10#exactanders";
    //salt password (username en email mogen niet veranderd worden tijdens gebruik van systeem)
    $password = hash('sha256', $salt.$password);//sha256
    //dubbele hash + salt
    $password = hash('sha256', $salt.$password);

    $sql = "SELECT administrator_id, firstname, lastname, username FROM administrator WHERE username = '$username' AND password = '$password' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
      // output
      while($row = $result->fetch_assoc())
      {
        echo "U wordt doorgestuurd.";
        //sessie administrator vullen
        $_SESSION['administrator'] = $row['administrator_id'];
        //doorsturen naar pagina.
        header( "refresh:0;url=index_administrator.php" );
      }
    }
    else
    {
      //fout bij inloggen.
      echo "Probeer opnieuw of neem contact op met de administrator van dit systeem.";
    }
  }
}
?>
