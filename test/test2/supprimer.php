<?php
session_start();

include('../config.php');
if(isset($_SESSION['id']) AND !empty($_SESSION['id'])) {
   if(isset($_GET['id']) AND !empty($_GET['id'])) {
      $id_message = intval($_GET['id']);
      $msg = $bdd->prepare('DELETE FROM messages WHERE id_sms = ? AND id_recoi = ?');
      $msg->execute(array($_GET['id'],$_SESSION['id']));
      header('Location:reception.php');
   }
}
?>