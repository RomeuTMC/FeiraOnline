<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED'); 
$_SESSION['dados']=$_POST;
if(!isset($_SESSION['route'][1]) or $_SESSION['route'][1]=='list'){
  $_SESSION['view']='home';
  $_SESSION['dados']=main_list();
} else if ($_SESSION['route'][1]=='es'){
  $_SESSION['view']='home_es';
} else if ($_SESSION['route'][1]=='pt'){
  $_SESSION['view']='home_pt';
} else if ($_SESSION['route'][1]=='helpdesk'){
  $_SESSION['view']='helpdesk';
  $_SESSION['dados']=array('titulo'=>'Help Desk - Central de Ajuda ao Expositor, Visitante e Interessados');
} else if ($_SESSION['route'][1]=='lobby'){
  $_SESSION['view']='lobby';
  $_SESSION['dados']=array(
    'titulo'=>'Bate Papo Lobby - Aberto Geral',
    'usuario'=>'0'
  );
}else {
    // VIEW PADRÃƒO ou MOSTRA QUE NÃƒO EXISTE se for DEV
    if(AMBIENTE == 'DEVELOPER') {
        print_r($_SESSION['route']);
      } else {
        $_SESSION['dados']=main_list();
      }
}

function main_list(){
  global $db;
  $sql="SELECT count(nId) as Total FROM expositores";
  $r=SqlQuery($sql);
  $l=$r->fetch(PDO::FETCH_ASSOC); 
  $data['total']=$l['Total'];
  $sql="SELECT nId,aLogo,cWeb  FROM expositores ORDER BY rand(),nId";
  $r=SqlQuery($sql);
  $data['registros']=$r->RowCount();
  while($l = $r->fetch(PDO::FETCH_ASSOC)) {
      $data['listagem'][$l['nId']]=$l;
  }
  return $data;
}