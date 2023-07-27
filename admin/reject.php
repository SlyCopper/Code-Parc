<?php
    if($_GET){
        require 'database.php';
        $db = Database::connect();
        $sqlQuery = $db -> prepare('UPDATE ordinateur SET user_id = NULL, etat = 0, observation = "magasin" WHERE id = ?');
        $sqlQuery -> execute(array($_GET['ordinateur_id']));
        Database::deconnect();
        header('Location: affectation.php');
    }
;?>