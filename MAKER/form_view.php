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
      <form  enctype=\'multipart/form-data\' method="POST" action="<?php echo(ADMIN."'.$_GET['table'].'/save/".$dados[\''.$PRI.'\']);?>" id="id_form_'.$_GET['table'].'" name="form_'.$_GET['table'].'">
      <fieldset class="frm_field">
        <legend>Cadastro de '.$_GET['table'].'</legend>';
          while($f = $r->fetch(PDO::FETCH_ASSOC)) {
            if($f['DATA_TYPE']=='varchar' or $f['DATA_TYPE']=='char' or $f['DATA_TYPE']=='tinytext'){
              echo '
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">'.$f['COLUMN_COMMENT'].'</label>
                <input type="text" class="form-control" id="id_'.$f['COLUMN_NAME'].'" name="'.$f['COLUMN_NAME'].'" value="<?php echo($dados[\''.$f['COLUMN_NAME'].'\']);?>" maxlength='.$f['CHARACTER_MAXIMUM_LENGTH'].'>
              </div>';
            } 
            if($f['DATA_TYPE']=='text' or $f['DATA_TYPE']=='mediumtext' or $f['DATA_TYPE']=='longtext'){
              echo '
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">'.$f['COLUMN_COMMENT'].'</label>
                <textarea class="form-control" id="id_'.$f['COLUMN_NAME'].'" name="'.$f['COLUMN_NAME'].'" value="" wrap="hard" cols=80><?php echo($dados[\''.$f['COLUMN_NAME'].'\']);?></textarea>
              </div>';
            }
            if($f['DATA_TYPE']=='blob' or $f['DATA_TYPE']=='mediumblob' or $f['DATA_TYPE']=='longblob'){
              echo '
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">'.$f['COLUMN_COMMENT'].'</label>BLOB
                <textarea class="form-control" id="id_'.$f['COLUMN_NAME'].'" name="'.$f['COLUMN_NAME'].'" value="<?php echo($dados[\''.$f['COLUMN_NAME'].'\']);?>" cols=200></textarea>
              </div>';
            }
            if($f['DATA_TYPE']=='tinyint' or $f['DATA_TYPE']=='smallint' or $f['DATA_TYPE']=='mediumint' or $f['DATA_TYPE']=='int' or $f['DATA_TYPE']=='bigint'){
              if($f['COLUMN_KEY']=='PRI'){
                echo '
                <input type="hidden" id="id_'.$f['COLUMN_NAME'].'" name="'.$f['COLUMN_NAME'].'" value="<?php echo($dados[\''.$f['COLUMN_NAME'].'\']);?>">
                ';
              } else {
              echo '
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">'.$f['COLUMN_COMMENT'].'</label>
                <input type="number" class="form-control" id="id_'.$f['COLUMN_NAME'].'" name="'.$f['COLUMN_NAME'].'" value="<?php echo($dados[\''.$f['COLUMN_NAME'].'\']);?>" maxlength='.$f['CHARACTER_MAXIMUM_LENGTH'].' step="1" min="0">
              </div>';
              }
            }
            if($f['DATA_TYPE']=='float' or $f['DATA_TYPE']=='double' or $f['DATA_TYPE']=='decimal'){
              echo '
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">'.$f['COLUMN_COMMENT'].'</label>
                <input type="number" class="form-control" id="id_'.$f['COLUMN_NAME'].'" name="'.$f['COLUMN_NAME'].'" value="<?php echo($dados[\''.$f['COLUMN_NAME'].'\']);?>" maxlength='.$f['CHARACTER_MAXIMUM_LENGTH'].' step="0.01" min="0">
              </div>';
            }
            if($f['DATA_TYPE']=='date'){
              echo '
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">'.$f['COLUMN_COMMENT'].'</label>
                <input type="date" class="form-control" id="id_'.$f['COLUMN_NAME'].'" name="'.$f['COLUMN_NAME'].'" value="<?php echo($dados[\''.$f['COLUMN_NAME'].'\']);?>" maxlength='.$f['CHARACTER_MAXIMUM_LENGTH'].' step="0.01" min="0">
              </div>';
            }
            if($f['DATA_TYPE']=='datetime'){
              echo '
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">'.$f['COLUMN_COMMENT'].'</label>
                <input type="datetime-local" class="form-control" id="id_'.$f['COLUMN_NAME'].'" name="'.$f['COLUMN_NAME'].'" value="<?php echo($dados[\''.$f['COLUMN_NAME'].'\']);?>" maxlength='.$f['CHARACTER_MAXIMUM_LENGTH'].' step="0.01" min="0">
              </div>';
            }
            if($f['DATA_TYPE']=='timestamp'){
              echo '
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">'.$f['COLUMN_COMMENT'].'</label>TIMESTAMP
                <input type="datetime-local" class="form-control" id="id_'.$f['COLUMN_NAME'].'" name="'.$f['COLUMN_NAME'].'" value="<?php echo($dados[\''.$f['COLUMN_NAME'].'\']);?>" maxlength='.$f['CHARACTER_MAXIMUM_LENGTH'].' step="0.01" min="0">
              </div>';
            }
            if($f['DATA_TYPE']=='time'){
              echo '
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">'.$f['COLUMN_COMMENT'].'</label>BLOB
                <input type="time" class="form-control" id="id_'.$f['COLUMN_NAME'].'" name="'.$f['COLUMN_NAME'].'" value="<?php echo($dados[\''.$f['COLUMN_NAME'].'\']);?>" maxlength='.$f['CHARACTER_MAXIMUM_LENGTH'].' step="0.01" min="0">
              </div>';
            }
            if($f['DATA_TYPE']=='boolean'){
              echo '
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">'.$f['COLUMN_COMMENT'].'</label>
                <select class="form-control" id="id_'.$f['COLUMN_NAME'].'" name="'.$f['COLUMN_NAME'].'" >
                <option value=0>Falso</option>
                <option value=1>Verdadeiro</option>
                </select>
              </div>';
            }
            if($f['DATA_TYPE']=='enum' or $f['DATA_TYPE']=='set'){
              echo '
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">'.$f['COLUMN_COMMENT'].'</label>SET
                <select class="form-control" id="id_'.$f['COLUMN_NAME'].'" name="'.$f['COLUMN_NAME'].'">
                <?php
                foreach($dados[\''.$f['COLUMN_NAME'].'_opc\'] as $k=>$v){
                    if($dados[\''.$f['COLUMN_NAME'].'\']==$k){
                        ?>
                        <option value="<?php echo($k);?>" selected><?php echo($v);?></option>
                        <?
                    } else {
                        ?>
                        <option value="<?php echo($k);?>"><?php echo($v);?></option>
                        <?    
                    }
                }
                ?>
                </select>
              </div>';
            }
          } // ENDWHILE
        echo '
        <div class="form-group">
        <?php 
        if(!empty($dados[\'read\']) and $dados[\'read\']==\'SIM\'){
          //MOSTRA VOLTAR
          ?>
          <a class="btn btn-dark" onclick="spinner.show(); window.location.href = \'<?php echo(ADMIN."/'.$_GET['table'].'"); ?>\'">VOLTAR</a>  
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
</div>';
echo '
<script languege="javascript">
function ClickCancel(){
  Swal.fire({
        title: "Confirmar Cancelamento?",
        html: "Ao confirmar, <b>TODAS</b> as alterações desta tela serão perdidas. Confirma?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Confirmar!"
      })
      .then((result) => {
        if (result.value) {
          spinner.show();
          window.location.href = "<?php echo(ADMIN."/'.$_GET['table'].'"); ?>"
        }
      });
}

function ClickSalvar(){
  spinner.show();
  document.getElementById("id_form_'.$_GET['table'].'").submit();
}
</script>';