<?php if(!isset($TRUE) or ($TRUE<>"index.php")) die("LOCKED");
logado('ADMIN');
$dados=$_SESSION['dados']; 
?>
<div class="d-flex flex-row">
  <div class="col mx-auto">
    <div class="table-responsive">
      <form method="POST" action="<?php echo ADMIN;?>expositores/wheresave/<?php echo($dados['nId']);?>" id="id_form_expositores" name="form_expositores" enctype='multipart/form-data'>
      <h1 class='form_title'><?php echo($dados['titulo']);?></h1>
      <fieldset class="frm_field">
        <legend>Cadastro da Sala Whereby</legend>
              <input type="hidden" id="id_nId" name="nId" value="<?php echo($dados['nId']);?>">
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Seller Name</label>
                <label><?php echo($dados['cName']);?></label>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Whereby Meeting Room</label> <a href='<?php echo($dados['aWhereby']);?>' target=_blank><?php echo($dados['aWhereby']);?></a>
                <input type="text" class="form-control" id="id_	aWhereby" name="aWhereby" value="<?php echo($dados['aWhereby']);?>" maxlength=255 required placeholder='Enter the Whereby Room Address'>
              </div>
        <div class="form-group">
        <a class="btn btn-secondary" onclick="ClickCancel();" >Cancelar</a>
        <button type="submit" class="btn btn-primary" >Salvar</button>
        </div>
      </fieldset>
      </form>
    </div>
  </div>
</div>
<script language="javascript">
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
          window.location.href = "<?php echo("/expositor"); ?>";
        }
      });
}

$("#id_form_expositores").validate({
  submitHandler: function(form) {
    // do other things for a valid form
    spinner.show();
    console.log('VAI MANDAR');
    form_expositores.submit();
  },
    rules: {
      cName: {
        required: true
      },
      cAddress: {
        required: true
      },
      cPostCode: {
        required: true
      },
      cPhone1: {
        required: true
      },
      SI_1: {
        required: true
      },
      SL_1: {
        required: true
      },
      SL_3: {
        required: true
      },
      SL_4: {
        required: true
      },
      SL_5: {
        required: true
      },
      SL_6: {
        required: true
      }
  }
});

function VerificaEstatusBusinessType(){
  console.log('CH');
  var selected = $("#id_nBusinessType").val();
  if(selected == 8){
    $("#id_nBusinessTypeOther").prop('readonly', false);
  } else {
    $("#id_nBusinessTypeOther").val('');
    $("#id_nBusinessTypeOther").prop('readonly', true);
  }
}
</script>