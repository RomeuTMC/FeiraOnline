<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED'); 
logado('ADMIN');
$_SESSION['dados']=$_POST;
if(!isset($_SESSION['route'][1]) or $_SESSION['route'][1]=='list'){
    $_SESSION['dados']=paises_list();
} elseif($_SESSION['route'][1]=='novo'){
    $_SESSION['dados']=paises_novo();
} elseif($_SESSION['route'][1]=='atualiza'){
    $_SESSION['dados']=paises_atualiza();
} elseif($_SESSION['route'][1]=='save'){
    $_SESSION['dados']=paises_salva();
} elseif($_SESSION['route'][1]=='exclui'){
    $_SESSION['dados']=paises_exclui();
} elseif($_SESSION['route'][1]=='mostra'){
    $_SESSION['dados']=paises_mostra();
}else {
    // VIEW PADRÃO ou MOSTRA QUE NÃO EXISTE se for DEV
    if(AMBIENTE == 'DEVELOPER') {
        print_r($_SESSION['route']);
      } else {
        $_SESSION['dados']=paises_list();
      }
}

//LISTAGEM DA TABELA
function paises_list(){
    global $db;
    $_SESSION['view']='list';
    $data['titulo']="Cadastro de paises";
    $sql="SELECT count(cId) as Total FROM paises";
    $r=SqlQuery($sql);
    $l=$r->fetch(PDO::FETCH_ASSOC); 
    $data['total']=$l['Total'];
    $sql="SELECT cId, wNome ,cSigla ,cSiglaIso ,wEnglish  FROM paises ORDER BY cId";
    $r=SqlQuery($sql);
    $data['registros']=$r->RowCount();
    while($l = $r->fetch(PDO::FETCH_ASSOC)) {
        $data['listagem'][$l['cId']]=$l;
    }
    return $data;
}

//NOVO CADASTRO - DADOS EM BRANCO
function paises_novo(){
    global $db;
    $_SESSION['view']='form';
    $msg['titulo']='Incluir paises';
    $msg['cId']=0; //ID do Pais -- PRI.
    $msg['wNome']=''; //Nome em Português -- .
    $msg['wEnglish']=''; //Nome Internacional (inglês) -- .
    $msg['cBacen']=''; //ID pelo sistema BACEN (banco central brasileiro) -- UNI.
    $msg['cSigla']=''; //Sigla com 3 Letras, Padrão ISO -- UNI.
    $msg['cSiglaIso']=''; //Sigla -- UNI.
    $msg['cIdIso']=''; //Código Único Padrão ISO -- UNI.
    return $msg;
}

//ATUALIZA CADASTRO - DADOS DO ID ESPECIFICADO
function paises_atualiza(){
    global $db;
    $_SESSION['view']='form';
    $msg['titulo']='Alterar paises';
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $sql="SELECT * FROM paises where cId=".$pr[':id']." limit 1";
    $r=SqlQuery($sql);
    $l = $r->fetch(PDO::FETCH_ASSOC);
    $msg['cId']=$l['cId']; //ID do Pais -- PRI.
    $msg['wNome']=$l['wNome']; //Nome em Português -- .
    $msg['wEnglish']=$l['wEnglish']; //Nome Internacional (inglês) -- .
    $msg['cBacen']=$l['cBacen']; //ID pelo sistema BACEN (banco central brasileiro) -- UNI.
    $msg['cSigla']=$l['cSigla']; //Sigla com 3 Letras, Padrão ISO -- UNI.
    $msg['cSiglaIso']=$l['cSiglaIso']; //Sigla -- UNI.
    $msg['cIdIso']=$l['cIdIso']; //Código Único Padrão ISO -- UNI.
    return $msg;
}

//SALVA CADASTRO - FAZ O INSERT ou UPDATE CONFORME O ID
function paises_salva(){
    global $db;
    $_SESSION['dados']['titulo']='Erro - Verifique Dados';
    $_SESSION['view']='list';
    $pr[':CID']=filter_input(INPUT_POST, 'cId', FILTER_SANITIZE_NUMBER_INT);
    $pr[':WNOME']=filter_input(INPUT_POST, 'wNome', FILTER_SANITIZE_STRING);
    $pr[':WENGLISH']=filter_input(INPUT_POST, 'wEnglish', FILTER_SANITIZE_STRING);
    $pr[':CBACEN']=filter_input(INPUT_POST, 'cBacen', FILTER_SANITIZE_STRING);
    $pr[':CSIGLA']=filter_input(INPUT_POST, 'cSigla', FILTER_SANITIZE_STRING);
    $pr[':CSIGLAISO']=filter_input(INPUT_POST, 'cSiglaIso', FILTER_SANITIZE_STRING);
    $pr[':CIDISO']=filter_input(INPUT_POST, 'cIdIso', FILTER_SANITIZE_STRING);
    $r=SqlQuery("SELECT cBacen, cId from paises where cBacen='".$pr[':CBACEN']."' and cId<>'".$pr[':CID']."' limit 1");
    if($r->rowCount()>0){
        //se JÁ EXISTE wNome
        $_SESSION['view']='form';
        $_SESSION['erro_no']=2;
        $_SESSION['erro']='<h3>NÃO SALVO</h3>Já existe um paises com estes dados cadastrados, tente novamente - cBacen';
        return $_SESSION['dados'];
    }
    $r=SqlQuery("SELECT cSigla, cId from paises where cSigla='".$pr[':CSIGLA']."' and cId<>'".$pr[':CID']."' limit 1");
    if($r->rowCount()>0){
        //se JÁ EXISTE wNome
        $_SESSION['view']='form';
        $_SESSION['erro_no']=2;
        $_SESSION['erro']='<h3>NÃO SALVO</h3>Já existe um paises com estes dados cadastrados, tente novamente - cSigla';
        return $_SESSION['dados'];
    }
    $r=SqlQuery("SELECT cSiglaIso, cId from paises where cSiglaIso='".$pr[':CSIGLAISO']."' and cId<>'".$pr[':CID']."' limit 1");
    if($r->rowCount()>0){
        //se JÁ EXISTE wNome
        $_SESSION['view']='form';
        $_SESSION['erro_no']=2;
        $_SESSION['erro']='<h3>NÃO SALVO</h3>Já existe um paises com estes dados cadastrados, tente novamente - cSiglaIso';
        return $_SESSION['dados'];
    }
    $r=SqlQuery("SELECT cIdIso, cId from paises where cIdIso='".$pr[':CIDISO']."' and cId<>'".$pr[':CID']."' limit 1");
    if($r->rowCount()>0){
        //se JÁ EXISTE wNome
        $_SESSION['view']='form';
        $_SESSION['erro_no']=2;
        $_SESSION['erro']='<h3>NÃO SALVO</h3>Já existe um paises com estes dados cadastrados, tente novamente - cIdIso';
        return $_SESSION['dados'];
    }
    if(filter_var($_SESSION['route'][2])==0){
        // SE 0 INSERT
        $sql="INSERT into paises (cId ,wNome ,wEnglish ,cBacen ,cSigla ,cSiglaIso ,cIdIso) values ('', '".$pr[':WNOME']."', '".$pr[':WENGLISH']."', '".$pr[':CBACEN']."', '".$pr[':CSIGLA']."', '".$pr[':CSIGLAISO']."', '".$pr[':CIDISO']."')";
    } else {
        // SE >0 UPDATE
        $sql="UPDATE paises set wNome='".$pr[':WNOME']."', wEnglish='".$pr[':WENGLISH']."', cBacen='".$pr[':CBACEN']."', cSigla='".$pr[':CSIGLA']."', cSiglaIso='".$pr[':CSIGLAISO']."', cIdIso='".$pr[':CIDISO']."' where cId='".$pr[':CID']."' limit 1";
    }
    $r=SqlQuery($sql);
    $_SESSION['view']='list';
    $_SESSION['erro_no']=1;
    $_SESSION['erro']='<h3>SALVO COM SUCESSO</h3>paises ID:'.$db->lastInsertId();
    return paises_list();
}

//EXCLUI CADASTRO
function paises_exclui(){
    global $db;
    $_SESSION['view']='list';
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $r=SqlQuery("select * from paises where cId=".$pr[':id']." limit 1");
    if($r->rowCount()<>1){
        $_SESSION['erro_no']='2';
        $_SESSION['erro']='ERRO: Validação da Exclusão não Aceita';
        return paises_list();
    } else {
        $r=SqlQuery("DELETE from paises where cId=".$pr[':id']." limit 1");
        $_SESSION['erro_no']='1';
        $_SESSION['erro']='SUCESSO: Excluído Com Sucesso';
        return paises_list();
    }
}

//MOSTRA 1 CADASTRO
function paises_mostra(){
    global $db;
    $_SESSION['view']='form';
    $data['titulo']='Mostrar paises';
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $r=SqlQuery("select * from paises where cId=".$pr[':id']." limit 1");
    if($r->rowCount()<>1){
        $_SESSION['erro_no']='2';
        $_SESSION['view']='list';
        $_SESSION['erro']='ERRO: CADASTRO NÃO LOCALIZADO';
        return paises_list();
    } else {
        $data['registros']=$r->RowCount();
        $data['read']='SIM';
        while($l = $r->fetch(PDO::FETCH_ASSOC)) {
            $data['cId']=$l['cId']; //ID do Pais -- PRI.
            $data['wNome']=$l['wNome']; //Nome em Português -- .
            $data['wEnglish']=$l['wEnglish']; //Nome Internacional (inglês) -- .
            $data['cBacen']=$l['cBacen']; //ID pelo sistema BACEN (banco central brasileiro) -- UNI.
            $data['cSigla']=$l['cSigla']; //Sigla com 3 Letras, Padrão ISO -- UNI.
            $data['cSiglaIso']=$l['cSiglaIso']; //Sigla -- UNI.
            $data['cIdIso']=$l['cIdIso']; //Código Único Padrão ISO -- UNI.

        }
        return $data;
    }
}
?>