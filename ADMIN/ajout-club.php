<?php

//connexion BDD
try
{
$tria = new PDO("mysql:host=127.0.30.1;dbname=triathlete;charset=utf8", 'root', '');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}


//si formulaire inscription
if (isset($_POST['Ajout_club'])) {
  $num = htmlspecialchars($_POST['Num']);
  $nom = htmlspecialchars($_POST['nom']);
  $ville = htmlspecialchars($_POST['Ville']);
  $tel = htmlspecialchars($_POST['Tel']);

  //si tout les champs existe
  if (!empty($_POST['Num']) and !empty($_POST['nom']) and !empty($_POST['Ville']) and !empty($_POST['Tel'])) {

    
    $reqNum = $tria->prepare("SELECT * FROM club WHERE Num_club = ?");
      $reqNum->execute(array($num));
      $numexist = $reqNum->rowCount();
      if ($numexist == 0) {


          //var_dump($Num_licence, $code_ca['code_cat'] ,$nom, $prenom, $sexe, $Adresse, $date, $don['Num_club']);
          $insertmbr = $tria->prepare("INSERT INTO club(Num_club, Nom_club, Ville_Club, tel_club, Admin_crea) VALUES(?, ?, ?, ?, ?)");
          $insertmbr->execute(array($num, $nom ,$ville, $tel, '0'));
          ?>
          <!---------------------------------- alerte success ---------------------------------->
          <div class="alert alert-success alert-dismissible fade show">
            <strong>YES ! L'évènement à été ajouté</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php
        }else {
        ?>

    <!---------------------------------- alerte danger ---------------------------------->
    <div class="alert alert-danger alert-dismissible fade show">
      <strong>ERREUR : Le numéro de club existe déjà</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <?php
      }
}else {
  ?>

<!---------------------------------- alerte danger ---------------------------------->
<div class="alert alert-danger alert-dismissible fade show">
<strong>ERREUR : Veuillez remplir tout les champs</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>
<?php
}
}
?>


<!------------------------Modal de connexion/inscription --------------------------------->
<div class="modal fade" id="ajoutclub">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <div class="btn_con" id="main">
        <!------------------------Partie inscription--------------------------------->
        <div id="1" class="sign-up">
          <form action="" method="POST">
            <a class="croix" data-dismiss="modal" aria-lable="close">&times;</a>
            <h1 style="padding-bottom: 30px;">Ajout de clubs</h1>
            <input type="text" name="Num" placeholder="N° du club" required>
            <input type="text" name="nom" placeholder="nom deu club" required>
            <input type="text" name="Ville" placeholder="Ville du club" required>
            <input type="text" name="Tel" placeholder="téléphone du club" required>
            <button type="submit" name="Ajout_club">Ajouter</button>
          </form>
        </div>


        <!------------------------volet colorées --------------------------------->
        <div id="2" class="overlay-container">
            <!------------------------partie colorée gauche --------------------------------->
            <div class="overlay-left">
              <img src="IMGSVG/back.jpg">
            </div>
        </div>
      </div>
    </div>
  </div>
</div>