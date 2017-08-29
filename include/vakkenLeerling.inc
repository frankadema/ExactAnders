<?php
//kijken naar gekoppelde vakken
$leerling_id = $_SESSION['leerling'];
$sql1 = "SELECT vak.vak_id, vak.vaknaam
FROM leerling, vak, vakleerling
WHERE leerling.leerling_id = vakleerling.leerling_id
AND vakleerling.vak_id = vak.vak_id
AND vakleerling.leerling_id = $leerling_id";
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
  <form action='vak_overzicht_inzien_leerling.php' method='post'>
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
    echo "<input type='hidden' name='vak_id' value='$vak_id'>";
    echo "<input class='$tileColor' type='submit' name='submit' value='$output'>";
    //echo $rowVakken['vaknaam'];
    ?>
    <!--</div>-->
    <?php
    $index++;
    echo "</form>";
  }


  ?>
