
<?php 
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['type_utilisateur'] !== 'admin') {
  // Redirect to login page if user is not logged in or is not a normal user
  header('Location: ../src/ind.php');
  exit();
}
include_once('../confi/c.php');
ob_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_etudiant = $_POST["id_etudiant"];
    $nom = $_POST["nom"];

    $email = $_POST["email"];
    $telephone = $_POST["telephone"];

    // image upload validation
    $imageName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imageSize = $_FILES['image']['size'];
    $imageError = $_FILES['image']['error'];

    // check if an image was uploaded
    if ($imageName) {
        // check for errors
        if ($imageError !== UPLOAD_ERR_OK) {
            header('Location:../inc/editForm.php?id='.$id_etudiant.'&error=Error uploading image');
            exit(0);
        }
        // check file type and size (optional)
        $imageFileType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif','pdf');
        $maxSize = 2 * 1024 * 1024; // 2MB
        if (!in_array($imageFileType, $allowedTypes) || $imageSize > $maxSize) {
            header('Location:../inc/editForm.php?id='.$id_etudiant.'&error=Invalid image file');
            exit(0);
        }
        // move the file to a permanent location
        $targetDir = '../uploads/';
        $targetFile = $targetDir . basename($imageName);
        if (move_uploaded_file($imageTmpName, $targetFile)) {
            $imagePath = $targetFile;
        } else {
            header('Location:../inc/editForm.php?id='.$id_etudiant.'&error=Error moving image file');
            exit(0);
        }
    } else {
        // no image was uploaded, set image path to null or a default value
        $imagePath = null;
    }
    
    try {
        $sql = "UPDATE ETUDIANTS SET nom = :nom, email = :email, telephone = :telephone WHERE id_etudiant = :id_etudiant";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":telephone", $telephone);
        $stmt->bindParam(":id_etudiant", $id_etudiant);
        $stmt->execute();
    
        // update the image file path and name in the DOCUMENT table
        $sql1 = "UPDATE DOCUMENT SET file_path = :file_path, imageName = :imageName WHERE id_etudiant = :id_etudiant";
        $stmt = $conn->prepare($sql1);
        $stmt->bindParam(':file_path', $imagePath);
        $stmt->bindParam(':imageName', $imageName);
        $stmt->bindParam(':id_etudiant', $id_etudiant);
        $stmt->execute();
    
        // move the header() function to the top of the script
        header('Location:../src/edit.php?success=updated!');
        ob_end_flush();
        exit();
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
    
} else {
    $id_etudiant = $_GET["id"];

    $sql = "SELECT * FROM ETUDIANTS WHERE id_etudiant = :id_etudiant";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id_etudiant", $id_etudiant);
    $stmt->execute();
    $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$etudiant) {
        echo "Etudiant not found.";
        exit;
    }

    $sql = "SELECT file_path, imageName FROM DOCUMENT WHERE id_etudiant = :id_etudiant";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id_etudiant", $id_etudiant);
    $stmt->execute();
    $document = $stmt->fetch(PDO::FETCH_ASSOC);
}
include('../header/header.php');

?>

 
<h2>Edit Etudiant</h2>
<div class="max-w-screen-md mx-auto">
  <form method="post" action="../inc/editForm.php" enctype="multipart/form-data">
    <input type="hidden" name="id_etudiant" value="<?php echo $etudiant["id_etudiant"]; ?>">
    <label class="block">FullNom:</label>
    <input type="text" name="nom" value="<?php echo $etudiant["nom"]; ?>" class="block w-full border-gray-400 border rounded py-2 px-3 mb-4">
  
    <label class="block">Email:</label>
    <input type="text" name="email" value="<?php echo $etudiant["email"]; ?>" class="block w-full border-gray-400 border rounded py-2 px-3 mb-4">
    <label class="block">Telephone:</label>
    <input type="text" name="telephone" value="<?php echo $etudiant["telephone"]; ?>" class="block w-full border-gray-400 border rounded py-2 px-3 mb-4">
    <label class="block">Fichier à uploader:</label>
    <input type="file" name="image" class="block w-full border-gray-400 border rounded py-2 px-3 mb-4">
    <?php if($document): ?>
      <p>Current document: <a href="<?php echo $document['file_path']; ?>"><?php echo $document['imageName']; ?></a></p>
    <?php endif; ?>
    <input type="submit" value="Update" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
  </form>
</div>


<?php include('../header/footer.php'); ?>
