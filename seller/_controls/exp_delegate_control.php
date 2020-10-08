<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED'); 
logado('SELLER');
$_SESSION['dados']=$_POST;
if(!isset($_SESSION['route'][1]) or $_SESSION['route'][1]=='list'){
    $_SESSION['dados']=exp_delegate_list();
} elseif($_SESSION['route'][1]=='novo'){
    $_SESSION['dados']=exp_delegate_novo();
} elseif($_SESSION['route'][1]=='atualiza'){
    $_SESSION['dados']=exp_delegate_atualiza();
} elseif($_SESSION['route'][1]=='save'){
    $_SESSION['dados']=exp_delegate_salva();
} elseif($_SESSION['route'][1]=='exclui'){
    $_SESSION['dados']=exp_delegate_exclui();
} elseif($_SESSION['route'][1]=='mostra'){
    $_SESSION['dados']=exp_delegate_mostra();
}else {
    // VIEW PADRÃO ou MOSTRA QUE NÃO EXISTE se for DEV
    if(AMBIENTE == 'DEVELOPER') {
        print_r($_SESSION['route']);
      } else {
        $_SESSION['dados']=exp_delegate_list();
      }
}

//LISTAGEM DA TABELA
function exp_delegate_list(){
    global $db;
    $_SESSION['view']='list';
    $data['titulo']="Company Delegates Information";
    $pr[':id']=$_SESSION['sel_id'];
    $sql="SELECT count(nId) as Total FROM exp_delegate WHERE nId_expositor='".$pr[':id']."' ORDER BY nId";
    $r=SqlQuery($sql);
    $l=$r->fetch(PDO::FETCH_ASSOC); 
    $data['total']=$l['Total'];
    $sql="SELECT nId, cNome, cEmail, cPhone, fPhoto FROM exp_delegate WHERE nId_expositor='".$pr[':id']."' ORDER BY nId";
    $r=SqlQuery($sql);
    $data['registros']=$r->RowCount();
    while($l = $r->fetch(PDO::FETCH_ASSOC)) {
        $data['listagem'][$l['nId']]=$l;
    }
    return $data;
}

//NOVO CADASTRO - DADOS EM BRANCO
function exp_delegate_novo(){
    global $db;
    $_SESSION['view']='form';
    $msg['titulo']="New Delegate from Company";
    $msg['nId']=0; //ID -- PRI.
    $msg['nId_expositor']=''; //ID xpositor -- .
    $msg['cNome']=''; //Complete Name -- .
    $msg['cEmail']=''; //Mail for login -- .
    $msg['sPassw']=''; //Password -- .
    $msg['cPhone']=''; //Personal Phone -- .
    $msg['eAdm']=''; // -- .
    $msg['fPhoto']=''; // -- .
    $msg['eAdm_list']=array('S'=>'Yes','N'=>'No');
    return $msg;
}

//ATUALIZA CADASTRO - DADOS DO ID ESPECIFICADO
function exp_delegate_atualiza(){
    global $db;
    $_SESSION['view']='form';
    $msg['titulo']="Update Delegate";
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $sql="SELECT * FROM exp_delegate where nId=".$pr[':id']." limit 1";
    $r=SqlQuery($sql);
    $l = $r->fetch(PDO::FETCH_ASSOC);
    $msg['nId']=$l['nId']; //ID -- PRI.
    $msg['nId_expositor']=$l['nId_expositor']; //ID xpositor -- .
    $msg['cNome']=$l['cNome']; //Complete Name -- .
    $msg['cEmail']=$l['cEmail']; //Mail for login -- .
    $msg['sPassw']=$l['sPassw']; //Password -- .
    $msg['cPhone']=$l['cPhone']; //Personal Phone -- .
    $msg['eAdm']=$l['eAdm']; // -- .
    return $msg;
}

//SALVA CADASTRO - FAZ O INSERT ou UPDATE CONFORME O ID
function exp_delegate_salva(){
    global $db;
    $_SESSION['dados']['titulo']='Erro - Verifique Dados';
    $_SESSION['view']='list';
    $pr[':NID']=filter_input(INPUT_POST, 'nId', FILTER_SANITIZE_NUMBER_INT);
    $pr[':NID_EXPOSITOR']=filter_input(INPUT_POST, 'nId_expositor', FILTER_SANITIZE_NUMBER_INT);
    $pr[':CNOME']=filter_input(INPUT_POST, 'cNome', FILTER_SANITIZE_STRING);
    $pr[':CEMAIL']=filter_input(INPUT_POST, 'cEmail', FILTER_SANITIZE_STRING);
    $pr[':SPASSW']=filter_input(INPUT_POST, 'sPassw', FILTER_SANITIZE_STRING);
    $pr[':SPASSW']=password_hash(sha1($pr[':SPASSW']), PASSWORD_DEFAULT);
    $pr[':CPHONE']=filter_input(INPUT_POST, 'cPhone', FILTER_SANITIZE_STRING);
    $pr[':EADM']=filter_input(INPUT_POST, 'eAdm', FILTER_UNSAFE_RAW,FILTER_DEFAULT);
    $r=SqlQuery("SELECT cEmail, nId from exp_delegate where cEmail='".$pr[':CEMAIL']."' and nId<>'".$pr[':NID']."' limit 1");
    if($r->rowCount()>0){
        //se JÁ EXISTE wNome
        $_SESSION['view']='list';
        $_SESSION['erro_no']=2;
        $_SESSION['erro']='<h3>ERROR</h3>This Email already registered';
        return exp_delegate_list();
    }
    $nm = md5(uniqid(rand(), true));
    if(count($_FILES['fPhoto'])>0){
        $ft=$_FILES['fPhoto'];
    } else {
        $_SESSION['view']='list';
        $_SESSION['erro_no']='2';
        $_SESSION['erro']="LOGO Image must be compulsory";
        return exp_delegate_list();
    }
    $nm = md5(uniqid(rand(), true)); // gera ID único para as imagens
    $name=slug($ft['name']);
    if(move_uploaded_file($ft['tmp_name'],"./../img/exp-dele/dele-$nm-".$name)){
        $pr[':FPHOTO']="img/exp-dele/dele-$nm-".$name;
    }
    if(filter_var($_SESSION['route'][2])==0){
        // SE 0 INSERT
        $sql="INSERT into exp_delegate (nId ,nId_expositor ,cNome ,cEmail ,sPassw ,cPhone ,eAdm ,fPhoto) values ('', '".$pr[':NID_EXPOSITOR']."', '".$pr[':CNOME']."', '".$pr[':CEMAIL']."', '".$pr[':SPASSW']."', '".$pr[':CPHONE']."', '".$pr[':EADM']."', '".$pr[':FPHOTO']."')";
    } else {
        // SE >0 UPDATE
        $sql="UPDATE exp_delegate set nId_expositor='".$pr[':NID_EXPOSITOR']."', cNome='".$pr[':CNOME']."', cEmail='".$pr[':CEMAIL']."', sPassw='".$pr[':SPASSW']."', cPhone='".$pr[':CPHONE']."', eAdm='".$pr[':EADM']."' where nId='".$pr[':NID']."' limit 1";
    }
    $r=SqlQuery($sql);
    $_SESSION['view']='list';
    $_SESSION['erro_no']=1;
    $_SESSION['erro']='<h3>SALVO COM SUCESSO</h3>';
    return exp_delegate_list();
}

//EXCLUI CADASTRO
function exp_delegate_exclui(){
    global $db;
    $_SESSION['view']='list';
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $r=SqlQuery("SELECT count(nId) as delegates from exp_delegate where nId_expositor='".$_SESSION['sel_id']."'");
    $l=$r->fetch(PDO::FETCH_ASSOC);
    if($l['delegates']==1){
        $_SESSION['view']='list';
        $_SESSION['erro_no']='2';
        $_SESSION['erro']='ERROR: It is mandatory that at least 1 delegate is registered to log in to the system.';
        return exp_delegate_list();
    }
    $r=SqlQuery("select * from exp_delegate where nId=".$pr[':id']." limit 1");
    if($r->rowCount()<>1){
        $_SESSION['erro_no']='2';
        $_SESSION['erro']='ERRO: Validação da Exclusão não Aceita';
        return exp_delegate_list();
    } else {
        $l=$l=$r->fetch(PDO::FETCH_ASSOC);
        @unlink(_FS.$l['fPhoto']);
        $r=SqlQuery("DELETE from exp_delegate where nId=".$pr[':id']." limit 1");
        $_SESSION['erro_no']='1';
        $_SESSION['erro']='SUCESSO: Excluído Com Sucesso';
        return exp_delegate_list();
    }
}

//MOSTRA 1 CADASTRO
function exp_delegate_mostra(){
    global $db;
    $_SESSION['view']='print';
    $data['titulo']="Details from Delegate";
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $r=SqlQuery("select * from exp_delegate where nId=".$pr[':id']." limit 1");
    if($r->rowCount()<>1){
        $_SESSION['erro_no']='2';
        $_SESSION['view']='list';
        $_SESSION['erro']='ERRO: CADASTRO NÃO LOCALIZADO';
        return exp_delegate_list();
    } else {
        $data['registros']=$r->RowCount();
        $data['read']='SIM';
        while($l = $r->fetch(PDO::FETCH_ASSOC)) {
            $data['nId']=$l['nId']; //ID -- PRI.
            $data['nId_expositor']=$l['nId_expositor']; //ID xpositor -- .
            $data['cNome']=$l['cNome']; //Complete Name -- .
            $data['cEmail']=$l['cEmail']; //Mail for login -- .
            $data['sPassw']=$l['sPassw']; //Password -- .
            $data['cPhone']=$l['cPhone']; //Personal Phone -- .
            $data['eAdm']=$l['eAdm']; // -- .
            $data['fPhoto']=$l['fPhoto']; // -- .

        }
        return $data;
    }
}
?>