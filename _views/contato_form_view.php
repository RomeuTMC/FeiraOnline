<?php if(!isset($TRUE) or ($TRUE<>"index.php")) die("LOCKED");
$dados=$_SESSION['dados']; ?>
<div class="d-flex flex-row">
  <div class="col mx-auto">
    <div class="table-responsive">
      <form method="POST" action="<?php echo("contato/save/".$dados['nId']);?>" id="id_form_contato" name="form_contato">
      <fieldset class="frm_field">
        <legend>Cadastro de contato</legend>
                <input type="hidden" id="id_nId" name="nId" value="<?php echo($dados['nId']);?>">
                
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">E-Mail</label>
                <input type="text" class="form-control" id="id_cEmail" name="cEmail" value="<?php echo($dados['cEmail']);?>" maxlength=250>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Nome</label>
                <input type="text" class="form-control" id="id_cName" name="cName" value="<?php echo($dados['cName']);?>" maxlength=200>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Telefone</label>
                <input type="text" class="form-control" id="id_cTel" name="cTel" value="<?php echo($dados['cTel']);?>" maxlength=20>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Mensagem</label>
                <textarea class="form-control" id="id_tMensagem" name="tMensagem" value="" wrap="hard" cols=80><?php echo($dados['tMensagem']);?></textarea>
              </div>
        <div class="form-group">
        <?php 
        if(!empty($dados['read']) and $dados['read']=='SIM'){
          //MOSTRA VOLTAR
          ?>
          <a class="btn btn-dark" onclick="spinner.show(); window.location.href = '<?php echo(ADMIN."/contato"); ?>'">VOLTAR</a>  
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
        html: "Ao confirmar, <b>TODAS</b> as alteraÃ§Ãµes desta tela serÃ£o perdidas. Confirma?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Confirmar!"
      })
      .then((result) => {
        if (result.value) {
          spinner.show();
          window.location.href = "<?php echo("/contato"); ?>"
        }
      });
}

function ClickSalvar(){
  spinner.show();
  document.getElementById("id_form_contato").submit();
}
</script>