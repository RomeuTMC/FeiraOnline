<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED'); 
//seleciona o control
if(!empty($_SESSION['route'][0])){
    $_SESSION['control']=$_SESSION['route'][0];
} else {
    $_SESSION['control']='login';
}

//seleciona a view
if(!empty($_SESSION['route'][1])){
    $_SESSION['view']=$_SESSION['route'][1];
} else {
    $_SESSION['route'][1]='list';
    $_SESSION['view']='list';
}

//seleciona a action
if(!empty($route[2])){
    $_SESSION['action']=$_SESSION['route'][2];
} else {
    $_SESSION['route'][2]='0';
    $_SESSION['action']='novo';
}
?>