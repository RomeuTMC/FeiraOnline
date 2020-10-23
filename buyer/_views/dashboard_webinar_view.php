<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
logado('BUYER');
$dados=$_SESSION['dados'];
// print_r($dados);
?>


<div class="webinar">
<?php include_once ('header-user.php'); ?>
<?php include_once ('webinar_embed.php'); ?>

<?php include_once ('navigation-dock-user.php'); ?>

</div>