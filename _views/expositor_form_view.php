<?php if(!isset($TRUE) or ($TRUE<>"index.php")) die("LOCKED");
$dados=$_SESSION['dados']; ?>
<?php include_once(_FS.'/_parts/_header_expositor.php'); ?>

<div class="container mt-5 d-flex flex-row">
  <div class="col mx-auto">
    <div class="">
      <form method="POST" action="<?php echo URL;?>expositor/save/<?php echo($dados['nId']);?>" class="mb-5"
        id="id_form_expositores" name="form_expositores" enctype='multipart/form-data'>
        <h1 class='form_title font-weight-bold color-pink'>Exhibitor - <small class="font-weight-bold">(Seller)</small>
        </h1>
        <fieldset class="frm_field">
          <input type="hidden" id="id_nId" name="nId" value="<?php echo($dados['nId']);?>">
          <div class="form-group p-2">
            <label for="message-text" class="col-form-label color-pink">Company Name</label>
            <input type="text" class="form-control" id="id_cName" name="cName" value="<?php echo($dados['cName']);?>"
              maxlength=250 required placeholder='Enter the company name to be displayed'>
          </div>
          <div class="form-group p-2">
            <label for="message-text" class="col-form-label">Company Address</label>
            <input type="text" class="form-control" id="id_cAddress" name="cAddress"
              value="<?php echo($dados['cAddress']);?>" maxlength=255 required placeholder='Enter the company address'>
          </div>
          <div class="form-group p-2">
            <label for="message-text" class="col-form-label">Country</label><br>
            <?php mk_select('cCountry',$dados['cCountry'],$dados['cCountry_list']); ?>
          </div>
          <div class="form-group p-2">
            <label for="message-text" class="col-form-label">Postal Code (Enter the company Postal Code)</label>
            <input type="text" class="form-control" id="id_cPostCode" name="cPostCode"
              value="<?php echo($dados['cPostCode']);?>" maxlength=12 required placeholder='Enter the company PostCode'>
          </div>
          <div class="form-group p-2">
            <label for="message-text" class="col-form-label">Phone Number</label>
            <input type="text" class="form-control" id="id_cPhone1" name="cPhone1"
              value="<?php echo($dados['cPhone1']);?>" maxlength=25 required
              placeholder='Enter the company Phone Number'>
          </div>
          <div class="form-group p-2">
            <label for="message-text" class="col-form-label">Direct Phone Number</label>
            <input type="text" class="form-control" id="id_cPhone2" name="cPhone2"
              value="<?php echo($dados['cPhone2']);?>" maxlength=25
              placeholder='Enter the Direct Phone Number or Cellphone'>
          </div>
          <div class="form-group p-2">
            <label for="message-text" class="col-form-label">Site (Enter Site with http:// ou https:// Ex.
              http://www.companyname.com) *</label>
            <input type="url" class="form-control" id="id_cWeb" name="cWeb" value="<?php echo($dados['cWeb']);?>"
              maxlength=200 placeholder='Enter Site with http:// ou https:// Ex. http://www.companyname.com'>
          </div>
          <div class="form-group p-2">
            <label for="message-text" class="col-form-label">Company Description (Describe your organisation in not
              more than 50~200 words)</label>
            <textarea class="form-control" id="id_tDescription" name="tDescription" value="" required wrap="hard"
              cols=80
              placeholder='Description will appear in the profile, and helps users to understand your products'><?php echo($dados['tDescription']);?></textarea>
          </div>
        </fieldset>
        <legend class="color-pink font-weight-bold">Company Delegates Information</legend>
        <p class="color-pink font-weight-bold">(Delegates who are set as Admin are able to attend appointments and edit booth information)</p>
        <fieldset class="input-form">
          <div class="form-group">
            <div class="form-row p-2">
              <div class="col">
                <label for="inputEmail4">Delegate Photo</label>
                <input type="file" class="form-control i-file" name='dele_foto[]' required accept="image/*">
              </div>
              <div class="col">
                <label for="inputEmail4">Name</label>
                <input type="text" class="form-control" name='dele_nome[]'
                  style="padding: 2.5rem 1rem;">
              </div>
              <div class="col">
                <label for="inputEmail4">E-mail</label>
                <input type="text" class="form-control" name='dele_email[]'
                  style="padding: 2.5rem 1rem;">
              </div>
              <div class="col">
                <label for="inputEmail4">Password</label>
                <input type="password" class="form-control" name='dele_passw[]'
                  style="padding: 2.5rem 1rem;">
              </div>
              <div class="col">
                <label for="inputEmail4">Cellphone</label>
                <input type="text" class="form-control" name='dele_fone[]'
                  style="padding: 2.5rem 1rem;">
              </div>
              <style>
                .slpadding{padding: 1.75rem 1rem;}
              </style>
              <div class="col">
                <label for="inputEmail4">Admin?</label>
                <?php mk_select('dele_adm[]',$dados['dele_adm'],$dados['adm_list'],'','slpadding'); ?>
              </div>

            </div>
          </div>
          </fieldset>
          <div class="p-2">
            <input type='button' class="mb-3 p-4 btn btn-secondary" id='but_add' value='Add new delegate'>
            </div>

          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <script>
            $(document).ready(function () {
              $('#but_add').click(function () {
                // Create clone of <div class='input-form'>
                $('.input-form:last').clone()
                  .find("input:text,input:password,input:file").val("").end()
                  .appendTo('.input-form:last');


              });
            });
          </script>

        <fieldset class="frm_field">
          <legend class="color-pink font-weight-bold">LOGO and Product Photos</legend>
          <div class="form-group p-2">
            <label for="message-text" class="col-form-label">Company Logo</label>
            <input type="file" class="form-control i-file" id="id_aLogo" name="aLogo"
              value="<?php echo($dados['aLogo']);?>" accept="image/*" required placeholder='Numbers Only'>
          </div>
          <div class="form-group p-2">
            <label for="message-text" class="col-form-label">Attach Photo (all photos appear on your profile in
              random order)</label>
            <input type="file" class="form-control i-file" id="id_aProducts" name="aProducts[]"
              value="<?php echo($dados['aLogo']);?>" accept="image/*" required multiple>
          </div>
        </fieldset>
        <fieldset class="frm_field">
          <legend class="color-pink font-weight-bold">COMPANY INFORMATION</legend>
          <p class='form_subtitle color-pink font-weight-bold'>TYPE OF BUSINESS SERVICES YOU PROVIDE (YOU CAN CHOOSE
            MORE THAN ONE)</p>

          <div class="form-group p-2">
            <span class="col-form-label font-weight-bold">1. Hotels & Resorts</span><br><br>
            <input type="checkbox" id="SI_1" name="SI_1[]" value="" style="opacity:0;pointer-events: none;">
            <?php mk_check('SI_1',$dados['SI_1'],$dados['SI_1_list']); ?>
          </div>
          <div class="form-group p-2">
            <label for="message-text" class="col-form-label">Others</label>
            <input type="text" class="form-control" id="id_SI_1_outros" name="SI_1_outros"
              value="<?php echo($dados['SI_1_outros']);?>" maxlength=250>
          </div>
          <hr class='check_separator'>
          <div class="form-group p-2">
            <span class="col-form-label font-weight-bold">2. Type of Tours</span><br><br>
            <!-- <label for="message-text" class="col-form-label">2. Hotels & Resorts</label><br> -->
            <input type="checkbox" id="id_2_SL_1" name="SL_1[]" value="" style="opacity:0;pointer-events: none;">
            <?php mk_check('SL_1',$dados['SL_2'],$dados['SL_2_list']); ?>
          </div>
          <div class="form-group p-2">
            <label for="message-text" class="col-form-label">Others</label>
            <input type="text" class="form-control" id="id_SL_2_outros" name="SL_2_outros"
              value="<?php echo($dados['SL_2_outros']);?>" maxlength=250>
          </div>
          <hr class='check_separator'>
          <div class="form-group p-2">
            <span class="col-form-label font-weight-bold">3. Transportations / Carriers</span><br><br>
            <!-- <label for="message-text" class="col-form-label">4. Transportations / Carriers</label><br> -->
            <input type="checkbox" id="SL_4" name="SL_4[]" value="" style="opacity:0;pointer-events: none;">
            <?php mk_check('SL_4',$dados['SL_4'],$dados['SL_4_list']); ?>
          </div>
          <div class="form-group p-2">
            <label for="message-text" class="col-form-label">Others</label>
            <input type="text" class="form-control" id="id_SL_4_outros" name="SL_4_outros"
              value="<?php echo($dados['SL_4_outros']);?>" maxlength=250>
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

          <div class="form-group">
            <button type="submit" class="btn btn-primary font-weight-bold border-0 btn-save">Save</button>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</div>


<script>
  function ClickCancel() {
    Swal.fire({
        title: "Confirm Calcel?",
        html: "When confirming or canceling, all pre-given dice will be lost. Confirm?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonText: "Cancel",
        confirmButtonText: "Confirm!"
      })
      .then((result) => {
        if (result.value) {
          spinner.show();
          window.location.href = "<?php echo(" / expositor "); ?>";
        }
      });
  }

  $("#id_form_expositores").validate({

    submitHandler: function (form) {
      errorLabelContainer: $("#id_form_expositores div.error")
      // do other things for a valid form
      spinner.show();
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
      "SI_1[]": {
        required: true,
        minlength: 1
      },
      "SL_1[]": {
        required: true
      },
      "SL_3[]": {
        required: true
      },
      "SL_4[]": {
        required: true
      },
      "SL_5[]": {
        required: true
      },
      "SL_6[]": {
        required: true
      },
      cPassw: {
        required: true,
        minlength: 6,
        maxlength: 15
      },
      cPasswR: {
        required: true,
        minlength: 6,
        maxlength: 15,
        equalTo: "#id_cPassw"
      }
    }
  });

  function VerificaEstatusBusinessType() {
    console.log('CH');
    var selected = $("#id_nBusinessType").val();
    if (selected == 8) {
      $("#id_nBusinessTypeOther").prop('readonly', false);
    } else {
      $("#id_nBusinessTypeOther").val('');
      $("#id_nBusinessTypeOther").prop('readonly', true);
    }
  }
</script>