<?php
session_start();
$bdd = new PDO('mysql:host=127.0.30.1;dbname=triathlete', 'root', '');
if(isset($_SESSION['Num_licence']) AND !empty($_SESSION['Num_licence'])) {
$msg = $bdd->prepare('SELECT * FROM messages WHERE id_recoi = ? AND date_sms = (SELECT MAX(date_sms)FROM messages) OR lu = 0 ORDER BY id_sms DESC');
$msg->execute(array($_SESSION['Num_licence']));
$msg_nbr = $msg->rowCount();
?>
<!DOCTYPE html>
<html>
<head>
   <title>Boîte de réception</title>
   <meta charset="utf-8" />
</head>
<body>
   <a href="envoi.php">Nouveau message</a><br /><br /><br />


   <h3>Votre boîte de réception:</h3>
   <?php
   if($msg_nbr == 0) { echo "Vous n'avez aucun message..."; }


   while($m = $msg->fetch()) {
      $p_exp = $bdd->prepare('SELECT prenom FROM athlete WHERE NUM_LICENCE = ?');
      $p_exp->execute(array($m['id_envoi']));
      $p_exp = $p_exp->fetch();
      $p_exp = $p_exp['prenom'];
   ?>
   <a href="lecture.php?id=<?= $m['id_sms'] ?>"<?php if($m['lu'] == 1) { ?><span style="color:grey"><?php } ?><b><?= $p_exp ?></b><br />
      <?= $m['SMS'] ?><?php if($m['lu'] == 1) { ?></span><?php } ?></a><br />
   -------------------------------------<br/>
   <?php } ?>
</body>
</html>
<?php } ?>