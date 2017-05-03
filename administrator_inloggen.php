<html>
<head>
  <title></title>
</head>
<body>
  <?php
    //include database connectie
    include ("include/connect.inc");

    echo"<h1>Administrator inloggen</h1>";
    $form_verstuurd = 0;
    if(isset($_POST['submit']))
    {
      if(empty($_POST['username']) OR empty($_POST['password']))
      {
        echo "<h3>Vul de gegevens compleet in </h3>";
        echo "<FORM><INPUT Type='button' VALUE='terug naar invoerscherm' onClick='history.go(-1);return true;'></FORM>";
        $form_verstuurd++;
      }
      else
      {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password = hash('sha256', $password);//sha256

/*
        $sql = "SELECT administrator_id FROM administrator WHERE username = '$username' and passoword = '$password'";
        $result = mysqli_query($databaseName,$sql);*/

        $sql = "SELECT administrator_id, firstname, lastname, username FROM administrator WHERE username = '$username' AND password = '$password' LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "id: " . $row["administrator_id"]. " - naam: " . $row["firstname"]. " " . $row["lastname"]. " ". $row['username']. "<br/>";
                echo "U wordt doorgestuurd naar de administrator pagina.";
            }
        } else {
            echo "Mislukt";
        }

      }
    }

  ?>
    <form action"<?php echo $_SERVER['PHP_SELF']; ?>" method='post'>
  <?php
if($form_verstuurd == 0)
  {
    echo "
       <table>
          <tr>
            <td>Gebruikersnaam</td>
            <td>:</td>
            <td><input type='text' name='username'></td>
          </tr>
          <tr>
            <td>Wachtwoord</td>
            <td>:</td>
            <td><input type='password' name='password'></td>
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

include('include/close.inc');
  ?>


</body>
</html>
