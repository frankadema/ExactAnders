<?
//  Frank Adema
//  Student Stenden Emmen
//  frank.adema@student.stenden.com
//  leerlingnummer: 277665
//  Jaar: 2017
//  Afstudeeropdracht Exact Anders

//sessie starten in api
session_start();

//database connectie
$servername = "localhost";
$username = "tech_ExactAnders";
$password = "uNijm5U2d";
$databaseName = "tech_ExactAnders";

// Create connection
$conn = new mysqli($servername, $username, $password, $databaseName);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//gegevens die van gebruiker binnenkomen.
$leerlingID = $_POST['leerling_id'];
$vakID = $_POST['vak_id'];
$vakHuiswerkID = $_POST['vak_huiswerk_id'];

//query met gegevens
$sql23 = "SELECT vakhuiswerkleerling.vakhuiswerk_id, vakhuiswerkleerling.inlevermoment, vakhuiswerk.duedate, /*vakhuiswerkleerling.pastDueDate,*/ vakhuiswerkleerling.vak_id, vakhuiswerkleerling.leerling_id
FROM vakhuiswerkleerling, vakhuiswerk
WHERE vakhuiswerkleerling.vakhuiswerk_id = vakhuiswerk.vakhuiswerk_id
AND vakhuiswerkleerling.leerling_id = $leerlingID
AND vakhuiswerkleerling.vak_id = $vakID
AND vakhuiswerkleerling.vakhuiswerk_id = $vakHuiswerkID";

//vullen result.
$result23 = $conn->query($sql23);

//array aanmaken
$arrayToFill = array();

//array vullen
while($rowCount = $result23->fetch_assoc())
{
  $arrayToFill[] = $rowCount;
}

//lengte van aray
$length = count($arrayToFill);


if($length === 0){
  print '{"vakhuiswerk_id":"'.$vakHuiswerkID.'","inlevermoment":"0","vak_id":"'.$vakID.'","leerling_id":"'.$leerlingID.'"}';
  //print '{"vakhuiswerk_id":"'.$vakHuiswerkID.'","inlevermoment":"0","duedate":"2018-08-24 00:00:00","pastDueDate":"0","vak_id":"'.$vakID.'","leerling_id":"'.$leerlingID.'"}';
}else{
  //print array in json
  print json_encode($arrayToFill[$length-1]);
}
