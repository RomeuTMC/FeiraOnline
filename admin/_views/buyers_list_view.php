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
              <th>ID do Cliente
              <th>Buyer Company Name
              <th>Personal Name
              <th>E-Mail (login)
              <th style="width:55%;">OPÇÕES</th>
            </tr>
          </thead>

          <tbody>
            <?php
        foreach($dados['listagem'] as $l) { // percorrer dados
        ?><tr>
              <td class="text-uppercase"><?php echo ($l['nId']); ?>
              <td class="text-uppercase"><?php echo ($l['cCompany']); ?>
              <td class="text-uppercase"><?php echo ($l['cPersonalName']); ?>
              <td class="text-lowercase"><?php echo ($l['cEmail']); ?>
              <td class="d-flex justify-content-between">
                <a href="<?php echo(ADMIN."buyers/atualiza/".$l['nId']); ?>"
                  class="btn btn-primary my-1">Atualizar</a>
                <a href="#" class="btn btn-danger my-1 delError"
                  onclick="AdminDel('<?php echo ($l['nId']); ?>','<?php echo ($l['nId']); ?>')">Excluir</a>
                <a href="<?php echo(ADMIN."buyers/mostra/".$l['nId']); ?>"
                  class="btn btn-success my-1">Exibir</a>
                  <a href="<?php echo(ADMIN."buyers/senha/".$l['nId']); ?>"
                  class="btn btn-info my-1">Senha</a>
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

<script>
  $(document).ready(function () {
    $('#AdminList').DataTable({
      language: {
        url: '<?php echo(URL.' / js / DT - pt - br.json '); ?>'
      },
      "paging": true,
      "info": true,
      "columns": [null, null, {
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
          buyers / exclui / "); ?>" + id + "/" + email;
        } else {
          console.log("cancela ID:" + id);
        }
      });
  }
</script>