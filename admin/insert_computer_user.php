<?php
    require 'database.php';
    if($_POST){
        $isuccess = true;
        $code = checkinput($_POST['code']);
        $marque = checkinput($_POST['marque']);
        $date = date('Y').'-'.date('m').'-'.date('d').' '.date('H:i:s');
        $user_id = checkinput($_POST['collaborateur']);
        $categorie = checkinput($_POST['categorie']);
        if(empty($_POST['code'])){
            $isuccess = false;
        }
        if(empty($_POST['marque'])){
            $isuccess = false;
        }
        if($isuccess){
            $db = Database::connect();
            $sqlRequest = $db -> prepare('INSERT INTO ordinateur(code,marque,user_id,category_id,date_affectation) VALUES(?,?,?,?,?)');
            $sqlRequest -> execute(array($code,$marque,$user_id,$categorie,$date));
            Database::deconnect();
            if($categorie == 1 || $categorie == 2){
                header('Location: index.php');
            }
            else
                header('Location: autre.php');
        }
    }
    function checkinput($verify){
        $verify = trim($verify);
        $verify = htmlspecialchars($verify);
        $verify = stripslashes($verify);
        return $verify;
} 
?>