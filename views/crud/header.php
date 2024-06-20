<header class="bg-primary-red px-4">
   <div class="container-lg h-100 d-flex justify-content-center align-items-center py-2">
      <a href="../menu.php" rel="noopener noreferrer" style="max-width: 12rem;">
         <img class="img-fluid" src="../../../images/logo.png" alt="">
      </a>
   </div>
</header>

<nav class="navbar bg-primary-dark px-4">
   <div class="container-lg d-flex justify-content-between align-items-center py-2 px-0">
      <div>
         <a class="navbar__link home" href="../../menu.php">
            <i class="fa fa-home"></i>
            Inicio</a>
      </div>
      <div class="navbar__user d-flex align-items-center">
         <a href="../../profile.php" class="navbar__link navbar__username m-0">
            <?php echo $_SESSION['NOMBRES']; ?>
         </a>
         <a href="../../profile.php" class="navbar__link">
            <?php
if (!empty($_SESSION['perfil'])) {
    echo '
                  <img loading="lazy" id="navbar__image" class="navbar__image" src="../../' . $_SESSION['perfil'] . '" alt="">
                  ';
} else {
    echo '
                  <img loading="lazy" id="navbar__image" class="navbar__image" src="../../../images/background/background-1.jpg" alt="">';
}
?>
         </a>
         <a href="../../../controller/login/logout.php" class="navbar__link navbar__link--exit">
            Salir </a>
      </div>
   </div>
</nav>