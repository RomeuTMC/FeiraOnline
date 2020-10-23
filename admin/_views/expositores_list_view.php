<?php if(!isset($TRUE) or ($TRUE<>"index.php")) die("LOCKED");
logado('ADMIN');
$dados=$_SESSION['dados']; ?>

<div class="container-fluid my-5">
  <div class="row m-0">
    <div class="w-100">
      <hr>
    </div>
    <h1 id="title" class="text-uppercase font-weight-bold m-0"><?php echo($dados['titulo']);?></h1>
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
              <th>ID Seller</th>
              <th>Seller Name</th>
              <th>Mail (login) *</th>
              <th>Complete Name (for Credential)</th>
              <th>Sala Appointment</th>
              <th style="width:35%;">OPÇÕES</th>
            </tr>
          </thead>

          <tbody>
            <?php
        foreach($dados['listagem'] as $l) { // percorrer dados
        ?><tr>
              <td><?php echo ($l['nId']); ?>
              <td class="text-uppercase"><?php echo ($l['cName']); ?>
              <td class="text-lowercase"><?php echo ($l['cEmail']); ?>
              <td class="text-uppercase"><?php echo ($l['cPersonalName']); ?>
              <td><?php echo ("<a href='".$l['aWhereby']."' target=_blank>".$l['aWhereby']."</a>"); ?>
              <td class="d-flex justify-content-between">
                <a href="<?php echo(ADMIN."expositores/atualiza/".$l['nId']); ?>"
                  class="w-25 btn btn-primary m-1">Atualizar</a>
                <a href="#" class="w-25 btn btn-danger m-1 delError"
                  onclick="AdminDel('<?php echo ($l['nId']); ?>','<?php echo ($l['nId']); ?>')">Excluir</a>
                <a href="<?php echo(ADMIN."expositores/mostra/".$l['nId']); ?>"
                  class="w-25 btn btn-success m-1">Exibir</a>
                <a href="<?php echo(ADMIN."expositores/wernew/".$l['nId']); ?>" class="btn btn-info m-1 d-none">Whereby
                  Meet</a>
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
  $(document).ready(function () {
    $('#AdminList').DataTable({
      language: {
        url: '<?php echo(URL.' / js / DT - pt - br.json '); ?>'
      },
      "paging": true,
      "info": true,
      "columns": [null, null, null, null, null, null, null, {
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
          window.location.href = "<?php echo(ADMIN."
          expositores / exclui / "); ?>" + id + "/" + email;
        } else {
          console.log("cancela ID:" + id);
        }
      });
  }
</script>