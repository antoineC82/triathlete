<?php

try
{
$tria = new PDO("mysql:host=127.0.30.1;dbname=triathlete;charset=utf8", 'AntoineC', 'Antoine0204!');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

?>