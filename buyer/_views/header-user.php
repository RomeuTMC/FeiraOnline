<div class="header-user">
  <div class="d-flex justify-content-center align-items-center">
    <div class="header-user-img">
    <a href="<?php echo (ADMIN."dashboard/myaccount/".$dados['id']); ?>" ><img src="<?php echo(URL.$dados['foto']); ?>" alt=""></a>
    </div>
    <h4 class="m-0 header-user-name"><b>Welcome</b>, <?php echo($dados['nome']); ?></h4>
  </div>
  <div>
    <a href="<?php echo (ADMIN."logout"); ?>" class="log-out">Logout</a>
  </div>
</div>