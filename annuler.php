<?php
    if($_GET){
        require 'admin/database.php';
        $db = Database::connect();
        $sqlQuery = $db -> prepare('UPDATE ordinateur SET user_id = NULL,etat = 0, observation = "magasin" WHERE id = ?');
        $sqlQuery -> execute(array($_GET['ordinateur_id']));
        $sqlQuery = $db -> prepare('SELECT category_id FROM ordinateur WHERE id = ?');
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
;?>