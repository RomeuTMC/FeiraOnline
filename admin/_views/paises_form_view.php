<?php if(!isset($TRUE) or ($TRUE<>"index.php")) die("LOCKED");
logado('ADMIN');
$dados=$_SESSION['dados']; ?>
<div class="d-flex flex-row">
  <div class="col mx-auto">
    <div class="table-responsive">
      <form method="POST" action="<?php echo(ADMIN."paises/save/".$dados['cId']);?>" id="id_form_paises" name="form_paises">
      <fieldset class="frm_field">
        <legend>Cadastro de paises</legend>
                <input type="hidden" id="id_cId" name="cId" value="<?php echo($dados['cId']);?>">

              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Nome em Português</label>
                <input type="text" class="form-control" id="id_wNome" name="wNome" value="<?php echo($dados['wNome']);?>" maxlength=200>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Nome Internacional (inglês)</label>
                <input type="text" class="form-control" id="id_wEnglish" name="wEnglish" value="<?php echo($dados['wEnglish']);?>" maxlength=200>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">ID pelo sistema BACEN (banco central brasileiro)</label>
                <input type="text" class="form-control" id="id_cBacen" name="cBacen" value="<?php echo($dados['cBacen']);?>" maxlength=4>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Sigla com 3 Letras, Padrão ISO</label>
                <input type="text" class="form-control" id="id_cSigla" name="cSigla" value="<?php echo($dados['cSigla']);?>" maxlength=3>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Sigla</label>
                <input type="text" class="form-control" id="id_cSiglaIso" name="cSiglaIso" value="<?php echo($dados['cSiglaIso']);?>" maxlength=2>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Código Único Padrão ISO</label>
                <input type="text" class="form-control" id="id_cIdIso" name="cIdIso" value="<?php echo($dados['cIdIso']);?>" maxlength=4>
              </div>
        <div class="form-group">
        <?php
        if(!empty($dados['read']) and $dados['read']=='SIM'){
          //MOSTRA VOLTAR
          ?>
          <a class="btn btn-dark" onclick="spinner.show(); window.location.href = '<?php echo(ADMIN."/paises"); ?>'">VOLTAR</a>
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
          window.location.href = "<?php echo(ADMIN."/paises"); ?>"
        }
      });
}

function ClickSalvar(){
  spinner.show();
  document.getElementById("id_form_paises").submit();
}
</script>