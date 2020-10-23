<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
logado('BUYER');
$dados=$_SESSION['dados'];
?>
<?php if(!isset($TRUE) or ($TRUE<>"index.php")) die("LOCKED");
$dados=$_SESSION['dados']; ?>
<style>
  .header-user {
    background-color:#000;
  }
</style>
<?php include_once ('header-user.php'); ?>

<div class="d-flex flex-row" style="margin-bottom: 100px">
  <div class="col mx-auto">
    <div class="table-responsive">
      <form  enctype='multipart/form-data' method="POST" action="<?php echo(ADMIN."dashboard/myaccountsave/".$dados['nId']);?>" id="id_form_clientes" name="form_clientes">
      <fieldset class="frm_field py-5">
        <h4 class="font-weight-bold">Atualizar meus dados</h4>
                <input type="hidden" id="id_nId" name="nId" value="<?php echo($dados['nId']);?>">
                <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Foto do Avatar (blank to no update)</label>
                <input type="file" class="form-control i-file" name='fPhoto' accept="image/*">
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Buyer Company Name</label>
                <input type="text" class="form-control" id="id_cCompany" name="cCompany" value="<?php echo($dados['cCompany']);?>" maxlength=250>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Address</label>
                <input type="text" class="form-control" id="id_cAddress" name="cAddress" value="<?php echo($dados['cAddress']);?>" maxlength=255>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">City</label>
                <input type="text" class="form-control" id="id_cCity" name="cCity" value="<?php echo($dados['cCity']);?>" maxlength=150>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Post Code</label>
                <input type="text" class="form-control" id="id_cCEP" name="cCEP" value="<?php echo($dados['cCEP']);?>" maxlength=12>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Country</label>
                <?php mk_select('cCountry',$dados['cCountry'],$dados['cCountry_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Website</label>
                <input type="text" class="form-control" id="id_cWeb" name="cWeb" value="<?php echo($dados['cWeb']);?>" maxlength=200>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">WhatsApp (for emergency)</label>
                <input type="text" class="form-control" id="id_cWhatsapp" name="cWhatsapp" value="<?php echo($dados['cWhatsapp']);?>" maxlength=25>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Phone</label>
                <input type="text" class="form-control" id="id_cPhone1" name="cPhone1" value="<?php echo($dados['cPhone1']);?>" maxlength=25>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Complete Name (for credential)</label>
                <input type="text" class="form-control" id="id_cPersonalName" name="cPersonalName" value="<?php echo($dados['cPersonalName']);?>" maxlength=250>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Job Title (for Credential)</label>
                <input type="text" class="form-control" id="id_cCargo" name="cCargo" value="<?php echo($dados['cCargo']);?>" maxlength=150>
              </div>

        <div class="form-group">
        <?php
        if(!empty($dados['read']) and $dados['read']=='SIM'){
          //MOSTRA VOLTAR
          ?>
          <a class="btn btn-dark" onclick="spinner.show(); window.location.href = '<?php echo(ADMIN."/clientes"); ?>'">VOLTAR</a>
        <?php } else { ?>
        <a class="btn btn-dark" href="<?php echo (ADMIN."dashboard"); ?>">Back</a>
        <a class="btn btn-primary text-white" onclick="ClickSalvar()" data-dismiss="modal">Save</a>
        <?php
        } //fim do echo mostra
        ?>
        </div>
      </fieldset>
      </form>
    </div>
  </div>
</div>


<?php include_once ('navigation-dock-user.php'); ?>
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
          window.location.href = "<?php echo(ADMIN."/clientes"); ?>"
        }
      });
}

function ClickSalvar(){
  spinner.show();
  document.getElementById("id_form_clientes").submit();
}
</script>