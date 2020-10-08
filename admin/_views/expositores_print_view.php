<?php if(!isset($TRUE) or ($TRUE<>"index.php")) die("LOCKED");
logado('ADMIN');
$dados=$_SESSION['dados']; 
?>
<div class="d-flex flex-row">
  <div class="col mx-auto">
    <div class="table-responsive">
        <h1>Cadastro de expositores</h1>
         <div class="form-group p-2">
          <label class="col-form-label">ID Seller: <b><?php echo($dados['nId']);?></b></label><br>
          <label class="col-form-label">Seller Name: <b><?php echo($dados['cName']);?></b></label><br>
          <label class="col-form-label">Seller Address: <b><?php echo($dados['cAddress']);?></b></label><br>
          <label class="col-form-label">Country: <b><?php printa($dados['cCountry'],$dados['cCountry_list']);?></b></label><br>
          <label class="col-form-label">Post Code: <b><?php echo($dados['cPostCode']);?></b></label><br>
          <label class="col-form-label">Phone Number: <b><?php echo($dados['cPhone1']);?></b></label><br>
          <label class="col-form-label">Direct Phone Number: <b><?php echo($dados['cPhone2']);?></b></label><br>
          <label class="col-form-label">Site *: <b><?php echo($dados['cWeb']);?></b></label><br>
          <label class="col-form-label">Logo File: <img src='<?php echo(URL.$dados['aLogo']);?>' width=250px><br>
          <label class="col-form-label">Hotels & Resorts: <b><?php printa($dados['SI_1'],$dados['SI_1_list']);?></b></label><br>
          <label class="col-form-label">Others: <b><?php echo($dados['SI_1_ourtros']);?></b></label><br>
          <label class="col-form-label">Tour Operators / Travel Agents: <b><?php printa($dados['SL_2'],$dados['SL_2_list']);?></b></label><br>
          <label class="col-form-label">Others: <b><?php echo($dados['SL_2_outros']);?></b></label><br>
          <label class="col-form-label">Associations / Tourism Organisations: <b><?php printa($dados['SL_3'],$dados['SL_3_list']);?></b></label><br>
          <label class="col-form-label">Others: <b><?php echo($dados['SL_3_outros']);?></b></label><br>
          <label class="col-form-label">Transportations / Carriers: <b><?php printa($dados['SL_4'],$dados['SL_4_list']);?></b></label><br>
          <label class="col-form-label">Others: <b><?php echo($dados['SL_4_outros']);?></b></label><br>
          <label class="col-form-label"> Business Travel / MICE: <b><?php printa($dados['SL_5'],$dados['SL_5_list']);?></b></label><br>
          <label class="col-form-label">Others: <b><?php echo($dados['SL_5_outros']);?></b></label><br>                
          <label class="col-form-label">Others: <b><?php printa($dados['SL_6'],$dados['SL_5_list']);?></b></label><br>
          <label class="col-form-label">Others: <b><?php echo($dados['SL_6_outros']);?></b></label><br>
          <label class="col-form-label">TOP3 MARKETS (COUNTRIES) 1: <b><?php printa($dados['cCountryMk1'],$dados['cCountry_list']);?></b></label><br>
          <label class="col-form-label">TOP3 MARKETS (COUNTRIES) 2: <b><?php printa($dados['cCountryMk2'],$dados['cCountry_list']);?></b></label><br>
          <label class="col-form-label">TOP3 MARKETS (COUNTRIES) 3: <b><?php printa($dados['cCountryMk3'],$dados['cCountry_list']);?></b></label><br>
          <label class="col-form-label">Company Description (Describe your organisation in not more than 50 words) BLOCK: <br><p><span style='border:1px solid;'><?php echo($dados['tDescription']);?></span></p></label><br>
          <label class="col-form-label">Photos of Products: <br>
          <?php foreach($dados['Products'] as $v){
            echo "<img src='".URL.$v."' width=200px> ";
          }?>
          </label><br>
          <label class="col-form-label">Delegates: <br></label>
          <table class='table'><tr><td>Foto<td>Nome<td>Email<td>Telefone<td>Admin
          <?php foreach($dados['Delegates'] as $v){
            echo '<tr><td><img src='.URL.$v['fPhoto'].' width=200px;><td>'.$v['cNome'].'<td>'.$v['cEmail'].'<td>'.$v['cPhone'].'<td>'.$v['eAdm'];
            echo '<td><a href=\''.ADMIN.'delegate/senha/'.$v['nId'].'\' class=\'btn btn-info\'>ALTERA SENHA</a>';
          }?>
          </table>
          <label class="col-form-label">Resources: <br>
          <table class='table'><tr><td>File<td>Descrição
          <?php foreach($dados['Resources'] as $v){
            echo '<tr><td><a href=\''.URL.$v['aFile'].'\' target=_blank>'.$v[title].'</a><td>'.$v['descricao'];
          }?>
          </table>
          <label class="col-form-label">Videos: <br></label>
          <div class="d-flex">
          <?php foreach($dados['Videos'] as $v){
            ?>
            <div style="width:280px;height:165px; margin:5px;">
            <iframe width='280' height='165' src="https://www.youtube.com/embed/<?php echo ($v['aFile']); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <?php } ?>
          </div><br>
        </div>
        <div class="form-group">
        <a class="btn btn-primary" href='<?php echo(ADMIN.'expositores'); ?>'>Voltar Para a Listagem</a>
        </div>
      </fieldset>
    </div>
  </div>
</div>