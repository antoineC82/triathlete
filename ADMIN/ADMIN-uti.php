<?php
session_start();
//connexion BDD
include('../config.php');


//-------------------nombre total athlète-------------------
$athletetotalesReq = $tria->query('SELECT * FROM athlete');
$athletetotales = $athletetotalesReq->rowCount();

//-------------------nombre athlete benjamin-------------------
$athletebenReq = $tria->query('SELECT * FROM athlete WHERE Code_cat = 1111');
$athleteben = $athletebenReq->rowCount();


//-------------------nombre athlete Minime-------------------
$athleteminimeReq = $tria->query('SELECT * FROM athlete WHERE Code_cat = 2222');
$athleteminime = $athleteminimeReq->rowCount();

//-------------------nombre athlete Cadet-------------------
$athletecadetReq = $tria->query('SELECT * FROM athlete WHERE Code_cat = 3333');
$athletecadet = $athletecadetReq->rowCount();

//-------------------nombre athlete Junior-------------------
$athletejuniorReq = $tria->query('SELECT * FROM athlete WHERE Code_cat = 4444');
$athletejunior = $athletejuniorReq->rowCount();

//-------------------Triathlon-------------------

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <!---------------------------------- bootstrap ---------------------------------->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  <!---------------------------------- icone fontawesome ---------------------------------->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">

  
  <!-- <link rel="stylesheet/less" type="text/css" href="styles.less" /> -->
  <link rel="stylesheet" type="text/css" href="style.css" />
  <!-- <script src="https://cdn.jsdelivr.net/npm/less@4.1.1"></script> -->
</head>

<body>

<?php include('ajout-club.php'); ?>

  <div class="app-container">
    <div class="app-header">
      <div class="app-header-left">
        <span class="app-icon"></span>
        <p class="app-name">Administrateur</p>
        <div class="search-wrapper">
        <form method="POST" action="" style="width: 100%;">
          <input class="search-input" type="text" placeholder="Rechercher" style="width: 90%;" name="motcle">
          <button type="submit" name="search" style="border: none;background:none;"><i class="fas fa-search"></i></button>
          </form>
        </div>
      </div>
      <div class="app-header-right">
        <button class="mode-switch" title="mode sombre">
          <a><i class="far fa-moon fa-2x"></i></a>
        </button>
        <button class="notification-btn" title="Déconnexion" onclick="window.location.href='../déconnexion.php'">
        <i class="fas fa-sign-out-alt fa-2x"></i>
        </button>
        <button class="profile-btn">
        <img src="../<?php echo $_SESSION['avatar']; ?>" alt="" title="<?php echo $_SESSION['Nom']; ?>"/>
          <span><?php echo $_SESSION['prenom']; ?></span>
        </button>
      </div>
    </div>
    <div class="app-content">
      <div class="app-sidebar">
        <a href="ADMIN.php?Li=<?php echo $_SESSION['Num_licence']?>" class="app-sidebar-link">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
            <polyline points="9 22 9 12 15 12 15 22" />
          </svg>
        </a>
        <a href="ADMIN-uti.php?Li=<?php echo $_SESSION['Num_licence']?>" class="app-sidebar-link  active">
          <i class="far fa-user fa-lg"></i>
        </a>
        <a href="#" class="app-sidebar-link">
          <svg class="link-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="feather feather-settings" viewBox="0 0 24 24">
            <defs />
            <circle cx="12" cy="12" r="3" />
            <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z" />
          </svg>
        </a>
      </div>
      <div class="projects-section">
        <div class="projects-section-header">
          <p>Athlètes</p>
          <?php $dateaujourdhui = date("d F Y"); ?>
          <p class="time"><?php echo $dateaujourdhui; ?></p>
        </div>
        <div class="projects-section-line">
          <div class="projects-status">
            <div class="item-status">
              <span class="status-number"><?php echo $athleteben; ?></span>
              <span class="status-type">Benjamin</span>
            </div>
            <div class="item-status">
              <span class="status-number"><?php echo $athleteminime; ?></span>
              <span class="status-type">Minime</span>
            </div>
            <div class="item-status">
              <span class="status-number"><?php echo $athletecadet; ?></span>
              <span class="status-type">Cadet</span>
            </div>
            <div class="item-status">
              <span class="status-number"><?php echo $athletejunior; ?></span>
              <span class="status-type">Junior</span>
            </div>
            <div class="item-status">
              <span class="status-number"><?php echo $athletetotales; ?></span>
              <span class="status-type">Total</span>
            </div>
          </div>
        </div>
        <div class="project-boxes jsGridView">
          <?php
          if (isset($_POST['search'])) {
            $mc = $_POST['motcle'];
  
            //reqête sql en fonction de la recherche
            $rech = $tria->prepare('SELECT * FROM athlete, club , categorie WHERE athlete.CLUB = club.Num_club AND athlete.CODE_CAT = categorie.CODE_CAT AND athlete.nom LIKE ?');
            $rech->execute(array('%' . $mc . '%'));
          } else {
            //si aucune réponse, met tout
            $rech = $tria->query('SELECT * FROM athlete, club , categorie WHERE athlete.CLUB = club.Num_club AND athlete.CODE_CAT = categorie.CODE_CAT');
          }

          
          while ($tri = $rech->fetch()) {
            $lignedate = date('d F Y', strtotime($tri['DATE_NAISSANCE']));
          ?>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="randomcolor.js"></script>
            <div class="project-box-wrapper">
              <div class="project-box">
                <div class="project-box-header">
                <img class="img-pro" src="../<?php echo $tri['avatar'] ?>" alt="" title="<?php echo $tri['NOM'] ?>">
                </div>
                <div class="project-box-content-header">
                  <p class="box-content-header" style="font-size:20px;"><?php echo $tri['PRENOM'] ?> <?php echo $tri['NOM'] ?></p>
                  <p class="box-content-subheader" style="font-size:18px;"><?php echo $tri['Nom_club'] ?></p>
                  <p class="box-content-subheader" style="font-size:18px;"><?php echo $tri['LIBELLE_CAT'] ?></p>
                  <p class="box-content-subheader"><?php echo $lignedate ?></p>
                </div>
                <div class="project-box-footer" style="display: flex;justify-content:end;">
                <div class="button-supp">
                <a style="color:white;" href="supp-uti.php?id=<?= $tri['NUM_LICENCE'] ?>"><i class="fas fa-trash"></i></a>
                  </div>
                </div>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
      <div class="messages-section">
        <div class="projects-section-header">
          <p>Listes des clubs</p>
          <button class="add-btn" title="Ajouter nouveaux projet" data-toggle="modal" data-target="#ajoutclub">
          <i class="fas fa-plus  fa-2x"></i>
        </button>
        </div>
        <div class="messages">
        <?php 
  
  //reqête sql en fonction de la recherche
  $club = $tria->query('SELECT * FROM club ');

while ($clu = $club->fetch()) {
?>
          <div class="message-box">
            <div class="message-content">
              <div class="message-header">
                <div class="name"><?php echo $clu['Nom_club'] ?> <br/><?php echo $clu['Ville_club'] ?></div>
                <div class="star-checkbox">
                  <div class="name">N°<?php echo $clu['Num_club'] ?></div>
                </div>
                <div class="name"><i class="fas fa-phone-volume"></i> <?php echo $clu['tel_club'] ?></div>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
  </div>

  <script src="script.js"></script>

</body>

</html>