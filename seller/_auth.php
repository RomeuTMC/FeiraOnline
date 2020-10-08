<?php if (!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');?>
<?php
$SSID=session_name();
if($_SESSION['SID']<>SSID) die('SESSION LOCKED');
if(!isset($_SESSION['login'])){
    $_SESSION['login']=FALSE;
}

if($_SESSION['login']<>'SELLER'){
    //LOGIN NÃO FEITO ou FALSE
    $_SESSION['login']=FALSE;
    $_SESSION['control']='login';
    $_SESSION['view']='login';
} else {
    // SE LOGIN ESTIVER OK (REGISTRA LOG DE ACESSO ADMIN)
    if(!isset($_SESSION['control'])){
        $_SESSION['control']='dashboard';
    }
    if(!isset($_SESSION['view'])){
        $_SESSION['view']='dashboard';
    }
}
?>