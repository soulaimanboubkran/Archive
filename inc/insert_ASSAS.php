<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['type_utilisateur'] !== 'admin') {
  // Redirect to login page if user is not logged in or is not a normal user
  header('Location: ../src/ind.php');
  exit();
}

include_once('../confi/c.php');

try{
if (isset($_POST['submit_annee'])) {
  $id_annee = $_POST['id_annee'];
  $annee= $_POST['annee'];

  $sql = "INSERT INTO ANNEE (id_annee, annee) VALUES (:id_annee, :annee)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id_annee', $id_annee);
  $stmt->bindParam(':annee', $annee);
  $stmt->execute(); 
  header('location:../src/annee.php?success=Annee inserted successfully!');
  exit(0);
}
} catch (PDOException $e) {
    header("Location:../src/annee.php?error=".$e->getMessage());
    exit(0);
}

try{
if (isset($_POST['submit_filiere'])) {
  $id_filiere = $_POST['id_filiere'];
  $nom_filiere= $_POST['nom_filiere'];

  $sql = "INSERT INTO FILIERE (id_filiere, nom_filiere) VALUES (:id_filiere, :nom_filiere)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id_filiere', $id_filiere);
  $stmt->bindParam(':nom_filiere', $nom_filiere);
  $stmt->execute();
  header('location:../src/filiere.php?success=Filiere inserted successfully!');
  exit(0);
 } 
} catch (PDOException $e) {
    header("Location:../src/filiere.php?error=".$e->getMessage());
    exit(0);
}

try{
if (isset($_POST['submit_class'])) {
  $id_class = $_POST['id_class'];
  $nom_class= $_POST['nom_class'];

  $sql = "INSERT INTO CLASS (id_class, nom_class) VALUES (:id_class, :nom_class)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id_class', $id_class);
  $stmt->bindParam(':nom_class', $nom_class);
  $stmt->execute();
  header('location:../src/class.php?success=Class inserted successfully!');
  exit(0);
}
}catch (PDOException $e) {
    header("Location:../src/class.php?error=".$e->getMessage());
    exit(0);
}
try{
  // Check if the form was submitted
  if (isset($_POST['submit-user'])) {
      // Get form data
      $nom_utilisateur = $_POST["nom_utilisateur"];
      $mot_de_passe = $_POST["mot_de_passe"];
      $type_utilisateur = $_POST["type_utilisateur"];
      
      // Insert new user into database
      $sql = "INSERT INTO UTILISATEUR (nom_utilisateur,mot_de_passe,type_utilisateur) VALUES (:nom_utilisateur,:mot_de_passe,:type_utilisateur)";
      // Redirect to homepage or confirmation page
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':nom_utilisateur', $nom_utilisateur);
      $stmt->bindParam(':mot_de_passe', $mot_de_passe);
      $stmt->bindParam(':type_utilisateur', $type_utilisateur);
      $stmt->execute(); 
      header('location:../src/insert.php?success=User inserted successfully!');
      exit();
    }
  } catch (PDOException $e) {
      header("Location:../src/insert.php?error=".$e->getMessage());
      exit(0);
  }
?>
