<?php
//  Frank Adema
//  Student Stenden Emmen
//  frank.adema@student.stenden.com
//  leerlingnummer: 277665
//  Jaar: 2017
//  Afstudeeropdracht Exact Anders


//Inlogcodes database Exact Anders
$servername = "localhost";
$username = "tech_ExactAnders";
$password = "uNijm5U2d";
$databaseName = "tech_ExactAnders";

// maken connectie
$conn = new mysqli($servername, $username, $password, $databaseName);

// Check connectie
if ($conn->connect_error)
{
  echo "Neem contact op met de administrator van dit systeem.";
  //die("Connection failed: " . $conn->connect_error);
}


/*
Direct Admin + PhpMyadmin:

Username:   tech
Password:   iRimNdGXup
*/

?>
