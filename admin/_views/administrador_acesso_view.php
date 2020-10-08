<?php if(!isset($TRUE) or ($TRUE<>"index.php")) die("LOCKED");
logado('ADMIN');
$dados=$_SESSION['dados'];
?>

<!-- <div class="container-fluid my-5"> -->
<div class="d-flex flex-row">
  <div class="col mx-auto">
    <div class="table-responsive">
    <form method="POST" action="<?php echo(ADMIN."administrador/permissoes/".$dados['nId_administrador']);?>" id="id_form_permissoes" name="form_permissoes" class="f-field">
    <div class="container-fluid">
    <fieldset class="frm_field">
        <legend class="my-5 font-weight-bold"><?php echo($dados['titulo']);?></legend>
              <input type=hidden name="nId_administrador" id="id_nId_administrador" value="<?php echo($dados['nId_administrador']); ?>">
              <div class="form-group">
              <?php
                  foreach ($dados['menu'] as $k => $v) {
              ?>
                  <fieldset class="field-set">
                    <legend class="field-set-legend"><?php echo $k; ?></legend>
                    <?php
                    foreach ($v as $i => $vi) {
                    ?>
                      <div class="form-check">
                        <input class="form-check-input frmPerId" type="checkbox" value="<?php echo $vi['id']; ?>" id="id_<?php echo $vi['id']; ?>" name="nId_item[]">
                        <label class="form-check-label" for="<?php echo $vi['item']; ?>">
                          <?php echo $vi['item']; ?>
                        </label>
                      </div>
                    <?php
                    } // fim do foreach dos endpoint (conteudo)
                    ?>
                  </fieldset>
              <?php
                } //fim do foreach dos menus (fieldset)
              ?>
              </div>
          <div class="form-group">
            <button type='button' class="btn btn-secondary" onclick="ClickCancel()">Cancelar</Button>
            <button type="button" class="btn btn-primary" onclick="envPer();">Salvar</button>
          </div>
    </fieldset>
    </div>
    </form>
    </div>
  </div>
</div>
<!-- </div> -->

<script>
function ClickCancel(){
  Swal.fire({
        title: "Confirmar Cancelamento?",
        html: "Ao confirmar, <b>TODAS</b> as alterações desta tela serão perdidas. Confirma?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonText: "Cancelar",
        confirmButtonText: 'Confirmar!'
      })
      .then((result) => {
        if (result.value) {
          spinner.show();
          window.location.href = '<?php echo(ADMIN."/administrador"); ?>'
        }
      });
}

function envPer() {
    if ((document.querySelectorAll('input[type="checkbox"]:checked').length) > 0) {
      document.getElementById("id_form_permissoes").submit();
    } else {
      Swal.fire({
        title: "Aviso?",
        text: "Você Deve Selecionar pelo menos 1 permissão para o administrador",
        icon: "error",
        showCancelButton: false,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Ok'
      });
    }
  }
</script>