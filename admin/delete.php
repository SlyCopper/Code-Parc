<?php
    require 'database.php';
    $db = Database::connect();
    $sqlRequest = $db -> prepare('DELETE FROM ordinateur WHERE id = ?');
    $sqlRequest -> execute(array($_GET['id']));
    Database::deconnect();
    header('Location: index.php');
?>