
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARCHIVE</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="node_modules/@material-tailwind/html/scripts/collapse.js"></script>
<!-- from cdn -->
<script src="https://unpkg.com/@material-tailwind/html@latest/scripts/collapse.js"></script>

</head>

<body class=' border-b-gray-300 dark:bg-gray-800      '>
<div id="results"> 

<nav class="bg-white  border-gray-200 dark:bg-gray-900">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-full p-4 ">
        <a href="../src/general.php" class="flex items-center            ">
        <svg class="w-10 h-auto" width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
          <rect width="100" height="100" rx="10" fill="black"/>
          <path d="M37.656 68V31.6364H51.5764C54.2043 31.6364 56.3882 32.0507 58.1283 32.8793C59.8802 33.696 61.1882 34.8146 62.0523 36.2351C62.9282 37.6555 63.3662 39.2654 63.3662 41.0646C63.3662 42.5443 63.0821 43.8108 62.5139 44.8643C61.9458 45.906 61.1823 46.7524 60.2235 47.4034C59.2646 48.0544 58.1934 48.522 57.0097 48.8061V49.1612C58.2999 49.2322 59.5369 49.6288 60.7206 50.3509C61.9162 51.0611 62.8927 52.0672 63.6503 53.3693C64.4079 54.6714 64.7867 56.2457 64.7867 58.0923C64.7867 59.9744 64.3309 61.6671 63.4195 63.1705C62.508 64.6619 61.1349 65.8397 59.3002 66.7038C57.4654 67.5679 55.1572 68 52.3754 68H37.656ZM44.2433 62.4957H51.3279C53.719 62.4957 55.4413 62.04 56.4948 61.1286C57.5601 60.2053 58.0928 59.0215 58.0928 57.5774C58.0928 56.5002 57.8264 55.5296 57.2938 54.6655C56.7611 53.7895 56.0035 53.103 55.021 52.6058C54.0386 52.0968 52.8667 51.8423 51.5054 51.8423H44.2433V62.4957ZM44.2433 47.1016H50.7597C51.896 47.1016 52.92 46.8944 53.8314 46.4801C54.7429 46.054 55.459 45.4562 55.9798 44.6868C56.5125 43.9055 56.7789 42.9822 56.7789 41.9169C56.7789 40.5083 56.2817 39.3482 55.2874 38.4368C54.3049 37.5253 52.843 37.0696 50.9017 37.0696H44.2433V47.1016Z" fill="white"/>
        </svg>
        </a>
        <div class="flex items-center">
            <a href="tel:" class="mr-6 text-sm  text-gray-500 dark:text-white hover:underline">(555) 412-1234</a>
            <a href="../loging.php"  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</a>
        </div>
    </div>
</nav>



<?php
// Start session
ob_start();
session_start();

// Set up database connection
include_once('confi/c.php');

// Check if form is submitted
if(isset($_POST['login'])) {
  // Get user's credentials
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Check if user exists
  $sql = "SELECT * FROM UTILISATEUR WHERE nom_utilisateur = :username AND mot_de_passe = :password";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':username', $username);
  $stmt->bindParam(':password', $password);
  $stmt->execute();

  if($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // User exists, set session variable based on their type
    $_SESSION['user'] = $user;

    // Redirect to appropriate page
    if($user['type_utilisateur'] === 'admin') {
      header('Location: ../src/general.php');
      exit();
    } else {
      header('Location: ../src/ind.php');
      exit();
    }
  } else {
    // Invalid credentials
    echo '<p class="text-red-500">Invalid username or password</p>';
  }
}

// Display login form
?>

<form class="flex justify-center" method="post" >
<div class='flex flex-wrap lg:mx-4 mx-1 w-full sm:w-2/3 lg:w-2/6 lg:mt-4'>
  <div class='class="mb-4 px-2 w-full md:w-6/6'>
  <label for="username"class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
  <input type="text" name="username"  class="bg-gray-50 borde scrollbar-hide border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full lg:w-6/6 first-letter p-3 m-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
  </div>
  <div class='class="mb-4 px-2 w-full md:w-6/6'>
  <label for="password"class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
  <input type="password" name="password"  class="bg-gray-50 borde scrollbar-hide border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full lg:w-6/6 first-letter p-3 m-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
  </div>
  <div class="mb-4 px-2 w-full md:w-6/6 flex justify-center">
  <button type="submit" name="login" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-0 h-11 px-4   my-2 w-full lg:w-2/6  rounded-lg">Login</button>
  </div>
</div>
</form>

<?php
// Display footer
include('header/footer.php');

// Close database connection
$conn = null;
?>
