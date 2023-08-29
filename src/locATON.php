
<?php


session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['type_utilisateur'] !== 'admin') {
  // Redirect to login page if user is not logged in or is not a normal user
  header('Location: ind.php');
  exit();
}
//
include_once('../confi/c.php');


$duplicate = false;

if(isset($_POST['nom']) && isset($_POST['prenom'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    
    // Check for duplicate
    $sql = "SELECT COUNT(*) as count FROM ETUDIANTS WHERE nom = :nom ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if($result['count'] > 0) {
        $duplicate = true;
    }
}

$sql = "SELECT id_annee, annee FROM annee";
$stmt = $conn->prepare($sql);
$stmt->execute();
$annees = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT id_filiere, nom_filiere FROM FILIERE";
$stmt = $conn->prepare($sql);
$stmt->execute();
$filiers = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT id_class, nom_class FROM CLASS";
$stmt = $conn->prepare($sql);
$stmt->execute();
$classs = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->query("SELECT *  FROM  DOCUMENT ORDER BY id_document DESC LIMIT 1");

// Fetch the result
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Assign the ID values to variables
$last_id_document = $result['id_document'] + 1;
$stmt = $conn->query("SELECT id_etudiant  FROM ETUDIANTS ORDER BY id_etudiant DESC LIMIT 1");
$last_id_etudiant = $result['id_etudiant'] + 1;
$result = $stmt->fetch(PDO::FETCH_ASSOC);
include('../header/header.php');
?>

  
<form method="post" class="flex justify-center" action="../inc/insert_data.php" enctype="multipart/form-data" id="myForm" >
  <div class="flex flex-wrap  w-full lg:w-3/6">
    <div hidden  class="mb-4 px-2 w-full md:w-1/2 lg:w-1/3">
      <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="id_etudiant">
        ID Étudiant:
      </label>
      <input class="appearance-none dark:bg-gray-700 dark:text-black dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-700 border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" name="id_etudiant" id="id_etudiant" value="<?php echo $last_id_etudiant; ?>" >
    </div>

    <div class="mb-4 px-2 w-full md:w-2/6">
  <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="nom">FullNom:</label>
  <input class="dark:bg-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 dark:text-black appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="nom" id="nom" required>
  <?php if($duplicate) { echo "<span style='color:red;'>Duplicate</span>"; } ?>
</div>




  <div class="mb-4 px-2 w-full md:w-2/6">
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="telephone">
      Téléphone:
    </label>
    <input class=" dark:bg-gray-700  dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 dark:text-black appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="tel" name="telephone" id="telephone">
  </div>



<div class="mb-4 px-2 w-full md:w-2/6">
  <label for="date_creation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de création:</label>
  <input type="date" id="date_creation" name="date_creation"  class=" dark:bg-gray-700  dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 dark:text-black appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
</div>

<script>
  // Get the current date
  var currentDate = new Date().toISOString().split("T")[0];
  
  // Set the value of the input field to the current date
  document.getElementById("date_creation").value = currentDate;
</script>


  <div class="mb-4 px-2 w-full md:w-3/6">
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="email">
      Email:
    </label>
    <input class=" dark:bg-gray-700  dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 dark:text-black appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="email" name="email" id="email">
  </div></br>

  


  <div hidden class="mb-4 px-2 w-full md:w-1/3">
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="id_document">
      ID Document:
    </label>
    <input class=" dark:bg-gray-700  dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 dark:text-black appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" id="id_document" name="id_document" value="<?php echo $last_id_document; ?>">
  </div>

 
  <div class="mb-4 px-2 w-full md:w-3/6">
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="adresse">
      Adresse:
    </label>
    <input class=" dark:bg-gray-700  dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 dark:text-black appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="adresse" id="adresse">
  </div>

  <div class="mb-4 px-2 w-full md:w-1/3">
  <label for="titre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titre:</label>
  <input type="text" id="titre" name="titre"  class=" dark:bg-gray-700  dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 dark:text-black appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
</div>

<div class="mb-4 px-2 w-full md:w-1/3">
  <label for="type_document" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type de document:</label>
  <input type="text" id="type_document" name="type_document"  class=" dark:bg-gray-700  dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 dark:text-black appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
</div>
<div class="mb-4 px-2 w-full md:w-1/3">
  <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fichier à uploader:</label>
  <input type="file" name="image" class=" dark:bg-gray-700  dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 dark:text-black appearance-none border rounded-lg w-full py-1.5 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
</div>


<div class="mb-4 px-2 w-full md:w-2/6">
  <label for="id_annee" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose a year:</label>
  <select name="id_annee" id="id_annee" class=" dark:bg-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 dark:text-black w-full border  rounded-lg px-4 py-2">
    <?php foreach ($annees as $annee) { ?>
      <option value="<?php echo $annee['id_annee']; ?>"><?php echo $annee['annee']; ?></option>
    <?php } ?>
  </select>
</div>

<div class="mb-4 px-2 w-full md:w-2/6">
  <label for="id_filiere" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose a filiere:</label>
  <select name="id_filiere" id="id_filiere" class="  dark:bg-gray-700  dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 dark:text-black w-full border border-gray-300 rounded-lg px-4 py-2">
    <?php foreach ($filiers as $filiere) { ?>
      <option value="<?php echo $filiere['id_filiere']; ?>"><?php echo $filiere['nom_filiere']; ?></option>
    <?php } ?>
  </select>
</div>

<div class="mb-4 px-2 w-full md:w-2/6">
  <label for="id_class" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose a class:</label>
  <select name="id_class" id="id_class" class="  dark:bg-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 dark:text-black w-full border border-gray-300 rounded-lg px-4 py-2">
    <?php foreach ($classs as $class) { ?>
      <option value="<?php echo $class['id_class']; ?>"><?php echo $class['nom_class']; ?></option>
    <?php } ?>
  </select>
</div>

<div class="mb-4   px-2 w-full md:w-2/6">
<label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">click pour send</label>
  <input type="submit" value='send' class=" text-white  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg w-full text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"></div></div>
</form>
</div>

                <?php include('../header/footer.php'); ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>