
<?php

session_start();

if (!isset($_SESSION['user']) ) {
  // Redirect to login page if user is not logged in or is not a normal user
  header('Location: ../loging.php'); 
  exit();
}
// Set up database connection
include_once('../confi/c.php');



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



//  SQL query to get search options
$sql = "SELECT ANNEE.annee, CLASS.nom_class, FILIERE.nom_filiere
FROM ANNEE 
JOIN ETUDIANTS_ANNEE ON ANNEE.id_annee = ETUDIANTS_ANNEE.id_annee 
JOIN ETUDIANTS_CLASS ON ETUDIANTS_ANNEE.id_etudiant = ETUDIANTS_CLASS.id_etudiant 
JOIN CLASS ON ETUDIANTS_CLASS.id_class = CLASS.id_class 
JOIN ETUDIANTS_FILIERE ON ETUDIANTS_CLASS.id_etudiant = ETUDIANTS_FILIERE.id_etudiant 
JOIN FILIERE ON ETUDIANTS_FILIERE.id_filiere = FILIERE.id_filiere 
GROUP BY ANNEE.annee, CLASS.nom_class, FILIERE.nom_filiere";

$stmt = $conn->prepare($sql);
$stmt->execute();
$options = $stmt->fetchAll(PDO::FETCH_ASSOC);

include('../header/headerforuser.php');
// Output search form HTML
?>

<form method="post" action="ind.php" id="search-form" data-action="ind.php" class="flex flex-wrap justify-start">

<div class="lg:flex mr-4  lg:mx-4 mx-1 w-full sm:w-full lg:w-12/12 lg:mt-4">

        <label for="annee" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select year:</label>
        <select name="annee" id="annee" class="bg-gray-50   borde scrollbar-hide border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2 m-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="">--Select year--</option>
            <?php
            $years = array();
            foreach ($options as $option) {
                $years[] = $option['annee'];
            }
            $years = array_unique($years);
            foreach ($years as $year) : ?>
                <option value="<?= $year ?>"><?= $year ?></option>
            <?php endforeach; ?>
        </select>

        <label for="class" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select class:</label>
        <select name="class" id="class" class="bg-gray-50 borde scrollbar-hide border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 m-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="">--Select class--</option>
            <?php
            $classes = array();
            foreach ($options as $option) {
                $classes[] = $option['nom_class'];
            }
            $classes = array_unique($classes);
            foreach ($classes as $class) : ?>
                <option value="<?= $class ?>"><?= $class ?></option>
            <?php endforeach; ?>
        </select>

        <label for="filiere" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select filiere:</label>
        <select name="filiere" id="filiere" class="bg-gray-50 borde scrollbar-hide border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 m-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="">--Select filiere--</option>
            <?php
            $filieres = array();
            foreach ($options as $option) {
                $filieres[] = $option['nom_filiere'];
            }
            $filieres = array_unique($filieres);
            foreach ($filieres as $filiere) : ?>
                <option value="<?= $filiere ?>"><?= $filiere ?></option>
            <?php endforeach; ?>
        </select>

        <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom de l'étudiant:</label>
  <input type="text" id="nom" name="nom" class="bg-gray-50 borde scrollbar-hide border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 m-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></div>
    

   
   
    <div class="flex  w-full  sm:w-2/3 lg:w-2/6 lg:mx-2 lg:mt-9 mx-3">
  <button name='submit' type="submit" id="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-0 h-11 px-4 rounded-lg">search</button></div>

            </div>
            
    
</form>
<?php
$results = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  $annee = isset($_POST['annee']) ? $_POST['annee'] : '';
  $class = isset($_POST['class']) ? $_POST['class'] : '';
  $filiere = isset($_POST['filiere']) ? $_POST['filiere'] : '';
  $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
  if (!empty($annee) || !empty($class) || !empty($filiere) || !empty($nom)) {
    // Get search criteria from form submission
    $sql = "SELECT ETUDIANTS.*, DOCUMENT.*, ANNEE.*, CLASS.*, FILIERE.*
            FROM ETUDIANTS
            JOIN ETUDIANTS_ANNEE ON ETUDIANTS.id_etudiant = ETUDIANTS_ANNEE.id_etudiant 
            JOIN ETUDIANTS_CLASS ON ETUDIANTS_ANNEE.id_etudiant = ETUDIANTS_CLASS.id_etudiant 
            JOIN ETUDIANTS_FILIERE ON ETUDIANTS_CLASS.id_etudiant = ETUDIANTS_FILIERE.id_etudiant 
            JOIN ANNEE ON ETUDIANTS_ANNEE.id_annee = ANNEE.id_annee 
            JOIN CLASS ON ETUDIANTS_CLASS.id_class = CLASS.id_class 
            JOIN FILIERE ON ETUDIANTS_FILIERE.id_filiere = FILIERE.id_filiere 
            JOIN DOCUMENT ON ETUDIANTS.id_etudiant = DOCUMENT.id_etudiant 
            WHERE (:annee = '' OR ANNEE.annee = :annee)
              AND (:class = '' OR CLASS.nom_class = :class)
              AND (:filiere = '' OR FILIERE.nom_filiere = :filiere)
              AND (:nom = '' OR ETUDIANTS.nom LIKE CONCAT('%', :nom, '%'))";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":annee", $annee);
    $stmt->bindParam(":class", $class);
    $stmt->bindParam(":filiere", $filiere);
    $stmt->bindParam(":nom", $nom);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}

if (!empty($results)) {
  // Display the results
  // ...
?>


<div>

<div class="flex px-6 md:px-0 overflow-x-auto justify-center scrollbar-hide">
<div>
</div>
  <table class="w-3/6 ml-4  md:w-3/6 text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
        <tr class="  ">
      
          <th scope="col" class="px-8 mx-5 py-3 rounded-l-lg ">FullName </th>
          <th scope="col" class="px-8 mx-5 py-3  ">year </th>
          <th scope="col" class="px-8 mx-5 py-3  ">class </th>
          <th scope="col" class="px-8 mx-5 py-3  ">filiere </th>
          <th scope="col" class="px-8  mx-5 py-3 rounded-r-lg" >file</th></th>
        
        </thead>
        <?php foreach ($results as $result) { ?>
     
            <tbody class="text-sm text-gray-900 dark:text-gray-200">
            
          

          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 ">
         
          <td class="#   py-1 md:px-8 md:py-3"><?php echo $result["nom"]; ?></td>
          <td class="#   py-1 md:px-8 md:py-3"> <span class="text-rose-500  "><?php echo $result["annee"]; ?></span></td>
          <td class="#   py-1 md:px-8 md:py-3"><span class="text-rose-500  "><?php echo $result["nom_class"]; ?></span></td>
          <td class="#   py-1 md:px-8 md:py-3"><span class="text-rose-500  "><?php echo $result["nom_filiere"]; ?></span></td>
     
            <?php if (empty($result["imageName"]) && empty($result["file_path"])) { ?>

              <td >No file available yet</td>

            <?php } elseif (file_exists('../uploads/' . $result["imageName"])) { ?>

              <td class='font-semibold text-gray-950    py-1 md:px-8 md:py-3  dark:text-white'><a href='../uploads/<?php echo $result["imageName"]; ?>' download class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900 dark:text-yellow-50">Download</a></td>

            <?php } else { ?>

              <td>No file available</td>

            <?php } ?>

          </tr>
          </tbody>
        <?php } ?>

      </table>
      </div></div>

    <?php
    } elseif(count($results) ==0) {

    }
 

    // Close database connection
    $conn = null;

 
?>








<?php include('../header/footer.php'); ?>

