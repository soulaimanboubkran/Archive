 
 
 
 
 <?php


session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['type_utilisateur'] !== 'admin') {
  // Redirect to login page if user is not logged in or is not a normal user
  header('Location: ind.php');
  exit();
}else{


//
include_once('../confi/c.php');
include('../header/header.php');

// Query to retrieve last ID value
// Query to retrieve last ID value

$stmt = $conn->query("SELECT  id_class FROM  CLASS ORDER BY  id_class DESC LIMIT 1");



// Fetch the result
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Assign the ID values to variables

$last_id_class = $result['id_class'] + 1;



$stmt = $conn->query("SELECT * FROM CLASS");
$classs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


 
 
 
 
 
 
 
 
 
 
<div class='flex justify-center'>
<div class="w-full lg:w-2/6 flex justify-center flex-col mx-4 my-4 p-4 dark:bg-gray-950 bg-slate-400 dark:text-white    rounded-xl ">
 
 
 
 <!-- Form for Class -->
  <form  method="post" action="../inc/insert_ASSAS.php">
    <div class="flex flex-wrap mb-4">
  
      <input hidden class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"type="number" name="id_class" value="<?php echo $last_id_class; ?>">
    </div>
    <div class="flex flex-wrap mb-4">
      <label class="block w-full font-medium ">Nom Class:</label>
      <input class="bg-gray-50 borde scrollbar-hide border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 m-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="nom_class">
    </div>
    <button class="btn btn-primary  bg-green-700  hover:bg-green-900  text-white font-bold py-2 px-4 rounded-xl" type="submit" name="submit_class">ADD CLASS</button>
  </form>

  
<form  method="post" action="../inc/delete_ASSAS.php" id='search-form'>
  <label class="block w-full font-medium  mb-2">Select filiere to delete:</label>
  <select multiple  class="bg-gray-50 border scrollbar-hide mb-5 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  name="id_class">
    <?php foreach($classs as $class): ?>
      <option value="<?php echo $class['id_class']; ?>"><?php echo $class['nom_class']; ?></option>
    <?php endforeach; ?>
  </select>
  <input class="block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-xl" type="submit" name="delete_class" value="DELETE CLASS">
</form>

</div>
</div>
<div class="container mx-auto px-4 py-8 dark:text-white">
  <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
  
  <h2 class="text-xl font-bold mb-2">Class</h2>
  <div class="grid grid-cols-4 gap-4">
    <?php foreach ($classs as $class): ?>
    <div class="bg-slate-400 dark:bg-gray-950   rounded shadow p-4">
    <p class="text">Class: <span class="text-rose-500  font-bold "><?php echo $class['nom_class']; ?></span></p>
      <h3 class="text-lg font-bold mb-2">ID: <span class="text-rose-500   "><?php echo $class['id_class']; ?></span></h3>
   
    </div>
    <?php endforeach; ?>
  </div>
  
  <!-- Other dashboard components -->
</div>
  <?php include('../header/foot.php'); }?>