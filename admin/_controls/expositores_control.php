<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED'); 
logado('ADMIN');
$_SESSION['dados']=$_POST;
if(!isset($_SESSION['route'][1]) or $_SESSION['route'][1]=='list'){
    $_SESSION['dados']=expositores_list();
} elseif($_SESSION['route'][1]=='novo'){
    $_SESSION['dados']=expositores_novo();
} elseif($_SESSION['route'][1]=='atualiza'){
    $_SESSION['dados']=expositores_atualiza();
} elseif($_SESSION['route'][1]=='save'){
    $_SESSION['dados']=expositores_salva();
} elseif($_SESSION['route'][1]=='exclui'){
    $_SESSION['dados']=expositores_exclui();
} elseif($_SESSION['route'][1]=='mostra'){
    $_SESSION['dados']=expositores_mostra();
} elseif($_SESSION['route'][1]=='wernew'){
    $_SESSION['dados']=expositores_wernew();
} elseif($_SESSION['route'][1]=='wheresave'){
    $_SESSION['dados']=expositores_wheresave();
}else {
    // VIEW PADRУO ou MOSTRA QUE NУO EXISTE se for DEV
    if(AMBIENTE == 'DEVELOPER') {
        print_r($_SESSION['route']);
      } else {
        $_SESSION['dados']=expositores_list();
      }
}

//LISTAGEM DA TABELA - OK
function expositores_list(){
    global $db;
    $_SESSION['view']='list';
    $data['titulo']="Cadastro de expositores";
    $sql="SELECT count(nId) as Total FROM expositores";
    $r=SqlQuery($sql);
    $l=$r->fetch(PDO::FETCH_ASSOC); 
    $data['total']=$l['Total'];
    $sql="SELECT nId ,cName ,cEmail ,cPersonalName,aWhereby FROM expositores ORDER BY nId";
    $r=SqlQuery($sql);
    $data['registros']=$r->RowCount();
    while($l = $r->fetch(PDO::FETCH_ASSOC)) {
        $data['listagem'][$l['nId']]=$l;
    }
    return $data;
}

//NOVO CADASTRO - DADOS EM BRANCO - ok
function expositores_novo(){
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
    $msg['cEmail']='';
    $msg['cPassw']='';
    $msg['cWeb']='';
    $msg['ePerson']='';
    $msg['ePerson_list']=array('MR'=>'Mr.','MS'=>'Ms', 'MRS'=>'Mrs');
    $msg['cPersonalName']='';
    $msg['cCargo']='';
    $msg['cPersonalEmail']='';
    $msg['cPersonalPhone']='';
    $msg['nBusinessType']='';
    $msg['nBusinessType_list']=array('1'=>'Association',
        '2'=>'Destination Management Companies (DMC)',
        '3'=>'Transportation',
        '4'=>'Wellness / Spa / Medical',
        '5'=>'Entertainment',
        '6'=>'Hotel & Resort',
        '7'=>'Tour Operators / Travel Agents',
        '8'=>'Others *'
    );
    $msg['nBusinessTypeOther']='';
    $msg['nBLI']='';
    $msg['dBLI']='';
    $msg['aBLI']='';
    $msg['cVAT']='';
    $msg['aVAT']='';
    $msg['aLogo']='';
    $msg['cCNR']='';
    $msg['cTaxID']='';
    $msg['cTaxAddr']='';
    $msg['cCountryR']='THA';
    $msg['Phone1R']='';
    $msg['MailR']='';
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
    $msg['SL_3']=array();
    $msg['SL_3_list']=array('1'=>'Spa and Heath Institutions',
        '2'=>'City Sightseeing Tours',
        '3'=>'Organisations',
        '4'=>'Wellness Offers',
        '5'=>'Associations',
        '6'=>'City Trips',
        '7'=>'Tourism Representatives / Tourism Boards',
        '8'=>'Others'
    );
    $msg['SL_3_outros']='';
    $msg['SL_4']=array();
    $msg['SL_4_list']=array('1'=>'Coach Companies / Carriers',
        '2'=>'Car Rental Companies',
        '3'=>'Airlines',
        '4'=>'Limousine Services',
        '5'=>'River Cruises',
        '6'=>'Others'
    );
    $msg['SL_4_outros']='';
    $msg['SL_5']=array();
    $msg['SL_5_list']=array('1'=>'Destination Management Companies',
        '2'=>'Exhibition Centers',
        '3'=>'Professional Conference Organisers',
        '4'=>'Business Travel Agencies',
        '5'=>'Event Agencies',
        '6'=>'Travel Management Company',
        '7'=>'Others'
    );
    $msg['SL_5_outros']='';
    $msg['SL_6']=array();
    $msg['SL_6_list']=array('1'=>'Cabaret / Variety Shows',
        '2'=>'Tourist Attractions',
        '3'=>'Musicals',
        '4'=>'Non-profit Organisations',
        '5'=>'Amusement Parks',
        '6'=>'Others'
    );
    $msg['SL_6_outros']='';
    $msg['cCountryMk1']='BRA';
    $msg['cCountryMk2']='ARG';
    $msg['cCountryMk3']='URY';
    $msg['tDescription']='';
    return $msg;
}

//SALVA CADASTRO - FAZ O INSERT ou UPDATE CONFORME O ID
function expositores_salva(){
    global $db;
    $_SESSION['dados']['titulo']='Erro - Verifique Dados';
    $_SESSION['view']='list';
    $pr[':NID']=filter_input(INPUT_POST, 'nId', FILTER_SANITIZE_NUMBER_INT);
    $pr[':CNAME']=filter_input(INPUT_POST, 'cName', FILTER_SANITIZE_STRING);
    $pr[':CADDRESS']=filter_input(INPUT_POST, 'cAddress', FILTER_SANITIZE_STRING);
    $pr[':CCOUNTRY']=filter_input(INPUT_POST, 'cCountry', FILTER_SANITIZE_STRING);
    $pr[':CPOSTCODE']=filter_input(INPUT_POST, 'cPostCode', FILTER_SANITIZE_STRING);
    $pr[':CPHONE1']=filter_input(INPUT_POST, 'cPhone1', FILTER_SANITIZE_STRING);
    $pr[':CPHONE2']=filter_input(INPUT_POST, 'cPhone2', FILTER_SANITIZE_STRING);
    $pr[':CEMAIL']=filter_input(INPUT_POST, 'cEmail', FILTER_SANITIZE_STRING);
    $pr[':CWEB']=filter_input(INPUT_POST, 'cWeb', FILTER_SANITIZE_STRING);
    $pr[':EPERSON']=filter_input(INPUT_POST, 'ePerson', FILTER_UNSAFE_RAW,FILTER_DEFAULT);
    $pr[':CPERSONALNAME']=filter_input(INPUT_POST, 'cPersonalName', FILTER_SANITIZE_STRING);
    $pr[':CCARGO']=filter_input(INPUT_POST, 'cCargo', FILTER_SANITIZE_STRING);
    $pr[':CPERSONALEMAIL']=filter_input(INPUT_POST, 'cPersonalEmail', FILTER_SANITIZE_STRING);
    $pr[':CPERSONALPHONE']=filter_input(INPUT_POST, 'cPersonalPhone', FILTER_SANITIZE_STRING);
    $pr[':NBUSINESSTYPE']=filter_input(INPUT_POST, 'nBusinessType', FILTER_SANITIZE_NUMBER_INT);
    $pr[':NBUSINESSTYPEOTHER']=filter_input(INPUT_POST, 'nBusinessTypeOther', FILTER_SANITIZE_STRING);
    $pr[':NBLI']=filter_input(INPUT_POST, 'nBLI', FILTER_SANITIZE_STRING);
    $pr[':DBLI']=filter_input(INPUT_POST, 'dBLI', FILTER_UNSAFE_RAW,FILTER_DEFAULT);
    $pr[':CVAT']=filter_input(INPUT_POST, 'cVAT', FILTER_SANITIZE_STRING);
    $pr[':CCNR']=filter_input(INPUT_POST, 'cCNR', FILTER_SANITIZE_STRING);
    $pr[':CTAXID']=filter_input(INPUT_POST, 'cTaxID', FILTER_SANITIZE_STRING);
    $pr[':CTAXADDR']=filter_input(INPUT_POST, 'cTaxAddr', FILTER_SANITIZE_STRING);
    $pr[':CCOUNTRYR']=filter_input(INPUT_POST, 'cCountryR', FILTER_SANITIZE_STRING);
    $pr[':PHONE1R']=filter_input(INPUT_POST, 'Phone1R', FILTER_SANITIZE_STRING);
    $pr[':MAILR']=filter_input(INPUT_POST, 'MailR', FILTER_SANITIZE_STRING);
    $pr[':SI_1']=implode(';',filter_var_array($_POST['SI_1'],FILTER_SANITIZE_NUMBER_INT));
    $pr[':SL_2']=implode(';',filter_var_array($_POST['SL_1'],FILTER_SANITIZE_NUMBER_INT));
    $pr[':SL_3']=implode(';',filter_var_array($_POST['SL_3'],FILTER_SANITIZE_NUMBER_INT));
    $pr[':SL_4']=implode(';',filter_var_array($_POST['SL_4'],FILTER_SANITIZE_NUMBER_INT));
    $pr[':SL_5']=implode(';',filter_var_array($_POST['SL_5'],FILTER_SANITIZE_NUMBER_INT));
    $pr[':SL_6']=implode(';',filter_var_array($_POST['SL_6'],FILTER_SANITIZE_NUMBER_INT));
    $pr[':CCOUNTRYMK1']=filter_input(INPUT_POST, 'cCountryMk1', FILTER_SANITIZE_STRING);
    $pr[':CCOUNTRYMK2']=filter_input(INPUT_POST, 'cCountryMk2', FILTER_SANITIZE_STRING);
    $pr[':CCOUNTRYMK3']=filter_input(INPUT_POST, 'cCountryMk3', FILTER_SANITIZE_STRING);
    $pr[':TDESCRIPTION']=filter_input(INPUT_POST, 'tDescription', FILTER_SANITIZE_STRING);
    $pr[':SI_1_OUTROS']=filter_input(INPUT_POST, 'SI_1_outros', FILTER_SANITIZE_STRING);
    $pr[':SL_2_OUTROS']=filter_input(INPUT_POST, 'SL_2_outros', FILTER_SANITIZE_STRING);
    $pr[':SL_3_OUTROS']=filter_input(INPUT_POST, 'SL_3_outros', FILTER_SANITIZE_STRING);
    $pr[':SL_4_OUTROS']=filter_input(INPUT_POST, 'SL_4_outros', FILTER_SANITIZE_STRING);
    $pr[':SL_5_OUTROS']=filter_input(INPUT_POST, 'SL_5_outros', FILTER_SANITIZE_STRING);
    $pr[':SL_6_OUTROS']=filter_input(INPUT_POST, 'SL_6_outros', FILTER_SANITIZE_STRING);
    //FAZ AS VERIFICAÇÕES 
    $r=SqlQuery("SELECT cName, nId from expositores where cName='".$pr[':CNAME']."' and nId<>'".$pr[':NID']."' limit 1");
    if($r->rowCount()>0){
        //se JÁ EXISTE wNome
        $_SESSION['view']='form';
        $_SESSION['erro_no']=2;
        $_SESSION['erro']='<h3>NÃO SALVO</h3>Já existe um expositores com estes dados cadastrados, tente novamente - cName';
        return array_merge(expositores_novo(),$_SESSION['dados']);
    }
    $r=SqlQuery("SELECT cEmail, nId from expositores where cEmail='".$pr[':CEMAIL']."' and nId<>'".$pr[':NID']."' limit 1");
    if($r->rowCount()>0){
        //se JÁ EXISTE cEmail
        $_SESSION['view']='form';
        $_SESSION['erro_no']=2;
        $_SESSION['erro']='<h3>NÃO SALVO</h3>Já existe um expositores com estes dados cadastrados, tente novamente - cEmail';
        return array_merge(expositores_novo(),$_SESSION['dados']);
    }
    $r=SqlQuery("SELECT cWeb, nId from expositores where cWeb='".$pr[':CWEB']."' and nId<>'".$pr[':NID']."' limit 1");
    if($r->rowCount()>0){
        //se JÁ EXISTE cWeb
        $_SESSION['view']='form';
        $_SESSION['erro_no']=2;
        $_SESSION['erro']='<h3>NÃO SALVO</h3>Já existe um expositores com estes dados cadastrados, tente novamente - cWeb';
        return array_merge(expositores_novo(),$_SESSION['dados']);
    }
    $r=SqlQuery("SELECT cPersonalName, nId from expositores where cPersonalName='".$pr[':CPERSONALNAME']."' and nId<>'".$pr[':NID']."' limit 1");
    if($r->rowCount()>0){
        //se JÁ EXISTE cPersonalName
        $_SESSION['view']='form';
        $_SESSION['erro_no']=2;
        $_SESSION['erro']='<h3>NÃO SALVO</h3>Já existe um expositores com estes dados cadastrados, tente novamente - cPersonalName';
        return array_merge(expositores_novo(),$_SESSION['dados']);
    }
    $r=SqlQuery("SELECT nBLI, nId from expositores where nBLI='".$pr[':NBLI']."' and nId<>'".$pr[':NID']."' limit 1");
    if($r->rowCount()>0){
        //se JÁ EXISTE nBLI
        $_SESSION['view']='form';
        $_SESSION['erro_no']=2;
        $_SESSION['erro']='<h3>NÃO SALVO</h3>Já existe um expositores com estes dados cadastrados, tente novamente - nBLI';
        return array_merge(expositores_novo(),$_SESSION['dados']);
    }
    $r=SqlQuery("SELECT cVAT, nId from expositores where cVAT='".$pr[':CVAT']."' and nId<>'".$pr[':NID']."' limit 1");
    if($r->rowCount()>0){
        //se JÁ EXISTE cVAT
        $_SESSION['view']='form';
        $_SESSION['erro_no']=2;
        $_SESSION['erro']='<h3>NÃO SALVO</h3>Já existe um expositores com estes dados cadastrados, tente novamente - cVAT';
        return array_merge(expositores_novo(),$_SESSION['dados']);
    }
    if(filter_var($_SESSION['route'][2])==0){
        // SE 0 INSERT
        $sql="INSERT into expositores (nId ,cName ,cAddress ,cCountry ,cPostCode ,cPhone1 ,cPhone2 ,cEmail ,cWeb ,ePerson ,cPersonalName ,cCargo ,cPersonalEmail ,cPersonalPhone ,nBusinessType ,nBusinessTypeOther ,nBLI ,dBLI ,aBLI ,cVAT ,aVAT ,aLogo ,cCNR ,cTaxID ,cTaxAddr ,cCountryR ,Phone1R ,MailR ,SI_1 ,SL_2 ,SL_3 ,SL_4 ,SL_5 ,SL_6 ,cCountryMk1 ,cCountryMk2 ,cCountryMk3 ,tDescription ,SI_1_ourtros ,SL_2_outros ,SL_3_outros ,SL_4_outros ,SL_5_outros ,SL_6_outros, cPassw) values ('', '".$pr[':CNAME']."', '".$pr[':CADDRESS']."', '".$pr[':CCOUNTRY']."', '".$pr[':CPOSTCODE']."', '".$pr[':CPHONE1']."', '".$pr[':CPHONE2']."', '".$pr[':CEMAIL']."', '".$pr[':CWEB']."', '".$pr[':EPERSON']."', '".$pr[':CPERSONALNAME']."', '".$pr[':CCARGO']."', '".$pr[':CPERSONALEMAIL']."', '".$pr[':CPERSONALPHONE']."', '".$pr[':NBUSINESSTYPE']."', '".$pr[':NBUSINESSTYPEOTHER']."', '".$pr[':NBLI']."', '".$pr[':DBLI']."', '".$pr[':ABLI']."', '".$pr[':CVAT']."', '".$pr[':AVAT']."', '".$pr[':ALOGO']."', '".$pr[':CCNR']."', '".$pr[':CTAXID']."', '".$pr[':CTAXADDR']."', '".$pr[':CCOUNTRYR']."', '".$pr[':PHONE1R']."', '".$pr[':MAILR']."', '".$pr[':SI_1']."', '".$pr[':SL_2']."', '".$pr[':SL_3']."', '".$pr[':SL_4']."', '".$pr[':SL_5']."', '".$pr[':SL_6']."', '".$pr[':CCOUNTRYMK1']."', '".$pr[':CCOUNTRYMK2']."', '".$pr[':CCOUNTRYMK3']."', '".$pr[':TDESCRIPTION']."', '".$pr[':SI_1_OUTROS']."', '".$pr[':SL_2_OUTROS']."', '".$pr[':SL_3_OUTROS']."', '".$pr[':SL_4_OUTROS']."', '".$pr[':SL_5_OUTROS']."', '".$pr[':SL_6_OUTROS']."', '".$pr[':CPASSW']."')";
        $r=SqlQuery($sql);
        $IID=$db->lastInsertId();
    } else {
        // SE >0 UPDATE
        $sql="UPDATE expositores set cName='".$pr[':CNAME']."', cAddress='".$pr[':CADDRESS']."', cCountry='".$pr[':CCOUNTRY']."', cPostCode='".$pr[':CPOSTCODE']."', cPhone1='".$pr[':CPHONE1']."', cPhone2='".$pr[':CPHONE2']."', cEmail='".$pr[':CEMAIL']."', cWeb='".$pr[':CWEB']."', ePerson='".$pr[':EPERSON']."', cPersonalName='".$pr[':CPERSONALNAME']."', cCargo='".$pr[':CCARGO']."', cPersonalEmail='".$pr[':CPERSONALEMAIL']."', cPersonalPhone='".$pr[':CPERSONALPHONE']."', nBusinessType='".$pr[':NBUSINESSTYPE']."', nBusinessTypeOther='".$pr[':NBUSINESSTYPEOTHER']."', nBLI='".$pr[':NBLI']."', dBLI='".$pr[':DBLI']."', cVAT='".$pr[':CVAT']."', cCNR='".$pr[':CCNR']."', cTaxID='".$pr[':CTAXID']."', cTaxAddr='".$pr[':CTAXADDR']."', cCountryR='".$pr[':CCOUNTRYR']."', Phone1R='".$pr[':PHONE1R']."', MailR='".$pr[':MAILR']."', SI_1='".$pr[':SI_1']."', SL_2='".$pr[':SL_2']."', SL_3='".$pr[':SL_3']."', SL_4='".$pr[':SL_4']."', SL_5='".$pr[':SL_5']."', SL_6='".$pr[':SL_6']."', cCountryMk1='".$pr[':CCOUNTRYMK1']."', cCountryMk2='".$pr[':CCOUNTRYMK2']."', cCountryMk3='".$pr[':CCOUNTRYMK3']."', tDescription='".$pr[':TDESCRIPTION']."', SI_1_ourtros='".$pr[':SI_1_OUTROS']."', SL_2_outros='".$pr[':SL_2_OUTROS']."', SL_3_outros='".$pr[':SL_3_OUTROS']."', SL_4_outros='".$pr[':SL_4_OUTROS']."', SL_5_outros='".$pr[':SL_5_OUTROS']."', SL_6_outros='".$pr[':SL_6_OUTROS']."' where nId='".$pr[':NID']."' limit 1";
        $r=SqlQuery($sql);
        $IID=$pr[':NID'];
    }
    $_SESSION['view']='list';
    $_SESSION['erro_no']=1;
    $_SESSION['erro']='<h3>SALVO COM SUCESSO</h3>expositores ID:'.$IID;
    return expositores_list();
}

//ATUALIZA CADASTRO - DADOS DO ID ESPECIFICADO
function expositores_atualiza(){
    global $db;
    $_SESSION['view']='form';
    $msg['titulo']='Alterar expositores';
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $sql="SELECT * FROM expositores where nId=".$pr[':id']." limit 1";
    $r=SqlQuery($sql);
    $l = $r->fetch(PDO::FETCH_ASSOC);
    $msg['nId']=$l['nId']; //ID Seller -- PRI.
    $msg['cName']=$l['cName']; //Seller Name -- UNI.
    $msg['cAddress']=$l['cAddress']; //Seller Address -- .
    $msg['cCountry']=$l['cCountry']; //Country -- .
    $msg['cPostCode']=$l['cPostCode']; //Post Code -- .
    $msg['cPhone1']=$l['cPhone1']; //Phone Number -- .
    $msg['cPhone2']=$l['cPhone2']; //Direct Phone Number -- .
    $msg['cEmail']=$l['cEmail']; //Mail (login) * -- UNI.
    $msg['cWeb']=$l['cWeb']; //Site * -- UNI.
    $msg['ePerson']=$l['ePerson']; //Contact Person -- .
    $msg['cPersonalName']=$l['cPersonalName']; //Complete Name (for Credential) -- UNI.
    $msg['cCargo']=$l['cCargo']; //Position -- .
    $msg['cPersonalEmail']=$l['cPersonalEmail']; //Personal Mail -- .
    $msg['cPersonalPhone']=$l['cPersonalPhone']; //Cell Phone -- .
    $msg['nBusinessType']=$l['nBusinessType']; //Business Type -- .
    $msg['nBusinessTypeOther']=$l['nBusinessTypeOther']; //Others -- .
    $msg['nBLI']=$l['nBLI']; //Business Licence Number -- UNI.
    $msg['dBLI']=$l['dBLI']; //B. L. I. Expiration Date -- .
    $msg['cVAT']=$l['cVAT']; //VAT Certificate Number -- UNI.
    $msg['cCNR']=$l['cCNR']; //Company Name for Receipt -- .
    $msg['cTaxID']=$l['cTaxID']; //Tax Id Number (13 Digits) -- .
    $msg['cTaxAddr']=$l['cTaxAddr']; //Address For Receipt -- .
    $msg['cCountryR']=$l['cCountryR']; //Country For Receipt -- .
    $msg['Phone1R']=$l['Phone1R']; //Phone For Receipt -- .
    $msg['MailR']=$l['MailR']; //Mail For Receipt -- .
    $msg['SI_1']=explode(';',$l['SI_1']); //Hotels & Resorts -- .
    $msg['SL_2']=explode(';',$l['SL_2']); //Tour Operators / Travel Agents -- .
    $msg['SL_3']=explode(';',$l['SL_3']); //Associations / Tourism Organisations -- .
    $msg['SL_4']=explode(';',$l['SL_4']); //Transportations / Carriers -- .
    $msg['SL_5']=explode(';',$l['SL_5']); // Business Travel / MICE -- .
    $msg['SL_6']=explode(';',$l['SL_6']); //Others -- .
    $msg['cCountryMk1']=$l['cCountryMk1']; //TOP3 MARKETS (COUNTRIES) 1 -- .
    $msg['cCountryMk2']=$l['cCountryMk2']; //TOP3 MARKETS (COUNTRIES) 2 -- .
    $msg['cCountryMk3']=$l['cCountryMk3']; //TOP3 MARKETS (COUNTRIES) 3 -- .
    $msg['tDescription']=$l['tDescription']; //Company Description (Describe your organisation in not more than 50 words) BLOCK -- .
    $msg['SI_1_ourtros']=$l['SI_1_ourtros']; //Others -- .
    $msg['SL_2_outros']=$l['SL_2_outros']; //Others -- .
    $msg['SL_3_outros']=$l['SL_3_outros']; //Others -- .
    $msg['SL_4_outros']=$l['SL_4_outros']; //Others -- .
    $msg['SL_5_outros']=$l['SL_5_outros']; //Others -- .
    $msg['SL_6_outros']=$l['SL_6_outros']; //Others -- .
    return array_merge(expositores_novo(),$msg);
}

//EXCLUI CADASTRO
function expositores_exclui(){
    global $db;
    $_SESSION['view']='list';
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $r=SqlQuery("select nId, aBLI, aVAT, aLogo from expositores where nId=".$pr[':id']." limit 1");
    if($r->rowCount()<>1){
        $_SESSION['erro_no']='2';
        $_SESSION['erro']='ERRO: Validação da Exclusão não Aceita';
        return expositores_list();
    } else {
        // PEGA E EXCLUI AS IMAGENS 
        $l=$r->fetch(PDO::FETCH_ASSOC);
        @unlink(_FS.$l['aLogo']);
        //PEGA imagens PRODUTO
        $s=SqlQuery("SELECT * from exp_produtct where nId_expositor='".$pr[':id']."'");
        while($z=$s->fetch(PDO::FETCH_ASSOC)){
            @unlink(_FS.$z['aFile']);
        }
        $r=SqlQuery("DELETE from exp_produtct where nId_expositor='".$pr[':id']."'");
        //PEGA DELEGATES
        $s=SqlQuery("SELECT * from exp_delegate where nId_expositor='".$pr[':id']."'");
        while($z=$s->fetch(PDO::FETCH_ASSOC)){
            @unlink(_FS.$z['fPhoto']);
        }
        $r=SqlQuery("DELETE from exp_delegate where nId_expositor='".$pr[':id']."'");
        //PEGA RESOURCE
        $s=SqlQuery("SELECT * from exp_resouce where nId_expositor='".$pr[':id']."'");
        while($z=$s->fetch(PDO::FETCH_ASSOC)){
            @unlink(_FS.$z['aFile']);
        }
        $r=SqlQuery("DELETE from exp_resouce where nId_expositor='".$pr[':id']."'");
        //PEGA RESOURCE
        $s=SqlQuery("SELECT * from exp_videos where nId_expositor='".$pr[':id']."'");
        $r=SqlQuery("DELETE from exp_videos where nId_expositor='".$pr[':id']."'");
        // exclui o expositor....
        $r=SqlQuery("DELETE from expositores where nId=".$pr[':id']." limit 1");
        $_SESSION['erro_no']='1';
        $_SESSION['erro']='SUCESSO: Excluído Com Sucesso';
        return expositores_list();
    }
}

//MOSTRA 1 CADASTRO
function expositores_mostra(){
    global $db;
    $_SESSION['view']='print';
    $data['titulo']='Mostrar expositores';
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $r=SqlQuery("select * from expositores where nId=".$pr[':id']." limit 1");
    if($r->rowCount()<>1){
        $_SESSION['erro_no']='2';
        $_SESSION['view']='list';
        $_SESSION['erro']='ERRO: CADASTRO NУO LOCALIZADO';
        return expositores_list();
    } else {
        $data['registros']=$r->RowCount();
        while($l = $r->fetch(PDO::FETCH_ASSOC)) {
            $data['nId']=$l['nId']; //ID Seller -- PRI.
            $data['cName']=$l['cName']; //Seller Name -- UNI.
            $data['cAddress']=$l['cAddress']; //Seller Address -- .
            $data['cCountry']=$l['cCountry']; //Country -- .
            $data['cPostCode']=$l['cPostCode']; //Post Code -- .
            $data['cPhone1']=$l['cPhone1']; //Phone Number -- .
            $data['cPhone2']=$l['cPhone2']; //Direct Phone Number -- .
            $data['cWeb']=$l['cWeb']; //Site * -- UNI.
            $data['aLogo']=$l['aLogo']; //Attach Picture Logo -- .
            $data['SI_1']=explode(';',$l['SI_1']); //Hotels & Resorts -- .
            $data['SL_2']=explode(';',$l['SL_2']); //Tour Operators / Travel Agents -- .
            $data['SL_3']=explode(';',$l['SL_3']); //Associations / Tourism Organisations -- .
            $data['SL_4']=explode(';',$l['SL_4']); //Transportations / Carriers -- .
            $data['SL_5']=explode(';',$l['SL_5']); // Business Travel / MICE -- .
            $data['SL_6']=explode(';',$l['SL_6']); //Others -- .
            $data['cCountryMk1']=$l['cCountryMk1']; //TOP3 MARKETS (COUNTRIES) 1 -- .
            $data['cCountryMk2']=$l['cCountryMk2']; //TOP3 MARKETS (COUNTRIES) 2 -- .
            $data['cCountryMk3']=$l['cCountryMk3']; //TOP3 MARKETS (COUNTRIES) 3 -- .
            $data['tDescription']=$l['tDescription']; //Company Description (Describe your organisation in not more than 50 words) BLOCK -- .
            $data['SI_1_ourtros']=$l['SI_1_ourtros']; //Others -- .
            $data['SL_2_outros']=$l['SL_2_outros']; //Others -- .
            $data['SL_3_outros']=$l['SL_3_outros']; //Others -- .
            $data['SL_4_outros']=$l['SL_4_outros']; //Others -- .
            $data['SL_5_outros']=$l['SL_5_outros']; //Others -- .
            $data['SL_6_outros']=$l['SL_6_outros']; //Others -- .
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
        $data=array_merge(expositores_novo(),$data);
        $_SESSION['view']='print';
        $data['titulo']='Mostrar expositor'.$data['cName'];
        return $data;
    }
}

//LISTAGEM DA TABELA - OK
function expositores_wernew(){
    global $db;
    $_SESSION['view']='where';
    $data['titulo']="Configuração das Meets";
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $r=SqlQuery("select nId, cName, aWhereby from expositores where nId=".$pr[':id']." limit 1");
    if($r->rowCount()<>1){
        $_SESSION['erro_no']='2';
        $_SESSION['view']='list';
        $_SESSION['erro']='ERROR: CADASTRO NÃO LOCALIZADO';
        return expositores_list();
    } else {
        $data['registros']=$r->RowCount();
        while($l = $r->fetch(PDO::FETCH_ASSOC)) {
            $data['nId']=$l['nId'];
            $data['cName']=$l['cName'];
            $data['aWhereby']=$l['aWhereby'];
        }
        return $data;    
    }
}

function expositores_wheresave(){
    global $db;
    $_SESSION['dados']['titulo']='Erro - Verifique Dados';
    $_SESSION['view']='list';
    $pr[':NID']=filter_input(INPUT_POST, 'nId', FILTER_SANITIZE_NUMBER_INT);
    $pr[':CW']=filter_input(INPUT_POST, 'aWhereby', FILTER_SANITIZE_STRING,FILTER_FLAG_ENCODE_HIGH);
    if(filter_var($_SESSION['route'][2])==0){
        // SE 0 INSERT
        $_SESSION['view']='list';
        $_SESSION['erro_no']=2;
        $_SESSION['erro']='<h3>ERROR:</h3> Expositor não cadastrado!';
        return expositores_list();
    } else {
        // SE >0 UPDATE
        $sql="UPDATE expositores set aWhereby='".$pr[':CW']."' where nId='".$pr[':NID']."' limit 1";
        $r=SqlQuery($sql);
        $IID=$pr[':NID'];
    }
    $_SESSION['view']='list';
    $_SESSION['erro_no']=1;
    $_SESSION['erro']='<h3>SALVO COM SUCESSO</h3>expositores ID:'.$IID;
    return expositores_list();
}
?>