<?php
// Inclure le fichier de configuration de la base de données
include "Classes/ConnectBD.php";

// Vérifier si l'ID de la tâche à supprimer est fourni
if (!isset($_GET['id']) || empty($_GET['id'])) {
  // Rediriger vers la page d'accueil si l'ID n'est pas fourni
  header('Location: list-tasks.php');
  exit();
} else {
  // Supprimer la tâche de la base de données
  $sqlDelete = 'DELETE FROM tasks WHERE id = :id';
  $stmt = $base->prepare($sqlDelete);
  $stmt->execute(['id' => $_GET['id']]);
  
  // Rediriger vers la page d'accueil 
  header('Location: list-tasks.php?msg=Suppression réalisée avec succès ! ');
  exit();
}
?>

