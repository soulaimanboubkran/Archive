<?php



session_start();

if (!isset($_SESSION['user'])) {
    // Redirect to login page if user is not logged in
    header('Location: ../loging.php');
    exit();
  } else {
    include('../confi/c.php');
  
    if ($_SESSION['user']['type_utilisateur'] === 'admin') {
      include('../header/header.php');
    } else {
      include('../header/headerforuser.php');
    }
//
// Set up database connection
include('../confi/c.php');




// Get number of classes
$sql_classes = "SELECT COUNT(*) AS num_classes FROM CLASS";
$stmt_classes = $conn->prepare($sql_classes);
$stmt_classes->execute();
$num_classes = $stmt_classes->fetch(PDO::FETCH_ASSOC)["num_classes"];

// Get number of filières
$sql_filieres = "SELECT COUNT(*) AS num_filieres FROM FILIERE";
$stmt_filieres = $conn->prepare($sql_filieres);
$stmt_filieres->execute();
$num_filieres = $stmt_filieres->fetch(PDO::FETCH_ASSOC)["num_filieres"];

// Get number of students
$sql_etudiants = "SELECT COUNT(*) AS num_etudiants FROM ETUDIANTS";
$stmt_etudiants = $conn->prepare($sql_etudiants);
$stmt_etudiants->execute();
$num_etudiants = $stmt_etudiants->fetch(PDO::FETCH_ASSOC)["num_etudiants"];



// Close database connection
$conn = null;


?>
<div class="flex  flex-wrap justify-center mt-44  ">

<div class='w-full max-w-sm mx-4 my-4 p-10   bg-gray-100 rounded-3xl dark:bg-slate-600  '>
    <label class="block w-full font-bold text-gray-700 dark:text-white"> Number of classes:</label></br>
    <span class='mx-1 px-2 text-5xl   text-red-600 font-bold  '><?php echo $num_classes; ?></span>
</div>
<div class='w-full max-w-sm mx-4 my-4 p-10  bg-gray-100 rounded-3xl dark:bg-slate-600 '> 
    <label class="block w-full font-bold text-gray-700 dark:text-white"> Number of filières:</label></br>
    <span  class='mx-1 px-2 text-5xl   text-red-600 font-bold  '><?php echo $num_filieres; ?></span>
</div>


<div class='w-full max-w-sm mx-4 my-4 p-10   bg-gray-100 rounded-3xl dark:bg-slate-600  '>
    <label class="block w-full font-bold  text-gray-700 dark:text-white">Number of students</label></br>
    <span class='mx-1 px-2 text-5xl   text-red-600 font-bold  '><?php echo $num_etudiants; ?></span></div>

</div>


<?php
include('../header/footer.php');
  }
?>