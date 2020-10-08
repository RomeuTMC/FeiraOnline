<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED'); 
logado('ADMIN');
$_SESSION['dados']=$_POST;
if(!isset($_SESSION['route'][1]) or $_SESSION['route'][1]=='list'){
    $_SESSION['dados']=appointments_list();
} elseif($_SESSION['route'][1]=='novo'){
    $_SESSION['dados']=appointments_novo();
} elseif($_SESSION['route'][1]=='atualiza'){
    $_SESSION['dados']=appointments_atualiza();
} elseif($_SESSION['route'][1]=='save'){
    $_SESSION['dados']=appointments_salva();
} elseif($_SESSION['route'][1]=='exclui'){
    $_SESSION['dados']=appointments_exclui();
} elseif($_SESSION['route'][1]=='mostra'){
    $_SESSION['dados']=appointments_mostra();
}else {
    // VIEW PADRÃO ou MOSTRA QUE NÃO EXISTE se for DEV
    if(AMBIENTE == 'DEVELOPER') {
        print_r($_SESSION['route']);
      } else {
        $_SESSION['dados']=appointments_list();
      }
}

//LISTAGEM DA TABELA
function appointments_list(){
    global $db;
    $_SESSION['view']='list';
    $data['titulo']="Cadastro de appointments";
    $sql="SELECT count(nId) as Total FROM appointments";
    $r=SqlQuery($sql);
    $l=$r->fetch(PDO::FETCH_ASSOC); 
    $data['total']=$l['Total'];
    $sql="SELECT appointments.nId,nId_expositor,cName,nId_cliente,cCompany,tHora,eDay FROM appointments,expositores,clientes where appointments.nId_expositor=expositores.nId and appointments.nId_cliente=clientes.nId ORDER BY nId";
    $r=SqlQuery($sql);
    $data['registros']=$r->RowCount();
    while($l = $r->fetch(PDO::FETCH_ASSOC)) {
        $data['listagem'][$l['nId']]=$l;
    }
    return $data;
}

//NOVO CADASTRO - DADOS EM BRANCO
function appointments_novo(){
    global $db;
    $_SESSION['view']='form';
    $msg['titulo']='Incluir appointments';
    $msg['nId']=0; //ID Appointment -- PRI.
    $msg['nId_expositor']=''; //Expositor -- MUL.
    $r=SqlQuery("SELECT nId, cName from expositores order by nId,cName");
    while($l=$r->fetch(PDO::FETCH_ASSOC)){
        $list[$l['nId']]=intval($l['nId']).'-'.$l['cName'];
    }
    $msg['expositor_list']=$list;
    unset($list);
    $msg['nId_cliente']=''; //Cliente -- MUL.
    $r=SqlQuery("SELECT nId, cCompany from clientes where GrupoA='S' order by nID,cCompany");
    while($l=$r->fetch(PDO::FETCH_ASSOC)){
        $list[$l['nId']]=intval($l['nId']).'-'.$l['cCompany'];
    }
    $msg['cliente_list']=$list;
    unset($list);
    $msg['tHora']=''; //Horario -- .
    $msg['tHora_list']=getenumval('appointments','tHora');
    $msg['eDay']=''; //Dia -- .
    $msg['eDay_list']=getenumval('appointments','eDay');
    return $msg;
}

//ATUALIZA CADASTRO - DADOS DO ID ESPECIFICADO
function appointments_atualiza(){
    global $db;
    $_SESSION['view']='form';
    $msg['titulo']='Alterar appointments';
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $sql="SELECT * FROM appointments where nId=".$pr[':id']." limit 1";
    $r=SqlQuery($sql);
    $l = $r->fetch(PDO::FETCH_ASSOC);
    $msg['nId']=$l['nId']; //ID Appointment -- PRI.
    $msg['nId_expositor']=$l['nId_expositor']; //Expositor -- MUL.
    $msg['nId_cliente']=$l['nId_cliente']; //Cliente -- MUL.
    $msg['tHora']=$l['tHora']; //Horario -- .
    $msg['eDay']=$l['eDay']; //Dia -- .
    $msg['avaliacao']=$l['avaliacao']; //Avaliacao -- .
    return $msg;
}

//SALVA CADASTRO - FAZ O INSERT ou UPDATE CONFORME O ID
function appointments_salva(){
    global $db;
    $_SESSION['dados']['titulo']='Erro - Verifique Dados';
    $_SESSION['view']='list';
    $pr[':NID']=filter_input(INPUT_POST, 'nId', FILTER_SANITIZE_NUMBER_INT);
    $pr[':NID_EXPOSITOR']=filter_input(INPUT_POST, 'nId_expositor', FILTER_SANITIZE_NUMBER_INT);
    $pr[':NID_CLIENTE']=filter_input(INPUT_POST, 'nId_cliente', FILTER_SANITIZE_NUMBER_INT);
    $pr[':THORA']=filter_input(INPUT_POST, 'tHora', FILTER_UNSAFE_RAW,FILTER_DEFAULT);
    $pr[':EDAY']=filter_input(INPUT_POST, 'eDay', FILTER_UNSAFE_RAW,FILTER_DEFAULT);
    $pr[':AVALIACAO']='N.A';
    if(filter_var($_SESSION['route'][2])==0){
        // SE 0 INSERT
        $sql="INSERT into appointments (nId ,nId_expositor ,nId_cliente ,tHora ,eDay ,avaliacao) values ('', '".$pr[':NID_EXPOSITOR']."', '".$pr[':NID_CLIENTE']."', '".$pr[':THORA']."', '".$pr[':EDAY']."', '".$pr[':AVALIACAO']."')";
    } else {
        // SE >0 UPDATE
        $sql="UPDATE appointments set nId_expositor='".$pr[':NID_EXPOSITOR']."', nId_cliente='".$pr[':NID_CLIENTE']."', tHora='".$pr[':THORA']."', eDay='".$pr[':EDAY']."', avaliacao='".$pr[':AVALIACAO']."' where nId='".$pr[':NID']."' limit 1";
    }
    $r=SqlQuery($sql);
    $_SESSION['view']='list';
    $_SESSION['erro_no']=1;
    $_SESSION['erro']='<h3>SALVO COM SUCESSO</h3>appointments ID:'.$db->lastInsertId();
    return appointments_list();
}

//EXCLUI CADASTRO
function appointments_exclui(){
    global $db;
    $_SESSION['view']='list';
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $r=SqlQuery("select * from appointments where nId=".$pr[':id']." limit 1");
    if($r->rowCount()<>1){
        $_SESSION['erro_no']='2';
        $_SESSION['erro']='ERRO: Validação da Exclusão não Aceita';
        return appointments_list();
    } else {
        $r=SqlQuery("DELETE from appointments where nId=".$pr[':id']." limit 1");
        $_SESSION['erro_no']='1';
        $_SESSION['erro']='SUCESSO: Excluído Com Sucesso';
        return appointments_list();
    }
}

//MOSTRA 1 CADASTRO
function appointments_mostra(){
    global $db;
    $_SESSION['view']='print';
    $data['titulo']='Mostrar appointments';
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $r=SqlQuery("select appointments.nId, nId_cliente, nId_expositor, cName, cCompany, tHora, eDay, avaliacao from appointments, expositores, clientes where appointments.nId=".$pr[':id']." and expositores.nId=appointments.nId_expositor and clientes.nId=appointments.nId_cliente limit 1");
    if($r->rowCount()<>1){
        $_SESSION['erro_no']='2';
        $_SESSION['view']='list';
        $_SESSION['erro']='ERRO: CADASTRO NÃO LOCALIZADO';
        return appointments_list();
    } else {
        $data['registros']=$r->RowCount();
        $data['read']='SIM';
        while($l = $r->fetch(PDO::FETCH_ASSOC)) {
            $data['nId']=$l['nId']; //ID Appointment -- PRI.
            $data['nId_expo']=$l['nId_expositor'];
            $data['nId_cliente']=$l['nId_cliente'];
            $data['cName']=$l['cName']; //Expositor -- NOME
            $data['cCompany']=$l['cCompany']; //Cliente -- NOME
            $data['tHora']=$l['tHora']; //Horario -- .
            $data['eDay']=$l['eDay']; //Dia -- .
            $data['avaliacao']=$l['avaliacao']; //Avaliacao -- .

        }
        return $data;
    }
}
?>