<?php
require("./views/header.php");

$test = $db->getAllUser();

if ( isset($_POST['username']) ) {
$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$password = sha1(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
  while ($donnee = $test->fetch()) {
    if ($username == $donnee->login && $password == $donnee->password) {
      $check = 'welcome';
      $_SESSION['username'] = $username;
    }
  }
  if (isset($check)) {
    header('location:index.php?action=welcome');
  } else {
    header('location:index.php?action=login&error=1');
  }
}
$errormessage = '';

require("./views/footer.php");
