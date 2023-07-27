<?php
    if($_POST){
        $issucess = true;
        $marque = checkinput($_POST['marque']);
        $code = checkinput($_POST['code']);
        $date = date('Y').'-'.date('m').'-'.date('d').' '.date('H:i:s');
        $observation = checkinput($_POST['observation']);
        $categorie = checkinput($_POST['categorie']);
        if(empty($code)){
            $issucess = False;
        }
        if(empty($marque)){
            $issucess = False;
        }
        if($issucess){
            require 'database.php';
            $db = Database::connect();
            $sqlRequest = $db -> prepare('INSERT INTO ordinateur(code,marque,category_id,date_affectation,observation) VALUES(?,?,?,?,?)');
            $sqlRequest -> execute(array($code,$marque,$categorie,$date,$observation));
            Database::deconnect();
            if($categorie == 1 || $categorie == 2){
                header('Location: stock-desktop.php');
            }
            else
                header('Location: imprimante.php');
        }
    }
    function checkinput($verify){
        $verify = trim($verify);
        $verify = htmlspecialchars($verify);
        $verify = stripslashes($verify);
        return $verify;
    } 
?>