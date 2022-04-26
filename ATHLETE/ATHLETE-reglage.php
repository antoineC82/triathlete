<?php
session_start();
//connexion BDD
include('../config.php');

//-------------------nombre total triathlon-------------------
$triathlonstotalesReq = $tria->query('SELECT * FROM triathlon');
$triathlonstotales = $triathlonstotalesReq->rowCount();

//-------------------nombre à venir triathlon-------------------
$triathlonsavenirReq = $tria->query('SELECT * FROM triathlon WHERE DATE_TRIATHLON > NOW()');
$triathlonsavenir = $triathlonsavenirReq->rowCount();


//-------------------nombre triathlon clos-------------------
$triathlonsclosReq = $tria->query('SELECT * FROM triathlon WHERE DATE_TRIATHLON < NOW()');
$triathlonsclos = $triathlonsclosReq->rowCount();

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

  <link rel="stylesheet/less" type="text/css" href="styles.less" />

  <script src="https://cdn.jsdelivr.net/npm/less@4.1.1"></script>
</head>

<body>
  <div class="app-container">
    <div class="app-header">
      <div class="app-header-left">
        <span class="app-icon"></span>
        <p class="app-name">Administrateur</p>
      </div>
      <div class="app-header-right">
        <button class="mode-switch" title="mode sombre">
          <a><i class="far fa-moon fa-2x"></i></a>
        </button>
        <button class="add-btn" title="Ajouter nouveaux projet" data-toggle="modal" data-target="#test">
          <i class="fas fa-plus  fa-2x"></i>
        </button>
        <button class="notification-btn" title="Déconnexion" onclick="window.location.href='../déconnexion.php'">
        <i class="fas fa-sign-out-alt fa-2x"></i>
        </button>
        <button class="profile-btn">
        <img src="../<?php echo $_SESSION['avatar']; ?>" />
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
        <a href="ADMIN-uti.php?Li=<?php echo $_SESSION['Num_licence']?>" class="app-sidebar-link">
          <i class="far fa-user fa-lg"></i>
        </a>
        <a href="ADMIN-reglage.php?Li=<?php echo $_SESSION['Num_licence']?>" class="app-sidebar-link active">
          <svg class="link-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="feather feather-settings" viewBox="0 0 24 24">
            <defs />
            <circle cx="12" cy="12" r="3" />
            <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z" />
          </svg>
        </a>
      </div>
      <div class="projects-section">
        <div class="projects-section-header">
          <p>Réglages</p>
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
          while ($tri = $triathlonstotalesReq->fetch()) {
            $lignedate = date('d F Y', strtotime($tri['DATE_TRIATHLON']));
          ?>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="randomcolor.js"></script>
            <div class="project-box-wrapper">
              <div class="project-box">
                <div class="project-box-header">
                  <span><?php echo $lignedate ?></span>
                  <div class="more-wrapper">
                    <button class="project-btn-more">
                      <i class="fas fa-ellipsis-v fa-lg"></i>
                    </button>
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
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2550&q=80" alt="participant">
                    <img src="https://images.unsplash.com/photo-1503023345310-bd7c1de61c7d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MTB8fG1hbnxlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=900&q=60" alt="participant">
                    <button class="add-participant" style="color: #ff942e;">
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                  <?php
                  $datediff = strtotime(date('Y-m-d'));
                  $diff = strtotime($tri['DATE_TRIATHLON']);
                  $fin = ceil(abs($datediff - $diff) / 86400);

                  if ($datediff < $diff){
                  ?>
                  <div class="days-left" style="color: #ff942e;">
                    Fin dans <?php echo $fin ?>J
                  </div>
                  <?php }else{ ?>
                    <div class="days-left" style="color: #ff942e;">
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
      <div class="messages-section">
        <button class="messages-close">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle">
            <circle cx="12" cy="12" r="10" />
            <line x1="15" y1="9" x2="9" y2="15" />
            <line x1="9" y1="9" x2="15" y2="15" />
          </svg>
        </button>
        <div class="projects-section-header">
          <p>Messagerie</p>
        </div>
        <div class="messages">
          <div class="message-box">
            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2550&q=80" alt="profile image">
            <div class="message-content">
              <div class="message-header">
                <div class="name">Stephanie</div>
                <div class="star-checkbox">
                  <input type="checkbox" id="star-1">
                  <label for="star-1">
                    <i class="far fa-star"></i>
                  </label>
                </div>
              </div>
              <p class="message-line">
                ça marche frérot !🥳
              </p>
              <p class="message-line time">
                12, Déc
              </p>
            </div>
          </div>
          <div class="message-box">
            <img src="https://images.unsplash.com/photo-1600486913747-55e5470d6f40?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2550&q=80" alt="profile image">
            <div class="message-content">
              <div class="message-header">
                <div class="name">Mark</div>
                <div class="star-checkbox">
                  <input type="checkbox" id="star-2">
                  <label for="star-2">
                    <i class="far fa-star"></i>
                  </label>
                </div>
              </div>
              <p class="message-line">
                Okay, merci de ta réponse !
              </p>
              <p class="message-line time">
                12, Déc
              </p>
            </div>
          </div>
          <div class="message-box">
            <img src="https://images.unsplash.com/photo-1543965170-4c01a586684e?ixid=MXwxMjA3fDB8MHxzZWFyY2h8NDZ8fG1hbnxlbnwwfDB8MHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=900&q=60" alt="profile image">
            <div class="message-content">
              <div class="message-header">
                <div class="name">David</div>
                <div class="star-checkbox">
                  <input type="checkbox" id="star-3">
                  <label for="star-3">
                    <i class="far fa-star"></i>
                  </label>
                </div>
              </div>
              <p class="message-line">
                Salut Marc, ça va ? tu vas à Esicad demain ?
              </p>
              <p class="message-line time">
                12, Déc
              </p>
            </div>
          </div>
          <div class="message-box">
            <img src="https://images.unsplash.com/photo-1533993192821-2cce3a8267d1?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MTl8fHdvbWFuJTIwbW9kZXJufGVufDB8fDB8&ixlib=rb-1.2.1&auto=format&fit=crop&w=900&q=60" alt="profile image">
            <div class="message-content">
              <div class="message-header">
                <div class="name">Jessica</div>
                <div class="star-checkbox">
                  <input type="checkbox" id="star-4">
                  <label for="star-4">
                    <i class="far fa-star"></i>
                  </label>
                </div>
              </div>
              <p class="message-line">
                Je suis crevé mon pote je vais dormir.
              </p>
              <p class="message-line time">
                12, Déc
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="script.js"></script>

</body>

</html>