<?php
include 'connection.php';
$list = "SELECT * FROM table1_columns";
$result = mysqli_query($con,$list);
session_start();
if (!isset($_SESSION['username'])) {
  # code...
  header("location: index.php");
}
$username = $_SESSION['username'];
?>
 ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Survey</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>


    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
  </head>
  <body>

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><?php echo $username; ?> </a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="logout.php">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="scholars.php">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="document.php">
              <span data-feather="file"></span>
              Documents
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="case_study.php">
              <span data-feather="shopping-cart"></span>
              Case Studies
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link  active" href="#">
              <span data-feather="users"></span>
              Surveys
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="create_survey.php">
              <span data-feather="bar-chart-2"></span>
              Create Surveey
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="view_case_study.php">
              <span data-feather="layers"></span>
              View Case Studies
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Last quarter
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Social engagement
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Year-end sale
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Survey Question</h1>

      </div>
      <?php

      $sql = "SELECT survey_type FROM assigned_survey WHERE user_name='$username'";
      $result = mysqli_query($con, $sql);
      if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
      $table_name[] = $row['survey_type'];
      //echo " table name:".json_encode($table_name);
      }
      ?>
      <h1 style="padding:10px;"> <?php echo strtoupper($table_name[0]); ?> </h1>
      <?php

      $number = count($table_name);
      if ($number==1) {
      //  echo "Number:".$number;
        $a  = "_columns";
        $table = $table_name[0].$a;
        //echo "\nTable Name:".$table;
        ?>
        <form class="" action="add_survey_data.php" method="post">

        <?php
        $sql2 = "SELECT * FROM `$table`";
        $result2 = mysqli_query($con, $sql2);
        if (mysqli_num_rows($result2) > 0) {
        // output data of each row
        //echo "Done";
        while($row2 = mysqli_fetch_assoc($result2)) {
          if($row2['columns_option']=='')
          {
            ?>
            <label for=""><?php echo $row2['columns_name']; ?></label>
            <input class="form-control" type="text" name="column_name[]">
            <input type="text" name="col_name[]" value="<?php echo $row2['columns_name']; ?>" hidden>
            <?php
          }

          else {

            $option = explode (",", $row2['columns_option']);
            //echo "done option".json_encode($option);
            $num = count($option);
            //echo "done option".json_encode($option)." ".$num;
            $i = 0;
            ?>
            <label for=""><?php echo $row2['columns_name']; ?></label>
            <select class="form-select" aria-label="Default select example" name="column_option[]">
              <option selected value="">Select Option</option>
              <?php
              while ($i < $num) {
                ?>

                <option value="<?php echo $option[$i]; ?>"><?php echo $option[$i]; ?></option>
                <?php
                ++$i;
              }
               ?>

            </select>
            <input type="text" name="opt_name[]" value="<?php echo $row2['columns_name']; ?>" hidden>
            <?php
          }
        }
      }
      }
      ?>
      <input type="text" name="table_name" value="<?php echo $table_name[0]; ?>" hidden>
      <br>
      <button type="submit" class="btn btn-primary mb-3">Submit</button>

      </form>
      <?php
        }
        else {
          echo "<h1>No Active Survey</h1> ". mysqli_error($con);
        }
       ?>
        </main>
  <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
</body>
</html>
