<?php if (!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
if($_SESSION['login']=='BUYER'){ ?>
    NOME: <?php echo('NOME'); ?><br>
    E-MAIL: <?php echo('EMAILLOGIN'); ?><br>
    ID: <?php echo('ID'); ?><br>
    <?php echo(SISTEM.' - '.SIS_VER.'<br>'.SIS_COPYRIGHT);
} else {
    echo($_SESSION['login']);
    echo(SISTEM.' - '.SIS_VER.'<br>'.SIS_COPYRIGHT);
}
?>