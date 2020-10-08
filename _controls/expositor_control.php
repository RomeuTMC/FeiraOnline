<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED'); 
$_SESSION['dados']=$_POST;
if(!isset($_SESSION['route'][1]) or $_SESSION['route'][1]=='list'){
    $_SESSION['dados']=expositor_list();
} elseif($_SESSION['route'][1]=='novo'){
    $_SESSION['dados']=expositores_novo();
} elseif($_SESSION['route'][1]=='save'){
    $_SESSION['dados']=expositor_salva();
}else {
    // VIEW PADRÃƒO ou MOSTRA QUE NÃƒO EXISTE se for DEV
    if(AMBIENTE == 'DEVELOPER') {
        print_r($_SESSION['route']);
      } else {
        $_SESSION['dados']=expositor_list();
      }
}

function expositor_list(){
   // SE DIRECIONADO PARA LIST, ENCAMINHA PARA NOVO
   return expositor_novo();
}

function expositor_novo(){
    $_SESSION['view']='form';
    $msg['titulo']='Expositor';
    $msg['nId']=0;
    $msg['cName']='';
    $msg['cAddress']='';
    $r=SqlQuery("SELECT cSigla, wEnglish from paises order by wEnglish");
    while($l=$r->fetch(PDO::FETCH_ASSOC)){
        $list[$l['cSigla']]=$l['wEnglish'];
    }
    $msg['cCountry_list']=$list;
    $msg['cCountry']='THA';
    $msg['cPostCode']='';
    $msg['cPhone1']='';
    $msg['cPhone2']='';
    $msg['cWeb']='';
    $msg['tDescription']='';
    $msg['SI_1']=array();
    $msg['SI_1_list']=array('1'=>'Holiday Apartments / Villas',
        '2'=>'Youth Hotel',
        '3'=>'Wellness / Spa Hotels',
        '4'=>'Hotel / Hotel Chains',
        '5'=>'Resorts',
        '6'=>'Hotel Representatives',
        '7'=>'Rural Holidays',
        '8'=>'Golf Hotels',
        '9'=>'Health Resorts',
        '10'=>'Conference and Congress Hotels',
        '11'=>'Others'
    );
    $msg['SI_1_outros']='';
    $msg['SL_2']=array();
    $msg['SL_2_list']=array('1'=>'Adventure and Bicycle Tours',
    '2'=>'Long Distance Trips',
    '3'=>'Group Tours',
    '4'=>'Culture Trips',
    '5'=>'Education and Study Tours',
    '6'=>'LBGT',
    '7'=>'Incentive Holidays',
    '8'=>'Eco-tour',
    '9'=>'Expeditions',
    '10'=>'Health Travel',
    '11'=>'Youth Travel 18-35',
    '12'=>'Responsible Tourism',
    '13'=>'Family Holidays',
    '14'=>'Golf Holidays',
    '15'=>'Cruises',
    '16'=>'Package Tour Operators',
    '17'=>'Others'
);
    $msg['SL_2_outros']='';
    $msg['SL_4']=array();
    $msg['SL_4_list']=array('1'=>'Coach Companies / Carriers',
    '2'=>'Car Rental Companies',
    '3'=>'Airlines',
    '4'=>'Limousine Services',
    '5'=>'River Cruises',
    '6'=>'Others'
);
    $msg['SL_4_outros']='';
    $msg['cCountryMk1']='BRA';
    $msg['cCountryMk2']='ARG';
    $msg['cCountryMk3']='URY';
    $msg['dele_adm']='N';
    $msg['adm_list']=array('S'=>'Yes','N'=>'No');
    return $msg;
}

//SALVA CADASTRO - FAZ O INSERT ou UPDATE CONFORME O ID
function expositor_salva(){
    global $db;
    $_SESSION['dados']['titulo']='Error - Check Dice';
    $_SESSION['view']='list';
    //print_r($_POST);
    $pr[':NID']=filter_input(INPUT_POST, 'nId', FILTER_SANITIZE_NUMBER_INT);
    $pr[':CNAME']=filter_input(INPUT_POST, 'cName', FILTER_SANITIZE_STRING);
    $pr[':CADDRESS']=filter_input(INPUT_POST, 'cAddress', FILTER_SANITIZE_STRING);
    $pr[':CCOUNTRY']=filter_input(INPUT_POST, 'cCountry', FILTER_SANITIZE_STRING);
    $pr[':CPOSTCODE']=filter_input(INPUT_POST, 'cPostCode', FILTER_SANITIZE_STRING);
    $pr[':CPHONE1']=filter_input(INPUT_POST, 'cPhone1', FILTER_SANITIZE_STRING);
    $pr[':CPHONE2']=filter_input(INPUT_POST, 'cPhone2', FILTER_SANITIZE_STRING);
    $pr[':CWEB']=filter_input(INPUT_POST, 'cWeb', FILTER_SANITIZE_STRING);
    $pr[':TDESCRIPTION']=filter_input(INPUT_POST, 'tDescription', FILTER_SANITIZE_STRING);
    $pr[':SI_1']=implode(';',filter_var_array($_POST['SI_1'],FILTER_SANITIZE_NUMBER_INT));
    $pr[':SI_1_OUTROS']=filter_input(INPUT_POST, 'SI_1_outros', FILTER_SANITIZE_STRING);
    $pr[':SL_2']=implode(';',filter_var_array($_POST['SL_1'],FILTER_SANITIZE_NUMBER_INT));
    $pr[':SL_2_OUTROS']=filter_input(INPUT_POST, 'SL_2_outros', FILTER_SANITIZE_STRING);
    $pr[':SL_4']=implode(';',filter_var_array($_POST['SL_4'],FILTER_SANITIZE_NUMBER_INT));
    $pr[':SL_4_OUTROS']=filter_input(INPUT_POST, 'SL_4_outros', FILTER_SANITIZE_STRING);
    $pr[':CCOUNTRYMK1']=filter_input(INPUT_POST, 'cCountryMk1', FILTER_SANITIZE_STRING);
    $pr[':CCOUNTRYMK2']=filter_input(INPUT_POST, 'cCountryMk2', FILTER_SANITIZE_STRING);
    $pr[':CCOUNTRYMK3']=filter_input(INPUT_POST, 'cCountryMk3', FILTER_SANITIZE_STRING);
    // IMAGENS
    if($pr[':NID']==0){ //se for 0 é INSERT e manipula as IMAGENS, senão pula as imagens
        $nm = md5(uniqid(rand(), true)); // gera ID único para as imagens
        //Imagem LOGO
        $pr[':ALOGO']='';
        if(count($_FILES['aLogo'])>0){
            $ft=$_FILES['aLogo'];
        } else {
            $_SESSION['view']='form';
            $_SESSION['erro_no']='2';
            $_SESSION['erro']="LOGO Image must be compulsory";
            deltmp($del);
            return array_merge(expositor_novo(),$_SESSION['dados']);
        }
        $name=slug($ft['name']);
        if(move_uploaded_file($ft['tmp_name'],"img/exp-logo/logo-$nm-".$name)){
            $pr[':ALOGO']="img/exp-logo/logo-$nm-".$name;
            $del[]="img/exp-logo/logo-$nm-".$name;
        }
        //VARIAS IMAGENS DOS PRODUTOS
        $pr[':APRODUCTS']=array(); // array de imagens
        if(count($_FILES['aProducts'])>0){
            $ft=$_FILES['aProducts'];
        } else {
            $_SESSION['view']='form';
            $_SESSION['erro_no']='2';
            $_SESSION['erro']="PRODUCTS PHOTO must be compulsory";
            deltmp($del);
            return array_merge(expositor_novo(),$_SESSION['dados']);
        }
        $c=count($ft['name']);
        for($n=0; $n<$c; $n++){
            $name=slug($ft['name'][$n]);
            $temp=$ft['tmp_name'][$n];
            if(move_uploaded_file($temp,"img/exp-produto/prod-$n-$nm-".$name)){
                $pr[':APRODUCTS'][]="img/exp-produto/prod-$n-$nm-".$name;
                $del[]="img/exp-produto/prod-$n-$nm-".$name;
            }
        }
    } // fim do menupulador de imagens
    if(filter_var($_SESSION['route'][2])==0){
        // SE 0 INSERT
        //retirada dos campos BLI e VAT
        //$sql="INSERT into expositores (nId ,cName ,cAddress ,cCountry ,cPostCode ,cPhone1 ,cPhone2 ,cEmail ,cWeb ,ePerson ,cPersonalName ,cCargo ,cPersonalEmail ,cPersonalPhone ,nBusinessType ,nBusinessTypeOther ,nBLI ,dBLI ,aBLI ,cVAT ,aVAT ,aLogo ,cCNR ,cTaxID ,cTaxAddr ,cCountryR ,Phone1R ,MailR ,SI_1 ,SL_2 ,SL_3 ,SL_4 ,SL_5 ,SL_6 ,cCountryMk1 ,cCountryMk2 ,cCountryMk3 ,tDescription ,SI_1_ourtros ,SL_2_outros ,SL_3_outros ,SL_4_outros ,SL_5_outros ,SL_6_outros, cPassw) values ('', '".$pr[':CNAME']."', '".$pr[':CADDRESS']."', '".$pr[':CCOUNTRY']."', '".$pr[':CPOSTCODE']."', '".$pr[':CPHONE1']."', '".$pr[':CPHONE2']."', '".$pr[':CEMAIL']."', '".$pr[':CWEB']."', '".$pr[':EPERSON']."', '".$pr[':CPERSONALNAME']."', '".$pr[':CCARGO']."', '".$pr[':CPERSONALEMAIL']."', '".$pr[':CPERSONALPHONE']."', '".$pr[':NBUSINESSTYPE']."', '".$pr[':NBUSINESSTYPEOTHER']."', '".$pr[':NBLI']."', '".$pr[':DBLI']."', '".$pr[':ABLI']."', '".$pr[':CVAT']."', '".$pr[':AVAT']."', '".$pr[':ALOGO']."', '".$pr[':CCNR']."', '".$pr[':CTAXID']."', '".$pr[':CTAXADDR']."', '".$pr[':CCOUNTRYR']."', '".$pr[':PHONE1R']."', '".$pr[':MAILR']."', '".$pr[':SI_1']."', '".$pr[':SL_2']."', '".$pr[':SL_3']."', '".$pr[':SL_4']."', '".$pr[':SL_5']."', '".$pr[':SL_6']."', '".$pr[':CCOUNTRYMK1']."', '".$pr[':CCOUNTRYMK2']."', '".$pr[':CCOUNTRYMK3']."', '".$pr[':TDESCRIPTION']."', '".$pr[':SI_1_OUTROS']."', '".$pr[':SL_2_OUTROS']."', '".$pr[':SL_3_OUTROS']."', '".$pr[':SL_4_OUTROS']."', '".$pr[':SL_5_OUTROS']."', '".$pr[':SL_6_OUTROS']."', '".$pr[':CPASSW']."')";
        $sql="INSERT into expositores (nId ,cName ,cAddress ,cCountry ,cPostCode ,cPhone1 ,cPhone2, cWeb, aLogo, SI_1, SL_2, SL_4, cCountryMk1, cCountryMk2, cCountryMk3, tDescription ,SI_1_ourtros ,SL_2_outros,SL_4_outros) values 
        ('', '".$pr[':CNAME']."', '".$pr[':CADDRESS']."', '".$pr[':CCOUNTRY']."', '".$pr[':CPOSTCODE']."', '".$pr[':CPHONE1']."', '".$pr[':CPHONE2']."', '".$pr[':CWEB']."', '".$pr[':ALOGO']."', '".$pr[':SI_1']."', '".$pr[':SL_2']."', '".$pr[':SL_4']."', '".$pr[':CCOUNTRYMK1']."', '".$pr[':CCOUNTRYMK2']."', '".$pr[':CCOUNTRYMK3']."', '".$pr[':TDESCRIPTION']."', '".$pr[':SI_1_OUTROS']."', '".$pr[':SL_2_OUTROS']."', '".$pr[':SL_4_OUTROS']."')";
        $r=SqlQuery($sql);
        $IID=$db->lastInsertId();
    } else {
        // SE >0 UPDATE
        //retirada dos campos BLI e VAT
        //$sql="UPDATE expositores set cName='".$pr[':CNAME']."', cAddress='".$pr[':CADDRESS']."', cCountry='".$pr[':CCOUNTRY']."', cPostCode='".$pr[':CPOSTCODE']."', cPhone1='".$pr[':CPHONE1']."', cPhone2='".$pr[':CPHONE2']."', cEmail='".$pr[':CEMAIL']."', cWeb='".$pr[':CWEB']."', ePerson='".$pr[':EPERSON']."', cPersonalName='".$pr[':CPERSONALNAME']."', cCargo='".$pr[':CCARGO']."', cPersonalEmail='".$pr[':CPERSONALEMAIL']."', cPersonalPhone='".$pr[':CPERSONALPHONE']."', nBusinessType='".$pr[':NBUSINESSTYPE']."', nBusinessTypeOther='".$pr[':NBUSINESSTYPEOTHER']."', nBLI='".$pr[':NBLI']."', dBLI='".$pr[':DBLI']."', cVAT='".$pr[':CVAT']."', cCNR='".$pr[':CCNR']."', cTaxID='".$pr[':CTAXID']."', cTaxAddr='".$pr[':CTAXADDR']."', cCountryR='".$pr[':CCOUNTRYR']."', Phone1R='".$pr[':PHONE1R']."', MailR='".$pr[':MAILR']."', SI_1='".$pr[':SI_1']."', SL_2='".$pr[':SL_2']."', SL_3='".$pr[':SL_3']."', SL_4='".$pr[':SL_4']."', SL_5='".$pr[':SL_5']."', SL_6='".$pr[':SL_6']."', cCountryMk1='".$pr[':CCOUNTRYMK1']."', cCountryMk2='".$pr[':CCOUNTRYMK2']."', cCountryMk3='".$pr[':CCOUNTRYMK3']."', tDescription='".$pr[':TDESCRIPTION']."', SI_1_ourtros='".$pr[':SI_1_OUTROS']."', SL_2_outros='".$pr[':SL_2_OUTROS']."', SL_3_outros='".$pr[':SL_3_OUTROS']."', SL_4_outros='".$pr[':SL_4_OUTROS']."', SL_5_outros='".$pr[':SL_5_OUTROS']."', SL_6_outros='".$pr[':SL_6_OUTROS']."' where nId='".$pr[':NID']."' limit 1";
        $sql="UPDATE expositores set cName='".$pr[':CNAME']."', cAddress='".$pr[':CADDRESS']."', cCountry='".$pr[':CCOUNTRY']."', cPostCode='".$pr[':CPOSTCODE']."', cPhone1='".$pr[':CPHONE1']."', cPhone2='".$pr[':CPHONE2']."', cEmail='".$pr[':CEMAIL']."', cWeb='".$pr[':CWEB']."', ePerson='".$pr[':EPERSON']."', cPersonalName='".$pr[':CPERSONALNAME']."', cCargo='".$pr[':CCARGO']."', cPersonalEmail='".$pr[':CPERSONALEMAIL']."', cPersonalPhone='".$pr[':CPERSONALPHONE']."', nBusinessType='".$pr[':NBUSINESSTYPE']."', nBusinessTypeOther='".$pr[':NBUSINESSTYPEOTHER']."', cCNR='".$pr[':CCNR']."', cTaxID='".$pr[':CTAXID']."', cTaxAddr='".$pr[':CTAXADDR']."', cCountryR='".$pr[':CCOUNTRYR']."', Phone1R='".$pr[':PHONE1R']."', MailR='".$pr[':MAILR']."', SI_1='".$pr[':SI_1']."', SL_2='".$pr[':SL_2']."', SL_3='".$pr[':SL_3']."', SL_4='".$pr[':SL_4']."', SL_5='".$pr[':SL_5']."', SL_6='".$pr[':SL_6']."', cCountryMk1='".$pr[':CCOUNTRYMK1']."', cCountryMk2='".$pr[':CCOUNTRYMK2']."', cCountryMk3='".$pr[':CCOUNTRYMK3']."', tDescription='".$pr[':TDESCRIPTION']."', SI_1_ourtros='".$pr[':SI_1_OUTROS']."', SL_2_outros='".$pr[':SL_2_OUTROS']."', SL_3_outros='".$pr[':SL_3_OUTROS']."', SL_4_outros='".$pr[':SL_4_OUTROS']."', SL_5_outros='".$pr[':SL_5_OUTROS']."', SL_6_outros='".$pr[':SL_6_OUTROS']."' where nId='".$pr[':NID']."' limit 1";
        $r=SqlQuery($sql);
        $IID=$pr[':NID'];
    }
    // FAZ O UPDATE DOS PRODUTOS
    if($pr[':NID']==0){ // se for INSERT manipula os produtos, senão ignora
        foreach($pr[':APRODUCTS'] as $k){
            $r=SqlQuery("INSERT into `exp_produtct` (`nId`, `nId_expositor`, `aFile`) VALUES ('', '$IID', '$k');");
        }
    }
    // FAZ O PROCESSAMENTO DOS DELEGATES
    $dele['nome']=filter_var_array($_POST['dele_nome'],FILTER_SANITIZE_STRING);
    $dele['email']=filter_var_array($_POST['dele_email'],FILTER_SANITIZE_STRING);
    $dele['passw']=filter_var_array($_POST['dele_passw'],FILTER_SANITIZE_STRING);
    $dele['fone']=filter_var_array($_POST['dele_fone'],FILTER_SANITIZE_STRING);
    $dele['adm']=filter_var_array($_POST['dele_adm'],FILTER_SANITIZE_STRING);
    if(count($_FILES['dele_foto'])>0){
        $ft=$_FILES['dele_foto'];
    } else {
        $_SESSION['view']='form';
        $_SESSION['erro_no']='2';
        $_SESSION['erro']="DELEGATES NOT INSERTED, PHOTO ERROR";
        return array_merge(expositor_novo(),$_SESSION['dados']);
    }
    $v=count($dele['adm']);
    $c=count($ft['name']);
    $foto='0';
    for($n=0;$n<$v;$n++){
        $nome=$dele['nome'][$n];
        $email=$dele['email'][$n];
        $fone=$dele['fone'][$n];
        $adm=$dele['adm'][$n];
        $passw=password_hash(sha1($dele['passw'][$n]), PASSWORD_DEFAULT);
        if(move_uploaded_file($ft['tmp_name'][$n],"img/exp-dele/dele-$n-$nm-".$name)){
            $foto="img/exp-dele/dele-$n-$nm-".$name;
        }
        $r=SqlQuery("INSERT into `exp_delegate` (nId, nId_expositor, cNome, cEmail, sPassw, cPhone, eAdm, fPhoto) VALUES ('', '$IID','$nome','$email','$passw','$fone','$adm','$foto');");
    }
    $_SESSION['control']='main';
    $_SESSION['view']='home';
    $_SESSION['erro_no']=1;
    $_SESSION['erro']='<h3>Your registration was successful</h3>';
    eMail("dev@thailatintrademeet.com","EXPO Sign up confirmation - ",'mail-thai-br.html');
    for($n=0;$n<$v;$n++){
        eMail($dele['email'][$n],"EXPO Sign up confirmation - ",'mail-thai-br.html');
    }
    return true;
}

function deltmp($fss = array()){
    foreach($fss as $f){
        if(!unlink($f)){
            __out("<h3>ERROR</h3> Fail during images manipulation - $f",200);
            return false;    
        } else {
            if(AMBIENTE == 'DEVELOPER') {
                echo "<ERROR data='EXCLUIDO: $f'>";
            } else {
                echo "<script>console.log('EXCLUIDO: $f');</script>";
                // se for fora do DEV, exclui silenciosamente
            }
        }
    }
    return true;
}