<?php
    require 'database.php';
    if($_GET){
        $db = Database::connect();
        $date = date('Y').'-'.date('m').'-'.date('d').' '.date('H:i:s');
        $sqlRequest = $db -> prepare('UPDATE ordinateur SET user_id = NULL, etat = 0, date_affectation = ?, observation = "magasin" WHERE id = ?');
        $sqlRequest -> execute(array($date, $_GET['ordinateur_id']));
        header('Location: restitution.php');
    }
?>