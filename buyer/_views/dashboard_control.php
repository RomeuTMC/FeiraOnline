<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
logado('BUYER');
$_SESSION['dados']=$_POST;
if(!isset($_SESSION['route'][1]) or $_SESSION['route'][1]=='list'){
    $_SESSION['dados']=dashboard_buyer();
} elseif($_SESSION['route'][1]=='myaccount'){
  $_SESSION['dados']=array_merge(dashboard_buyer(),myaccount_list());
} elseif($_SESSION['route'][1]=='myaccountsave'){
  $_SESSION['dados']=array_merge(dashboard_buyer(),myaccount_salva());
} elseif($_SESSION['route'][1]=='stands'){
  $_SESSION['dados']=array_merge(dashboard_buyer(),dashboard_stands());
} elseif($_SESSION['route'][1]=='categs'){
  $_SESSION['dados']=array_merge(dashboard_buyer(),dashboard_categs());
} elseif($_SESSION['route'][1]=='stand'){
  $_SESSION['dados']=array_merge(dashboard_buyer(),dashboard_stand());
} elseif($_SESSION['route'][1]=='networking'){
  $_SESSION['dados']=array_merge(dashboard_buyer(),dashboard_networking());
} elseif($_SESSION['route'][1]=='webinar'){
  $_SESSION['dados']=dashboard_buyer();
}else {
    // VIEW PADRÃƒO ou MOSTRA QUE NÃƒO EXISTE se for DEV
    if(AMBIENTE == 'DEVELOPER') {
        print_r($_SESSION['route']);
      } else {
        $_SESSION['dados']=dashboard_buyer();
      }
}

function dashboard_buyer(){
  $dados['titulo']='Dashboard Buyer - '.$_SESSION['buy_emp'];
  $dados['empresa']=$_SESSION['buy_emp'];
  $dados['email']=$_SESSION['buy_email'];
  $dados['foto']=$_SESSION['buy_foto'];
  $dados['id']=$_SESSION['buy_id'];
  $dados['nome']=$_SESSION['buy_name'];
  $dados['nomecompleto']=$_SESSION['buy_completename'];
  $dados['nomechat']=$_SESSION['buy_emp'].' - '.$_SESSION['buy_name'];
  $dados['links']=array(
    'home'=>ADMIN.'dashboard',
    'myaccount'=>ADMIN.'myaccount/view/'.$_SESSION['buy_id'],
  );
  $hoje=date('m-d');
  $r=SqlQuery("SELECT a.nId, a.eDay, a.tHora, a.avaliacao, e.cName, e.nId as expo, c.nId as buye from appointments as a, expositores as e, clientes as c where a.nId_expositor=e.nId and a.nId_cliente=c.nId and a.nId_cliente='".$_SESSION['buy_id']."' order by eDay, tHora");
  $dados['apoints']=array();
  while($l=$r->fetch(PDO::FETCH_ASSOC)){
      $dados['apoints'][]=$l;
  }
  $dados['help']=dashboard_helpdesk();
  return $dados;
}

function myaccount_list(){
  global $db;
  $_SESSION['view']='myaccount';
  $msg['titulo']='Alterar clientes';
  $pr[':id']=$_SESSION['buy_id'];
  $sql="SELECT * FROM clientes where nId=".$pr[':id']." limit 1";
  $r=SqlQuery($sql);
  $l = $r->fetch(PDO::FETCH_ASSOC);
  $msg['nId']=$l['nId']; //ID do Cliente -- PRI.
  $msg['cCompany']=$l['cCompany']; //Buyer Company Name -- .
  $msg['cAddress']=$l['cAddress']; //Address -- .
  $msg['cCity']=$l['cCity']; //City -- .
  $msg['cCEP']=$l['cCEP']; //Post Code -- .
  $msg['cCountry']=$l['cCountry']; //Country -- .
  $msg['cWeb']=$l['cWeb']; //Website -- .
  $msg['cWhatsapp']=$l['cWhatsapp']; //WhatsApp (for emergency) -- .
  $msg['cPhone1']=$l['cPhone1']; //Phone -- .
  $msg['ePerson']=$l['ePerson']; //Person -- .
  $msg['cPersonalName']=$l['cPersonalName']; //Complete Name (for credential) -- .
  $msg['cCargo']=$l['cCargo']; //Job Title (for Credential) -- .
  $msg['cEmail']=$l['cEmail']; //Mail (for Credential) -- .
  $r=SqlQuery("SELECT cSigla, wEnglish from paises order by wEnglish");
  while($l=$r->fetch(PDO::FETCH_ASSOC)){
      $list[$l['cSigla']]=$l['wEnglish'];
  }
  $msg['cCountry_list']=$list;
  return $msg;
}

function myaccount_salva(){
  global $db;
  $_SESSION['dados']['titulo']='Erro - Verifique Dados';
  $_SESSION['view']='list';
  $pr[':NID']=filter_input(INPUT_POST, 'nId', FILTER_SANITIZE_NUMBER_INT);
  $pr[':CCOMPANY']=filter_input(INPUT_POST, 'cCompany', FILTER_SANITIZE_STRING);
  $pr[':CADDRESS']=filter_input(INPUT_POST, 'cAddress', FILTER_SANITIZE_STRING);
  $pr[':CCITY']=filter_input(INPUT_POST, 'cCity', FILTER_SANITIZE_STRING);
  $pr[':CCEP']=filter_input(INPUT_POST, 'cCEP', FILTER_SANITIZE_STRING);
  $pr[':CCOUNTRY']=filter_input(INPUT_POST, 'cCountry', FILTER_SANITIZE_STRING);
  $pr[':CWEB']=filter_input(INPUT_POST, 'cWeb', FILTER_SANITIZE_STRING);
  $pr[':CWHATSAPP']=filter_input(INPUT_POST, 'cWhatsapp', FILTER_SANITIZE_STRING);
  $pr[':CPHONE1']=filter_input(INPUT_POST, 'cPhone1', FILTER_SANITIZE_STRING);
  $pr[':EPERSON']=filter_input(INPUT_POST, 'ePerson', FILTER_UNSAFE_RAW,FILTER_DEFAULT);
  $pr[':CPERSONALNAME']=filter_input(INPUT_POST, 'cPersonalName', FILTER_SANITIZE_STRING);
  $pr[':CCARGO']=filter_input(INPUT_POST, 'cCargo', FILTER_SANITIZE_STRING);
  if($pr[':NID']<>$_SESSION['buy_id']){
    $_SESSION['view']='list';
    $_SESSION['erro_no']=2;
    $_SESSION['erro']='<h3>FALHA NA AUTENTICAÇÃO DO USUÁRIO</h3>';
    return dashboard_buyer();
  }
  $sql="UPDATE clientes set cCompany='".$pr[':CCOMPANY']."', cAddress='".$pr[':CADDRESS']."', cCity='".$pr[':CCITY']."', cCEP='".$pr[':CCEP']."', cCountry='".$pr[':CCOUNTRY']."', cWeb='".$pr[':CWEB']."', cWhatsapp='".$pr[':CWHATSAPP']."', cPhone1='".$pr[':CPHONE1']."', cPersonalName='".$pr[':CPERSONALNAME']."', cCargo='".$pr[':CCARGO']."' where nId='".$pr[':NID']."' limit 1";
  $r=SqlQuery($sql);
  $nm = md5(uniqid(rand(), true)); // gera ID único para as imagens
  //Imagem LOGO
  $pr[':FPHOTO']='';
  if(is_uploaded_file($_FILES['fPhoto']['tmp_name'])){
    $ft=$_FILES['fPhoto'];
    $sql="SELECT fPhoto from clientes where nId='".$pr[':NID']."' limit 1";
    $r=SqlQuery($sql);
    $l=$r->fetch(PDO::FETCH_ASSOC);
    if($l['fPhoto']<>'img/buyer/no_photo.png'){
      @unlink(_FS.$l['fPhoto']);
    }
    $name=slug($ft['name']);
     if(move_uploaded_file($ft['tmp_name'],"./../img/buyer/avatar-$nm-".$name)){
       $pr[':FPHOTO']="img/buyer/avatar-$nm-".$name;
       $sql="UPDATE clientes set fPhoto='".$pr[':FPHOTO']."' where nId='".$pr[':NID']."' limit 1";
       $_SESSION['buy_foto']=$pr[':FPHOTO'];
       $r=SqlQuery($sql);
     }
  }
  $_SESSION['view']='list';
  $_SESSION['erro_no']=1;
  $_SESSION['erro']='<h3>Information saved successfully!</h3>';
  return dashboard_buyer();
}

function dashboard_stands(){
  global $db;
  $_SESSION['view']='stands';
  $data['titulo']="Listagem de Stands";
  $pr[':NIDCAT']=$_SESSION['route'][2];

  $sql="SELECT count(nId) as Total FROM expositores where nId_categoria = {$pr[':NIDCAT']}";
  $r=SqlQuery($sql);
  $l=$r->fetch(PDO::FETCH_ASSOC); 
  $data['total']=$l['Total'];
  $sql="SELECT nId,aLogo  FROM expositores ORDER BY nId";
  $r=SqlQuery($sql);
  $data['registros']=$r->RowCount();
  while($l = $r->fetch(PDO::FETCH_ASSOC)) {
      $data['listagem'][$l['nId']]=$l;
  }
  return $data;
}

function dashboard_categs(){
  global $db;
  $_SESSION['view']='categs';
  $data['titulo']="Listagem de Categorias";
  $sql="SELECT count(nId) as Total FROM expo_categoria";
  $r=SqlQuery($sql);
  $l=$r->fetch(PDO::FETCH_ASSOC); 
  $data['total']=$l['Total'];
  $sql="SELECT nId,fFoto  FROM expo_categoria ORDER BY cCategoria";
  $r=SqlQuery($sql);
  $data['registros']=$r->RowCount();
  while($l = $r->fetch(PDO::FETCH_ASSOC)) {
      $data['listagem'][$l['nId']]=$l;
  }
  return $data;
}

function dashboard_stand(){
  global $db;
  $pr[':id']=filter_var($_SESSION['route'][2]);
  $r=SqlQuery("select * from expositores where nId=".$pr[':id']." limit 1");
  if($r->rowCount()<>1){
      $_SESSION['erro_no']='2';
      $_SESSION['view']='list';
      $_SESSION['erro']='ERRO: CADASTRO NÃO LOCALIZADO';
      return expositores_list();
  } else {
      $data['registros']=$r->RowCount();
      while($l = $r->fetch(PDO::FETCH_ASSOC)) {
          $data1['nId']=$l['nId']; //ID Seller -- PRI.
          $data1['cName']=$l['cName']; //Seller Name -- UNI.
          $data1['cAddress']=$l['cAddress']; //Seller Address -- .
          $data1['cCountry']=$l['cCountry']; //Country -- .
          $data1['cPostCode']=$l['cPostCode']; //Post Code -- .
          $data1['cPhone1']=$l['cPhone1']; //Phone Number -- .
          $data1['cPhone2']=$l['cPhone2']; //Direct Phone Number -- .
          $data1['cWeb']=$l['cWeb']; //Site * -- UNI.
          $data1['aLogo']=$l['aLogo']; //Attach Picture Logo -- .
          $data1['tDescription']=$l['tDescription']; //Company Description (Describe your organisation in not more than 50 words) BLOCK -- .
          $data['chat']=chat_stand($l['aWhereby']);
          $data['Infos']=$data1;
          $s=SqlQuery("SELECT nId, aFile from exp_produtct where nId_expositor='".$l['nId']."' order by nId");
          while($z=$s->fetch(PDO::FETCH_ASSOC)){
              $list[]=$z['aFile'];
          }
          $data['Products']=$list;
          unset($list);
          $s=SqlQuery("SELECT nId, cNome, cEmail, cPhone, eAdm, fPhoto from exp_delegate where nId_expositor='".$l['nId']."' order by nId");
          while($z=$s->fetch(PDO::FETCH_ASSOC)){
              $list[]=$z;
          }
          $data['Delegates']=$list;
          unset($list);
          $s=SqlQuery("SELECT nId, aFile, descricao, title from exp_resouce where nId_expositor='".$l['nId']."' order by nId");
          while($z=$s->fetch(PDO::FETCH_ASSOC)){
              $list[]=$z;
          }
          $data['Resources']=$list;
          unset($list);
          $s=SqlQuery("SELECT nId, aFile from exp_videos where nId_expositor='".$l['nId']."' order by nId");
          while($z=$s->fetch(PDO::FETCH_ASSOC)){
              $list[]=$z;
          }
          $data['Videos']=$list;
      }
      //$data=array_merge(expositores_novo(),$data);
      $data['titulo']='Mostrar expositor'.$l['cName'];
      return $data;
  }
}

function dashboard_networking(){
  $password = 'tmc202020';
  $nomechat=$_SESSION['buy_emp'].'-'.$_SESSION['buy_name'];
  $nomechat=substr($nomechat,0,50);
  $user = array('webmasterid'=>25952, 
  'password'=>$password, 
  'username'=>"$nomechat",
  'gender'=>'buyer', 
  'role'=>'user', 
  'image'=>URL.$_SESSION['buy_foto'],
  //'image'=>'https://html5-chat.com/img/avatars/m/13.svg'
  );
  $json=json_encode($user);
  $encoded = file_get_contents("https://jwt.html5-chat.com/protect/".base64_encode($json));
  $data['enc']=$encoded;
  return $data;
}

function dashboard_helpdesk(){
  $password = 'tmc202020';
  $nomechat=$_SESSION['buy_emp'].'-'.$_SESSION['buy_name'];
  $nomechat=substr($nomechat,0,50);
  $user = array('webmasterid'=>25952, 
  'password'=>$password, 
  'username'=>"$nomechat",
  'gender'=>'buyer', 
  'role'=>'user', 
  'startRoom'=>50372,
  'image'=>URL.$_SESSION['buy_foto'],
  //'image'=>'https://html5-chat.com/img/avatars/m/13.svg'
  );
  $json=json_encode($user);
  $encoded = file_get_contents("https://jwt.html5-chat.com/protect/".base64_encode($json));
  $data['help']=$encoded;
  return $encoded;
}

function chat_stand($sala = 50372){
  $password = 'tmc202020';
  $nomechat=$_SESSION['buy_emp'].'-'.$_SESSION['buy_name'];
  $nomechat=substr($nomechat,0,50);
  $user = array('webmasterid'=>25952, 
  'password'=>$password, 
  'username'=>"$nomechat",
  'gender'=>'buyer', 
  'role'=>'user', 
  'startRoom'=>$sala,
  'image'=>URL.$_SESSION['buy_foto'],
  //'image'=>'https://html5-chat.com/img/avatars/m/13.svg'
  );
  $json=json_encode($user);
  $encoded = file_get_contents("https://jwt.html5-chat.com/protect/".base64_encode($json));
  $data['help']=$encoded;
  return $encoded;
}

?>