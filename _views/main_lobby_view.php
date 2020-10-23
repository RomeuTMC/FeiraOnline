<?php if(!isset($TRUE) or ($TRUE<>"index.php")) die("LOCKED");
$dados=$_SESSION['dados']; ?>
<div style="width:100%;height:1000px;">
<?php
if($dados['usuario']=='0'){
    ?><script src='https://html5-chat.com/script/25274/5f188e2a45e0e/?startRoom=48251'></script><?php
} else {
   ?><script src='https://html5-chat.com/script/25274/5f188e2a45e0e/<?php echo $dados['usuario']; ?>/1?startRoom=48251'></script><?php
}
?>
</div>