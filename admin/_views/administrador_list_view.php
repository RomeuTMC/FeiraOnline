<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
logado('ADMIN');
$dados=$_SESSION['dados'];
?>
<!-- cabeçario/add -->
<link href="<?php echo URL;?>css/administrador.css" rel="stylesheet">

<div class="container-fluid my-5">
<div class="row m-0">
  <div class="w-100">
    <hr>
  </div>
  <h1 id="title" class="text-uppercase font-weight-bold m-0">Cadastro de Administradores</h1>
  <a href="<?php echo(ADMIN."administrador/novo"); ?>" class="btn btn-primary ml-auto m-1">Adicionar Novo</a>
  <div class="w-100">
    <hr>
  </div>
</div>

<!-- LISTAGEM -->
<div class="row">
  <div class="col">
    <div class="table-responsive">
      <table class="table table-hover" id="AdminList">
        <thead>
          <tr class="table-primary">
            <th style="width:5%;">#ID</th>
            <th style="width:65%;">Nome Completo</th>
            <th style="width:5%;">Permissões</th>
            <th style="width:35%;">OPÇÕES</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach($dados['listagem'] as $l) { // percorrer dados
          ?><tr>
                <td><?php echo ($l['nId']); ?></td>
                <td><?php echo ($l['wNome']); ?></td>
                <td><?php echo ($l['wLogin']); ?></td>
                <td class="d-flex justify-content-between">
                  <a href="<?php echo(ADMIN."administrador/atualiza/".$l['nId']); ?>" class="btn btn-primary w-25 my-1">Atualizar</a>
                  <a href="#" class="btn btn-danger w-25 my-1 delError" onclick="AdminDel('<?php echo ($l['nId']); ?>','<?php echo ($l['wLogin']); ?>','<?php echo ($l['wNome']); ?>');">Excluir</a>
                  <a href="<?php echo(ADMIN."administrador/acesso/".$l['nId']); ?>" style="width: 30%;" type="button" class="btn btn-success w-25 my-1 delError">Acessos</a>
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
      "columns": [null, null, null, {
        "orderable": true,
        "searchable": true,
      }]
    })
  });

function AdminDel(id, email, msg) {
    Swal.fire({
        title: "Confirmar Exclusão?",
        html: "<b>ID:" + id + " - " + msg + "</b><br><br>Será excluido o ADMIN e todas as suas pemissões de acesso. Confirma?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonText: "Cancelar",
        confirmButtonText: 'Confirmar!'
      })
      .then((result) => {
        if (result.value) {
          spinner.show();
          window.location.href = "<?php echo(ADMIN."administrador/exclui/"); ?>" + id + "/" + email;
        } else {
          console.log("cancela ID:" + id);
        }
      });
}
</script>