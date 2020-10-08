<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED'); 
logado('ADMIN');
$_SESSION['dados']=$_POST;
if(!isset($_SESSION['route'][1]) or $_SESSION['route'][1]=='list'){
    $_SESSION['dados']=dashboard_list();
} elseif($_SESSION['route'][1]=='helpdesk'){
  $_SESSION['dados']=dashboard_help();
} elseif($_SESSION['route'][1]=='overview'){
  $_SESSION['dados']=dashboard_overview();
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
    $r=SqlQuery("SELECT count(nId) as total FROM expositores");
    $l=$r->fetch(PDO::FETCH_ASSOC);
    $data['sellers']=$l['total'];
    $r=SqlQuery("SELECT count(nId) as total FROM clientes");
    $l=$r->fetch(PDO::FETCH_ASSOC);
    $data['buyers']=$l['total'];
    $r=SqlQuery("SELECT count(nId) as total FROM contato");
    $l=$r->fetch(PDO::FETCH_ASSOC);
    $data['contato']=$l['total'];
    $r=SqlQuery("SELECT nId as Total FROM appointments where eDay='09-02' and avaliacao='N.A'");
    $l=$r->RowCount();
    $data['day1']=$l;
    $r=SqlQuery("SELECT nId as Total FROM appointments where eDay='09-03' and avaliacao='N.A'");
    $l=$r->RowCount();
    $data['day2']=$l;
    return $data;
}

function dashboard_help(){
  $password = 'tmc202020';
  $nomechat='ADMIN - '.$_SESSION['adm_nome'];
  if($_SESSION['adm_id']=='1'){
    $role='root';
  } else {
    $role='moderator';
  }
  $user = array('webmasterid'=>25952, 
  'password'=>$password, 
  'username'=>$nomechat,
  'gender'=>'admin', 
  'role'=>"$role", 
  'startRoom'=>50372,
  //'image'=>URL.$_SESSION['sel_foto'],
  //'image'=>'https://html5-chat.com/img/avatars/m/13.svg'
  );
  $json=json_encode($user);
  $encoded = file_get_contents("https://jwt.html5-chat.com/protect/".base64_encode($json));
  $data['help']=$encoded;
  return $data;
}

function dashboard_overview(){
  $r=SqlQuery("SELECT email FROM logs where time > (NOW() - INTERVAL 10 minute) group by email");
  $l=$r->RowCount();
  $data['online']=$l;
  $r=SqlQuery("SELECT email FROM logs where time > (NOW() - INTERVAL 10 minute) and page='seller/dashboard/webinar/0' group by email");
  $l=$r->RowCount();
  $data['Sellers On Webinar']=$l;
  $r=SqlQuery("SELECT email FROM logs where time > (NOW() - INTERVAL 10 minute) and page='buyer/dashboard/webinar/0' group by email");
  $l=$r->RowCount();
  $data['Buyers On Webinar']=$l;
  return $data;
}