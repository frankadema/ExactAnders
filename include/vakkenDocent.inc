<?php
//kijken naar gekoppelde vakken
$docent_id = $_SESSION['docent'];

$sql1 = "SELECT vak.vak_id, vak.vaknaam, vak.vakomschrijving
        FROM vak, vakdocent, docent
        WHERE docent.docent_id = vakdocent.docent_id
        AND vakdocent.vak_id = vak.vak_id
        AND docent.docent_id =  $docent_id";

$result1 = $conn->query($sql1);

if ($result1->num_rows > 0)
{

}
else
{
  echo "Probeer opnieuw";
}
$colors = array("tegelGreen", "tegelOrange", "tegelBlue");
$index = 0;

while($rowVakken = $result1->fetch_assoc())
{
  $tileColor = $colors[$index % 3] ;// Use modolo to get an index between 0 - 3
  ?>
  <form action='vak_overzicht_aanpassen.php' method='post'>
    <!--<div class="<?php echo $tileColor?>">-->


    <?php
    $text = $rowVakken['vaknaam'];
    $output = substr($text, 0, 9);
    //  $output = substr($text, 0, -1);
    $vak = $rowVakken['vaknaam'];
    $vak_id = $rowVakken['vak_id'];
    //echo "<input type='hidden' name='submit' value='$vak'>";
    //echo $vak;
    //echo "$output\n";
    echo "  <input type='hidden' name='vak_id' value='$vak_id'>";
    echo "<input class='$tileColor' type='submit' name='submit' value='$output'>";
    //echo $rowVakken['vaknaam'];
    ?>
    <!--</div>-->
    <?php
    $index++;
    echo "</form>";
  }


  ?>
