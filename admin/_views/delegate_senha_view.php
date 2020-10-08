<?php if(!isset($TRUE) or ($TRUE<>"index.php")) die("LOCKED");
logado('ADMIN');
$dados=$_SESSION['dados']; ?>
<div class="d-flex flex-row">
  <div class="col mx-auto">
    <div class="table-responsive">
      <form method="POST" action="<?php echo(ADMIN."delegate/senhasave/".$dados['nId']);?>" id="id_form_clientes" name="form_clientes" enctype='multipart/form-data'>
      <fieldset class="frm_field">
        <legend>Atualização de Senha</legend>
              <input type="hidden" id="id_nId" name="nId" value="<?php echo($dados['nId']);?>">
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Buyer Name</label>
                <span><?php echo($dados['cNome']);?></span>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Mail</label>
                <span><?php echo($dados['cEmail']);?></span>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">New Password (if needs update)</label>
                <input type="text" class="form-control" id="id_sPassw" name="sPassw" value="" maxlength=15>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Photo (if needs update)</label>
                <input type="file" class="form-control" id="id_Photo" name="Photo" accept="image/*">
              </div>
        </fieldset>

        <div class="form-group">
        <?php 
        if(!empty($dados['read']) and $dados['read']=='SIM'){
          //MOSTRA VOLTAR
          ?>
          <a class="btn btn-dark" onclick="spinner.show(); window.location.href = '<?php echo(ADMIN."/clientes"); ?>'">VOLTAR</a>  
        <?php } else { ?>
        <a class="btn btn-secondary" onclick="ClickCancel()" >Cancelar</a>
        <a class="btn btn-primary" onclick="ClickSalvar()">Salvar</a>
        <?php 
        } //fim do echo mostra
        ?>
        </div>
      </fieldset>
      </form>
    </div>
  </div>
</div>
<script languege="javascript">
function ClickCancel(){
  Swal.fire({
        title: "Confirmar Cancelamento?",
        html: "Ao confirmar, <b>TODAS</b> as alterações desta tela serão perdidas. Confirma?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Confirmar!"
      })
      .then((result) => {
        if (result.value) {
          spinner.show();
          window.location.href = "<?php echo(ADMIN."/buyers"); ?>"
        }
      });
}

function ClickSalvar(){
  spinner.show();
  document.getElementById("id_form_clientes").submit();
}
</script>