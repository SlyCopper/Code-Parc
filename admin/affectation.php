<?php
  require 'database.php';
  if($_GET){
        $db = Database::connect();
        $date = date('Y').'-'.date('m').'-'.date('d').' '.date('H:i:s');
        $sqlRequest = $db -> prepare('UPDATE ordinateur SET etat = 0, date_affectation = ? WHERE id = ?');
        $sqlRequest -> execute(array($date, $_GET['ordinateur_id']));
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Parc-Informatique CGP</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

  <!-- Favicons -->
  <link href="assets/img/avatar.jpg" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/avatar.jpg" alt="" height="100%">
        <span class="d-none d-lg-block">CGP</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">


        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number"></span>
          </a><!-- End Notification Icon -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown">


        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/user-1.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">Administrateur</span>
          </a><!-- End Profile Iamge Icon -->

        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      <li>
        <a href="index.html">
          <img src="assets/img/avatar.jpg" alt="" style="width: 100%;">
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " data-bs-target="#desktop-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-grid"></i>
          <span>Demande</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="desktop-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="affectation.php">
              <i class="bi bi-circle"></i><span>Affectation</span>
            </a>
          </li>
          <li>
            <a href="restitution.php">
              <i class="bi bi-circle"></i><span>Restitution</span>
            </a>
          </li>
        </ul>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>parc-informatique</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="index.php">
              <i class="bi bi-circle"></i><span>Oridnateur</span>
            </a>
          </li>
          <li>
            <a href="stock-projecteur.php">
              <i class="bi bi-circle"></i><span>Autre</span>
            </a>
          </li>
        </ul>
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h4 style="color: rgb(9,1,143);"><strong>Liste Demande d'affectation d'oridnateur</strong></h4>
      <p style="border-top: 1px solid rgb(9,1,143);"></p>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="col-lg-8" style="margin: 0px auto!important;width: 100%!important;">
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Marque</th>
                        <th scope="col">Code</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $db = Database::connect();
                        $sqlQuery = $db -> query('SELECT ordinateur.id AS id, user.nom AS nom, ordinateur.date_affectation AS date_affectation, ordinateur.marque AS marque, ordinateur.code AS code FROM ordinateur JOIN user ON (ordinateur.user_id = user.id) WHERE etat = 1 AND category_id IN (1,2)');
                        while($data = $sqlQuery->fetch()){
                            echo '<tr>';
                            echo '<td style="margin-left: 15px">'.$data['nom'].'</td>';
                            echo '<td>'.$data['marque'].'</td>';
                            echo '<td>'.$data['code'].'</td>';
                            echo '<td>'.$data['date_affectation'].'</td>';
                            echo '<td style="width:350px;"><a class="btn btn-outline-success" href="affectation.php?ordinateur_id='.$data['id'].'"><i class="bi bi-check2"></i></a>
                            <a class="btn btn-outline-danger" href="reject.php?ordinateur_id='.$data['id'].'"><i class="bi bi-x"></i></a>
                            </td>';
                            echo '</tr>';
                        }
                        Database::deconnect();
                    ?>
                </tbody>
            </table>
        </div>

      </div><!-- End Left side columns -->

      <!-- Right side columns -->
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
   
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>