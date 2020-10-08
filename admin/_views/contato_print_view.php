<?php if(!isset($TRUE) or ($TRUE<>"index.php")) die("LOCKED");
$dados=$_SESSION['dados']; ?>
<div class="d-flex flex-row">
  <div class="col mx-auto">
    <div class="table-responsive">
      <form method="POST" action="<?php echo(ADMIN."contato/save/".$dados['nId']);?>" id="id_form_contato" name="form_contato">
      <fieldset class="frm_field">
        <legend>Cadastro de contato</legend>
          <div class="form-group p-2">
                <label class="col-form-label">Identificador: <b><?php echo($dados['nId']);?></b></label><br>
                <label class="col-form-label">E-Mail: <b><?php echo($dados['cEmail']);?></b></label><br>
                <label class="col-form-label">Nome: <b><?php echo($dados['cName']);?></b></label><br>
                <label class="col-form-label">Telefone: <b><?php echo($dados['cTel']);?></b></label><br>
                <label class="col-form-label">Mensagem: <b><?php echo($dados['tMensagem']);?></b></label><br>
        </div>
        <div class="form-group">
        <a class="btn btn-secondary" onclick="ClickCancel()" >Cancelar</a>
        </div>
      </fieldset>
    </div>
  </div>
</div>