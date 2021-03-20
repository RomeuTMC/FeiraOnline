<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
if($_SESSION['login']<>'SELLER'){
     echo "";
} else {
?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
     <a class="navbar-brand" href="<?php echo ADMIN.'dashboard'; ?>">
          <img src="<?php echo(URL);?>/img/logo.png" class="w-50" alt="">
     </a>
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
     </button>

     <div class="collapse navbar-collapse custom-menu" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto d-flex align-items-center">
               <li class="nav-item dropdown">
                    <a class="nav-link" href="<?php echo ADMIN.'dashboard'; ?>" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">HOME</a>
               </li>
               <?php
               if (!isset($_SESSION['menu'])) {
                    $_SESSION['erro_no'] = 4;
                    $_SESSION['erro'] = "Sem permissões de Acesso, solicite ao ADMINISTRADOR que conceda os acessos!";
               } else {
                    foreach ($_SESSION['menu'] as $k => $v) {
               ?>
                         <li class="nav-item dropdown d-flex flex-column text-uppercase align-items-center">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $k; ?></a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                   <?php
                                   foreach ($v as $i => $vi) {
                                   ?>
                                        <a class="dropdown-item" href="<?php echo ADMIN.$vi['endpoint']; ?>" data-toggle="tooltip" data-placement="right" title="<?php echo $vi['desc']; ?>"><?php echo $vi['item']; ?></a>
                                        <div class="dropdown-divider"></div>
                                   <?php
                                   }
                                   ?>
                              </div>
                         </li> <?php
                              }
                         } ?>

          </ul>
          <ul class="navbar-nav  mt-2 mt-lg-0 d-flex align-items-center ml-auto">
               <li class="nav-item dropdown text-center logout">
                    <a class="nav-link" href="<?php echo ADMIN.'logout'; ?>" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                         <i class="fas fa-power-off fa-lg"></i> <br>SAIR </a></li>
          </ul>
     </div>
</nav>
<?php
}
?>