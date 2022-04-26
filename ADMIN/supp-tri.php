  <!---------------------------------- début PHP ---------------------------------->
  <?php
//connexion BDD
include('../config.php');
//si id existe est n'est pas vide
if(isset($_GET['id']) AND !empty($_GET['id'])) {
   $suppr_id = htmlspecialchars($_GET['id']);
   //delete triathlon
   $suppr = $tria->prepare('DELETE FROM triathlon WHERE NUM_TRIATHLON = ?');
   $suppr->execute(array($suppr_id));
   //direction admin utilisateur
   header("Location: ADMIN.php?Li=" . $_SESSION['Num_licence']);
}
?>