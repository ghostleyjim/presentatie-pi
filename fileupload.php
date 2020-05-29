<?php
error_reporting(E_ALL);
$uploadOk = 0;
$target_dir = "presentation/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//$totalfilename = basename($_FILES["fileToUpload"]["name"] .= $imageFileType);

// Allow certain file formats
if($imageFileType != "pps") {
 verkeerdefile();
}
else{
  $uploadOk = 1;
}
 
$error_types = array(
0 => 'There is no error, the file uploaded with success',
1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
3 => 'The uploaded file was only partially uploaded',
4 => 'No file was uploaded',
6 => 'Missing a temporary folder',
7 => 'Failed to write file to disk.',
8 => 'A PHP extension stopped the file upload.',
);

if($_FILES['fileToUpload']['error']==0) {
  // process
  if ($uploadOk==1){
  if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
{
	if($imageFileType == "pps"){ 
 rename($target_file, $target_dir .= "new_presentation.pps");
  echo "powerpoint (PPS) geupload presentatie word gestart";
}
  else{
	  echo "fout in verplaatsen";
  }
}
}  
else {
  $error_message = $error_types[$_FILES['fileToUpload']['error']];
  echo $error_message . "<br>";
  echo "het gaat allemaal mis";
}
header( "refresh:3; url=index.html");
}


function verkeerdefile(){
  echo "alleen bestanden die eindigen op pps <br> <b>bij opslaan klik op opslaan als en selecteer dan opslaan als type pps</b>";
  header( "refresh:6; url=index.html");
}

 // echo $target_file;
 

//   echo 'Here is some more debugging info:';
// print_r($_FILES);
?>