<?php
//  Frank Adema
//  Student Stenden Emmen
//  frank.adema@student.stenden.com
//  leerlingnummer: 277665
//  Jaar: 2017
//  Afstudeeropdracht Exact Anders

// kijken als sessie docent gevuld is voor tegelmenu.
$docent_id = $_SESSION['docent'];

$sql1 = "SELECT vak.vak_id, vak.vaknaam, vak.vakomschrijving
FROM vak, vakdocent, docent
WHERE docent.docent_id = vakdocent.docent_id
AND vakdocent.vak_id = vak.vak_id
AND docent.docent_id =  $docent_id";

$result1 = $conn->query($sql1);


if ($result1->num_rows > 0)
{
  //kijken als database record weergeeft
}
else
{
  //fout bij aanmelden
  echo "Probeer opnieuw";
}

//array vullen met css namen, worden later gebruik voor tegel.
$colors = array("tegelGreen", "tegelOrange", "tegelBlue");
$index = 0;

while($rowVakken = $result1->fetch_assoc())
{
  //tegels modolo laten reguleren ivm kleuren in array.
  $tileColor = $colors[$index % 3] ;

  //als op tegel geklikt word doorsturen
  echo "<form action='vak_overzicht_aanpassen.php' method='post'>";

  //vaknaam weergeven.
  $text = $rowVakken['vaknaam'];
  //inkorten tekst ivm afmetingen tegels
  $output = substr($text, 0, 9);

  //variabelen
  $vak = $rowVakken['vaknaam'];
  $vak_id = $rowVakken['vak_id'];

  //output
  echo "<input type='hidden' name='vak_id' value='$vak_id'>";
  //tegel kleuren weergeven icm css.
  echo "<input class='$tileColor' type='submit' name='submit' value='$output'>";

  //while ophogen.
  $index++;
  //einde form
  echo "</form>";
}
?>
