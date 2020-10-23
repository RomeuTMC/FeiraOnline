<?php if(!isset($TRUE) or ($TRUE<>"index.php")) die("LOCKED");
$dados=$_SESSION['dados'];
include_once('topo.php');
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
<div class="d-flex flex-row">
  <div class="col mx-auto">
    <div class="table-responsive">
      <form method="POST" action="<?php echo(ADMIN."exp_resource/save/".$dados['nId']);?>" id="id_form_exp_resouce" name="form_exp_resouce" enctype='multipart/form-data'>
      <fieldset class="frm_field">
        <h1 class="font-weight-bold"><?php echo($dados['titulo']);?></h1>
        <div class="w-100">
    <hr>
  </div>
                <input type="hidden" id="id_nId" name="nId" value="<?php echo($dados['nId']);?>">
                <input type="hidden" id="id_nId_expositor" name="nId_expositor" value="<?php echo($dados['nId_expositor']);?>">
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Title or Name To Link File</label>
                <input type="text" class="form-control" id="id_title" name="title" value="<?php echo($dados['descricao']);?>" maxlength=99>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">File For Download (any type)</label>
                <input type="file" class="form-control i-file" id="id_aFile" name="aFile" accept="image/*, .doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document, audio/*, video/*, .xls, .csv, .ics, .pdf, .odf, .odt, .xlsx, application/pdf,application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Describe Our Content File</label>
                <input type="text" class="form-control" id="id_descricao" name="descricao" value="<?php echo($dados['descricao']);?>" maxlength=255>
              </div>
        <div class="form-group">
        <?php
        if(!empty($dados['read']) and $dados['read']=='SIM'){
          //MOSTRA VOLTAR
          ?>
          <a class="btn btn-dark" onclick="spinner.show(); window.location.href = '<?php echo(ADMIN."/exp_resouce"); ?>'">VOLTAR</a>
        <?php } else { ?>
        <a class="btn btn-secondary text-white" onclick="ClickCancel()" >Cancel</a>
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
function ClickCancel(){
  Swal.fire({
        title: "Confirm Cancellation?",
        html: "Upon confirmation, <b>ALL</b> the changes on this screen will be lost. Confirm?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonText: "Cancel",
        confirmButtonText: "Confirm!"
      })
      .then((result) => {
        if (result.value) {
          spinner.show();
          window.location.href = "<?php echo(ADMIN."exp_resource"); ?>"
        }
      });
}

function ClickSalvar(){
  spinner.show();
  document.getElementById("id_form_exp_resouce").submit();
}
</script>