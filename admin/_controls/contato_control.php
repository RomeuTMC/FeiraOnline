<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED'); 
logado('ADMIN');
$_SESSION['dados']=$_POST;
if(!isset($_SESSION['route'][1]) or $_SESSION['route'][1]=='list'){
    $_SESSION['dados']=contato_list();
} elseif($_SESSION['route'][1]=='novo'){
    $_SESSION['dados']=contato_novo();
} elseif($_SESSION['route'][1]=='atualiza'){
    $_SESSION['dados']=contato_atualiza();
} elseif($_SESSION['route'][1]=='save'){
    $_SESSION['dados']=contato_salva();
} elseif($_SESSION['route'][1]=='exclui'){
    $_SESSION['dados']=contato_exclui();
} elseif($_SESSION['route'][1]=='mostra'){
    $_SESSION['dados']=contato_mostra();
}else {
    // VIEW PADRÃO ou MOSTRA QUE NÃO EXISTE se for DEV
    if(AMBIENTE == 'DEVELOPER') {
        print_r($_SESSION['route']);
      } else {
        $_SESSION['dados']=contato_list();
      }
}

//LISTAGEM DA TABELA
function contato_list(){
    global $db;
    $_SESSION['view']='list';
    $data['titulo']="Cadastro de contato";
    $sql="SELECT count(nId) as Total FROM contato";
    $r=SqlQuery($sql);
    $l=$r->fetch(PDO::FETCH_ASSOC); 
    $data['total']=$l['Total'];
    $sql="SELECT nId,cName,cEmail,cTel,tMensagem FROM contato ORDER BY nId";
    $r=SqlQuery($sql);
    $data['registros']=$r->RowCount();
    while($l = $r->fetch(PDO::FETCH_ASSOC)) {
        $data['listagem'][$l['nId']]=$l;
    }
    return $data;
}

//NOVO CADASTRO - DADOS EM BRANCO
function contato_novo(){
    global $db;
    $_SESSION['view']='form';
    $msg['titulo']='Incluir contato';
    $msg['nId']=0; //Identificador -- PRI.
    $msg['cEmail']=''; //E-Mail -- .
    $msg['cName']=''; //Nome -- .
    $msg['cTel']=''; //Telefone -- .
    $msg['tMensagem']=''; //Mensagem -- .
    return $msg;
}

//ATUALIZA CADASTRO - DADOS DO ID ESPECIFICADO
function contato_atualiza(){
    global $db;
    $_SESSION['view']='form';
    $msg['titulo']='Alterar contato';
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $sql="SELECT * FROM contato where nId=".$pr[':id']." limit 1";
    $r=SqlQuery($sql);
    $l = $r->fetch(PDO::FETCH_ASSOC);
    $msg['nId']=$l['nId']; //Identificador -- PRI.
    $msg['cEmail']=$l['cEmail']; //E-Mail -- .
    $msg['cName']=$l['cName']; //Nome -- .
    $msg['cTel']=$l['cTel']; //Telefone -- .
    $msg['tMensagem']=$l['tMensagem']; //Mensagem -- .
    return $msg;
}

//SALVA CADASTRO - FAZ O INSERT ou UPDATE CONFORME O ID
function contato_salva(){
    global $db;
    $_SESSION['dados']['titulo']='Erro - Verifique Dados';
    $_SESSION['view']='list';
    $pr[':NID']=filter_input(INPUT_POST, 'nId', FILTER_SANITIZE_NUMBER_INT);
    $pr[':CEMAIL']=filter_input(INPUT_POST, 'cEmail', FILTER_SANITIZE_STRING);
    $pr[':CNAME']=filter_input(INPUT_POST, 'cName', FILTER_SANITIZE_STRING);
    $pr[':CTEL']=filter_input(INPUT_POST, 'cTel', FILTER_SANITIZE_STRING);
    $pr[':TMENSAGEM']=filter_input(INPUT_POST, 'tMensagem', FILTER_SANITIZE_STRING);
    if(filter_var($_SESSION['route'][2])==0){
        // SE 0 INSERT
        $sql="INSERT into contato (nId ,cEmail ,cName ,cTel ,tMensagem) values ('', '".$pr[':CEMAIL']."', '".$pr[':CNAME']."', '".$pr[':CTEL']."', '".$pr[':TMENSAGEM']."')";
    } else {
        // SE >0 UPDATE
        $sql="UPDATE contato set cEmail='".$pr[':CEMAIL']."', cName='".$pr[':CNAME']."', cTel='".$pr[':CTEL']."', tMensagem='".$pr[':TMENSAGEM']."' where nId='".$pr[':NID']."' limit 1";
    }
    $r=SqlQuery($sql);
    $_SESSION['view']='list';
    $_SESSION['erro_no']=1;
    $_SESSION['erro']='<h3>SALVO COM SUCESSO</h3>contato ID:'.$db->lastInsertId();
    return contato_list();
}

//EXCLUI CADASTRO
function contato_exclui(){
    global $db;
    $_SESSION['view']='list';
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $r=SqlQuery("select * from contato where nId=".$pr[':id']." limit 1");
    if($r->rowCount()<>1){
        $_SESSION['erro_no']='2';
        $_SESSION['erro']='ERRO: Validação da Exclusão não Aceita';
        return contato_list();
    } else {
        $r=SqlQuery("DELETE from contato where nId=".$pr[':id']." limit 1");
        $_SESSION['erro_no']='1';
        $_SESSION['erro']='SUCESSO: Excluído Com Sucesso';
        return contato_list();
    }
}

//MOSTRA 1 CADASTRO
function contato_mostra(){
    global $db;
    $_SESSION['view']='print';
    $data['titulo']='Mostrar contato';
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $r=SqlQuery("select * from contato where nId=".$pr[':id']." limit 1");
    if($r->rowCount()<>1){
        $_SESSION['erro_no']='2';
        $_SESSION['view']='list';
        $_SESSION['erro']='ERRO: CADASTRO NÃO LOCALIZADO';
        return contato_list();
    } else {
        $data['registros']=$r->RowCount();
        $data['read']='SIM';
        while($l = $r->fetch(PDO::FETCH_ASSOC)) {
            $data['nId']=$l['nId']; //Identificador -- PRI.
            $data['cEmail']=$l['cEmail']; //E-Mail -- .
            $data['cName']=$l['cName']; //Nome -- .
            $data['cTel']=$l['cTel']; //Telefone -- .
            $data['tMensagem']=$l['tMensagem']; //Mensagem -- .

        }
        return $data;
    }
}
?>