<?php if(!isset($TRUE) or ($TRUE<>"index.php")) die("LOCKED");
$dados=$_SESSION['dados']; ?>
<div class="d-flex flex-row">
  <div class="col mx-auto">
    <div class="table-responsive">
      <form method="POST" action="<?php echo(ADMIN."clientes/save/".$dados['nId']);?>" id="id_form_clientes" name="form_clientes">
      <fieldset class="frm_field">
        <legend>Cadastro de clientes</legend>
          <div class="form-group p-2">
                <label class="col-form-label">ID do Cliente: <b><?php echo($dados['nId']);?></b></label><br>
                <label class="col-form-label">Buyer Company Name: <b><?php echo($dados['cCompany']);?></b></label><br>
                <label class="col-form-label">Address: <b><?php echo($dados['cAddress']);?></b></label><br>
                <label class="col-form-label">City: <b><?php echo($dados['cCity']);?></b></label><br>
                <label class="col-form-label">Post Code: <b><?php echo($dados['cCEP']);?></b></label><br>
                <label class="col-form-label">Country: <b><?php printa($dados['cCountry'],$dados['cCountry_list']);?></b></label><br>
                <label class="col-form-label">Website: <b><?php echo($dados['cWeb']);?></b></label><br>
                <label class="col-form-label">WhatsApp (for emergency): <b><?php echo($dados['cWhatsapp']);?></b></label><br>
                <label class="col-form-label">Phone: <b><?php echo($dados['cPhone1']);?></b></label><br>
                <label class="col-form-label">Complete Name: <b><?php printa($dados['ePerson'],$dados['ePerson_list']);?> <?php echo($dados['cPersonalName']);?></b></label><br>
                <label class="col-form-label">Job Title: <b><?php echo($dados['cCargo']);?></b></label><br>
                <label class="col-form-label">Mail: <b><?php echo($dados['cEmail']);?></b></label><br>
                <label class="col-form-label">Company Business Profile: <b><?php printa($dados['CompanyProfile'],$dados['CompanyProfile_list']);?></b></label><br>
                <label class="col-form-label">Product of Interest: <b><?php printa($dados['ProductInterest'],$dados['ProductInterest_list']);?></b></label><br>
                <label class="col-form-label">What Level of Responsibility do You Have for Outbound Business: <b><?php printa($dados['eResponsa'],$dados['eResponsa_list']);?></b></label><br>
                <label class="col-form-label">Major Selector: <b><?php printa($dados['eMajorSector'],$dados['eMajorSector_list']);?></b></label><br>
                <label class="col-form-label">Inbound %: <b><?php echo($dados['nInbound']);?></b></label><br>
                <label class="col-form-label">Outbound %: <b><?php echo($dados['nOutbound']);?></b></label><br>
                <label class="col-form-label">Number of Outbound Group Organized Per Year?: <b><?php printa($dados['nOutboundGroup'],$dados['nOutboundGroup_list']);?></b></label><br>
                <label class="col-form-label">Average Number of Outbound Pax(s) Organized per Year?: <b><?php printa($dados['nOutboundAverage'],$dados['nOutboundAverage_list']);?></b></label><br>
                <label class="col-form-label">Principais Fornecedores: <b><?php echo($dados['cSeller1']);?>;<?php echo($dados['cSeller2']);?>;<?php echo($dados['cSeller3']);?>;<?php echo($dados['cSeller4']);?>;<?php echo($dados['cSeller5']);?></b></label><br>
                <label class="col-form-label">Principais Paises: <b><?php printa($dados['cCountry1'],$dados['cCountry_list']);?>;<?php printa($dados['cCountry2'],$dados['cCountry_list']);?>;<?php printa($dados['cCountry3'],$dados['cCountry_list']);?>;<?php printa($dados['cCountry4'],$dados['cCountry_list']);?>;<?php printa($dados['cCountry5'],$dados['cCountry_list']);?></b></label><br>
                <label class="col-form-label">Principais Destinos: <b><?php printa($dados['cDestino1'],$dados['cCountry_list']);?>;<?php printa($dados['cDestino2'],$dados['cCountry_list']);?>;<?php printa($dados['cDestino3'],$dados['cCountry_list']);?>;<?php printa($dados['cDestino4'],$dados['cCountry_list']);?>;<?php printa($dados['cDestino5'],$dados['cCountry_list']);?></b></label><br>
                <label class="col-form-label">Company Description: <br>
                <p><pre><?php echo($dados['tDescription']);?></pre></p>
                </label><br>
        </div>
        <div class="form-group">
        <a class="btn btn-secondary" onclick="ClickCancel()" >Cancelar</a>
        </div>
      </fieldset>
    </div>
  </div>
</div>