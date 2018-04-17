<?php

// open the file
$filePath = "./saved/" . "combinedFile.json";
$openFile = file_get_contents("$filePath");
// make sure the file has been opened properly
if ($openFile === false) {
  echo "File '$filePath' not found, use the 'Combine and Save' Button then try again";
}

// return the file
echo $openFile;

//////////// code for getting all the event names inside this php
// // decode the json file
// $storeFileData = json_decode($openFile, true);
//
// // loop through the file and echo out the event keys
// function GetEventKeys($arrayToSearch)
// {
//   $returnArray = false; // if we dont get any keys from the passed array then we return false
//
//   // loop through the passed array
//   foreach ($arrayToSearch as $key => $value) {
//     // if value is an array, then we can get its key for outputing
//     if (is_array($value))
//     {
//       // check if the key is just the int number for current value in the array of that key, if not output it as just the value name
//       if (!is_int($key))
//       {
//             //echo "<b>$key</b><br/>";
//             $returnArray[] = $key;
//       }
//     }
//   }
//
//   return $returnArray;
// }
//
// $EventKeys = GetEventKeys($storeFileData);
//
// if ($EventKeys != false) {
//   foreach ($EventKeys as $key => $value) {
//     echo "$value<br/>"; // test output making sure we have all keys
//   }
// }


// close the file
fclose($openFile);

?>
