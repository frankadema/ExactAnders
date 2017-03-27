<?php
  include ("include/connect.inc");
?>
<!--menu-->
<div class="row">
  <div class="col-lg-12">
    <nav class="navbar navbar-default">
<div class="container-fluid">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>

</div>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<ul class="nav navbar-nav">
  <?php
  if(!empty($_SESSION['docent']))
  {
  ?>
  <li><a href="#">Voortgangendocent</a></li>
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Opdrachten<span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><a href="#">Vak 1</a></li>
      <li><a href="#">Vak 1</a></li>
      <li><a href="#">Vak 2</a></li>
      <li role="separator" class="divider"></li>
      <li><a href="#">Beoordelen vak</a></li>
      <li role="separator" class="divider"></li>
      <li><a href="#">Beoordelen docent</a></li>
    </ul>
  </li>
  <?php
  }
  if(!empty($_SESSION['leerling']))
  {
  ?>
  <li><a href="#">Voortgangenleelring</a></li>
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Opdrachten<span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><a href="#">Vak 1</a></li>
      <li><a href="#">Vak 1</a></li>
      <li><a href="#">Vak 2</a></li>
      <li role="separator" class="divider"></li>
      <li><a href="#">Beoordelen vak</a></li>
      <li role="separator" class="divider"></li>
      <li><a href="#">Beoordelen docent</a></li>
    </ul>
  </li>
  <?php
  }
  if(!empty($_SESSION['administrator']))
  {
  ?>
  <li><a href="#">Instellingen</a></li>
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Docent<span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><a href="docent_aanmaken_administrator.php">Aanmaken</a></li>
      <li><a href="#">Wijzigen</a></li>
      <li><a href="#">Verwijderen</a></li>
    </ul>
  </li>
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Leerling<span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><a href="leerling_aanmaken_administrator.php">Aanmaken</a></li>
      <li><a href="#">Wijzigen</a></li>
      <li><a href="#">Verwijderen</a></li>
    </ul>
  </li>
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administrator<span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><a href="administrator_aanmaken_administrator.php">Aanmaken</a></li>
      <li><a href="#">Wijzigen</a></li>
      <li><a href="#">Verwijderen</a></li>
    </ul>
  </li>
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Vakken<span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><a href="vak_aanmaken_administrator.php">Aanmaken</a></li>
      <li><a href="#">Wijzigen</a></li>
      <li><a href="#">Verwijderen</a></li>
    </ul>
  </li>
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Beoordelingen<span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><a href="#">Docent</a></li>
      <li><a href="#">Vak</a></li>
      <li><a href="#"></a></li>
    </ul>
  </li>
  <?php
  }


  /*if($_SESSION['leerling'] == "")*/
  if(empty($_SESSION['docent'] || $_SESSION['leerling'] || $_SESSION['administrator']))
  {
    ?>
  <li>
    <form method="post"  action"<?php echo $_SERVER['PHP_SELF']; ?>" class="navbar-form navbar-left" role="login">
      <div class="form-group">
        <input type="text" class="form-control" name="username" id="username" placeholder="Gebruikersnaam">
        <input type="password" class="form-control" name="password" id="password" placeholder="Wachwoord">

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
  if(!empty($_SESSION['docent']) || !empty($_SESSION['leerling']) || !empty($_SESSION['administrator']))
  {
    if(isset($_POST['uitloggen']))
    {
      session_destroy();
      header( "refresh:0;url=index.php" );
    }
  ?>

  <form method="post"  action"<?php echo $_SERVER['PHP_SELF']; ?>" class="navbar-form navbar-left" role="login">
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

if(isset($_POST['submit']))
{
  $type = $_POST['usertype'];
  if($type == 1)
  {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = hash('sha256', $password);//sha256

    $sql = "SELECT leerling_id, firstname, lastname, username FROM leerling WHERE username = '$username' AND password = '$password' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
        // output data of each row
        while($row = $result->fetch_assoc())
        {
            //echo "id: " . $row["leerling_id"]. " - naam: " . $row["firstname"]. " " . $row["lastname"]. " ". $row['username']. "<br/>";
            echo "U wordt doorgestuurd.";
            $_SESSION['leerling'] = $row['leerling_id'];
            header( "refresh:0;url=index_leerling.php" );
            }
    }
    else
    {
        echo "Probeer opnieuw";
    }
  }
  if($type == 2)
  {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = hash('sha256', $password);//sha256

    $sql = "SELECT docent_id, firstname, lastname, username FROM docent WHERE username = '$username' AND password = '$password' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
        // output data of each row
        while($row = $result->fetch_assoc())
         {
            //echo "id: " . $row["docent_id"]. " - naam: " . $row["firstname"]. " " . $row["lastname"]. " ". $row['username']. "<br/>";
            echo "U wordt doorgestuurd.";
            $_SESSION['docent'] = $row['docent_id'];
            header( "refresh:0;url=index_docent.php" );

        }
    }
    else
    {
        echo "Probeer opnieuw";
    }
  }
  if($type == 3)
  {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = hash('sha256', $password);//sha256

    $sql = "SELECT administrator_id, firstname, lastname, username FROM administrator WHERE username = '$username' AND password = '$password' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
        // output data of each row
        while($row = $result->fetch_assoc())
        {
            //echo "id: " . $row["administrator_id"]. " - naam: " . $row["firstname"]. " " . $row["lastname"]. " ". $row['username']. "<br/>";
            echo "U wordt doorgestuurd.";
            $_SESSION['administrator'] = $row['administrator_id'];
            header( "refresh:0;url=index_administrator.php" );
        }
    }
    else
    {
        echo "Probeer opnieuw";
    }
  }
}
?>
