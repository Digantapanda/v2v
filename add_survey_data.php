<?php
include 'connection.php';
session_start();
$username = $_SESSION['username'];
$sql_user_type = "SELECT user_type FROM `user_details` WHERE username = '$username'";
$result_user_type = mysqli_query($con,$sql_user_type);
while($row22 = mysqli_fetch_assoc($result_user_type)) {
$user_type = $row22['user_type'];
}
$table_name = $_POST['table_name'];
$number = count($_POST["column_name"]);
$number2 = count($_POST["column_option"]);
$number3 = count($_POST["col_name"]);
$number4 = count($_POST["opt_name"]);
$a  = "_columns";
$table = $table_name.$a;
//echo " ".$table_name." ".$table."".$state;
$sql2 = "SELECT * FROM `$table`";
$result2 = mysqli_query($con, $sql2);
if (mysqli_num_rows($result2) > 0) {
// output data of each row
//echo "Done";
while($row2 = mysqli_fetch_assoc($result2)) {

  $column[] = $row2['columns_name'];
  //$val = $_POST[$column];
  //echo json_encode($column);
}
}
$num = count($column);
if($number > 0)
 {
      for($i=0; $i<$number; $i++)
      {
           if(trim($_POST["column_name"][$i] != ''))
           {
                $column_value[] = $_POST["column_name"][$i];
                $column_title[] = $_POST["col_name"][$i];

              }
            }
          }

          if($number2 > 0)
           {
                for($i=0; $i<$number; $i++)
                {
                     if(trim($_POST["column_option"][$i] != ''))
                     {
                          $column_value[] = $_POST["column_option"][$i];
                          $column_title[] = $_POST["opt_name"][$i];
                        }
                      }


                    }

                    $test = str_replace("[","(",json_encode($column_title));
                    $test2 = str_replace("]",")",$test);
                    $test3 = str_replace('"','`',$test2);
                    $test1 = str_replace("[","(",json_encode($column_value));
                    $test12 = str_replace("]",")",$test1);
                    $test13 = str_replace('"',"'",$test12);
                    $add_data = "INSERT INTO `$table_name` $test3 VALUES $test13";
                    if (mysqli_query($con,$add_data)) {

                      echo "Sucess";
                      header("location: $user_type.php");
                    }
                    else {
                      echo mysqli_error($con);
                    }
 ?>
