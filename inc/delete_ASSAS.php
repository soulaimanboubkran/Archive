<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['type_utilisateur'] !== 'admin') {
  // Redirect to login page if user is not logged in or is not a normal user
  header('Location: ../src/ind.php');
  exit();
}
include_once('../confi/c.php');

if (isset($_POST['delete_annee'])) {
    try{
  $id_annee = $_POST['id_annee'];
  $stmt = $conn->prepare("DELETE FROM ANNEE WHERE id_annee = ?");
  $stmt->execute([$id_annee]);
  // Redirect to the previous page
  header("Location:../src/annee.php");
 
}catch (PDOException $e) {
    // Handle the exception
    header("Location:../src/annee.php?error=You can not delete this annee"); 
    
  }
}


if (isset($_POST['delete_filiere'])) {
    try {
      $id_filiere = $_POST['id_filiere'];
      $stmt = $conn->prepare("DELETE FROM FILIERE WHERE id_filiere = ?");
      $stmt->bindParam(1, $id_filiere);
      $stmt->execute();
      // Redirect to the previous page
      header("Location:../src/filiere.php");
       
    } catch (PDOException $e) {
      // Handle the exception
      header("Location:../src/filiere.php?error=You can not delete this filiere"); 
      
    }
  }
  
if (isset($_POST['delete_class'])) {
    try{
  $id_class = $_POST['id_class'];
  $stmt = $conn->prepare("DELETE FROM CLASS WHERE id_class = ?");
  $stmt->execute([$id_class]);
  // Redirect to the previous page
  header("Location:../src/class.php");

}catch (PDOException $e) {
    // Handle the exception
    header("Location:../src/class.php?error=You can not delete this class"); 
    
  }
}
?>