<?php

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['type_utilisateur'] !== 'admin') {
  // Redirect to login page if user is not logged in or is not a normal user
  header('Location: ../src/ind.php');
  exit();
}
include_once('../confi/c.php');


  
?>