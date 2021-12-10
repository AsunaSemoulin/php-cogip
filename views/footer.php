<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
</head>
<footer class="footer">
  <div class="content has-text-centered">
    <p>
      <h2>Vive la Cogip</h2>
    </p>
  </div>
</footer>
<?php
if (isset($_SESSION['username'])) {
  if ($_SESSION['modegod']==1) echo "<script src='./assets/js/menugod.js'></script>";
  else echo "<script src='./assets/js/menuuser.js'></script>";
}
else echo "<script src='./assets/js/menu.js'></script>";
?>
</body>
</html>
