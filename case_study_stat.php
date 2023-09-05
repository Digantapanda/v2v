<?php
     include('connection.php');
     session_start();
     if (!isset($_SESSION['username'])) {
       # code...
       header("location: index.php");
     }
     $username = $_SESSION['username'];


    $case_study_title = $_POST['case_study_title'];
    $case_study_description = $_POST['case_study_comment'];
    $state = $_POST['state'];
    $block = $_POST['country'];

    //to prevent from mysqli injection
    $username = stripcslashes($username);
    $block = stripcslashes($block);
    $case_study_title = stripcslashes($case_study_title);
    $case_study_description = stripcslashes($case_study_description);
    $username = mysqli_real_escape_string($con, $username);
    $case_study_title = mysqli_real_escape_string($con, $case_study_title);
    $case_study_description = mysqli_real_escape_string($con, $case_study_description);
    $block = mysqli_real_escape_string($con, $block);




        //image upload

        $target_dir = "case study/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
          $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
          if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
          } else {
            echo "File is not an image.";
            $uploadOk = 0;
          }
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }



        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $sql3 = "INSERT INTO `case_study`(`case_study_title`, `case_study_description`, `image`, `status`, `state`, `author`, `block`) VALUES ('$case_study_title', '$case_study_description', '$target_file', 'private', '$state', '$username', '$block')";
            if(mysqli_query($con, $sql3)== 1)
            {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            header("location: case_study.php");
          }
          else {
          echo "complaint not added". mysqli_error($con);
          }
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }
        mysqli_close($con);


?>
