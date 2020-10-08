<?php if(!isset($TRUE) or ($TRUE<>"index.php")) die("LOCKED");
logado('ADMIN');
$dados=$_SESSION['dados'];
?>

<div class="container-fluid my-5">
<div class="row m-0">
  <div class="w-100">
    <hr>
  </div>
  <h1 id="title" class="text-uppercase font-weight-bold m-0"><?php echo($dados['titulo']);?></h1>
  <a href="<?php echo(ADMIN."paises/novo"); ?>" class="btn btn-primary ml-auto m-1">Adicionar Novo</a>
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
             <th>ID
             <th>Nome
             <th>Sigla ISO
             <th>Sigla
             <th>English
             <th style="width:35%;">OPÇÕES</th>
          </tr>
        </thead>

        <tbody>
        <?php
        foreach($dados['listagem'] as $l) { // percorrer dados
        ?><tr>
             <td><?php echo ($l['cId']); ?>
             <td><?php echo ($l['wNome']); ?>
             <td><?php echo ($l['cSigla']); ?>
             <td><?php echo ($l['cSiglaIso']); ?>
             <td><?php echo ($l['wEnglish']); ?>
             <td class="d-flex justify-content-between">
                <a href="<?php echo(ADMIN."paises/atualiza/".$l['cId']); ?>" class="btn btn-primary w-25 my-1">Atualizar</a>
                <a href="#" class="btn btn-danger w-25 my-1 delError" onclick="AdminDel('<?php echo ($l['cId']); ?>','<?php echo ($l['cId']); ?>')">Excluir</a>
                <a href="<?php echo(ADMIN."paises/mostra/".$l['cId']); ?>" class="btn btn-success w-25 my-1">Exibir</a>
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
</div>

<script language="javascript">
 $(document).ready(function() {
    $('#AdminList').DataTable({
      language: {
        url: '<?php echo(URL.'/js/DT-pt-br.json'); ?>'
      },
      "paging":   true,
      "info":     true,
      "columns": [null, null, null, null, null,  {
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
        confirmButtonColor: '#d33',
        cancelButtonText: "Cancelar",
        confirmButtonText: 'Confirmar!'
      })
      .then((result) => {
        if (result.value) {
          spinner.show();
          window.location.href = "<?php echo(ADMIN."paises/exclui/"); ?>" + id + "/" + email;
        } else {
          console.log("cancela ID:" + id);
        }
      });
}
</script>