<?php
if(!isset($_GET['table'])){ 
    echo "DEFINA ?table=tabela_do_banco - para criar um formulário para a tabela selecionada";
    die('--');
  }
  header('Content-Type: text/plain; charset=utf-8');
  require_once("./../_configure.php"); // Carrega as funções e configurações globais
  define('MAKER',URL.'MAKER');
  $r=SqlQuery('SELECT COLUMN_NAME, COLUMN_COMMENT,COLUMN_KEY,DATA_TYPE
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_NAME="'.$_GET['table'].'" and COLUMN_KEY<>""');
  while($l = $r->fetch(PDO::FETCH_ASSOC)) {
        $KEY[]=$l;
        if($l['COLUMN_KEY']=='PRI'){
          $PRI=$l['COLUMN_NAME'];
        }
  }
echo '<?php if(!isset($TRUE) or ($TRUE<>"index.php")) die("LOCKED");
$dados=$_SESSION[\'dados\']; ?>';
//cria o formulário conforme o tipo de dados
echo '
<div class="row m-0">
  <div class="w-100">
    <hr>
  </div>
  <h1 id="title" class="text-uppercase font-weight-bold m-0"><?php echo($dados[\'titulo\']);?></h1>
  <a href="<?php echo(ADMIN."'.$_GET['table'].'/novo"); ?>" class="btn btn-primary ml-auto m-1">Adicionar Novo</a>
  <div class="w-100">
    <hr>
  </div>
</div>

<div class="row">
  <div class="col">
    <div class="table-responsive">
      <table class="table table-hover" id="AdminList">
        <thead>
          <tr class="table-primary">
';
          //coloca a listagem de COLUNAS TIPO UNI
          foreach($KEY as $k){
            echo '             <th>'.$k['COLUMN_COMMENT'].PHP_EOL;
          }
          echo '             <th style="width:35%;">OPÇÕES</th>
          </tr>
        </thead>

        <tbody>
        <?php
        foreach($dados[\'listagem\'] as $l) { // percorrer dados
        ?><tr>
';
        foreach($KEY as $k){
          echo '             <td><?php echo ($l[\''.$k['COLUMN_NAME'].'\']); ?>'.PHP_EOL;
        }
        echo '             <td class="d-flex justify-content-between">
                <a href="<?php echo(ADMIN."'.$_GET['table'].'/atualiza/".$l[\''.$PRI.'\']); ?>" class="btn btn-primary ml-auto m-1">Atualizar</a>
                <a href="#" style="width: 30%;" class="btn btn-danger ml-auto m-1 delError" onclick="AdminDel(\'<?php echo ($l[\''.$PRI.'\']); ?>\',\'<?php echo ($l[\''.$PRI.'\']); ?>\')">Excluir</a>
                <a href="<?php echo(ADMIN."'.$_GET['table'].'/mostra/".$l[\''.$PRI.'\']); ?>" class="btn btn-success ml-auto m-1">Exibir</a>
              </td>
            </tr>
        <?php
          } // ENDWHILE
        ?>
      </tbody>
    </table>
    </div>
  </div>
</div>

<script language="javascript">
 $(document).ready(function() {
    $(\'#AdminList\').DataTable({
      language: {
        url: \'<?php echo(URL.\'/js/DT-pt-br.json\'); ?>\'
      },
      "paging":   true,
      "info":     true,
      "columns": [';
      foreach($KEY as $k){
        echo 'null, ';
      }
      echo' {
        "orderable": true,
        "searchable": true,
      }]
    })
  });

function AdminDel(id, email, msg) {
    Swal.fire({
        title: "Confirmar Exclusão?",
        html: "<b>ID:" + id + " - " + msg + "</b><br><br>Será excluido o ID. Confirma?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: \'#d33\',
        cancelButtonText: "Cancelar",
        confirmButtonText: \'Confirmar!\'
      })
      .then((result) => {
        if (result.value) {
          spinner.show();
          window.location.href = "<?php echo(ADMIN."'.$_GET['table'].'/exclui/"); ?>" + id + "/" + email;
        } else {
          console.log("cancela ID:" + id);
        }
      });
}
</script>
';