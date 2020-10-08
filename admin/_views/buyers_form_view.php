<?php if(!isset($TRUE) or ($TRUE<>"index.php")) die("LOCKED");
logado('ADMIN');
$dados=$_SESSION['dados']; ?>
<div class="d-flex flex-row">
  <div class="col mx-auto">
    <div class="table-responsive">
      <form method="POST" action="<?php echo(ADMIN."buyers/save/".$dados['nId']);?>" id="id_form_clientes" name="form_clientes">
      <fieldset class="frm_field">
        <legend>Cadastro de clientes</legend>
                <input type="hidden" id="id_nId" name="nId" value="<?php echo($dados['nId']);?>">
                
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
                <label for="message-text" class="col-form-label">Person</label>
                <?php mk_select('ePerson',$dados['ePerson'],$dados['ePerson_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Complete Name (for credential)</label>
                <input type="text" class="form-control" id="id_cPersonalName" name="cPersonalName" value="<?php echo($dados['cPersonalName']);?>" maxlength=250>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Job Title (for Credential)</label>
                <input type="text" class="form-control" id="id_cCargo" name="cCargo" value="<?php echo($dados['cCargo']);?>" maxlength=150>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Mail (for Credential)</label>
                <input type="text" class="form-control" id="id_cEmail" name="cEmail" value="<?php echo($dados['cEmail']);?>" maxlength=200>
              </div>
        </fieldset>
        <fieldset class="frm_field">
        <legend>Buyer Questionnaire</legend>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Company Business Profile</label>
                <?php mk_check('CompanyProfile',$dados['CompanyProfile'],$dados['CompanyProfile_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Product of Interest</label>
                <?php mk_check('ProductInterest',$dados['ProductInterest'],$dados['ProductInterest_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">What Level of Responsibility do You Have for Outbound Business</label>
                <?php mk_select('eResponsa',$dados['eResponsa'],$dados['eResponsa_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Major Selector</label>
                <?php mk_select('eMajorSector',$dados['eMajorSector'],$dados['eMajorSector_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Inbound %</label>
                <input type="number" class="form-control" id="id_nInbound" name="nInbound" value="<?php echo($dados['nInbound']);?>" maxlength= step="1" min="0">
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Outbound %</label>
                <input type="number" class="form-control" id="id_nOutbound" name="nOutbound" value="<?php echo($dados['nOutbound']);?>" maxlength= step="1" min="0">
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Number of Outbound Group Organized Per Year?</label>
                <?php mk_select('nOutboundGroup',$dados['nOutboundGroup'],$dados['nOutboundGroup_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Average Number of Outbound Pax(s) Organized per Year?</label>
                <?php mk_select('nOutboundAverage',$dados['nOutboundAverage'],$dados['nOutboundAverage_list']); ?>
              </div>
              <h3 class='message-title'>Name 5 existing service Suppliers/Sellers you are currently working with in the asia pacific region</h3>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Name 1</label>
                <input type="text" class="form-control" id="id_cSeller1" name="cSeller1" value="<?php echo($dados['cSeller1']);?>" maxlength=200>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Name 2</label>
                <input type="text" class="form-control" id="id_cSeller2" name="cSeller2" value="<?php echo($dados['cSeller2']);?>" maxlength=200>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Name 3</label>
                <input type="text" class="form-control" id="id_cSeller3" name="cSeller3" value="<?php echo($dados['cSeller3']);?>" maxlength=200>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Name 4</label>
                <input type="text" class="form-control" id="id_cSeller4" name="cSeller4" value="<?php echo($dados['cSeller4']);?>" maxlength=200>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Name 5</label>
                <input type="text" class="form-control" id="id_cSeller5" name="cSeller5" value="<?php echo($dados['cSeller5']);?>" maxlength=200>
              </div>
              <h3 class='message-title'>Name 5 Countries/Destinations you are currently sending business to the asia pacifc region</h3>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Country 1</label>
                <?php mk_select('cCountry1',$dados['cCountry1'],$dados['cCountry_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Country 2</label>
                <?php mk_select('cCountry2',$dados['cCountry2'],$dados['cCountry_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Country 3</label>
                <?php mk_select('cCountry3',$dados['cCountry3'],$dados['cCountry_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Country 4</label>
                <?php mk_select('cCountry4',$dados['cCountry4'],$dados['cCountry_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Country 5</label>
                <?php mk_select('cCountry5',$dados['cCountry5'],$dados['cCountry_list']); ?>
              </div>
              <h3 class='message-title'>Name 5 Country/Destinations you are planning to develop business to asia pacifc region</h3>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Destination 1</label>
                <?php mk_select('cDestino1',$dados['cDestino1'],$dados['cCountry_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Destination 2</label>
                <?php mk_select('cDestino2',$dados['cDestino2'],$dados['cCountry_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Destination 3</label>
                <?php mk_select('cDestino3',$dados['cDestino3'],$dados['cCountry_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Destination 4</label>
                <?php mk_select('cDestino4',$dados['cDestino4'],$dados['cCountry_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Destination 5</label>
                <?php mk_select('cDestino5',$dados['cDestino5'],$dados['cCountry_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Company Description</label>
                <textarea class="form-control" id="id_tDescription" name="tDescription" value="" wrap="hard" cols=80><?php echo($dados['tDescription']);?></textarea>
              </div>
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
          window.location.href = "<?php echo(ADMIN."/buyers"); ?>"
        }
      });
}

function ClickSalvar(){
  spinner.show();
  document.getElementById("id_form_clientes").submit();
}
</script>