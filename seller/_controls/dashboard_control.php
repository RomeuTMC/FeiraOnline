<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
logado('SELLER');
$_SESSION['dados']=$_POST;
if(!isset($_SESSION['route'][1]) or $_SESSION['route'][1]=='list'){
    $_SESSION['dados']=dashboard_seller();
} elseif($_SESSION['route'][1]=='agenda'){
      $_SESSION['dados']=dashboard_agenda();
} elseif($_SESSION['route'][1]=='avpos'){
  $_SESSION['dados']=dashboard_avpos();
} elseif($_SESSION['route'][1]=='avneg'){
  $_SESSION['dados']=dashboard_avneg();
} elseif($_SESSION['route'][1]=='networking'){
  $_SESSION['dados']=dashboard_networking();
} elseif($_SESSION['route'][1]=='chatroom'){
  $_SESSION['dados']=dashboard_chatroom();
} elseif($_SESSION['route'][1]=='helpdesk'){
  $_SESSION['dados']=dashboard_helpdesk();
} elseif($_SESSION['route'][1]=='overview'){
  $_SESSION['dados']=dashboard_overview();
} elseif($_SESSION['route'][1]=='webinar'){
  $_SESSION['dados']=array();
} elseif($_SESSION['route'][1]=='visitors'){
  $_SESSION['dados']=dashboard_export();
}else {
    // VIEW PADRÃƒO ou MOSTRA QUE NÃƒO EXISTE se for DEV
    if(AMBIENTE == 'DEVELOPER') {
        print_r($_SESSION['route']);
      } else {
        $_SESSION['dados']=dashboard_seller();
      }
}

function dashboard_seller(){
  $selId=$_SESSION['sel_id'];
  //monta a AGENDA
  $mname=$_SESSION['sel_emp'].' - '.$_SESSION['sel_nome'];
  $dados['titulo']=' Pre-Scheduled Appointments Agenda - '.$_SESSION['sel_emp'];
  $dados['empresa']=$_SESSION['sel_emp'];
  $dados['delegate']=$_SESSION['sel_nome'];
  $nomechat=$_SESSION['sel_emp'].' - '.$_SESSION['sel_nome'];
  //$user = array('webmasterid'=>25952, 'password'=>'tmc202020', 'username'=>"$nomechat", 'gender'=>'seller', 'role'=>'user', 'image'=>URL.$_SESSION['sel_foto']);
  //$json = json_encode($user);
  //$encoded = file_get_contents("https://jwt.html5-chat.com/protect/" . base64_encode($json));
  $dados['links']=array(
    'home'=>ADMIN.'dashboard',
    'resources'=>ADMIN.'exp_resource',
    'products'=>ADMIN.'expprod',
    'videos'=>ADMIN.'expvideo',
    'delegates'=>ADMIN.'exp_delegate',
    'network'=>ADMIN.'dashboard/networking',
    'chatroom'=>ADMIN.'dashboard/chatroom',
    'helpdesk'=>ADMIN.'dashboard/helpdesk',
    //'chatroom'=>'https://thailatintrademeet.com/chat/?sala='.$_SESSION['sel_id'].'&user='."$mname".'&stat=EXP',
  );
  $hoje=date('m-d');
  $r=SqlQuery("SELECT a.nId, a.eDay, a.tHora, a.avaliacao, c.cCompany, e.nId as expo, c.nId as buye from appointments as a, expositores as e, clientes as c where a.nId_expositor=e.nId and a.nId_cliente=c.nId and a.nId_expositor='$selId' order by eDay, tHora");
  while($l=$r->fetch(PDO::FETCH_ASSOC)){
      $dados['apoints'][]=$l;
  }
  $dados['help']=dashboard_helpdesk();
  return $dados;
}

function dashboard_agenda(){
  $pr[':id']=filter_var($_SESSION['route'][2],FILTER_SANITIZE_NUMBER_INT);
  $r=SqlQuery("UPDATE appointments set expoOk='SIM' where appointments.nId='".$pr[':id']."' limit 1");
  $r=SqlQuery("select appointments.nId as agenda, expositores.nId as expo, clientes.nId as clie, tHora, eDay from appointments, expositores, clientes where appointments.nId='".$pr[':id']."' and expositores.nId=appointments.nId_expositor and clientes.nId=appointments.nId_cliente limit 1");
  $l=$r->fetch(PDO::FETCH_ASSOC);
  $idexpo=str_pad($l['expo'],3,'0', STR_PAD_LEFT);
  $idclie=str_pad($l['clie'],5,'0', STR_PAD_LEFT);
  //echo("https://appr.tc/r/thai".$idsala.'e'.$idexpo.'c'.$idclie);
  //https://www.thailatintrademeet.com/salappts/#
  $chat='day='.$l['eDay'].'&start='.$l['tHora'].'&sala=help&user=ex'.$l['expo'].'&stat=EXP';
  header("Location:https://tmccomunicacao.com.br/feiraonline/salappts/?".$chat."#thai".$idexpo.'c'.$idclie);
  return true;
}

function dashboard_avpos(){
  $pr[':id']=filter_var($_SESSION['route'][2],FILTER_SANITIZE_NUMBER_INT);
  $r=SqlQuery("UPDATE appointments set avaliacao='POSITIVE' where appointments.nId='".$pr[':id']."' limit 1");
  $r=SqlQuery("select appointments.nId, avaliacao, expoOk, expositores.aWhereby from appointments, expositores, clientes where appointments.nId='".$pr[':id']."' and expositores.nId=appointments.nId_expositor and clientes.nId=appointments.nId_cliente limit 1");
  $l=$r->fetch(PDO::FETCH_ASSOC);
  $_SESSION['view']='list';
  $_SESSION['erro_no']=4;
  $_SESSION['erro']='Positively endorsed conversation';
  return dashboard_seller();
}

function dashboard_avneg(){
  $pr[':id']=filter_var($_SESSION['route'][2],FILTER_SANITIZE_NUMBER_INT);
  $r=SqlQuery("UPDATE appointments set avaliacao='NEGATIVA' where appointments.nId='".$pr[':id']."' limit 1");
  $r=SqlQuery("select appointments.nId, avaliacao, expoOk, expositores.aWhereby from appointments, expositores, clientes where appointments.nId='".$pr[':id']."' and expositores.nId=appointments.nId_expositor and clientes.nId=appointments.nId_cliente limit 1");
  $l=$r->fetch(PDO::FETCH_ASSOC);
  $_SESSION['view']='list';
  $_SESSION['erro_no']=4;
  $_SESSION['erro']='Talks negatively endorsed';
  return dashboard_seller();
}

function dashboard_networking(){
  $password = 'tmc202020';
  $nomechat=$_SESSION['sel_emp'].'-'.$_SESSION['sel_nome'];
  $nomechat=substr($nomechat,0,50);
  $user = array('webmasterid'=>25952, 
  'password'=>$password, 
  'username'=>"$nomechat",
  'gender'=>'seller', 
  'role'=>'user', 
  'image'=>URL.$_SESSION['sel_foto'],
  //'image'=>'https://html5-chat.com/img/avatars/m/13.svg'
  );
  $json=json_encode($user);
  $encoded = file_get_contents("https://jwt.html5-chat.com/protect/".base64_encode($json));
  $data['enc']=$encoded;
  return $data;
  // $password = 'tmc202020';
  // $nomechat=$_SESSION['sel_emp'].' - '.$_SESSION['sel_nome'];
  // $user = array('webmasterid'=>25952, 
  // 'password'=>'tmc202020', 
  // 'username'=>"$nomechat",
  // 'gender'=>'buyer', 
  // 'role'=>'user', 
  // 'image'=>URL.$_SESSION['sel_foto'],
  // //'image'=>'https://html5-chat.com/img/avatars/m/13.svg'
  // );
  // $json=json_encode($user);
  // $encoded = file_get_contents("https://jwt.html5-chat.com/protect/".base64_encode($json));
  // $data['enc']=$encoded;
  // return $data;
}

function dashboard_chatroom(){
  $password = 'tmc202020';
  $nomechat=$_SESSION['sel_emp'].' - '.$_SESSION['sel_nome'];
  $nomechat=substr($nomechat,0,50);
  $user = array('webmasterid'=>25952, 
  'password'=>$password, 
  'username'=>"$nomechat",
  'gender'=>'seller', 
  'role'=>'user', 
  'startRoom'=>$_SESSION['sala'],
  'image'=>URL.$_SESSION['sel_foto'],
  //'image'=>'https://html5-chat.com/img/avatars/m/13.svg'
  );
  $json=json_encode($user);
  $encoded = file_get_contents("https://jwt.html5-chat.com/protect/".base64_encode($json));
  $data['chat']=$encoded;
  return $data;
}

function dashboard_helpdesk(){
  $password = 'tmc202020';
  $nomechat=$_SESSION['sel_emp'].'-'.$_SESSION['sel_nome'];
  $nomechat=substr($nomechat,0,50);
  $user = array('webmasterid'=>25952, 
  'password'=>$password, 
  'username'=>"$nomechat",
  'gender'=>'seller', 
  'role'=>'user', 
  'startRoom'=>50372,
  'image'=>URL.$_SESSION['sel_foto'],
  //'image'=>'https://html5-chat.com/img/avatars/m/13.svg'
  );
  $json=json_encode($user);
  $encoded = file_get_contents("https://jwt.html5-chat.com/protect/".base64_encode($json));
  $data['help']=$encoded;
  return $data;
}

function dashboard_overview(){
  $r=SqlQuery("SELECT distinct email FROM logs where time > (NOW() - INTERVAL 10 minute)");
  $l=$r->RowCount();
  $data['online']=$l;
  $selid=$_SESSION['sel_id'];
  $r=SqlQuery("SELECT distinct email FROM logs where time > (NOW() - INTERVAL 10 minute) and page='buyer/dashboard/stand/$selid'");
  $l=$r->RowCount();
  $data['On Stand']=$l;
  $r=SqlQuery("SELECT distinct email FROM logs where time > (NOW() - INTERVAL 10 minute) and page='buyer/dashboard/stand/$selid'");
  $l=$r->RowCount();
  $data['Total Visitor Stand']=$l;
  return $data;
}

function dashboard_export(){
  global $db;
  $_SESSION['view']='list';
  $sql="SELECT `cCompany`,`cAddress`,`cCity`,`cCEP`,`cCountry`,`cWeb`,`cWhatsapp`,`cPhone1`,`cPersonalName`,`cCargo`,`cEmail` FROM `clientes` WHERE 1 order by `cCompany`,`cPersonalName`";
  $r=SqlQuery($sql);
  $dadosXls  = "";
  $dadosXls .= "  <table border='1' >";
$dadosXls .= "          <tr>";
    $dadosXls .= "          <th>Company</th>";
    $dadosXls .= "          <th>Address</th>";
    $dadosXls .= "          <th>City</th>";
    $dadosXls .= "          <th>CEP</th>";
    $dadosXls .= "          <th>Country</th>";
    $dadosXls .= "          <th>Web</th>";
    $dadosXls .= "          <th>WhatsApp</th>";
    $dadosXls .= "          <th>Phone</th>";
    $dadosXls .= "          <th>Name</th>";
    $dadosXls .= "          <th>Cargo</th>";
    $dadosXls .= "          <th>Mail</th>";
    $dadosXls .= "      </tr>";
  while($l = $r->fetch(PDO::FETCH_ASSOC)) {
    $dadosXls.= '       <tr>';
    $dadosXls .= "          <td>".$l['cCompany']."</th>";
    $dadosXls .= "          <td>".$l['cAddress']."</th>";
    $dadosXls .= "          <td>".$l['cCity']."</th>";
    $dadosXls .= "          <td>".$l['cCEP']."</th>";
    $dadosXls .= "          <td>".$l['cCountry']."</th>";
    $dadosXls .= "          <td>".$l['cWeb']."</th>";
    $dadosXls .= "          <td>".$l['cWhatsapp']."</th>";
    $dadosXls .= "          <td>".$l['cPhone1']."</th>";
    $dadosXls .= "          <td>".$l['cPersonalName']."</th>";
    $dadosXls .= "          <td>".$l['cCargo']."</th>";
    $dadosXls .= "          <td>".$l['cEmail']."</th>";
    $dadosXls .= "      </tr>";
  }
  $dadosXls .= "  </table>";
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="Buyers-'.date('d-m-Y').'.xls"');
  header('Cache-Control: max-age=0');
  // Se for o IE9, isso talvez seja necessário
  header('Cache-Control: max-age=1');
  // Envia o conteúdo do arquivo  
  echo $dadosXls;
  die();
}
?>