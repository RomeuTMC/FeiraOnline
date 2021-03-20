<?php
if(!isset($_GET['table'])){ 
  echo "DEFINA ?table=tabela_do_banco - para criar um formulário para a tabela selecionada";
  die('--');
}
header('Content-Type: text/plain; charset=utf-8');
require_once("./../_configure.php"); // Carrega as funções e configurações globais
define('MAKER',URL.'MAKER');

$pr=SqlQuery('SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_NAME="'.$_GET['table'].'" and COLUMN_KEY="PRI" limit 1');
$r=SqlQuery('SELECT COLUMN_NAME,DATA_TYPE, CHARACTER_MAXIMUM_LENGTH, COLUMN_KEY, COLUMN_COMMENT,COLUMN_KEY
FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_NAME="'.$_GET['table'].'" ');
$PRIA = $pr->fetch(PDO::FETCH_ASSOC);
$PRI=$PRIA['COLUMN_NAME'];
$fields = array();
echo '<?php if(!isset($TRUE) or ($TRUE<>"index.php")) die("LOCKED");
$dados=$_SESSION[\'dados\']; ?>';
//cria o formulário conforme o tipo de dados
echo '
<div class="d-flex flex-row">
  <div class="col mx-auto">
    <div class="table-responsive">
      <form method="POST" action="<?php echo(ADMIN."'.$_GET['table'].'/save/".$dados[\''.$PRI.'\']);?>" id="id_form_'.$_GET['table'].'" name="form_'.$_GET['table'].'">
      <fieldset class="frm_field">
        <legend>Cadastro de '.$_GET['table'].'</legend>
          <div class="form-group p-2">';
          while($f = $r->fetch(PDO::FETCH_ASSOC)) {
              echo '
                <label class="col-form-label">'.$f['COLUMN_COMMENT'].': <b><?php echo($dados[\''.$f['COLUMN_NAME'].'\']);?></b></label><br>';
          } // ENDWHILE
        echo '
        </div>
        <div class="form-group">
        <a class="btn btn-secondary" onclick="ClickCancel()" >Cancelar</a>
        </div>
      </fieldset>
    </div>
  </div>
</div>';