<?php
if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
$_SESSION['login']='FALSE-LOGOUT';
$_SESSION['menu']=array();
$_SESSION['control']='main';
$_SESSION['view']='list';