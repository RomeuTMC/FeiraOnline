<?php if(!isset($TRUE) or ($TRUE<>"index.php")) die("LOCKED");
$dados=$_SESSION['dados']; 
?>
<div class="d-flex flex-row">
  <div class="col mx-auto">
    <div class="table-responsive">
      <form method="POST" action="<?php echo(ADMIN."appointments/save/".$dados['nId']);?>" id="id_form_appointments" name="form_appointments">
      <fieldset class="frm_field">
        <legend>Cadastro de appointments</legend>
          <div class="form-group p-2">
                <label class="col-form-label">ID Appointment: <b><?php echo($dados['nId']);?></b></label><br>
                <label class="col-form-label">Expositor: <b><?php echo($dados['cName']);?></b></label><br>
                <label class="col-form-label">Cliente: <b><?php echo($dados['cCompany']);?></b></label><br>
                <label class="col-form-label">Horario: <b><?php echo($dados['tHora']);?></b></label><br>
                <label class="col-form-label">Dia: <b><?php echo($dados['eDay']);?></b></label><br>
                <label class="col-form-label">Avaliacao: <b><?php echo($dados['avaliacao']);?></b></label><br>
                <a href='<?php echo(URL.'salappts/#thai'.$dados['nId_expo'].'c'.$dados['nId_cliente']); ?>' target=_blank class='btn btn-success btn-block'>Access</a>
        </div>
        <div class="form-group">
        <a class="btn btn-secondary" onclick="ClickCancel()" >Cancelar</a>
        </div>
      </fieldset>
    </div>
  </div>
</div>