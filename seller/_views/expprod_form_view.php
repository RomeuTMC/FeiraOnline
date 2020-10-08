<?php if(!isset($TRUE) or ($TRUE<>"index.php")) die("LOCKED");
logado('SELLER');
$dados=$_SESSION['dados'];
include_once('topo.php');
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
  <div class="d-flex flex-row">
    <div class="col mx-auto">
      <div class="table-responsive">
        <form method="POST" action="<?php echo(ADMIN."expprod/save/".$dados['nId']);?>" id="id_form_exp_produtct"
          name="form_exp_produtct" enctype='multipart/form-data'>
          <fieldset class="frm_field">
            <h1 id="title" class="font-weight-bold m-0"><?php echo($dados['titulo']);?></h1>
            <div class="w-100">
              <hr>
            </div>
            <input type="hidden" id="id_nId" name="nId" value="<?php echo($dados['nId']);?>">
            <input type="hidden" id="id_nId_expositor" name="nId_expositor"
              value="<?php echo($dados['nId_expositor']);?>">
            <div class="form-group p-2">
              <label for="message-text" class="col-form-label">Select a file</label>
              <input type="file" class="form-control i-file" id="id_aFile" name="aFile[]" accept="image/*" required
                multiple>
            </div>
            <div class="form-group">
              <?php
        if(!empty($dados['read']) and $dados['read']=='SIM'){
          //MOSTRA VOLTAR
          ?>
              <a class="btn btn-dark"
                onclick="spinner.show(); window.location.href = '<?php echo(ADMIN."/exp_produtct"); ?>'">VOLTAR</a>
              <?php } else { ?>
              <a class="btn btn-secondary text-white" onclick="ClickCancel()">Cancel</a>
              <a class="btn btn-primary text-white" onclick="ClickSalvar()">Save</a>
              <?php
        } //fim do echo mostra
        ?>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
  </div>
  <script languege="javascript">
    function ClickCancel() {
      Swal.fire({
          title: "Confirm Cancellation?",
          html: "Upon confirmation, <b>ALL</b> the changes on this screen will be lost. Confirm??",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#d33",
          cancelButtonText: "Cancel",
        confirmButtonText: "Confirm!"
        })
        .then((result) => {
          if (result.value) {
            spinner.show();
            window.location.href = "<?php echo(ADMIN."expprod"); ?>"
          }
        });
    }

    function ClickSalvar() {
      spinner.show();
      document.getElementById("id_form_exp_produtct").submit();
    }
  </script>