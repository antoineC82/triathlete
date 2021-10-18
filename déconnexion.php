<!---------------------------------- début PHP ---------------------------------->
<?php
//ouverture de session
session_start();
$_SESSION = array();
//session détruite
session_destroy();
//envoi vers l'accueil
header("Location: home.php");
?>