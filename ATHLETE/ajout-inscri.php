
    <!---------------------------------- Début PHP ---------------------------------->
    <?php

    session_start();

    //connexion BDD
    $tria = new PDO("mysql:host=127.0.30.1;dbname=triathlete;charset=utf8", 'root', '');

    //si id (get) donc url donc voyage
    if (isset($_GET['Num']) and !empty($_GET['Num'])) {
        $Num_tri = htmlspecialchars($_GET['Num']);


        if (isset($_SESSION['Num_licence']) and !empty($_SESSION['Num_licence'])) {
          $id_athlete = $_SESSION['Num_licence'];

          if (isset($_POST['inscription'])) {

            $date = date('Y-m-d');
            $Num_doss = htmlspecialchars($_POST['Num_dossard']);

            //requête sql récuperer infos voyages
            $num_doss = $tria->prepare('SELECT NUM_DOSSARD FROM inscription WHERE NUM_DOSSARD = ?');
            $num_doss->execute(array($Num_doss));

        //config variable
        if ($num_doss->rowCount() == 0) {

                        //requête sql insérer dans reservations
                        $insertmbr = $tria->prepare("INSERT INTO inscription(NUM_DOSSARD, NUM_LICENCE, NUM_TRIATHLON, DATE_INSCRIPTION) VALUES(?, ?, ?, NOW())");
                        $insertmbr->execute(array($Num_doss, $id_athlete, $Num_tri));
                        header("Location: ATHLETE-inscri.php?Li=" . $id_athlete);
                    } else {
                        ?>

                        <!---------------------------------- alerte message ---------------------------------->
                        <div class="alert alert-danger alert-dismissible fade show">
                            <strong>ERREUR : Le Numéro de dossard est deja utilisé</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php
                    }
            }
        } else {
            die('Vous n\'êtes pas connecté');
        }
    } else {
        die('L\'article n\'existe pas');
    }
    ?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

<!---------------------------------- icone fontawesome ---------------------------------->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">

<!---------------------------------- bootstrap ---------------------------------->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  <link rel="stylesheet" href="ajout.css">
</head>
<body class="fond">


<div class="log">
      <div class="btn_con" id="main">
        

        <!------------------------Partie connexion --------------------------------->
        <div id="3" class="sign-in">
          <form action="" method="POST" style="height: 100%;">
            <h1>Inscription au triathlon N°</h1>
            <input type="text" name="Num_dossard" placeholder="Numéro de dossard" required>
            <input type="text" name="Num_licence" placeholder="N° de licence" readonly="readonly" value="<?php echo $id_athlete ?>"  required>
            <input type="text" name="Num_triathlon" placeholder="Numéro de thriathlon" readonly="readonly" value="<?php echo $Num_tri; ?>" required>
            <button type="submit" name="inscription">Valider</button>
          </form>
        </div>
      </div>
<div>
</body>
</html>