<?php if (!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
if($_SESSION['login']=='SELLER'){ ?>
    NOME: <?php echo('NOME SELLER'); ?><br>
    E-MAIL: <?php echo('EMAIL LOGIN'); ?><br>
    ID: <?php echo('ID'); ?><br>
    <?php echo(SISTEM.' - '.SIS_VER.'<br>'.SIS_COPYRIGHT);
} else {
    echo($_SESSION['login']);
    echo(SISTEM.' - '.SIS_VER.'<br>'.SIS_COPYRIGHT);
}
?>