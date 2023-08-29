<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['type_utilisateur'] !== 'admin') {
  // Redirect to login page if user is not logged in or is not an admin
  header('Location: ind.php');
  exit();
} else {
  include_once('../confi/c.php');
  include('../header/header.php');

  // Query to retrieve last ID value
  $stmt = $conn->query("SELECT id_annee FROM ANNEE ORDER BY id_annee DESC LIMIT 1");
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $last_id_annee = $result['id_annee'] + 1;

  $stmt = $conn->query("SELECT * FROM ANNEE");
  $annees = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class='flex justify-center'>
  <div class="w-full lg:w-2/6 flex justify-center flex-col mx-4 my-4 p-4 dark:bg-gray-950 bg-slate-400 dark:text-white rounded-xl ">
    <form class="" method="post"action="../inc/insert_ASSAS.php" id="form">
      <div class="flex flex-wrap mb-4">
        <input hidden class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" name="id_annee" value="<?php echo $last_id_annee; ?>">
      </div>
      <div class="flex flex-wrap mb-4">
        <label class="block w-full font-medium">Entrez Annee:</label>
        <input class="bg-gray-50 borde scrollbar-hide border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 m-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" name="annee">
      </div>
      <button class="btn btn-primary bg-green-700 hover:bg-green-900 text-white font-bold py-2 px-4 rounded-xl" type="submit" name="submit_annee">ADD ANNEE</button>
    </form>

    <form method="post" action="../inc/delete_ASSAS.php" id='search-form'>
      <label class="block w-full font-medium mt-2 mb-2">Select annee to delete:</label>
      <select multiple class="bg-gray-50 border scrollbar-hide mb-5 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="id_annee">
        <?php foreach ($annees as $annee) : ?>
          <option value="<?php echo $annee['id_annee']; ?>"><?php echo $annee['annee']; ?></option>
        <?php endforeach; ?>
      </select>
      <input class="block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-xl" type="submit" name="delete_annee" value="DELETE ANNEE">
    </form>
  </div>
</div>
<div class="container mx-auto px-4 py-8 dark:text-white">
  <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
  <h2 class="text-xl font-bold mb-2">Years</h2>
  <div class="grid grid-cols-4 gap-4" id="results">
    <?php foreach ($annees as $annee): ?>
      <div class="bg-slate-400 dark:bg-gray-950 rounded shadow p-4">
        <p class="text-gray-400">Class: <span class="text-rose-500"><?php echo $annee['annee']; ?></span></p>
        <h3 class="text-lg font-bold mb-2">ID: <span class="text-rose-500 font-bold"><?php echo $annee['id_annee']; ?></span></h3>
      </div>
    <?php endforeach; ?>
  </div>
</div>



<?php
  include('../header/foot.php');
}
?>
