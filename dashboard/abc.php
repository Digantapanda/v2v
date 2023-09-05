<?php
include '../connection.php';
function calculateMeanMedianMode($arr) {
	$n = count($arr);

	// Calculate the mean
	$sum = array_sum($arr);
	$mean = $sum / $n;

	// Calculate the median
	sort($arr);
	$mid = floor($n / 2);
	$median = ($n % 2 == 0) ? (($arr[$mid-1] + $arr[$mid]) / 2) : $arr[$mid];

	// Calculate the mode
	$count = array_count_values($arr);
	arsort($count);
	$mode = array_keys($count)[0];

	// Return an associative array with the results
	return array(
		"mean" => $mean,
		"median" => $median,
		"mode" => $mode
	);
}
$list = "SELECT * FROM table1_columns";
$result = mysqli_query($con,$list);

 ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Dashboard Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">



    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

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
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">User name</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="#">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file"></span>
              Orders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="shopping-cart"></span>
              Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="users"></span>
              Customers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="bar-chart-2"></span>
              Reports
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Integrations
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
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>

      <h2>Table Section</h2>
      <div class="table-responsive">
    <form class="" action="abc.php" method="post">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <?php
               while($row = mysqli_fetch_assoc($result)) {
                 $column[] = $row['column_name'];
                     ?>
                     <th><input type='checkbox' name='check[]' value='<?php echo $row['column_name']; ?>'><?php echo $row['column_name']; ?></th>
                   <?php } ?>
            </tr>
          </thead>
          <tbody>
            <?php
                  $num = count($column);
                 $list2 = "SELECT * FROM table1";
                 $result2 = mysqli_query($con,$list2);
                   while($row2 = mysqli_fetch_assoc($result2)){
                          echo "<tr>";
                          for ($i=0; $i < $num; $i++) {
                             echo "<td>". $row2[$column[$i]] ."</td>";
                          }


                          echo "</tr>";
                      }
                          ?>
          </tbody>
        </table>
      </div>
      <div class="d-grid gap-2 col-6 mx-auto">
  <input type="submit" name="submit" value="submit" class="btn btn-primary">
</form>
</div>
      <h2>Result Section</h2>
      <div class="table-responsive">
        <?php

        if (isset($_POST['submit'])) {

          if (isset($_POST['check'])) {
            $colm = $_POST['check'];

          }
        }
        $num1 = count($colm);

         ?>
        <table class="table table-striped table-sm">
            <tr>
              <th>Operation</th>
    <?php
    for ($i=0; $i < $num1; $i++) {
       echo "<th>". $colm[$i] ."</th>";
    }
     ?>
  </tr>
  <tr>
    <td>Mean</td>
    <?php
    for ($i=0; $i < $num1; $i++) {
    $result3 = mysqli_query($con,$list2);
      while($row3 = mysqli_fetch_assoc($result3)){

           $arr[$i][]=$row3[$colm[$i]];
        }

      }
        for ($j=0; $j < $num1; $j++) {
      $results = calculateMeanMedianMode($arr[$j]);
      echo "<td>". ceil($results['mean']*100)/100 ."</td>";
    }
     ?>
  </tr>
  <tr>
    <td>Median</td>
    <?php
    for ($i=0; $i < $num1; $i++) {
    $result3 = mysqli_query($con,$list2);
      while($row3 = mysqli_fetch_assoc($result3)){

           $arr[$i][]=$row3[$colm[$i]];
        }

      }
        for ($j=0; $j < $num1; $j++) {
      $results = calculateMeanMedianMode($arr[$j]);
      echo "<td>". $results['median'] ."</td>";
    }
     ?>
  </tr>
  <tr>
    <td>Mode</td>
    <?php
    for ($i=0; $i < $num1; $i++) {
    $result3 = mysqli_query($con,$list2);
      while($row3 = mysqli_fetch_assoc($result3)){

           $arr[$i][]=$row3[$colm[$i]];
        }

      }
        for ($j=0; $j < $num1; $j++) {
      $results = calculateMeanMedianMode($arr[$j]);
      echo "<td>". $results['mode'] ."</td>";
    }
     ?>
  </tr>
</table>
</div>
    </main>
  </div>
</div>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>
