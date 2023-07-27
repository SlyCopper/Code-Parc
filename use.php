<?php
  require 'admin/database.php';
  session_start();
  $db = Database::connect();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Parc-Informatique CGP</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="avatar.jpg" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Arsha
  * Updated: Jul 05 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">
      <span style="display: block; margin-right: 250px"><img src="avatar.jpg"  class="rounded" alt="" height="90px"></span>
      <h1 class="logo me-auto"><a href="use.php">Parc-Informatique</a></h1>
      
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="getstarted scrollto" href="http://192.168.1.2:8081/">Intranet</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <h3  class="btn-get-started scrollto">Ordinateur Portable</h3>
          <table class="table table-striped" style="margin-top: 10px; border: 1px solid black; border-radius: 25px!important">
            <thead style="border-radius: 25px!important">
              <tr>
                <th scope="col">Numero de serie</th>
                <th scope="col">Marque</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $reponse = $db -> query('SELECT ordinateur.id AS id, UPPER(ordinateur.code) as code, UPPER(ordinateur.marque) as marque FROM ordinateur WHERE category_id = 2 AND user_id IS NULL AND observation = "magasin"');
                while($data = $reponse -> fetch()){
                  echo '<tr>';
                  echo '<td>'.$data['code'].'</td>';
                  echo '<td>'.$data['marque'].'</td>';
                  echo '<td><a class= "btn btn-outline-secondary" href="take.php?ordinateur_id='.$data['id'].'&user_id='.$_SESSION['id'].'"><i class="bi   bi-cart"></i></a>
                  </td>';
                  echo '</tr>';
                }
              ;?>
            </tbody>
          </table>
          <div id="demande" style="margin-top: 50px;">
            <table class="table table-striped">
              <tbody>
                <?php
                  $reponse = $db -> prepare('SELECT id, UPPER(ordinateur.marque) as marque FROM ordinateur WHERE category_id IN (1,2) AND user_id = ? AND etat = 1');
                  $reponse -> execute(array($_SESSION['id']));
                  while($data = $reponse -> fetch()){
                    echo '<tr>';
                    echo '<td>'.$data['marque'].'</td>';
                    echo '<td>Demande En attente</td>';
                    echo '<td style="width:350px;"><a class="btn btn-outline-danger" href="annuler.php?ordinateur_id='.$data['id'].'"><i class="bi bi-x"></i></a>
                    </td>';
                    echo '</tr>';
                  }
                ;?>
              </tbody>
            </table>
          </div>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="desktop.php" class="btn-get-started scrollto">Ordinateur De Bureau</a>
            <a href="#possession" class="btn-get-started scrollto">Ordinateur En votre possession</a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills">
      <div class="container" data-aos="fade-up">
        <div class="row" id="possession">
          <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
            <img src="assets/img/skills.png" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left" data-aos-delay="100">
            <h3 style="text-align: center"><strong>Bienvenu M.<?php echo $_SESSION['nom'];?></strong></h3>
            <p style="font-size: 18px">actuellement le/les ordinateur(s) qui sont en votre possession</p>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Numero de serie</th>
                  <th scope="col">Marque</th>
                  <th scope="col">Date d'affectation</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $useComputer = $db -> prepare('SELECT ordinateur.id AS id, user.id As user_id, UPPER(ordinateur.marque) AS marque, UPPER(ordinateur.code) AS code, DATE_FORMAT(ordinateur.date_affectation,"%d/%m/%Y") AS date_affectation FROM ordinateur JOIN user ON (ordinateur.user_id = user.id) WHERE ordinateur.user_id = ? AND etat = 0 AND category_id IN (1,2)');
                  $useComputer -> execute(array($_SESSION['id']));
                  while($reponse = $useComputer -> fetch()){
                    echo '<tr>';
                    echo '<td>'.$reponse['code'].'</td>';
                    echo '<td>'.$reponse['marque'].'</td>';
                    echo '<td>'.$reponse['date_affectation'].'</td>';
                    echo '<td><a class="btn btn-outline-secondary" href="restituer.php?ordinateur_id='.$reponse['id'].'&user_id='.$_SESSION['id'].'"><i class="bi bi-laptop"></i></a>
                    </td>';
                    echo '</tr>';
                  }
                ;?>    
              </tbody>
            </table>
            <div id="restituer">
              <table class="table table-striped">
                <tbody>
                  <?php
                    $reponse = $db -> prepare('SELECT id, UPPER(ordinateur.marque) as marque FROM ordinateur WHERE category_id IN (1,2) AND user_id = ? AND etat = 2');
                    $reponse -> execute(array($_SESSION['id']));
                    while($data = $reponse -> fetch()){
                      echo '<tr>';
                      echo '<td>'.$data['marque'].'</td>';
                      echo '<td>Restitution En attente</td>';
                      echo '</tr>';
                    }
                    Database::deconnect();
                  ;?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>