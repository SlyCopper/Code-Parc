<?php
    require 'admin/database.php';
    if($_GET){
        $ordinateur_id = $_GET['ordinateur_id'];
        $user_id = $_GET['user_id'];
        $db = Database::connect();
        $sqlQuery = $db -> prepare('SELECT nom FROM user WHERE id = ?');
        $sqlQuery -> execute(array($user_id));
        $data = $sqlQuery -> fetch();
        $sqlQuery = $db -> prepare('UPDATE ordinateur SET dernier_utilisateur = ?, etat = 2 WHERE id = ?');
        $sqlQuery -> execute(array($data['nom'],$ordinateur_id));
        $sqlQuery = $db -> prepare('SELECT category_id FROM ordinateur WHERE ordinateur.id = ?');
        $sqlQuery -> execute(array($ordinateur_id));
        $data = $sqlQuery -> fetch();
        Database::deconnect();
        if($data['category_id'] == 2){
            header('Location: use.php');
        }
        else{
            header('Location: desktop.php');
        }
    }
?>