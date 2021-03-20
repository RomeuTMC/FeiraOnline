<?php if(!isset($TRUE) or ($TRUE<>"index.php")) die("LOCKED");
$dados=$_SESSION['dados'];
include_once('topo.php');
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
<div class="row m-0">

  <h1 id="title" class="font-weight-bold m-0"><?php echo($dados['titulo']);?></h1>
  <h2>(file extensions accepted: .pdf, .jpeg, .doc, .xls, .png)</h2>
  <a href="<?php echo(ADMIN."exp_resource/novo"); ?>" class="btn btn-primary ml-auto m-1">Add new</a>
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
             <th>File</th>
             <th>Description</th>
             <th style="width:7rem;">Options</th>
          </tr>
        </thead>

        <tbody>
        <?php
        foreach($dados['listagem'] as $l) { // percorrer dados
        ?><tr>
             <td><a href='<?php echo (URL.$l['aFile']); ?>' target=_new class='link_res'><?php echo ($l['title']); ?></a>
             <td><?php echo ($l['descricao']); ?>
             <td class="d-flex justify-content-between">
                <a href="#" style="width:7rem;" class="btn btn-danger ml-auto m-1 delError" onclick="AdminDel('<?php echo ($l['nId']); ?>','<?php echo ($l['nId']); ?>')">Delete</a>
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
        title: "Confirm Delete?",
        html: "<b>ID:" + id + " - " + msg + "</b><br><br>Confirm?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonText: "Cancel",
        confirmButtonText: 'Confirm!'
      })
      .then((result) => {
        if (result.value) {
          spinner.show();
          window.location.href = "<?php echo(ADMIN."exp_resource/exclui/"); ?>" + id + "/" + email;
        } else {
          console.log("cancela ID:" + id);
        }
      });
}
</script>