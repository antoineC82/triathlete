<?php
session_start();
//connexion BDD
try {
  $tria = new PDO("mysql:host=127.0.30.1;dbname=triathlete;charset=utf8", 'root', '');
} catch (Exception $e) {
  die('Erreur : ' . $e->getMessage());
}

//-------------------nombre total triathlon-------------------
$triathlonstotalesReq = $tria->query('SELECT * FROM triathlon');
$triathlonstotales = $triathlonstotalesReq->rowCount();

//-------------------nombre à venir triathlon-------------------
$triathlonsavenirReq = $tria->query('SELECT * FROM triathlon WHERE DATE_TRIATHLON > NOW()');
$triathlonsavenir = $triathlonsavenirReq->rowCount();


//-------------------nombre triathlon clos-------------------
$triathlonsclosReq = $tria->query('SELECT * FROM triathlon WHERE DATE_TRIATHLON < NOW()');
$triathlonsclos = $triathlonsclosReq->rowCount();

//-------------------nombre triathlon +1 mois-------------------
$date1month = date('Y-m-d', strtotime("- 1 month"));
          
$triathlonslist = $tria->prepare('SELECT * FROM triathlon WHERE DATE_TRIATHLON < ?');
  $triathlonslist->execute(array($date1month));
  $triathlons1month = $triathlonslist->rowCount();

//-------------------Triathlon-------------------

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

 <!-- IMPORT BOOTSTRAP STYLES -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


<!-- IMPORT BOOTSTRAP SCRIPTS-->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>  <!---------------------------------- icone fontawesome ---------------------------------->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">

  <!-- <link rel="stylesheet/less" type="text/css" href="styles.less" /> -->
  <link rel="stylesheet" type="text/css" href="style.css" />
  <!-- <script src="https://cdn.jsdelivr.net/npm/less@4.1.1"></script> -->
</head>

<body>
  <?php include('ajout.php'); ?>

  <div class="app-container">
    <div class="app-header">
      <div class="app-header-left">
        <span class="app-icon"></span>
        <p class="app-name">Administrateur</p>
      </div>
      <div class="app-header-right">
        <button class="mode-switch" title="mode sombre">
          <i class="far fa-moon fa-2x"></i>
        </button>
        <button class="add-btn" title="Ajouter nouveaux projet" data-toggle="modal" data-target="#test">
          <i class="fas fa-plus  fa-2x"></i>
        </button>
        <button class="notification-btn" title="Déconnexion" onclick="window.location.href='../déconnexion.php'">
          <i class="fas fa-sign-out-alt fa-2x"></i>
        </button>
        <button class="profile-btn">
          <img src="../<?php echo $_SESSION['avatar']; ?>" alt="" title="<?php echo $_SESSION['Nom']; ?>" />
          <span><?php echo $_SESSION['prenom']; ?></span>
        </button>
      </div>
    </div>
    <div class="app-content">
      <div class="app-sidebar">
        <a href="ADMIN.php?Li=<?php echo $_SESSION['Num_licence'] ?>" class="app-sidebar-link active">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
            <polyline points="9 22 9 12 15 12 15 22" />
          </svg>
        </a>
        <a href="ADMIN-uti.php?Li=<?php echo $_SESSION['Num_licence'] ?>" class="app-sidebar-link">
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
          <p>Triathlons</p>
          <?php $dateaujourdhui = date("d F Y"); ?>
          <p class="time"><?php echo $dateaujourdhui; ?></p>
        </div>
        <div class="projects-section-line">
          <div class="projects-status">
            <div class="item-status">
              <span class="status-number"><?php echo $triathlonsavenir; ?></span>
              <span class="status-type">à venir</span>
            </div>
            <div class="item-status">
              <span class="status-number"><?php echo $triathlonsclos; ?></span>
              <span class="status-type">Clos</span>
            </div>
            <div class="item-status">
              <span class="status-number"><?php echo $triathlons1month; ?></span>
              <span class="status-type">+ 1 mois</span>
            </div>
            <div class="item-status">
              <span class="status-number"><?php echo $triathlonstotales; ?></span>
              <span class="status-type">Total</span>
            </div>
          </div>
          <div class="view-actions">
            <button class="view-btn list-view" title="List View">
              <i class="fas fa-list-ul fa-lg"></i>
            </button>
            <button class="view-btn grid-view active" title="Grid View">
              <i class="fas fa-border-all fa-lg"></i>
            </button>
          </div>
        </div>
        <div class="project-boxes jsGridView">
          <?php

          $triathlonslist = $tria->prepare('SELECT * FROM triathlon WHERE DATE_TRIATHLON > ? ORDER BY DATE_TRIATHLON ASC');
            $triathlonslist->execute(array($date1month));

          while ($tri = $triathlonslist->fetch()) {
            $lignedate = date('d F Y', strtotime($tri['DATE_TRIATHLON']));
          ?>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="randomcolor.js"></script>
            <div class="project-box-wrapper">
              <div class="project-box">
                <div class="project-box-header">
                  <span><?php echo $lignedate ?></span>
                  <div class="more-wrapper">
                    <div class="dropdown">
                      <button class="project-btn-more" type="button" id="dropdownMenuButton<?php echo $tri['NOM_TRIATHLON'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-lg"></i>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo $tri['NOM_TRIATHLON'] ?>">
                        <a class="dropdown-item" href="modi-tri.php?num=<?php echo $tri['NUM_TRIATHLON']?>">Modifier</a>
                        <a class="dropdown-item" href="supp-tri.php?num=<?php echo $tri['NUM_TRIATHLON']?>">Supprimer</a>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="project-box-content-header">
                <p class="box-content-header"><?php echo $tri['NOM_TRIATHLON'] ?></p>
                <p class="box-content-subheader"><?php echo $tri['LIEU_TRIATHLON'] ?></p>
              </div>
              <?php
              $dateok = date('Y-m-d');
              $datetria = $tri['DATE_TRIATHLON'];
              $date7 = date('Y-m-d', strtotime("+ 7 days"));
              $date3 = date('Y-m-d', strtotime("+ 3 days"));
              $date1 = date('Y-m-d', strtotime("+ 1 days"));

              if ($datetria < $dateok) {
              ?>
                <div class="box-progress-wrapper">
                  <p class="box-progress-header">Terminé</p>
                  <div class="box-progress-bar">
                    <span class="box-progress" style="width: 100%; background-color: #1fdd48"></span>
                  </div>
                  <p class="box-progress-percentage">100%</p>
                </div>
              <?php
              } elseif ($datetria == $dateok) {
              ?>
                <div class="box-progress-wrapper">
                  <p class="box-progress-header">En cours</p>
                  <div class="box-progress-bar">
                    <span class="box-progress" style="width: 70%; background-color: #3b96f7"></span>
                  </div>
                  <p class="box-progress-percentage">70%</p>
                </div>
              <?php
              } elseif ($datetria >= $date1 && $datetria <= $date3) {
              ?>
                <div class="box-progress-wrapper">
                  <p class="box-progress-header">Mise en place</p>
                  <div class="box-progress-bar">
                    <span class="box-progress" style="width: 50%; background-color: #dc3545"></span>
                  </div>
                  <p class="box-progress-percentage">50%</p>
                </div>
              <?php
              } elseif ($datetria >= $date3 && $datetria <= $date7) {
              ?>
                <div class="box-progress-wrapper">
                  <p class="box-progress-header">Prochainement</p>
                  <div class="box-progress-bar">
                    <span class="box-progress" style="width: 30%; background-color: #ff942e"></span>
                  </div>
                  <p class="box-progress-percentage">30%</p>
                </div>
              <?php
              } elseif ($datetria > $date7) {
              ?>
                <div class="box-progress-wrapper">
                  <p class="box-progress-header">Publié</p>
                  <div class="box-progress-bar">
                    <span class="box-progress" style="width: 0%; background-color: #ff942e"></span>
                  </div>
                  <p class="box-progress-percentage">0%</p>
                </div>
              <?php
              }
              ?>
              <div class="project-box-footer">
                <div class="participants">
                  <?php
                  //-------------------nombre triathlon clos-------------------
                  $participantstria = $tria->query('SELECT avatar,nom FROM inscription, triathlon, athlete WHERE athlete.NUM_LICENCE = inscription.NUM_LICENCE AND inscription.NUM_TRIATHLON = triathlon.NUM_TRIATHLON AND inscription.NUM_TRIATHLON = ' . $tri['NUM_TRIATHLON']);
                  $triathlonsclos = $participantstria->rowCount();

                  while ($participants = $participantstria->fetch()) {
                  ?>
                    <img src="../<?php echo $participants['avatar']; ?>" alt="" title="<?php echo $participants['nom']; ?>">
                  <?php } ?>
                </div>
                <?php
                $datediff = strtotime(date('Y-m-d'));
                $diff = strtotime($tri['DATE_TRIATHLON']);
                $fin = ceil(abs($datediff - $diff) / 86400);

                if ($datediff < $diff) {
                ?>
                  <div class="days-left" style="color: #413933;">
                    J-<?php echo $fin ?>
                  </div>
                <?php } elseif ($datediff == $diff) { ?>
                  <div class="days-left" style="color: #413933;">
                    En cours
                  </div>
                <?php } else { ?>
                  <div class="days-left" style="color: #413933;">
                    Finis
                  </div>
                <?php } ?>
              </div>
            </div>
        </div>
      <?php
          }
      ?>

      </div>
    </div>

  </div>
  </div>

  <script src="script.js"></script>

</body>

</html>