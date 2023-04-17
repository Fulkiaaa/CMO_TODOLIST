<?php 
try 
    {
      require_once('Classes/Tasks.php');
        $base = new PDO('mysql:host=localhost;dbname=CMO_MANU', 'root', '');
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $base->exec("set names utf8mb4");
    }
  catch (Exception $erreur)
    {
        die('Erreur lors de la connexion : '. $erreur->getMessage()); //Objet->méthode();
    } //die termine le script courant en affichant un message. =='exit'
    
?>