<?php if (!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');?>
<?php
$SSID=session_name();
//if($_SESSION['SID']<>SSID) die('SESSION LOCKED');
if(!isset($_SESSION['login'])){
    $_SESSION['login']='FALSE';
}
?>