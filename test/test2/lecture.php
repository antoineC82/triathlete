<?php
session_start();
include('../config.php');
if(isset($_SESSION['Num_licence']) AND !empty($_SESSION['Num_licence'])) {
   if(isset($_GET['id']) AND !empty($_GET['id'])) {
      $id_message = intval($_GET['id']);
      $msg = $bdd->prepare('SELECT * FROM messages WHERE id_sms = ? AND id_recoi = ?');
      $msg->execute(array($_GET['id'],$_SESSION['Num_licence']));
      $msg_nbr = $msg->rowCount();
      $m = $msg->fetch();
      $p_exp = $bdd->prepare('SELECT prenom FROM athlete WHERE NUM_LICENCE = ?');
      $p_exp->execute(array($m['id_envoi']));
      $p_exp = $p_exp->fetch();
      $p_exp = $p_exp['prenom'];
?>
<!DOCTYPE html>
<html>
<head>
   <title>Lecture du message #<?= $id_message ?></title>
   <meta charset="utf-8" />
</head>
<body>
   <a href="reception.php">Boîte de réception</a>    <a href="envoi.php?r=<?= $p_exp ?>&o=<?= urlencode($m['date_sms']) ?>">Répondre</a>    <a href="supprimer.php?id=<?= $m['id_sms'] ?>">Supprimer</a><br /><br /><br />
   <h3 align="center">Lecture du message #<?= $id_message ?></h3>
   <div align="center">
      <?php if($msg_nbr == 0) { echo "Erreur"; } else { ?>
      <b><?= $p_exp ?></b> vous a envoyé: <br /><br />
      <b>Objet:</b> <?= $m['date_sms'] ?>
      <br /><br />
      <?= nl2br($m['SMS']) ?><br />
      <?php } ?>
   </div>
</body>
</html>
<?php
      $lu = $bdd->prepare('UPDATE messages SET lu = 1 WHERE id_sms = ?');
      $lu->execute(array($m['id_sms']));
   }
}
?>