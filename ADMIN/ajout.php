<?php

//connexion BDD
include('../config.php');


//si formulaire inscription
if (isset($_POST['Ajout'])) {
  $num = htmlspecialchars($_POST['Numéro']);
  $nom = htmlspecialchars($_POST['nom']);
  $lieu = htmlspecialchars($_POST['Lieu']);
  $type = htmlspecialchars($_POST['Type']);
  $date = date('Y-m-d', strtotime($_POST['date']));

  //si tout les champs existe
  if (!empty($_POST['Numéro']) and !empty($_POST['nom']) and !empty($_POST['Lieu']) and !empty($_POST['Type']) and !empty($_POST['date'])) {

    $aujourdhui = date("Y-m-d");

    if( $date >= $aujourdhui ){


      $reqNum = $tria->prepare("SELECT * FROM triathlon WHERE NUM_TRIATHLON = ?");
      $reqNum->execute(array($num));
      $numexist = $reqNum->rowCount();
      if ($numexist == 0) {


          //var_dump($Num_licence, $code_ca['code_cat'] ,$nom, $prenom, $sexe, $Adresse, $date, $don['Num_club']);
          $insertmbr = $tria->prepare("INSERT INTO triathlon(NUM_TRIATHLON, CODE_TYPE_TRIATHLON, NOM_TRIATHLON, LIEU_TRIATHLON, DATE_TRIATHLON) VALUES(?, ?, ?, ?, ?)");
          $insertmbr->execute(array($num, $type ,$nom, $lieu, $date));
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
      <strong>ERREUR : Le numéro de triathlon existe déjà</strong>
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
<strong>ERREUR : La date entrée est déjâ passée !</strong>
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
<div class="modal fade" id="test">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <div class="btn_con" id="main">
        <!------------------------Partie inscription--------------------------------->
        <div id="1" class="sign-up"">
          <form action="" method="POST">
            <a class="croix" data-dismiss="modal" aria-lable="close">&times;</a>
            <h1 style="padding-bottom: 30px;">Ajout d'évènement</h1>
            <input type="text" name="Numéro" placeholder="N° de l'évènement" required>
            <input type="text" name="nom" placeholder="nom de l'évènement" required>
            <input type="text" name="Lieu" placeholder="Lieu" required>
            <select name="Type" id="Listetype">
            <option value="" disabled selected hidden>Type</option>
            <?php
                
                $infotype = $tria->query('SELECT * FROM type_triathlon');
                  
                while ($donnees = $infotype->fetch())
                {
                ?>
                  <option value="<?php echo $donnees['CODE_TYPE_TRIATHLON']; ?>"> <?php echo $donnees['LIBELLE_TYPE_TRIATHLON']; ?></option>
                <?php
                }
                  
                ?>
            </select>
            <input type="date" name="date" id="date">
            <button type="submit" name="Ajout">Ajouter</button>
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