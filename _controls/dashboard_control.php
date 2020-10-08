<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED'); 
$_SESSION['dados']=$_POST;
if(!isset($_SESSION['route'][1]) or $_SESSION['route'][1]=='list'){
    $_SESSION['dados']=dashboard_list();
}else {
    // VIEW PADRÃƒO ou MOSTRA QUE NÃƒO EXISTE se for DEV
    if(AMBIENTE == 'DEVELOPER') {
        print_r($_SESSION['route']);
      } else {
        $_SESSION['dados']=dashboard_list();
      }
}

function dashboard_list(){
    global $db;
    return $_POST;
}