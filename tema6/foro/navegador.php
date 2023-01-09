<nav class="nav">
  <a href="index.php">inicio</a>
  <?php
    if(isset($username) && $username!="") {
      echo "<a href='perfil.php?USERNAME=".$username."'>".$username."</a>";
    }else echo "<a href='login.php'>login</a>";
  ?>
  <a href="register.php">register</a>
  <a href="logout.php">logout</a>
</nav>