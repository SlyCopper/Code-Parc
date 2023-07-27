<?php
  session_start();
  if($_SESSION['nom'] != "admin" AND $_SESSION['password'] != "ADMINPROFISC")
  {
    header('LOCATION: ../index.php');
  }
  require 'database.php';
  $db = Database::connect();
  $sqlQuery = $db -> query('SELECT count(ordinateur.id) AS nombreDemande FROM ordinateur JOIN user ON (ordinateur.user_id = user.id) WHERE category_id IN (1,2) AND etat IN (1,2)');
  $nombreDemande = $sqlQuery -> fetch();
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
      <a href="index.php" class="logo d-flex align-items-center">
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
            <span class="badge bg-primary badge-number"><?php echo $nombreDemande['nombreDemande'];?></span>
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
        <a href="index.php">
          <img src="assets/img/avatar.jpg" alt="" style="width: 100%;">
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " data-bs-target="#desktop-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-printer"></i>
          <span>Imprimante</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="desktop-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="imprimante.php">
              <i class="bi bi-circle"></i><span>En Utilisation</span>
            </a>
          </li>
          <li>
            <a href="stock-imprimante.php">
              <i class="bi bi-circle"></i><span>En Stock</span>
            </a>
          </li>
        </ul>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-projector"></i><span>Projecteur</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="projecteur.php">
              <i class="bi bi-circle"></i><span>En Utilisation</span>
            </a>
          </li>
          <li>
            <a href="projecteur-stock.php">
              <i class="bi bi-circle"></i><span>En Stock</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-laptop"></i><span>Ordinateur</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="index.php">
              <i class="bi bi-circle"></i><span>Ordinateur Desktop</span>
            </a>
          </li>
          <li>
            <a href="laptop.php">
              <i class="bi bi-circle"></i><span>Ordinateur Laptop</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Demande</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
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
      </li><!-- End Tables Nav -->
      </li><!-- End Icons Nav -->
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h4 style="color: rgb(9,1,143);"><strong>Ordinateur Gamer</strong></h4>
      <p style="border-top: 1px solid rgb(9,1,143);"></p>
    </div><!-- End Page Title -->
    <section class="section dashboard">
      <div class="col-lg-8" style="margin: 0px auto!important;width: 100%!important;">
        <div class="row">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Numero de serie</th>
                <th scope="col">Marque</th>
                <th scope="col">Utilisateur</th>
                <th scope="col">Date d'affectation</th>
                <th scope="col">Departement</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $db = Database::connect();
                $reponse = $db -> query('SELECT COUNT(ordinateur.id) AS nombre FROM ordinateur WHERE ordinateur.category_id = 2 AND user_id IS NOT NULL AND marque LIKE "%gamer%"');
                $countSql = $reponse -> fetch();
                $reponse = $db -> query('SELECT ordinateur.id AS id, UPPER(ordinateur.marque) AS marque, UPPER(ordinateur.code) AS code, UPPER(user.nom) AS user, DATE_FORMAT(ordinateur.date_affectation,"%d/%m/%Y %H:%i:%s") AS date_affectation, UPPER(departement.nom) AS departement FROM ordinateur JOIN user ON (ordinateur.user_id = user.id) JOIN departement ON (departement.id = user.departement_id) WHERE ordinateur.category_id = 2 AND marque LIKE "%gamer%" ORDER BY departement ASC');
                while($data = $reponse -> fetch()){
                  echo '<tr>';
                  echo '<td>'.$data['code'].'</td>';
                  echo '<td>'.$data['marque'].'</td>';
                  echo '<td>'.$data['user'].'</td>';
                  echo '<td>'.$data['date_affectation'].'</td>';
                  echo '<td>'.$data['departement'].'</td>';
                  echo '</tr>';
                }
              ;?>
              <tr>
                <td colspan="6"><strong>Total</strong><span style="padding-left:50%;"><strong><?php echo $countSql['nombre']; ?></strong></span></td>
              </tr>
            </tbody>
          </table>
        </div>
        <h4 style="color: rgb(9,1,143);"><strong>Ordinateur Gamer En Stock</strong></h4>
        <p style="border-top: 1px solid rgb(9,1,143);"></p>
        <div class="row">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Numero de serie</th>
                <th scope="col">Marque</th>
                <th scope="col">Derniere Utilisation</th>
                <th scope="col">Commentaire</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $reponse = $db -> query('SELECT COUNT(ordinateur.id) AS nombre FROM ordinateur WHERE ordinateur.category_id = 2 AND user_id IS NULL AND marque LIKE "%gamer%"');
                $countSql = $reponse -> fetch();
                $reponse = $db -> query('SELECT ordinateur.id, UPPER(ordinateur.code) as code, UPPER(ordinateur.marque) as marque, UPPER(ordinateur.observation) as observation, CONCAT(dernier_utilisateur, " ", DATE_FORMAT(ordinateur.date_affectation,"%d/%m/%Y %H:%i:%s")) as date_affectation FROM ordinateur WHERE category_id = 2 AND user_id IS NULL AND marque LIKE "%gamer%"');
                while($data = $reponse -> fetch()){
                  echo '<tr>';
                  echo '<td>'.$data['code'].'</td>';
                  echo '<td>'.$data['marque'].'</td>';
                  echo '<td>'.$data['date_affectation'].'</td>';
                  echo '<td>'.$data['observation'].'</td>';
                  echo '</tr>';
                }
                Database::deconnect();
              ;?>
              <tr>
                <td colspan="6"><strong>Total</strong><span style="padding-left:50%;"><strong><?php echo $countSql['nombre']; ?></strong></span></td>
              </tr>
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