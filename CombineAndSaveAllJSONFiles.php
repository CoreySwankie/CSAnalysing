<?php

// location of the json files
$folderPath = "./data/";
// create an array of all the json files
$jsonFilePaths = glob("$folderPath*.{json}", GLOB_BRACE);

// array for all the files to be added to once decoded/flattened
$jsonFiles = array();

// foreach filepath entry in the $jsonFilePaths add the file to the jsonfiles array
foreach ($jsonFilePaths as $arrayPos => $filePath) {

  // get the file contents of the specified path
  $jsonFileContents = file_get_contents($filePath);

  // decode the jsonfile
  $jsonFile = json_decode($jsonFileContents, true);

  // add the jsonFile to the file array
  $jsonFiles[] = $jsonFile;
}

// set up iterator for the jsonfiles array
$jsonIterator = new RecursiveIteratorIterator( new RecursiveArrayIterator($jsonFiles), RecursiveIteratorIterator::SELF_FIRST);

foreach ($jsonIterator as $key => $value){
      // check if the value is an array
    if(is_array($value)) {
      // check if already in the event names array, if not add it
      if (!in_array($key, $eventNames, true)) {
        // check that the key is not an int value, this is done because with arrays within arrays we get a int value back for the number of arrays within and we just want the event name no further depth
        if (!is_int($key)) {
            $eventNames[] = $key;
        }
      }
    }
}

function ReturnFoundKey($keyLookingFor, $arraySearching, $loopNum)
{
  $returnBool = false;
  // loop through all arrays values
  foreach ($arraySearching as $key => $value) {

    // if the key we are looking for is equal to the key
    if ($key == $keyLookingFor) {

      // set the return bool to true and break since we have found the correct tag
      $returnBool = true;
      break;
    }
    // if the value is an array then search that array for the keys
    else if (is_array($value)) {
      // loop through the next array
      ReturnFoundKey($keyLookingFor, $value, $loopNum++);
    }
  }
  // return if the key was found or not.
  return $returnBool;
}

$endArray = array();
$finalJsonIterator = new RecursiveIteratorIterator( new RecursiveArrayIterator($jsonFiles), RecursiveIteratorIterator::SELF_FIRST);
// sort all the events into their respective event names
foreach ($jsonIterator as $key => $value) {

  // check that the value is an array
  if (is_array($value)) {

    // make sure its not an int so that its not the value of the array count
    if (!is_int($key)) {
      // if the key is in the end array
      if (ReturnFoundKey($key, $eventNames, 0)) {

        // save the found key
        $searchedForKey = $key;
        // if the value to add is an array of arrays // hopefully will not go deeper than this since function referancing isnt working for me
        if (is_array($value)) {
          // loop through the arrays values and add them to the end array
          foreach ($value as $key2 => $value2){
            $newArrayToAdd = $value2;
            $endArray[$searchedForKey][] = $newArrayToAdd;
          }
        }
        else { // add the single array to the end array
          $newArrayToAdd = $value;
          $endArray[$searchedForKey][] = $newArrayToAdd;
        }
      }
    }
  }
}

// encode the array to json before sending to the page
echo "<b>All json files combined and saved to ./saved/combinedFile.json</b> <br/>";
echo "<b>Displaying data saved to combinedFile.json</b> <br/>";
$exportJson = json_encode($endArray);
echo $exportJson;

// save out the file
$filePath = "./saved/" . "combinedFile.json";
$saveFile = fopen("$filePath", "w");
$txt = $exportJson;
fwrite($saveFile, $txt);
fclose($saveFile);

?>
