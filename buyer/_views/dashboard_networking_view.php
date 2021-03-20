<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
logado('BUYER');
$dados=$_SESSION['dados'];
?>

<div class="networking">
  <?php include_once ('header-user.php'); ?>
  <div class="windowShow">

    <div class="container">
      <div class="row">
        <div class="col-md-8 m-auto">
        <div class="alert alert-warning" role="alert">
  <h4 class="alert-heading">É muito bom te ver por aqui!</h4>
  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
  <hr>
  <p class="mb-0">Lorem Ipsum passages, and more recently with desktop publishing software.</p>
</div>
        </div>
      </div>
      <div class="row">
      <!-- Button trigger modal -->
    <div class="col-md-12 text-center">
    <button type="button" class="btn btn-primary bg-secondary mt-3 px-5 py-3 btnOpenChat border-0" data-toggle="modal"
      data-target="#chatModal">
      Abrir chat
    </button>
    </div>
      </div>
    </div>




    <!-- Modal -->
    <div class="modal fade " id="chatModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Networking Lounge</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div style="width:1000px;height:450px;margin:0 auto;">
            <script src="https://html5-chat.com/script/25952/<?=$dados['enc']; ?>"></script>
              <!-- <script src='https://html5-chat.com/script/25952/5f3fea13ba0f0/<?php echo $dados['nomechat']; ?>/buyer'>
              </script> -->
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <?php include_once ('navigation-dock-user.php'); ?>
</div>