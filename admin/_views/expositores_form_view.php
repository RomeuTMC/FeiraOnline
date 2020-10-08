<?php if(!isset($TRUE) or ($TRUE<>"index.php")) die("LOCKED");
logado('ADMIN');
$dados=$_SESSION['dados']; ?>
<div class="d-flex flex-row">
  <div class="col mx-auto">
    <div class="table-responsive">
      <form method="POST" action="<?php echo URL;?>expositor/save/<?php echo($dados['nId']);?>" id="id_form_expositores" name="form_expositores" enctype='multipart/form-data'>
      <h1 class='form_title'><?php echo($dados['titulo']);?></h1>
      <fieldset class="frm_field">
        <legend>Seller</legend>
              <input type="hidden" id="id_nId" name="nId" value="<?php echo($dados['nId']);?>">
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Seller Name</label>
                <input type="text" class="form-control" id="id_cName" name="cName" value="<?php echo($dados['cName']);?>" maxlength=250 required placeholder='Enter the company name to be displayed'>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Seller Address</label>
                <input type="text" class="form-control" id="id_cAddress" name="cAddress" value="<?php echo($dados['cAddress']);?>" maxlength=255 required placeholder='Enter the company address'>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Country</label><br>
                <?php mk_select('cCountry',$dados['cCountry'],$dados['cCountry_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Post Code</label>
                <input type="text" class="form-control" id="id_cPostCode" name="cPostCode" value="<?php echo($dados['cPostCode']);?>" maxlength=12 required placeholder='Enter the company PostCode'>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Phone Number</label>
                <input type="text" class="form-control" id="id_cPhone1" name="cPhone1" value="<?php echo($dados['cPhone1']);?>" maxlength=25 required placeholder='Enter the company Phone Number'>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Direct Phone Number</label>
                <input type="text" class="form-control" id="id_cPhone2" name="cPhone2" value="<?php echo($dados['cPhone2']);?>" maxlength=25  placeholder='Enter the Direct Phone Number or Cellphone'>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Mail (login) *</label>
                <input type="email" class="form-control" id="id_cEmail" name="cEmail" value="<?php echo($dados['cEmail']);?>" maxlength=200 required placeholder='Enter Mail from Login' autocomplete="username">
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Site *</label>
                <input type="url" class="form-control" id="id_cWeb" name="cWeb" value="<?php echo($dados['cWeb']);?>" maxlength=200 placeholder='Enter Site with http:// ou https:// Ex. http://www.companyname.com'>
              </div>
      </fieldset>
      <fieldset class="frm_field">
        <legend>Personal Contact</legend>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Contact Person</label>SET
                <?php mk_select('ePerson',$dados['ePerson'],$dados['ePerson_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Complete Name (for Credential)</label>
                <input type="text" class="form-control" id="id_cPersonalName" name="cPersonalName" value="<?php echo($dados['cPersonalName']);?>" maxlength=250 required placeholder='Full name for the credential'>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Position</label>
                <input type="text" class="form-control" id="id_cCargo" name="cCargo" value="<?php echo($dados['cCargo']);?>" maxlength=150 placeholder='For the credential'>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Personal Mail</label>
                <input type="text" class="form-control" id="id_cPersonalEmail" name="cPersonalEmail" value="<?php echo($dados['cPersonalEmail']);?>" maxlength=200 placeholder='To appear in contact information'>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Cell Phone</label>
                <input type="text" class="form-control" id="id_cPersonalPhone" name="cPersonalPhone" value="<?php echo($dados['cPersonalPhone']);?>" maxlength=25 placeholder='to appear in contact information'>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Business Type</label>
                <?php mk_select('nBusinessType',$dados['nBusinessType'],$dados['nBusinessType_list'], 'VerificaEstatusBusinessType'); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Others</label>
                <input type="text" class="form-control" id="id_nBusinessTypeOther" name="nBusinessTypeOther" value="<?php echo($dados['nBusinessTypeOther']);?>" maxlength=100 readonly>
              </div>
      </fieldset>
      <fieldset class="frm_field">
        <legend>Business License Information</legend>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Business Licence Number</label>
                <input type="text" class="form-control" id="id_nBLI" name="nBLI" value="<?php echo($dados['nBLI']);?>" maxlength=50 required placeholder='Numbers Only'>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">B. L. I. Expiration Date</label>
                <input type="date" class="form-control" id="id_dBLI" name="dBLI" value="<?php echo($dados['dBLI']);?>" required min="2020-07-01">
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">VAT Certificate Number</label>
                <input type="text" class="form-control" id="id_cVAT" name="cVAT" value="<?php echo($dados['cVAT']);?>" maxlength=50 required>
              </div>
      </fieldset>
      <fieldset class="frm_field">
        <legend>SELLER TAX RECEIPT INFORMATION</legend>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Company Name for Receipt</label>
                <input type="text" class="form-control" id="id_cCNR" name="cCNR" value="<?php echo($dados['cCNR']);?>" maxlength=50 required placeholder='Name used in the issuance of the Receipt of Payments'>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Tax Id Number (13 Digits)</label>
                <input type="text" class="form-control" id="id_cTaxID" name="cTaxID" value="<?php echo($dados['cTaxID']);?>" maxlength=20 required placeholder='Numbers Only'>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Address For Receipt</label>
                <input type="text" class="form-control" id="id_cTaxAddr" name="cTaxAddr" value="<?php echo($dados['cTaxAddr']);?>" maxlength=250 required placeholder='Adderss used in the issuance of the Receipt of Payments'>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Country For Receipt</label>
                <?php mk_select('cCountryR',$dados['cCountryR'],$dados['cCountry_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Phone For Receipt</label>
                <input type="text" class="form-control" id="id_Phone1R" name="Phone1R" value="<?php echo($dados['Phone1R']);?>" maxlength=25  placeholder='Used in the issuance of the Receipt of Payments'>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Mail For Receipt</label>
                <input type="text" class="form-control" id="id_MailR" name="MailR" value="<?php echo($dados['MailR']);?>" maxlength=200 placeholder='Used in the issuance of the Receipt of Payments'>
              </div>
      </fieldset>
      <fieldset class="frm_field">
        <legend>SELLER INFORMATION</legend>
        <h2 class='form_subtitle'>TYPE OF BUSINESS SERVICES YOU PROVIDE (YOU CAN CHOOSE MORE THAN ONE)</h3>
              <div class="form-group p-2">
                <span class="col-form-label">1. Hotels & Resorts</span><br>
                <?php mk_check('SI_1',$dados['SI_1'],$dados['SI_1_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Others</label>
                <input type="text" class="form-control" id="id_SI_1_outros" name="SI_1_outros" value="<?php echo($dados['SI_1_outros']);?>" maxlength=250>
              </div>
              <hr class='check_separator'>
              <div class="form-group p-2">
              <label for="message-text" class="col-form-label">2. Hotels & Resorts</label><br>
                <?php mk_check('SL_1',$dados['SL_2'],$dados['SL_2_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Others</label>
                <input type="text" class="form-control" id="id_SL_2_outros" name="SL_2_outros" value="<?php echo($dados['SL_2_outros']);?>" maxlength=250>
              </div>
              <hr class='check_separator'>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">3. Associations / Tourism Organisations</label><br>
                <?php mk_check('SL_3',$dados['SL_3'],$dados['SL_3_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Others</label>
                <input type="text" class="form-control" id="id_SL_3_outros" name="SL_3_outros" value="<?php echo($dados['SL_3_outros']);?>" maxlength=250>
              </div>
              <hr class='check_separator'>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">4. Transportations / Carriers</label><br>
                <?php mk_check('SL_4',$dados['SL_4'],$dados['SL_4_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Others</label>
                <input type="text" class="form-control" id="id_SL_4_outros" name="SL_4_outros" value="<?php echo($dados['SL_4_outros']);?>" maxlength=250>
              </div>
              <hr class='check_separator'>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">5. Business Travel / MICE</label><br>
                <?php mk_check('SL_5',$dados['SL_5'],$dados['SL_5_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Others</label>
                <input type="text" class="form-control" id="id_SL_5_outros" name="SL_5_outros" value="<?php echo($dados['SL_5_outros']);?>" maxlength=250>
              </div>
              <hr class='check_separator'>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">6. Others</label><br>
                <?php mk_check('SL_6',$dados['SL_6'],$dados['SL_6_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Others</label>
                <input type="text" class="form-control" id="id_SL_6_outros" name="SL_6_outros" value="<?php echo($dados['SL_6_outros']);?>" maxlength=250>
              </div>
              <hr class='check_separator'>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">TOP3 MARKETS (COUNTRIES) 1</label>
                <?php mk_select('cCountryMk1',$dados['cCountryMk1'],$dados['cCountry_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">TOP3 MARKETS (COUNTRIES) 2</label>
                <?php mk_select('cCountryMk2',$dados['cCountryMk2'],$dados['cCountry_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">TOP3 MARKETS (COUNTRIES) 3</label>
                <?php mk_select('cCountryMk3',$dados['cCountryMk3'],$dados['cCountry_list']); ?>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Company Description (Describe your organisation in not more than 50~200 words)</label>
                <textarea class="form-control" id="id_tDescription" name="tDescription" value="" required wrap="hard" cols=80 placeholder='Description will appear in the profile, and helps users to understand your products'><?php echo($dados['tDescription']);?></textarea>
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