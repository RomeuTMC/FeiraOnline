<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
logado('SELLER');
$dados=$_SESSION['dados'];
// print_r($dados);
include_once('topo.php');
?>
<div class="webinar-area" style="position: absolute; top:20%; left: 30%;">
  <!-- <iframe width="560" height="315" src="https://www.youtube.com/embed/c2y95e1DpW8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo LIVE; ?>?rel=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>