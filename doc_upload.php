<?php
     include('connection.php');
session_start();
if (!isset($_SESSION['username'])) {
  # code...
  header("location: index.php");
}
$username = $_SESSION['username'];
$dt = date("Y.m.d");
$target_dir = "documents/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$doc = basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "pdf" && $imageFileType != "docx" && $imageFileType != "pptx"
&& $imageFileType != "xlsx" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $sql="INSERT INTO `documents`(`doc_name`, `doc_date`, `doc_loc`, `author`, `status`) VALUES ('$doc','$dt','$target_file','$username','private')";
  if(mysqli_query($con, $sql)== 1){
    header("location: document.php");
  }} else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>
