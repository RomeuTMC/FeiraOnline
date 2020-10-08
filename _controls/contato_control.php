<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED'); 
$_SESSION['dados']=$_POST;
if(!isset($_SESSION['route'][1]) or $_SESSION['route'][1]=='list'){
    $_SESSION['dados']=contato_novo();
} elseif($_SESSION['route'][1]=='novo'){
    $_SESSION['dados']=contato_novo();
} elseif($_SESSION['route'][1]=='save'){
    $_SESSION['dados']=contato_salva();
} else {
    // VIEW PADRÃƒO ou MOSTRA QUE NÃƒO EXISTE se for DEV
    if(AMBIENTE == 'DEVELOPER') {
        print_r($_SESSION['route']);
      } else {
        $_SESSION['dados']=contato_novo();
      }
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

//SALVA CADASTRO - FAZ O INSERT ou UPDATE CONFORME O ID
function contato_salva(){
    global $db;
    $_SESSION['dados']['titulo']='Erro - Verifique Dados';
    $_SESSION['view']='list';
    $redir=filter_input(INPUT_POST, 'redirect', FILTER_VALIDATE_URL);
    if($redir==''){
        $redir=URL;
    }
    $pr[':NID']=filter_input(INPUT_POST, 'nId', FILTER_SANITIZE_NUMBER_INT);
    $pr[':CEMAIL']=filter_input(INPUT_POST, 'cEmail', FILTER_SANITIZE_STRING);
    $pr[':CNAME']=filter_input(INPUT_POST, 'cName', FILTER_SANITIZE_STRING);
    $pr[':CTEL']=filter_input(INPUT_POST, 'cTel', FILTER_SANITIZE_STRING);
    $pr[':TMENSAGEM']=filter_input(INPUT_POST, 'tMensagem', FILTER_SANITIZE_STRING);
    if($pr[':TMENSAGEM']=='' or $pr[':CEMAIL']=='' or $pr[':CNAME']==''){
        $_SESSION['erro_no']=2;
        $_SESSION['erro']='ERROR: Your NAME, MESSAGE and EMAIL must be completed.';
        header("Location:$redir?erro=".$_SESSION['erro'].'&erro_no='.$_SESSION['erro_no']);
        return contato_novo();
    }
    if(filter_var($_SESSION['route'][2])==0){
        // SE 0 INSERT
        $sql="INSERT into contato (nId ,cEmail ,cName ,cTel ,tMensagem) values ('', '".$pr[':CEMAIL']."', '".$pr[':CNAME']."', '".$pr[':CTEL']."', '".$pr[':TMENSAGEM']."')";
        $msg=array(
            'Nome'=>$pr[':CNAME'],
            'Email'=>$pr[':CEMAIL'],
            'Telefone'=>$pr[':CTEL'],
            'Mensagem'=>$pr[':TMENSAGEM']
        );
        eMailMsg($pr[':CEMAIL'],'tatbr@capitalmarketing.com.br','Contato thailatintrademeet.com',$msg);
        eMailMsg($pr[':CEMAIL'],'romeu.tmccomunicacao@gmail.com','Contato thailatintrademeet.com',$msg);
    } else {
        // SE >0 UPDATE
        $sql="UPDATE contato set cEmail='".$pr[':CEMAIL']."', cName='".$pr[':CNAME']."', cTel='".$pr[':CTEL']."', tMensagem='".$pr[':TMENSAGEM']."' where nId='".$pr[':NID']."' limit 1";
    }
    $r=SqlQuery($sql);
    $_SESSION['erro_no']=1;
    $_SESSION['erro']='Your contact has been sent, we will reply as soon as possible';
    header("Location:$redir?erro=".$_SESSION['erro'].'&erro_no='.$_SESSION['erro_no']);
    return contato_novo();
}

?>