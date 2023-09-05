<?php
include('connection.php');
session_start();

if (!isset($_SESSION['username'])) {
  # code...
  $user_type = "index.php";
  $sql2 = "SELECT * FROM case_study";
  $result2 = mysqli_query($con, $sql2);
}
else {
  # code...
  $username = $_SESSION['username'];
  $sql_user_type = "SELECT user_type FROM `user_details` WHERE username = '$username'";
  $result_user_type = mysqli_query($con,$sql_user_type);

  while($row22 = mysqli_fetch_assoc($result_user_type)) {
  $user_type = $row22['user_type'];
  }
  $sql2 = "SELECT * FROM case_study where author = '$username'";
  $result2 = mysqli_query($con, $sql2);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>View Case Studies</title>

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
            <a class="nav-link active" href="document.php">
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
            <a class="nav-link" href="survey.php">
              <span data-feather="users"></span>
              Surveys
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="create_survey.php">
              <span data-feather="bar-chart-2"></span>
              Create Survey
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



      <div class="row row-cols-1 row-cols-md-2 g-4" style="padding:10px;">

  <?php

      if (mysqli_num_rows($result2) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result2)) {
       ?>
       <div class="col">
         <div class="card h-100 bg-transparent border-success">
           <img src=" <?php echo $row["image"]; ?> " class="card-img-top" alt="..." style="width:200px;height:250px; margin-left: auto; margin-right: auto;">
           <div class="card-body">
             <h5 class="card-title"><?php echo $row["case_study_title"]; ?></h5>
             <p class="card-text"><?php echo $row["case_study_description"]; ?></p>
             <form class="" action="read_case_study.php" method="post">
               <input type="text" name="title" value="<?php echo $row["case_study_title"]; ?>" hidden>
               <button type="submit" name="button" class="btn btn-primary">Read More</button>
             </form>
           </div>
           <div class="card-footer border-success">
             <small class="text-muted">Last updated 3 mins ago</small>
           </div>
         </div>
       </div>
  <?php
  }
  }
  else {
    echo  mysqli_error($con);
    ?>
    </div>
  <h1 style="  margin: auto; padding: 150px;">No Case Studies Found !!!!</h1>
    <?php
  }
  mysqli_close($con);
   ?>
  </main>
  <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
</body>
</html>
