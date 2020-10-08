<?php if(!isset($TRUE) or ($TRUE<>"index.php")) die("LOCKED");
logado('ADMIN');
$dados=$_SESSION['dados'];
?>
<div class="d-flex flex-row">
  <div class="col mx-auto">
    <div class="table-responsive">
      <form method="POST" action="<?php echo(ADMIN."agenda/save/".$dados['nId']);?>" id="id_form_appointments" name="form_appointments">
      <fieldset class="frm_field">
        <legend>Cadastro de Agenda</legend>
              <input type="hidden" id="id_nId" name="nId" value="<?php echo($dados['nId']);?>">  
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Cliente</label>
                <?php mk_select('nId_cliente',$dados['nId_cliente'],$dados['cliente_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Expositor</label>
                <?php mk_select('nId_expositor',$dados['nId_expositor'],$dados['expositor_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Horario</label>
                <?php mk_select('tHora',$dados['tHora'],$dados['tHora_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Dia (MONTH-DAY)</label>
                <?php mk_select('eDay',$dados['eDay'],$dados['eDay_list']); ?>
              </div>
        <div class="form-group">
        <?php 
        if(!empty($dados['read']) and $dados['read']=='SIM'){
          //MOSTRA VOLTAR
          ?>
          <a class="btn btn-dark" onclick="spinner.show(); window.location.href = '<?php echo(ADMIN."/appointments"); ?>'">VOLTAR</a>  
        <?php } else { ?>
        <a class="btn btn-secondary" onclick="ClickCancel()" >Cancelar</a>
        <a class="btn btn-primary" onclick="ClickSalvar()">Salvar</a>
        <?php 
        } //fim do echo mostra
        ?>
        </div>
      </fieldset>
      <script>document.getElementById("id_nId_cliente").focus();</script>
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
          window.location.href = "<?php echo(ADMIN."/appointments"); ?>"
        }
      });
}

function ClickSalvar(){
  spinner.show();
  document.getElementById("id_form_appointments").submit();
}
</script>