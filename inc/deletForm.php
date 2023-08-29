<?php
 session_start();

 if (!isset($_SESSION['user']) || $_SESSION['user']['type_utilisateur'] !== 'admin') {
   // Redirect to login page if user is not logged in or is not a normal user
   header('Location: ../src/ind.php');
   exit();
 }
    include_once('../confi/c.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $id_etudiant = $_POST["id_etudiant"];

        $conn->beginTransaction();

        $stmt = $conn->prepare("DELETE FROM DOCUMENT_ANNEE WHERE id_document IN (SELECT id_document FROM DOCUMENT WHERE id_etudiant = :id_etudiant)");
        $stmt->execute(array(':id_etudiant'=>$id_etudiant));
        $stmt = $conn->prepare("DELETE FROM DOCUMENT_FILIERE WHERE id_document IN (SELECT id_document FROM DOCUMENT WHERE id_etudiant = :id_etudiant)");
        $stmt->execute(array(':id_etudiant'=>$id_etudiant));
        $stmt = $conn->prepare("DELETE FROM DOCUMENT_CLASS WHERE id_document IN (SELECT id_document FROM DOCUMENT WHERE id_etudiant = :id_etudiant)");
        $stmt->execute(array(':id_etudiant'=>$id_etudiant));

        $conn->exec("DELETE FROM ETUDIANTS_FILIERE WHERE id_etudiant = $id_etudiant");
        $conn->exec("DELETE FROM ETUDIANTS_CLASS WHERE id_etudiant = $id_etudiant");
        $conn->exec("DELETE FROM ETUDIANTS_ANNEE WHERE id_etudiant = $id_etudiant");
        $conn->exec("DELETE FROM DOCUMENT WHERE id_etudiant = $id_etudiant");
        $conn->exec("DELETE FROM ETUDIANTS WHERE id_etudiant = $id_etudiant");

        $conn->commit();
        header('location:../src/edit.php?success=deleted succefully!');
        exit(); // add an exit statement after the header() function call
    } catch (PDOException $e) {
        header("Location:../src/edit.php?error=$e");
        exit();
    }
} else {
    try {
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
    } catch (PDOException $e) {
        header("Location:../src/edit.php?error=$e");
        exit();
    }

}
include('../header/header.php');
?>



   
    <div class="flex flex-col mt-10  items-center pb-10">
              <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="240_F_97000908_wwH2goIihwrMoeV9QF3BW6HtpsVFaNVM.jpg" alt="Bonnie image"/>
              <form method="post" action="../inc/deletForm.php" class="mb-4 ">
          <input type="hidden" name="id_etudiant" value="<?php echo $etudiant["id_etudiant"]; ?>">
          <h5 class="mb-2 flex justify-center"> <?php echo $etudiant["nom"] ?></h5>
          <div class="flex">
            <input type="submit" value="Delete" class="bg-red-500 text-white px-4 py-2 rounded-md mr-2">
            <a href="/tp/" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md">return</a>
          </div>
        </form>
           
        </div>
    </div>



<?php include('../header/footer.php'); ?>
