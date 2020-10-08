<?php if(!isset($TRUE) or ($TRUE<>"index.php")) die("LOCKED");
logado('SELLER');
$dados=$_SESSION['dados'];
include_once('topo.php');
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
  <div class="row m-0">
    <div class="w-100">
      <hr>
    </div>
    <h1 id="title" class="font-weight-bold m-0"><?php echo($dados['titulo']);?></h1>
    <a href="<?php echo(ADMIN."exp_delegate/novo"); ?>" class="btn btn-primary ml-auto m-1">Add new</a>
    <div class="w-100">
      <hr>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="table-responsive">
        <table class="table " id="AdminList">
          <thead class="thead-dark">
            <tr class="table-primary">
              <th>Photo
              <th>ID
              <th>Name
              <th>E-Mail
              <th>Phone
              <th style="width:10rem;">Options</th>
            </tr>
          </thead>

          <tbody>
            <?php
        foreach($dados['listagem'] as $l) { // percorrer dados
        ?>
            <tr>
              <td class="align-middle"><img src='<?php echo (URL.$l['fPhoto']); ?>'style="object-fit: fill;width:80px;height:80px;border-radius:50%;"></td>
              <td class="align-middle"><?php echo ($l['nId']); ?>
              <td class="align-middle"><?php echo ($l['cNome']); ?>
              <td class="align-middle"><?php echo ($l['cEmail']); ?>
              <td class="align-middle"><?php echo ($l['cPhone']); ?>
              <td class="d-flex justify-content-between py-5">
                <a style="width: 7rem;" class="btn btn-danger delError mr-2" href="#"
                  onclick="AdminDel('<?php echo ($l['nId']); ?>','<?php echo ($l['nId']); ?>')">Remove</a>
                <a style="width: 7rem;" class="btn btn-success ml-auto"
                  href="<?php echo(ADMIN."exp_delegate/mostra/".$l['nId']); ?>">Show</a>
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
        "columns": [null, {
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
            exp_delegate / exclui / "); ?>" + id + "/" + email;
          } else {
            console.log("cancela ID:" + id);
          }
        });
    }
  </script>