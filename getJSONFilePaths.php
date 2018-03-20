<?php

$folderPath = "./data/";
$jsonFilePaths = glob("$folderPath*.{json}", GLOB_BRACE);

// foreach filepath entry in the $jsonFilePaths add the file to the jsonfiles array
foreach ($jsonFilePaths as $arrayPos => $filePath) {

  echo "$filePath";
  echo "<br/>";
}



?>
