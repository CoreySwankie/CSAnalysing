<?php

// get the file from the ajax call
if (isset($_GET['PassedFilePath'])) {
  $filePath = $_GET['PassedFilePath'];
}
else {
  echo "data not found";
}

// open the file
$openFile = file_get_contents("$filePath");
// make sure the file has been opened properly
if ($openFile === false) {
  echo "File '$filePath' not found, use the 'Combine and Save' Button then try again";
}
// decode the json file
$storeFileData = json_decode($openFile, true);

// set up iterator for the json file
//$jsonIterator = new RecursiveIteratorIterator( new RecursiveArrayIterator($storeFileData), RecursiveIteratorIterator::SELF_FIRST);

// loop through the file and echo

function OutputJSONArrays($arrayToOutputValues)
{
  // loop through the passed array
  foreach ($arrayToOutputValues as $key => $value) {
    // if value is an array
    if (is_array($value))
    {
      // check if the key is just the int number for current value in the array of that key, if not output it as just the value name
      if (!is_int($key))
      {
            echo "<b>$key</b><br/>";
      }
      else { // otherwise its an entry in the array of values so show a header for that
        echo "<b><i>Entry: $key</i></b><br/>";
      }

      //  recursive array so redo the function but increase the number of the array value for displaying
      OutputJSONArrays($value);
    }
    else
    {
      echo "&nbsp$key: $value<br/>";
    }
  }
}

OutputJSONArrays($storeFileData);


// close the file
fclose($openFile);

?>
