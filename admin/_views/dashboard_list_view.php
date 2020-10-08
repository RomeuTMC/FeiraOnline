<?php if (!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
logado('ADMIN');
$dados=$_SESSION['dados'];
?>

<div class="container">
  <div class="row">
    <div class="col-md-12 font-weight-bold">
      <h3 class="py-5 font-weight-bold color-pink">
        DashBoard -
        <small class="text-muted"><?= SISTEM ?></small>
      </h3>
    </div>
  </div> <!-- end row -->
  <div class="row">
    <div class="col">
      <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
          <div class="col-md-4 d-flex justify-content-center align-items-center border-count">
            <h1 class="count-info text-muted"><?php echo($dados['buyers']); ?></h1>
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title font-weight-bold">Buyers</h5>
              <p class="card-text">Número atual de cadastros, esse dado é atualizado dinâmicamente.</p>
              <a href="<?php echo(URL.'admin/buyers'); ?>" class="btn btn-secondary btn-lg">Acessar lista</a>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- end col -->
    <div class="col">
      <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
          <div class="col-md-4 d-flex justify-content-center align-items-center border-count">
            <h1 class="count-info text-muted"><?php echo($dados['sellers']); ?></h1>
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title font-weight-bold">Sellers</h5>
              <p class="card-text">Número atual de cadastros, esse dado é atualizado dinâmicamente.</p>
              <a href="<?php echo(URL.'admin/expositores'); ?>" class="btn btn-secondary btn-lg">Acessar lista</a>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- end col -->
    <div class="col">
      <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
          <div class="col-md-4 d-flex justify-content-center align-items-center border-count">
            <h1 class="count-info text-muted"><?php echo($dados['contato']); ?></h1>
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title font-weight-bold">Contacts</h5>
              <p class="card-text">Número atual de cadastros, esse dado é atualizado dinâmicamente.</p>
              <a href="<?php echo(URL.'admin/contato'); ?>" class="btn btn-secondary btn-lg">Acessar lista</a>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- end col -->
  </div>

  <div class="row">
  <div class="col">
      <div class="card mb-3">
        <div class="row no-gutters">
          <div class="col-md-4 d-flex justify-content-center align-items-center border-count">
            <h1 class="count-info text-muted"><?php echo($dados['day1']); ?></h1>
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title font-weight-bold text-muted">Appointments Day1</h5>
              <p class="card-text text-muted">Número de Appointments Sem Avaliação</p>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- end col -->
    <div class="col">
      <div class="card mb-3">
        <div class="row no-gutters">
          <div class="col-md-4 d-flex justify-content-center align-items-center border-count">
            <h1 class="count-info text-muted"><?php echo($dados['day2']); ?></h1>
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title font-weight-bold text-muted">Appointments Day2</h5>
              <p class="card-text text-muted">Número de Appointments Sem Avaliação</p>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- end col -->
  </div>
</div>