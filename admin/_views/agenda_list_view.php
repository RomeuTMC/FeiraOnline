<?php if(!isset($TRUE) or ($TRUE<>"index.php")) die("LOCKED");
logado('ADMIN');
$dados=$_SESSION['dados']; ?>
<div class="container-fluid my-5">
<div class="row m-0">
  <div class="w-100">
    <hr>
  </div>
  <h1 id="title" class="text-uppercase font-weight-bold m-0"><?php echo($dados['titulo']);?></h1>
  <a href="<?php echo(ADMIN."agenda/novo"); ?>" class="btn btn-primary ml-auto m-1">Adicionar Novo</a>
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
             <th>ID Appointment
             <th>Expositor
             <th>Cliente
             <th>Day-Time
             <th style="width:20rem;">OPÇÕES</th>
          </tr>
        </thead>

        <tbody>
        <?php
        foreach($dados['listagem'] as $l) { // percorrer dados
        ?><tr style="font-size:.8rem;">
             <td class="align-middle"><?php echo ($l['nId']); ?>
             <td class="text-uppercase align-middle"><?php echo ($l['cName']); ?>
             <td class="text-uppercase align-middle"><?php echo ($l['cCompany']); ?>
             <td class="align-middle"><?php echo ($l['eDay'].' '.$l['tHora']); ?>
             <td class="d-flex justify-content-between">
                <a href="<?php echo(ADMIN."agenda/atualiza/".$l['nId']); ?>" class="btn btn-primary ml-auto m-1">Atualizar</a>
                <a href="#" class="btn btn-danger ml-auto m-1 delError" onclick="AdminDel('<?php echo ($l['nId']); ?>','<?php echo ($l['nId']); ?>')">Excluir</a>
                <a href="<?php echo(ADMIN."agenda/mostra/".$l['nId']); ?>" class="btn btn-success ml-auto m-1">Exibir</a>
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
      "columns": [null, null, null,  {
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
          window.location.href = "<?php echo(ADMIN."agenda/exclui/"); ?>" + id + "/" + email;
        } else {
          console.log("cancela ID:" + id);
        }
      });
}
</script>