  <!---------------------------------- début PHP ---------------------------------->
  <?php
  session_start();
//connexion BDD
include('../config.php');
//si id existe est n'est pas vide
if(isset($_GET['DOS']) AND !empty($_GET['DOS'])) {
   $suppr_inscri = htmlspecialchars($_GET['DOS']);
   //delete inscription
   $suppr = $tria->prepare('DELETE FROM inscription WHERE NUM_DOSSARD = ? AND NUM_LICENCE = ?');
   $suppr->execute(array($suppr_inscri, $_SESSION['Num_licence']));
   //direction admin utilisateur
   header("Location: ATHLETE-inscri.php");
}
?>