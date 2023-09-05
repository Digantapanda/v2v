<?php
include_once("connection.php");
$number = count($_POST["name"]);
$number2 = count($_POST["option"]);
$table = $_POST["table_name"];



$exists = mysqli_query($con, "select * from `$table`");

if($exists !== FALSE)
{
   echo("This table exists");
}else{

   $result2 = mysqli_query($con, "CREATE TABLE `$table` (sr_no INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY)");
   if($result2 !== FALSE)
   {
      echo("Table Created");
   }else{
      echo("Table Not Created");
   }
}

 if($number > 0)
  {
       for($i=0; $i<$number; $i++)
       {
            if(trim($_POST["name"][$i] != ''))
            {
                 $column = $_POST["name"][$i];
                 $option = $_POST["option"][$i];

                 $sql = "ALTER TABLE `$table` ADD COLUMN `$column` VARCHAR(50)";
                 $result = mysqli_query($con, $sql);
                 if($result !== FALSE)
                 {
                   echo "\nSucessfully added the column".$column;

                  $a  = "_columns";
                  $table_name = $table.$a;
                   $exists2 = mysqli_query($con, "select * from `$table_name`");

                   if($exists2 !== FALSE)
                   {
                      echo("This column table exists");
                   }else{
                      $sql21 = "CREATE TABLE `$table_name` (columns_name VARCHAR(100),columns_option VARCHAR(200))";
                      if (mysqli_query($con,$sql21)) {
                        echo "column Table created successfully";
                      } else {
                        echo "Error creating column table: ";
                      }
                   }
                   $sql_column = "INSERT INTO `$table_name` (columns_name,columns_option) VALUES ('$column','$option')";

                  if (mysqli_query($con,$sql_column)) {
                    echo "column added in column table";
                  } else {
                    echo "Error adding data in column table: " . mysqli_error($con);
                  }

                 }else{
                    echo "column not added". mysqli_error($con);
                 }

            }
       }

 }
  else
  {
       echo "Please Retry";
  }


 ?>
