<?

session_start();
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

// $leerlingID = $_POST['leerling_id'];
// $vakID = $_POST['vak_id'];
// $vakHuiswerkID = $_POST['vak_huiswerk_id'];

$leerlingID = $_POST['leerling_id'];
$vakID = $_POST['vak_id'];
//$vakHuiswerkID = $_POST['vak_huiswerk_id'];

$nested = explode("_-_", $_POST['vak_huiswerk_id']);
$groep_id = $nested[0];
$vakHuiswerkID = $nested[1];



$sql23 = "SELECT vakhuiswerk.vakhuiswerk_id, vakhuiswerk.Opdrachtnaam, groepinfo.groepnaam, groepinfo.groep_id, vakhuiswerkleerling.inlevermoment
FROM groepinfo, vakhuiswerk, vakhuiswerkleerling
WHERE vakhuiswerk.vakhuiswerk_id = groepinfo.vakhuiswerk_id
AND vakhuiswerkleerling.groep_id = groepinfo.groep_id
AND groepinfo.leerling_leider = $leerlingID
AND vakhuiswerk.vak_id = $vakID
AND vakhuiswerkleerling.vakhuiswerk_id = $vakHuiswerkID
AND vakhuiswerkleerling.groep_id = $groep_id";






$result23 = $conn->query($sql23);

$arrayToFill = array();

while($rowCount = $result23->fetch_assoc())
{
  $arrayToFill[] = $rowCount;
}

$length = count($arrayToFill);

if($length === 0){
  print '{"vakhuiswerk_id":"'.$vakHuiswerkID.'","inlevermoment":"0","duedate":"2018-08-24 00:00:00","pastDueDate":"0","vak_id":"'.$vakID.'","leerling_id":"'.$leerlingID.'","groep_id":"'.$groep_id.'"}';
}else{
  print json_encode($arrayToFill[$length-1]);
}
?>
