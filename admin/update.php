<?php
    require 'database.php'; 
    if(!empty($_GET['id'])){
        $id = checkinput($_GET['id']);
        $statement = Database::connect();
        $sqlRequest = $statement -> prepare('SELECT id,code,marque,user_id FROM ordinateur WHERE id = ?');
        $sqlRequest -> execute(array($id));
        $data = $sqlRequest -> fetch();
        Database::deconnect();
    }

    if($_POST){
        $collaborateur = checkinput($_POST['collaborateur']);
        $code =  checkinput($_POST['code']);
        $marque = checkinput($_POST['marque']);
        $observation = checkinput($_POST['observation']);
        $date = $date = date('Y').'-'.date('m').'-'.date('d').' '.date('H:i:s');
        if($collaborateur != "aucun" && $observation == "aucune"){
            $statement = Database::connect();
            $sqlRequest = $statement -> prepare('SELECT id FROM user WHERE id = ?');
            $sqlRequest -> execute(array($collaborateur));
            $user_id = $sqlRequest -> fetch();
            $sqlRequest = $statement -> prepare('UPDATE ordinateur SET code = ?, marque =?, user_id = ?, date_affectation = ?, observation = ? WHERE id = ?');
            $observation = NULL;
            $sqlRequest  -> execute(array($code,$marque,$user_id['id'],$date,$observation,$_POST['id']));
            Database::deconnect();
            header('Location: index.php');
        }
        else{
            $statement = Database::connect();
            $sqlRequest = $statement -> prepare('UPDATE ordinateur SET code = ?, marque =?, user_id= ?, date_affectation = ?, observation = ? WHERE id = ?');
            $user_id = NULL;
            $sqlRequest  -> execute(array($code,$marque,$user_id,$date,$observation,$_POST['id']));
            Database::deconnect();
            header('Location: index.php');
        }
        
    }
    function checkinput($verify){
        $verify = trim($verify);
        $verify = htmlspecialchars($verify);
        $verify = stripslashes($verify);
        return $verify;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>Informatique</title>
</head>
<body>
    <div class="wrapper">
        <div id="content-wrapper" class="bg-white d-flex flex-column" style="margin-left:22%!important;">
            <div class="mb-5">
                <div id="content" class="bg-white mb-5">
                    <div class="container"  style="margin-top: 40px;">
                        <h3 style="text-align: center"><strong>Modification</strong></h3>
                        <div class="row">
                            <div class="col">
                                <form action="update.php" method="post" style="width: 800px; margin: 0px auto;">
                                    <div class="form-group">
                                        <input type="hidden" name="id" id="id" class="form-control" value=<?php echo "".$data['id'];?>>
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="observation">Observation</label>
                                        <select class="form-select" name="observation" id="observation">
                                            <option value="aucune">Aucune</option>
                                            <option value="magasin">MAGASIN</option>
                                            <option value="defectueux">DEFECTUEUX</option>
                                            <option value="En Utilisation">En Utilisation</option>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="sr-only" for="collaborateur">Collaborateur</label>
                                        <select class="form-select" id="collaborateur" name="collaborateur">
                                            <option value="aucun">Aucun</option>
                                            <?php
                                                $db = Database::connect();
                                                $reponse = $db -> query('SELECT id, UPPER(nom) AS nom FROM user');
                                                while($user = $reponse -> fetch()){
                                                    if($data['user_id'] == $user['id']){
                                                        echo '<option selected value="'.$user["id"].'">'.$user['nom'].'</option>';
                                                    }
                                                    else{
                                                        echo '<option value="'.$user["id"].'">'.$user['nom'].'</option>';
                                                    }
                                                }
                                                Database::deconnect();
                                            ;?>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="code">Numero de serie</label>
                                        <input type="text" name="code" id="code" class="form-control" value="<?php echo $data['code'];?>">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="marque">Marque</label>
                                        <input type="text" name="marque" id="marque" class="form-control" <?php echo 'value="'.$data['marque'].'"';?>>
                                    </div>
                                    <br>
                                    <div style="float: right">
                                        <button type="submit" class="btn btn-success" style="margin-bottom: 15px">Enregistre</button>
                                        <p style="display: inline-block" class="btn btn-secondary"><a href="index.php" style="color: #fff; text-decoration: none;">Annuler</a></p>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>