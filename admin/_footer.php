<?php if (!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
if($_SESSION['login']=='ADMIN'){ ?>
    NOME: <?php echo($_SESSION['adm_nome']); ?><br>
    E-MAIL: <?php echo($_SESSION['adm_email']); ?><br>
    ID: <?php echo($_SESSION['adm_id']); ?><br>
    <?php echo(SISTEM.' - '.SIS_VER.'<br>'.SIS_COPYRIGHT);
} else {
    echo($_SESSION['login']);
    echo(SISTEM.' - '.SIS_VER.'<br>'.SIS_COPYRIGHT);
}
?>