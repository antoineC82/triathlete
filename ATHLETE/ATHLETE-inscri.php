<?php
session_start();
//connexion BDD
try {
  $tria = new PDO("mysql:host=127.0.30.1;dbname=triathlete;charset=utf8", 'root', '');
} catch (Exception $e) {
  die('Erreur : ' . $e->getMessage());
}


//-------------------nombre triathlon inscris-------------------
$triathlonsinscri = $tria->query('SELECT * FROM inscription, triathlon WHERE inscription.NUM_TRIATHLON = triathlon.NUM_TRIATHLON AND NUM_LICENCE = ' . $_SESSION['Num_licence']);
$triathlonsinscricount = $triathlonsinscri->rowCount();

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


  <div class="app-container">
    <div class="app-header">
      <div class="app-header-left">
        <span class="app-icon"></span>
        <p class="app-name">Espace Athlète</p>
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
        <a href="ATHLETE.php?Li=<?php echo $_SESSION['Num_licence']?>" class="app-sidebar-link">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
            <polyline points="9 22 9 12 15 12 15 22" />
          </svg>
        </a>
        <a href="ATHLETE-inscri.php?Li=<?php echo $_SESSION['Num_licence']?>" class="app-sidebar-link  active">
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
          <p>Inscriptions</p>
          <?php $dateaujourdhui = date("d F Y"); ?>
          <p class="time"><?php echo $dateaujourdhui; ?></p>
        </div>
        <div class="projects-section-line">
          <div class="projects-status">
            <div class="item-status">
              <span class="status-number"><?php echo $triathlonsinscricount; ?></span>
              <span class="status-type">Inscriptions</span>
            </div>
          </div>
        </div>
        <div class="project-boxes jsGridView">
          <?php
            $dateAUJ = date("Y-m-d");
            //inscriptions
            $inscri = $tria->query('SELECT * FROM inscription, triathlon WHERE inscription.NUM_TRIATHLON = triathlon.NUM_TRIATHLON AND NUM_LICENCE =' . $_SESSION['Num_licence'] . ' AND DATE_TRIATHLON >= '. $dateAUJ . ' ORDER BY DATE_TRIATHLON ASC');
          

          
          while ($inscription = $inscri->fetch()) {
            $lignedate = date('d F Y', strtotime($inscription['DATE_INSCRIPTION']));
            $lignedate2 = date('d F Y', strtotime($inscription['DATE_TRIATHLON']));
          ?>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="randomcolor.js"></script>
            <div class="project-box-wrapper">
              <div class="project-box">
                <!-- <div class="project-box-header">
                <img class="img-pro" src="../" alt="" title="">
                </div> -->
                <div class="project-box-content-header">
                  <p class="box-content-header" style="font-size:20px; padding-top:30px;">Dossard N°<?php echo $inscription['NUM_DOSSARD'] ?></p>
                  <p class="box-content-subheader" style="font-size:18px;"><?php echo $inscription['NOM_TRIATHLON'] ?></p>
                  <p class="box-content-subheader" style="font-size:18px;"><?php echo $inscription['LIEU_TRIATHLON'] ?></p>
                  <p class="box-content-subheader">Inscris le : <?php echo $lignedate ?></p>
                  <p class="box-content-subheader">Prévu le : <?php echo $lignedate2 ?></p>
                </div>
                <div class="project-box-footer" style="display: flex;justify-content:end;">
                <div class="button-supp">
                <a style="color:white;" href="supp-inscri.php?DOS=<?= $inscription['NUM_DOSSARD'] ?>"><i class="fas fa-trash"></i></a>
                  </div>
                </div>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
      </div>  
  </div>

  <script src="script.js"></script>

</body>

</html>