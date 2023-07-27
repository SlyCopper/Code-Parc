<?php
  session_start();
  $error = '';
  if($_POST){
    $issucess = true;
    require 'admin/database.php';
    $db = Database::connect();
    $sqlRequest = $db -> prepare('SELECT * from user where nom = ? AND motDePasse = ?');
    $sqlRequest -> execute(array($_POST['name'], $_POST['password']));
    $data = $sqlRequest -> fetch();
    if(empty($data)){
      $error = "Le mot de passe ou le nom de l'utilisateur est incorrecte";
      $issucess = false;
      Database::deconnect();
    }
    if($issucess){
      if($data['nom']!= "admin" AND $data['password'] != "ADMINPROFISC"){
        $_SESSION['id'] = $data['id'];
        $_SESSION['nom'] = $data['nom'];
        Database::deconnect();
        header('Location: use.php');
      }
      else {
        $_SESSION['id'] = $data['id'];
        $_SESSION['nom'] = $data['nom'];
        Database::deconnect();
        header('Location: admin/index.php');
      }
    }
  }
;?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Document</title>
    <link href="https://fonts.cdnfonts.com/css/century-gothic" rel="stylesheet">
  </head>
  <body style="font-family: century-gothic">
    <div style ="text-align: center">
      <img src="avatar.jpg" alt="" style ="height: 400px">
      <form class="form-inline" action="index.php" method ="post">
        <div class="form-group" style="width: 400px; margin: 0px auto">
          <input class="form-control" type="text" name="name" placeholder="Votre nom" required>
          <br>
          <input class="form-control" type="password" name="password" placeholder="votre mot de passe" required>
          <br>
          <button  type="submit" class="btn btn-success">Se Connecter</button>
          <p style = "color: red"><?php echo $error?></p>
        </div>
      </form>
    </div>
  </body>
</html>
