<?php
session_start();
include('../config.php');
if(isset($_SESSION['Num_licence']) AND !empty($_SESSION['Num_licence'])) {
   if(isset($_POST['envoi_message'])) {
      if(isset($_POST['destinataire'],$_POST['message']) AND !empty($_POST['destinataire']) AND !empty($_POST['message'])) {
         $destinataire = htmlspecialchars($_POST['destinataire']);
         $message = htmlspecialchars($_POST['message']);
         $id_destinataire = $bdd->prepare('SELECT NUM_LICENCE FROM athlete WHERE prenom = ?');
         $id_destinataire->execute(array($destinataire));
         $dest_exist = $id_destinataire->rowCount();
         if($dest_exist == 1) {
            $id_destinataire = $id_destinataire->fetch();
            $id_destinataire = $id_destinataire['NUM_LICENCE'];
            $ins = $bdd->prepare('INSERT INTO messages(id_envoi,id_recoi,message,date_sms) VALUES (?,?,?,NOW())');
            $ins->execute(array($_SESSION['Num_licence'],$id_destinataire,$message));
            $error = "Votre message a bien été envoyé !";
         } else {
            $error = "Cet utilisateur n'existe pas...";
         }
      } else {
         $error = "Veuillez compléter tous les champs";
      }
   }
   $destinataires = $bdd->query('SELECT prenom FROM athlete ORDER BY prenom');
   if(isset($_GET['r']) AND !empty($_GET['r'])) {
      $r = htmlspecialchars($_GET['r']);
   }
   if(isset($_GET['o']) AND !empty($_GET['o'])) {
      $o = urldecode($_GET['o']);
      $o = htmlspecialchars($_GET['o']);
      if(substr($o,0,3) != 'RE:') {
         $o = "RE:".$o;
      }
   }
   ?>
   <!DOCTYPE html>
   <html>
   <head>
      <title>Envoi de message</title>
      <meta charset="utf-8" />
   </head>
   <body>
      <form method="POST">
         <!-- <select name="destinataire">
            <?php while($d = $destinataires->fetch()) { ?>
            <option><?= $d['prenom'] ?></option>
            <?php } ?>
         </select> -->
         <label>Destinataire:</label>
         <input type="text" name="destinataire" <?php if(isset($r)) { echo 'value="'.$r.'"'; } ?> />
         <br /><br />
         <label>Objet:</label>
         <input type="text" name="objet" <?php if(isset($o)) { echo 'value="'.$o.'"'; } ?> />
         <br /><br />
         <textarea placeholder="Votre message" name="message"></textarea>
         <br /><br />
         <input type="submit" value="Envoyer" name="envoi_message" />
         <br /><br />
         <?php if(isset($error)) { echo '<span style="color:red">'.$error.'</span>'; } ?>
      </form>
      <br />
      <a href="reception.php">Boîte de réception</a>
   </body>
   </html>
<?php
}
?>