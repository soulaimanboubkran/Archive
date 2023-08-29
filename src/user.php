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
?>


<!-- Display logged-in user's information -->
<div class="flex justify-center">
  <div class="w-full lg:w-2/6 mx-4 my-4 p-4 dark:bg-gray-950 bg-slate-400 dark:text-white rounded-xl">
    <h1 class="text-2xl font-bold mb-4">Logged-in User Information</h1>
    <p><strong>Name:</strong> <?php echo $_SESSION['user']['nom_utilisateur']; ?></p>
    <p><strong>Type:</strong> <?php echo $_SESSION['user']['type_utilisateur']; ?></p>
  </div>
</div>

<?php
include('../header/foot.php');
}
?>
