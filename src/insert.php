<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['type_utilisateur'] !== 'admin') {
  // Redirect to login page if user is not logged in or is not an admin
  header('Location: ind.php');
  exit();
} else {
  include_once('../confi/c.php');
  include('../header/header.php');
?>

<!-- Use PHP echo to prefill input fields with last ID values -->
<!-- Form for Annee -->

<!-- Form for Filiere -->

<div class='flex justify-center'>
  <div class="w-full lg:w-2/6 flex justify-center flex-col mx-4 my-4 p-4 dark:bg-gray-950 bg-slate-400 dark:text-white rounded-xl ">

    <form method="POST" action="../inc/insert_ASSAS.php">
      <div class="flex flex-wrap mb-4">
        <label for="nom_utilisateur">Nom d'utilisateur:</label>
        <input type="text" id="nom_utilisateur" class="bg-gray-50 borde scrollbar-hide border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 m-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="nom_utilisateur">
      </div>
      <div class="flex flex-wrap mb-4">
        <label for="mot_de_passe">Mot de passe:</label>
        <input type="password" class="bg-gray-50 borde scrollbar-hide border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 m-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="mot_de_passe" name="mot_de_passe">
      </div>
      <div class="flex w-3/6 flex-wrap mb-4">
        <label for="type_utilisateur">Type d'utilisateur:</label>
        <select class="bg-gray-50 border scrollbar-hide mt-1 mb-5 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="type_utilisateur" id="type_utilisateur">
          <option value="admin">Admin</option>
          <option value="user">User</option>
        </select>
      </div>

      <button class="btn btn-primary bg-green-700 hover:bg-green-900 text-white font-bold py-2 px-4 rounded" type="submit" name='submit-user'>Ajouter utilisateur</button>
    </form>

  </div>
</div>
<!-- Table to display users -->
<div class="flex justify-center">
  <div class="w-full lg:w-2/6 mx-4 my-4 p-4 dark:bg-gray-950 bg-slate-400 dark:text-white rounded-xl">
    <table class="table-auto w-full">
      <thead>
        <tr>
          <th class="px-4 py-2">ID</th>
          <th class="px-4 py-2">Nom d'utilisateur</th>
          <th class="px-4 py-2">Type d'utilisateur</th>
        </tr>
      </thead>
      <tbody>
      <?php
// Fetch users from the database
$sql = "SELECT * FROM UTILISATEUR";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
  foreach ($result as $row) {
    echo "<tr>";
    echo "<td class='border px-4 py-2'>" . $row['id_utilisateur'] . "</td>";
    echo "<td class='border px-4 py-2'>" . $row['nom_utilisateur'] . "</td>";
    echo "<td class='border px-4 py-2'>" . $row['type_utilisateur'] . "</td>";
    echo "</tr>";
  }
} else {
  echo "Error: ";
}
?>

      </tbody>
    </table>
  </div>
</div>

<?php
include('../header/foot.php');
}
?>