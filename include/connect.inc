<?php
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
?>
