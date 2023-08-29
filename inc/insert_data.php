<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['type_utilisateur'] !== 'admin') {
  // Redirect to login page if user is not logged in or is not a normal user
  header('Location: ../src/ind.php');
  exit();
}
include_once('../confi/c.php');


	
$id_annee = $_POST['id_annee'];

$id_filiere = $_POST['id_filiere'];

$id_class = $_POST['id_class'];



$nom = $_POST['nom'];

$email = $_POST['email'];
$telephone = $_POST['telephone'];
$adresse = $_POST['adresse'];
$id_etudiant = $_POST['id_etudiant'];
$id_document = $_POST['id_document'];
$titre = $_POST['titre'];
$date_creation = $_POST['date_creation'];
$type_document = $_POST['type_document'];


  

// get the image file
$imageName = $_FILES['image']['name'];
$imageTmpName = $_FILES['image']['tmp_name'];
$imageSize = $_FILES['image']['size'];
$imageError = $_FILES['image']['error'];

// check if an image was uploaded
if ($imageName) {
    // check for errors
    if ($imageError !== UPLOAD_ERR_OK) {
        header('Location:../src/locATON.php?error=Error uploading image');
        exit(0);
    }
    // check file type and size (optional)
    $imageFileType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif','pdf');
    $maxSize = 2 * 1024 * 1024; // 2MB
    if (!in_array($imageFileType, $allowedTypes) || $imageSize > $maxSize) {
        header('Location:../src/locATON.php?error=Invalid image file');
        exit(0);
    }
    // move the file to a permanent location
    $targetDir = '../uploads/';
    $targetFile = $targetDir . basename($imageName);
    if (move_uploaded_file($imageTmpName, $targetFile)) {
        $imagePath = $targetFile;
    } else {
        header('Location:../src/locATON.php?error=Error moving image file');
        exit(0);
    }
} else {
    // no image was uploaded, set image path to null or a default value
    $imagePath = null;
}

// insert form data and image path into database
try {
    $sql1 = "INSERT INTO ETUDIANTS (id_etudiant, nom, email, telephone, adresse) 
    SELECT :id_etudiant, :nom, :email, :telephone, :adresse
    FROM DUAL
    WHERE (
        SELECT COUNT(*)
        FROM ETUDIANTS
        WHERE nom = :nom
    ) < 3";

       
    $stmt = $conn->prepare($sql1);
    $stmt->bindParam(':id_etudiant', $id_etudiant);
    $stmt->bindParam(':nom', $nom);
    
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':adresse', $adresse);
    $stmt->execute();

    $sql = "INSERT INTO DOCUMENT (id_document, titre, date_creation, type_document, id_etudiant, file_path, imageName) 
            VALUES (:id_document, :titre, :date_creation, :type_document, :id_etudiant, :file_path, :imageName)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_document', $id_document);
    $stmt->bindParam(':titre', $titre);
    $stmt->bindParam(':date_creation', $date_creation);
    $stmt->bindParam(':type_document', $type_document);
    $stmt->bindParam(':id_etudiant', $id_etudiant);
    $stmt->bindParam(':file_path', $imagePath);
    $stmt->bindParam(':imageName', $imageName);
    $stmt->execute();
} catch (PDOException $e) {
    header("Location:../src/locATON.php?error=Email or Nom and Prenom combination already exists in the database");
    exit(0);
}


  


$sql = "INSERT INTO ETUDIANTS_FILIERE (id_etudiant, id_filiere) 
        VALUES (:id_etudiant, :id_filiere)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_etudiant', $id_etudiant);
$stmt->bindParam(':id_filiere', $id_filiere);
$stmt->execute();
$sql = "INSERT INTO ETUDIANTS_CLASS (id_etudiant, id_class) 
        VALUES (:id_etudiant, :id_class)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_etudiant', $id_etudiant);
$stmt->bindParam(':id_class', $id_class);
$stmt->execute();
$sql = "INSERT INTO ETUDIANTS_ANNEE (id_etudiant, id_annee) 
        VALUES (:id_etudiant, :id_annee)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_etudiant', $id_etudiant);
$stmt->bindParam(':id_annee', $id_annee);
$stmt->execute();
$sql = "INSERT INTO DOCUMENT_CLASS (id_document, id_class) 
        VALUES (:id_document, :id_class)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_document', $id_document);
$stmt->bindParam(':id_class', $id_class);
$stmt->execute();
$sql = "INSERT INTO DOCUMENT_FILIERE (id_document, id_filiere) 
        VALUES (:id_document, :id_filiere)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_document', $id_document);
$stmt->bindParam(':id_filiere', $id_filiere);
$stmt->execute();
$sql = "INSERT INTO DOCUMENT_ANNEE (id_document, id_annee) 
        VALUES (:id_document, :id_annee)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_document', $id_document);
$stmt->bindParam(':id_annee', $id_annee);
$stmt->execute();


header('location:../src/locATON.php?success=Data inserted succefully');

?>