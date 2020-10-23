<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED'); 
logado('ADMIN');
$_SESSION['dados']=$_POST;
if(!isset($_SESSION['route'][1]) or $_SESSION['route'][1]=='list'){
    $_SESSION['dados']=clientes_list();
} elseif($_SESSION['route'][1]=='novo'){
    $_SESSION['dados']=clientes_novo();
} elseif($_SESSION['route'][1]=='atualiza'){
    $_SESSION['dados']=clientes_atualiza();
} elseif($_SESSION['route'][1]=='save'){
    $_SESSION['dados']=clientes_salva();
} elseif($_SESSION['route'][1]=='exclui'){
    $_SESSION['dados']=clientes_exclui();
} elseif($_SESSION['route'][1]=='mostra'){
    $_SESSION['dados']=clientes_mostra();
} elseif($_SESSION['route'][1]=='senha'){
    $_SESSION['dados']=clientes_senha(); 
} elseif($_SESSION['route'][1]=='senhasave'){
    $_SESSION['dados']=clientes_senhasave(); 
}else {
    // VIEW PADRÃO ou MOSTRA QUE NÃO EXISTE se for DEV
    if(AMBIENTE == 'DEVELOPER') {
        print_r($_SESSION['route']);
      } else {
        $_SESSION['dados']=clientes_list();
      }
}

//LISTAGEM DA TABELA
function clientes_list(){
    global $db;
    $_SESSION['view']='list';
    $data['titulo']="Cadastro de clientes";
    $sql="SELECT count(nId) as Total FROM clientes";
    $r=SqlQuery($sql);
    $l=$r->fetch(PDO::FETCH_ASSOC); 
    $data['total']=$l['Total'];
    $sql="SELECT nId ,cCompany, cEmail, cPersonalName FROM clientes ORDER BY nId";
    $r=SqlQuery($sql);
    $data['registros']=$r->RowCount();
    while($l = $r->fetch(PDO::FETCH_ASSOC)) {
        $data['listagem'][$l['nId']]=$l;
    }
    return $data;
}

//NOVO CADASTRO - DADOS EM BRANCO
function clientes_novo(){
    global $db;
    $_SESSION['view']='form';
    $msg['titulo']='Incluir clientes';
    $msg['nId']=0; //ID do Cliente -- PRI.
    $msg['cCompany']=''; //Buyer Company Name -- UNI.
    $msg['cAddress']=''; //Address -- .
    $msg['cCity']=''; //City -- .
    $msg['cCEP']=''; //Post Code -- .
    $msg['cCountry']='BRA'; //Country -- .
    $r=SqlQuery("SELECT cSigla, wEnglish from paises order by wEnglish");
    while($l=$r->fetch(PDO::FETCH_ASSOC)){
        $list[$l['cSigla']]=$l['wEnglish'];
    }
    $msg['cCountry_list']=$list;
    $msg['cWeb']=''; //Website -- .
    $msg['cWhatsapp']=''; //WhatsApp (for emergency) -- .
    $msg['cPhone1']=''; //Phone -- .
    $msg['ePerson']='';
    $msg['ePerson_list']=array('MR'=>'Mr.','MS'=>'Ms', 'MRS'=>'Mrs');
    $msg['cPersonalName']=''; //Complete Name (for credential) -- .
    $msg['cCargo']=''; //Job Title (for Credential) -- .
    $msg['cEmail']=''; //Mail (for Credential) -- .
    // J. => Buyer Questionnaire
    $msg['CompanyProfile']=array(); //Company Business Profile -- .
    $msg['CompanyProfile_list']=array('1'=>'Outbound Group Travel',
        '2'=>'Outbound Individual Travel',
        '3'=>'Outbound Corporate / Business Travel',
        '4'=>'Outbound Incentive Travel',
        '5'=>'Outbound Leisure Travel',
        '6'=>'Outbound Adventure Travel',
        '7'=>'Outbound Golf Travel',
        '8'=>'Outbound Spa & Wellness Travel',
        '9'=>'Meeting & Conversations',
        '10'=>'Exhibitions',
        '11'=>'Honey Moon Tours',
        '12'=>'Dive Tours',
        '13'=>'Cruises',
        '14'=>'Events',
        '15'=>'Youth & Student Travel',
        '16'=>'Special Interest Tour Operators',
        '17'=>'Others'
    );
    $msg['ProductInterest']=array(); //Product of Interest -- .
    $msg['ProductInterest_list']=array('1'=>'Accommodation - Hotels Chains',
        '2'=>'Accommodation - Independent Hotels',
        '3'=>'Accommodation - Ressorts',
        '4'=>'Serviced Apartments',
        '5'=>'Airlines',
        '6'=>'National / Regional Tourism Organizations',
        '7'=>'Inbound Tour Operators',
        '8'=>'Professional Conference Organizers',
        '9'=>'Destination Management Companies',
        '10'=>'Day Cruise Operators',
        '11'=>'Regional / International Cruise Operators',
        '12'=>'Car Rental',
        '13'=>'Adventure Tour Operators',
        '14'=>'Dive Operators',
        '15'=>'Attractions / Museums / Galleries',
        '16'=>'Rail Travel',
        '17'=>'Theme Parks',
        '18'=>'Nature / National Parks',
        '19'=>'Restaurants',
        '20'=>'Travel Media',
        '21'=>'Travel Technology Companies',
        '22'=>'Travel Web Portal',
        '23'=>'Meeting / Convention Venue',
        '24'=>'Spass',
        '25'=>'Golf Courses',
        '26'=>'Sports / Special Events',
        '27'=>'Others'
    );
    $msg['eResponsa']=array(); //What Level of Responsibility do You Have for Outbound Business -- .
    $msg['eResponsa_list']=array(
        '1'=>'Final Decision',
        '2'=>'Research',
        '3'=>'Recommend',
        '4'=>'Plan / Organize',
        '5'=>'None',
        '6'=>'Others'
    );
    $msg['eMajorSector']=array(); //Major Selector -- .
    $msg['eMajorSector_list']=array(
        '1'=>'Leisure',
        '2'=>'MICE',
        '3'=>'Leisure + MICE',
        '4'=>'Special Interest (e-Commerce, Online Booking)'
    );
    $msg['nInbound']=''; //Inbound % -- .
    $msg['nOutbound']=''; //Outbound % -- .
    $msg['nOutboundGroup']=array(); //Number of Outbound Group Organized Per Year? -- .
    $msg['nOutboundGroup_list']=array(
        '1'=>'1-15',
        '2'=>'16-30',
        '3'=>'31-45',
        '4'=>'46-60',
        '5'=>'60+',
        '6'=>'None'
    );
    $msg['nOutboundAverage']=array(); //Average Number of Outbound Pax(s) Organized per Year? -- .
    $msg['nOutboundAverage_list']=array(
        '1'=>'1-15',
        '2'=>'16-30',
        '3'=>'31-45',
        '4'=>'46-60',
        '5'=>'60+',
        '6'=>'None'
    );
    $msg['cSeller1']=''; //Name 1 -- .
    $msg['cSeller2']=''; //Name 2 -- .
    $msg['cSeller3']=''; //Name 3 -- .
    $msg['cSeller4']=''; //Name 4 -- .
    $msg['cSeller5']=''; //Name 5 -- .
    $msg['cCountry1']='BRA'; //Country 1 -- .
    $msg['cCountry2']='ARG'; //Country 2 -- .
    $msg['cCountry3']='URY'; //Country 3 -- .
    $msg['cCountry4']='THA'; //Country 4 -- .
    $msg['cCountry5']='ECU'; //Country 5 -- .
    $msg['cDestino1']='BRA'; //Destination 1 -- .
    $msg['cDestino2']='ARG'; //Destination 2 -- .
    $msg['cDestino3']='URY'; //Destination 3 -- .
    $msg['cDestino4']='THA'; //Destination 4 -- .
    $msg['cDestino5']='ECU'; //Destination 5 -- .
    $msg['tDescription']=''; //Company Description -- .
    $msg['cPassw']='';
    return $msg;
}

//ATUALIZA CADASTRO - DADOS DO ID ESPECIFICADO
function clientes_atualiza(){
    global $db;
    $_SESSION['view']='form';
    $msg['titulo']='Alterar clientes';
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $sql="SELECT * FROM clientes where nId=".$pr[':id']." limit 1";
    $r=SqlQuery($sql);
    $l = $r->fetch(PDO::FETCH_ASSOC);
    $msg['nId']=$l['nId']; //ID do Cliente -- PRI.
    $msg['cCompany']=$l['cCompany']; //Buyer Company Name -- UNI.
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
    $msg['CompanyProfile']=explode(';',$l['CompanyProfile']); //Company Business Profile -- .
    $msg['ProductInterest']=explode(';',$l['ProductInterest']); //Product of Interest -- .
    $msg['eResponsa']=$l['eResponsa']; //What Level of Responsibility do You Have for Outbound Business -- .
    $msg['eMajorSector']=$l['eMajorSector']; //Major Selector -- .
    $msg['nInbound']=$l['nInbound']; //Inbound % -- .
    $msg['nOutbound']=$l['nOutbound']; //Outbound % -- .
    $msg['nOutboundGroup']=$l['nOutboundGroup']; //Number of Outbound Group Organized Per Year? -- .
    $msg['nOutboundAverage']=$l['nOutboundAverage']; //Average Number of Outbound Pax(s) Organized per Year? -- .
    $msg['cSeller1']=$l['cSeller1']; //Name 1 -- .
    $msg['cSeller2']=$l['cSeller2']; //Name 2 -- .
    $msg['cSeller3']=$l['cSeller3']; //Name 3 -- .
    $msg['cSeller4']=$l['cSeller4']; //Name 4 -- .
    $msg['cSeller5']=$l['cSeller5']; //Name 5 -- .
    $msg['cCountry1']=$l['cCountry1']; //Country 1 -- .
    $msg['cCountry2']=$l['cCountry2']; //Country 2 -- .
    $msg['cCountry3']=$l['cCountry3']; //Country 3 -- .
    $msg['cCountry4']=$l['cCountry4']; //Country 4 -- .
    $msg['cCountry5']=$l['cCountry5']; //Country 5 -- .
    $msg['cDestino1']=$l['cDestino1']; //Destination 1 -- .
    $msg['cDestino2']=$l['cDestino2']; //Destination 2 -- .
    $msg['cDestino3']=$l['cDestino3']; //Destination 3 -- .
    $msg['cDestino4']=$l['cDestino4']; //Destination 4 -- .
    $msg['cDestino5']=$l['cDestino5']; //Destination 5 -- .
    $msg['tDescription']=$l['tDescription']; //Company Description -- .
    return array_merge(clientes_novo(),$msg);
}

//SALVA CADASTRO - FAZ O INSERT ou UPDATE CONFORME O ID
function clientes_salva(){
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
    $pr[':CEMAIL']=filter_input(INPUT_POST, 'cEmail', FILTER_SANITIZE_STRING);
    $pr[':COMPANYPROFILE']=filter_input(INPUT_POST, 'CompanyProfile', FILTER_SANITIZE_STRING);
    $pr[':PRODUCTINTEREST']=filter_input(INPUT_POST, 'ProductInterest', FILTER_SANITIZE_STRING);
    $pr[':ERESPONSA']=filter_input(INPUT_POST, 'eResponsa', FILTER_SANITIZE_STRING);
    $pr[':EMAJORSECTOR']=filter_input(INPUT_POST, 'eMajorSector', FILTER_SANITIZE_STRING);
    $pr[':NINBOUND']=filter_input(INPUT_POST, 'nInbound', FILTER_SANITIZE_NUMBER_INT);
    $pr[':NOUTBOUND']=filter_input(INPUT_POST, 'nOutbound', FILTER_SANITIZE_NUMBER_INT);
    $pr[':NOUTBOUNDGROUP']=filter_input(INPUT_POST, 'nOutboundGroup', FILTER_SANITIZE_STRING);
    $pr[':NOUTBOUNDAVERAGE']=filter_input(INPUT_POST, 'nOutboundAverage', FILTER_SANITIZE_STRING);
    $pr[':CSELLER1']=filter_input(INPUT_POST, 'cSeller1', FILTER_SANITIZE_STRING);
    $pr[':CSELLER2']=filter_input(INPUT_POST, 'cSeller2', FILTER_SANITIZE_STRING);
    $pr[':CSELLER3']=filter_input(INPUT_POST, 'cSeller3', FILTER_SANITIZE_STRING);
    $pr[':CSELLER4']=filter_input(INPUT_POST, 'cSeller4', FILTER_SANITIZE_STRING);
    $pr[':CSELLER5']=filter_input(INPUT_POST, 'cSeller5', FILTER_SANITIZE_STRING);
    $pr[':CCOUNTRY1']=filter_input(INPUT_POST, 'cCountry1', FILTER_SANITIZE_STRING);
    $pr[':CCOUNTRY2']=filter_input(INPUT_POST, 'cCountry2', FILTER_SANITIZE_STRING);
    $pr[':CCOUNTRY3']=filter_input(INPUT_POST, 'cCountry3', FILTER_SANITIZE_STRING);
    $pr[':CCOUNTRY4']=filter_input(INPUT_POST, 'cCountry4', FILTER_SANITIZE_STRING);
    $pr[':CCOUNTRY5']=filter_input(INPUT_POST, 'cCountry5', FILTER_SANITIZE_STRING);
    $pr[':CDESTINO1']=filter_input(INPUT_POST, 'cDestino1', FILTER_SANITIZE_STRING);
    $pr[':CDESTINO2']=filter_input(INPUT_POST, 'cDestino2', FILTER_SANITIZE_STRING);
    $pr[':CDESTINO3']=filter_input(INPUT_POST, 'cDestino3', FILTER_SANITIZE_STRING);
    $pr[':CDESTINO4']=filter_input(INPUT_POST, 'cDestino4', FILTER_SANITIZE_STRING);
    $pr[':CDESTINO5']=filter_input(INPUT_POST, 'cDestino5', FILTER_SANITIZE_STRING);
    $pr[':TDESCRIPTION']=filter_input(INPUT_POST, 'tDescription', FILTER_SANITIZE_STRING);
    $r=SqlQuery("SELECT cCompany, nId from clientes where cCompany='".$pr[':CCOMPANY']."' and nId<>'".$pr[':NID']."' limit 1");
    if($r->rowCount()>0){
        //se JÁ EXISTE wNome
        $_SESSION['view']='form';
        $_SESSION['erro_no']=2;
        $_SESSION['erro']='<h3>NÃO SALVO</h3>Já existe um clientes com estes dados cadastrados, tente novamente - cCompany';
        return $_SESSION['dados'];
    }
    if(filter_var($_SESSION['route'][2])==0){
        // SE 0 INSERT
        $sql="INSERT into clientes (nId ,cCompany ,cAddress ,cCity ,cCEP ,cCountry ,cWeb ,cWhatsapp ,cPhone1 ,ePerson ,cPersonalName ,cCargo ,cEmail ,CompanyProfile ,ProductInterest ,eResponsa ,eMajorSector ,nInbound ,nOutbound ,nOutboundGroup ,nOutboundAverage ,cSeller1 ,cSeller2 ,cSeller3 ,cSeller4 ,cSeller5 ,cCountry1 ,cCountry2 ,cCountry3 ,cCountry4 ,cCountry5 ,cDestino1 ,cDestino2 ,cDestino3 ,cDestino4 ,cDestino5 ,tDescription) values ('', '".$pr[':CCOMPANY']."', '".$pr[':CADDRESS']."', '".$pr[':CCITY']."', '".$pr[':CCEP']."', '".$pr[':CCOUNTRY']."', '".$pr[':CWEB']."', '".$pr[':CWHATSAPP']."', '".$pr[':CPHONE1']."', '".$pr[':EPERSON']."', '".$pr[':CPERSONALNAME']."', '".$pr[':CCARGO']."', '".$pr[':CEMAIL']."', '".$pr[':COMPANYPROFILE']."', '".$pr[':PRODUCTINTEREST']."', '".$pr[':ERESPONSA']."', '".$pr[':EMAJORSECTOR']."', '".$pr[':NINBOUND']."', '".$pr[':NOUTBOUND']."', '".$pr[':NOUTBOUNDGROUP']."', '".$pr[':NOUTBOUNDAVERAGE']."', '".$pr[':CSELLER1']."', '".$pr[':CSELLER2']."', '".$pr[':CSELLER3']."', '".$pr[':CSELLER4']."', '".$pr[':CSELLER5']."', '".$pr[':CCOUNTRY1']."', '".$pr[':CCOUNTRY2']."', '".$pr[':CCOUNTRY3']."', '".$pr[':CCOUNTRY4']."', '".$pr[':CCOUNTRY5']."', '".$pr[':CDESTINO1']."', '".$pr[':CDESTINO2']."', '".$pr[':CDESTINO3']."', '".$pr[':CDESTINO4']."', '".$pr[':CDESTINO5']."', '".$pr[':TDESCRIPTION']."')";
    } else {
        // SE >0 UPDATE
        $sql="UPDATE clientes set cCompany='".$pr[':CCOMPANY']."', cAddress='".$pr[':CADDRESS']."', cCity='".$pr[':CCITY']."', cCEP='".$pr[':CCEP']."', cCountry='".$pr[':CCOUNTRY']."', cWeb='".$pr[':CWEB']."', cWhatsapp='".$pr[':CWHATSAPP']."', cPhone1='".$pr[':CPHONE1']."', ePerson='".$pr[':EPERSON']."', cPersonalName='".$pr[':CPERSONALNAME']."', cCargo='".$pr[':CCARGO']."', cEmail='".$pr[':CEMAIL']."', CompanyProfile='".$pr[':COMPANYPROFILE']."', ProductInterest='".$pr[':PRODUCTINTEREST']."', eResponsa='".$pr[':ERESPONSA']."', eMajorSector='".$pr[':EMAJORSECTOR']."', nInbound='".$pr[':NINBOUND']."', nOutbound='".$pr[':NOUTBOUND']."', nOutboundGroup='".$pr[':NOUTBOUNDGROUP']."', nOutboundAverage='".$pr[':NOUTBOUNDAVERAGE']."', cSeller1='".$pr[':CSELLER1']."', cSeller2='".$pr[':CSELLER2']."', cSeller3='".$pr[':CSELLER3']."', cSeller4='".$pr[':CSELLER4']."', cSeller5='".$pr[':CSELLER5']."', cCountry1='".$pr[':CCOUNTRY1']."', cCountry2='".$pr[':CCOUNTRY2']."', cCountry3='".$pr[':CCOUNTRY3']."', cCountry4='".$pr[':CCOUNTRY4']."', cCountry5='".$pr[':CCOUNTRY5']."', cDestino1='".$pr[':CDESTINO1']."', cDestino2='".$pr[':CDESTINO2']."', cDestino3='".$pr[':CDESTINO3']."', cDestino4='".$pr[':CDESTINO4']."', cDestino5='".$pr[':CDESTINO5']."', tDescription='".$pr[':TDESCRIPTION']."' where nId='".$pr[':NID']."' limit 1";
    }
    $r=SqlQuery($sql);
    $_SESSION['view']='list';
    $_SESSION['erro_no']=1;
    $_SESSION['erro']='<h3>SALVO COM SUCESSO</h3>clientes ID:'.$db->lastInsertId();
    return clientes_list();
}

//EXCLUI CADASTRO
function clientes_exclui(){
    global $db;
    $_SESSION['view']='list';
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $r=SqlQuery("select * from clientes where nId=".$pr[':id']." limit 1");
    if($r->rowCount()<>1){
        $_SESSION['erro_no']='2';
        $_SESSION['erro']='ERRO: Validação da Exclusão não Aceita';
        return clientes_list();
    } else {
        $r=SqlQuery("DELETE from clientes where nId=".$pr[':id']." limit 1");
        $_SESSION['erro_no']='1';
        $_SESSION['erro']='SUCESSO: Excluído Com Sucesso';
        return clientes_list();
    }
}

//MOSTRA 1 CADASTRO
function clientes_mostra(){
    global $db;
    $_SESSION['view']='form';
    $data['titulo']='Mostrar clientes';
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $r=SqlQuery("select * from clientes where nId=".$pr[':id']." limit 1");
    if($r->rowCount()<>1){
        $_SESSION['erro_no']='2';
        $_SESSION['view']='list';
        $_SESSION['erro']='ERRO: CADASTRO NÃO LOCALIZADO';
        return clientes_list();
    } else {
        $data['registros']=$r->RowCount();
        $data['read']='SIM';
        while($l = $r->fetch(PDO::FETCH_ASSOC)) {
            $data['nId']=$l['nId']; //ID do Cliente -- PRI.
            $data['cCompany']=$l['cCompany']; //Buyer Company Name -- UNI.
            $data['cAddress']=$l['cAddress']; //Address -- .
            $data['cCity']=$l['cCity']; //City -- .
            $data['cCEP']=$l['cCEP']; //Post Code -- .
            $data['cCountry']=$l['cCountry']; //Country -- .
            $data['cWeb']=$l['cWeb']; //Website -- .
            $data['cWhatsapp']=$l['cWhatsapp']; //WhatsApp (for emergency) -- .
            $data['cPhone1']=$l['cPhone1']; //Phone -- .
            $data['ePerson']=$l['ePerson']; //Person -- .
            $data['cPersonalName']=$l['cPersonalName']; //Complete Name (for credential) -- .
            $data['cCargo']=$l['cCargo']; //Job Title (for Credential) -- .
            $data['cEmail']=$l['cEmail']; //Mail (for Credential) -- .
            $data['CompanyProfile']=$l['CompanyProfile']; //Company Business Profile -- .
            $data['ProductInterest']=$l['ProductInterest']; //Product of Interest -- .
            $data['eResponsa']=$l['eResponsa']; //What Level of Responsibility do You Have for Outbound Business -- .
            $data['eMajorSector']=$l['eMajorSector']; //Major Selector -- .
            $data['nInbound']=$l['nInbound']; //Inbound % -- .
            $data['nOutbound']=$l['nOutbound']; //Outbound % -- .
            $data['nOutboundGroup']=$l['nOutboundGroup']; //Number of Outbound Group Organized Per Year? -- .
            $data['nOutboundAverage']=$l['nOutboundAverage']; //Average Number of Outbound Pax(s) Organized per Year? -- .
            $data['cSeller1']=$l['cSeller1']; //Name 1 -- .
            $data['cSeller2']=$l['cSeller2']; //Name 2 -- .
            $data['cSeller3']=$l['cSeller3']; //Name 3 -- .
            $data['cSeller4']=$l['cSeller4']; //Name 4 -- .
            $data['cSeller5']=$l['cSeller5']; //Name 5 -- .
            $data['cCountry1']=$l['cCountry1']; //Country 1 -- .
            $data['cCountry2']=$l['cCountry2']; //Country 2 -- .
            $data['cCountry3']=$l['cCountry3']; //Country 3 -- .
            $data['cCountry4']=$l['cCountry4']; //Country 4 -- .
            $data['cCountry5']=$l['cCountry5']; //Country 5 -- .
            $data['cDestino1']=$l['cDestino1']; //Destination 1 -- .
            $data['cDestino2']=$l['cDestino2']; //Destination 2 -- .
            $data['cDestino3']=$l['cDestino3']; //Destination 3 -- .
            $data['cDestino4']=$l['cDestino4']; //Destination 4 -- .
            $data['cDestino5']=$l['cDestino5']; //Destination 5 -- .
            $data['tDescription']=$l['tDescription']; //Company Description -- .
        }
        $data=array_merge(clientes_novo(),$data);
        $_SESSION['view']='print';
        $data['titulo']='Mostrar Buyer';        
        return $data;
    }
}

function clientes_senha(){
    global $db;
    $_SESSION['view']='senha';
    $msg['titulo']='Alterar senha de clientes';
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $sql="SELECT * FROM clientes where nId=".$pr[':id']." limit 1";
    $r=SqlQuery($sql);
    $l = $r->fetch(PDO::FETCH_ASSOC);
    $msg['nId']=$l['nId']; //ID do Cliente -- PRI.
    $msg['cCompany']=$l['cCompany']; //Buyer Company Name -- UNI.
    $msg['cPersonalName']=$l['cPersonalName']; //Complete Name (for credential) -- .
    $msg['cEmail']=$l['cEmail']; //Mail (for Credential) -- .
    return $msg;
}

function clientes_senhasave(){
    global $db;
    $_SESSION['dados']['titulo']='Erro - Verifique Dados';
    $_SESSION['view']='list';
    $pr[':NID']=filter_input(INPUT_POST, 'nId', FILTER_SANITIZE_NUMBER_INT);
    $pr[':CPASSW']=filter_input(INPUT_POST, 'sPassw', FILTER_SANITIZE_STRING);
    $pr[':CPASSW']=password_hash(sha1($pr[':CPASSW']), PASSWORD_DEFAULT);
    $sql="UPDATE clientes set sPassw='".$pr[':CPASSW']."' where nId='".$pr[':NID']."' limit 1";
    $r=SqlQuery($sql);
    $_SESSION['view']='list';
    $_SESSION['erro_no']=1;
    $_SESSION['erro']='<h3>SALVO COM SUCESSO</h3>';
    return clientes_list();
}
?>