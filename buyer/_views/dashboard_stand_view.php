<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
logado('BUYER');
$dados=$_SESSION['dados'];
// print_r($dados);
?>
<?php include_once ('header-user.php'); ?>
<?php include_once ('infos_stand.php'); ?>
<div class="booth">


  <div class="stand-areaa">

  <div class="col-um">
  <div style="margin-top:80%;margin-left:25px;margin-right:25px;background: #fff;display:flex; border-radius: 8px; align-items:center;border: 4px solid #ff1a88;">
    <div class="logoStands">
      <img src="<?php echo(URL.$dados['Infos']['aLogo']); ?>" alt="">
    </div>
  </div>
  </div>
  <div class="col-dois">
  <div style="display:flex;justify-content:center; align-items:center;">
    <div class="standLinkGroup">
      <a href="#" data-toggle="modal" data-target="#infoAbout" class="font-weight-bold standLink font-weight-bold">About us</a>
      <a href="#" data-toggle="modal" data-target="#infoProduct" class="font-weight-bold standLink font-weight-bold">Products</a>
      <a href="#" data-toggle="modal" data-target="#infoVideo" class="font-weight-bold standLink font-weight-bold">More Videos</a>
      <a href="#" data-toggle="modal" data-target="#infoResource" class="font-weight-bold standLink font-weight-bold">Resources</a>
    </div>
  </div>
  </div>
  <div class="col-tres">
  <div style="top:85%;right:14%;position:relative;background:transparent;display:flex;justify-content:flex-end; align-items:end;">
  <a href="#" data-toggle="modal" data-target="#chatStand" class="btn btn-secondary py2 btnStandChat font-weight-bold">
  <!-- <a href='https://thailatintrademeet.com/chat/?sala=<?php echo $dados['Infos']['nId']?>&user=<?php echo $dados['nomechat']; ?>&stat=CLI' target='_Blank' class="btn btn-secondary py-3 btnStandChat font-weight-bold"> -->
      <i class="fa fa-comments-o fa-lg" aria-hidden="true"></i> Chat</a>
  </div>
  </div>

  </div><!-- stand areaa -->

</div>
<?php include_once ('navigation-dock-user.php'); ?>
</div>
<script>
if($(location).attr('hash')=='#open'){
  $("#chatStand").modal('show');
}
</script>