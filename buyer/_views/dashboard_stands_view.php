<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
logado('BUYER');
$dados=$_SESSION['dados'];
// print_r($dados);

$tmp = '';
// echo "LISTA STANDS";
?>


<div class="exhibit">
<?php include_once ('header-user.php'); ?>

<div class="stands-area">
  <div class="stands-content">
  <?php foreach($dados['listagem'] as $v) { ?>
    <div class="stands-item">
        <a href="<?php echo ADMIN.'dashboard/stand/'.$v['nId']; ?>"><img src="<?php echo(URL.$v['aLogo']); ?>" alt=""></a>
    </div>
  <?php } ?>
</div>


<?php include_once ('navigation-dock-user.php'); ?>
</div>