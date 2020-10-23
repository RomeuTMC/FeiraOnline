<?php if(!isset($TRUE) or ($TRUE<>"index.php")) die("LOCKED");
$dados=$_SESSION['dados'];
include_once('topo.php');
 ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
<div class="d-flex flex-row">
  <div class="col mx-auto">
    <div class="table-responsive">
      <form method="POST" action="<?php echo(ADMIN."exp_delegate/save/".$dados['nId']);?>" id="id_form_exp_delegate" name="form_exp_delegate">
      <fieldset class="frm_field">
        <legend>Cadastro de Delegates</legend>
          <div class="form-group p-2">
                <label class="col-form-label">ID: <b><?php echo($dados['nId']);?></b></label><br>
                <label class="col-form-label">Complete Name: <b><?php echo($dados['cNome']);?></b></label><br>
                <label class="col-form-label">Mail for login: <b><?php echo($dados['cEmail']);?></b></label><br>
                <label class="col-form-label">Personal Phone: <b><?php echo($dados['cPhone']);?></b></label><br>
                <label class="col-form-label">Is Admin? <b><?php echo($dados['eAdm']);?></b></label><br>
                <label class="col-form-label"><img src='<?php echo(URL.$dados['fPhoto']);?>'></label><br>
        </div>
        <div class="form-group">
        <a href="javascript:history.go(-1)" class="btn btn-secondary" onclick="ClickCancel()" >Cancelar</a>
        </div>
      </fieldset>
    </div>
  </div>
</div>
</div>