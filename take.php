<?php
    require 'admin/database.php';
    if($_GET){
        $ordinateur_id = $_GET['ordinateur_id'];
        $user_id = $_GET['user_id'];
        $db = Database::connect();
        $reponse = $db -> prepare('SELECT ordinateur.user_id AS user_id FROM ordinateur WHERE id = ?');
        $reponse -> execute(array($ordinateur_id));
        $data = $reponse -> fetch();
        if($data['user_id'] != NULL){
            header('Location: use.php');
        }
        else{
            $reponse = $db -> prepare('UPDATE ordinateur SET user_id = ?, etat = 1, observation = NULL WHERE id = ?');
            $reponse -> execute(array($user_id,$ordinateur_id));
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
       
    }
?>