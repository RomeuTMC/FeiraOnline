<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED'); 
logado('SELLER');
$_SESSION['dados']=$_POST;
if(!isset($_SESSION['route'][1]) or $_SESSION['route'][1]=='list'){
    $_SESSION['dados']=exp_videos_list();
} elseif($_SESSION['route'][1]=='novo'){
    $_SESSION['dados']=exp_videos_novo();
} elseif($_SESSION['route'][1]=='atualiza'){
    $_SESSION['dados']=exp_videos_atualiza();
} elseif($_SESSION['route'][1]=='save'){
    $_SESSION['dados']=exp_videos_salva();
} elseif($_SESSION['route'][1]=='exclui'){
    $_SESSION['dados']=exp_videos_exclui();
} elseif($_SESSION['route'][1]=='mostra'){
    $_SESSION['dados']=exp_videos_mostra();
}else {
    // VIEW PADRÃO ou MOSTRA QUE NÃO EXISTE se for DEV
    if(AMBIENTE == 'DEVELOPER') {
        print_r($_SESSION['route']);
      } else {
        $_SESSION['dados']=exp_videos_list();
      }
}

//LISTAGEM DA TABELA
function exp_videos_list(){
    global $db;
    $_SESSION['view']='list';
    $data['titulo']="Video resource from products";
    $sql="SELECT count(nId) as Total FROM exp_videos where nId_expositor='".$_SESSION['sel_id']."'";
    $r=SqlQuery($sql);
    $l=$r->fetch(PDO::FETCH_ASSOC); 
    $data['total']=$l['Total'];
    $sql="SELECT nId,aFile FROM exp_videos where nId_expositor='".$_SESSION['sel_id']."' ORDER BY nId";
    $r=SqlQuery($sql);
    $data['registros']=$r->RowCount();
    while($l = $r->fetch(PDO::FETCH_ASSOC)) {
        $data['listagem'][$l['nId']]=$l;
    }
    return $data;
}

//NOVO CADASTRO - DADOS EM BRANCO
function exp_videos_novo(){
    global $db;
    $_SESSION['view']='form';
    $msg['titulo']='New video resources';
    $msg['nId']=0; // -- PRI.
    $msg['nId_expositor']=$_SESSION['sel_id']; // ID DO EXPOSITOR
    $msg['aFile']=''; //Nome do Arquivo -- UNI.
    return $msg;
}

//SALVA CADASTRO - FAZ O INSERT ou UPDATE CONFORME O ID
function exp_videos_salva(){
    global $db;
    $_SESSION['dados']['titulo']='Error - Verify Data';
    $_SESSION['view']='list';
    $pr[':NID']=filter_input(INPUT_POST, 'nId', FILTER_SANITIZE_NUMBER_INT);
    $pr[':NID_EXPOSITOR']=filter_input(INPUT_POST, 'nId_expositor', FILTER_SANITIZE_NUMBER_INT);
    $pr[':AFILE']=filter_input(INPUT_POST, 'aFile', FILTER_SANITIZE_STRING,FILTER_FLAG_ENCODE_HIGH);
    if(strlen($pr[':AFILE'])>11){
        $pr[':AFILE']=substr($pr[':AFILE'],-11);
    }
    $r=SqlQuery("SELECT aFile, nId from exp_videos where aFile='".$pr[':AFILE']."' and nId<>'".$pr[':NID']."' limit 1");
    if($r->rowCount()>0){
        //se JÁ EXISTE wNome
        $_SESSION['view']='form';
        $_SESSION['erro_no']=2;
        $_SESSION['erro']='<h3>NÃO SALVO</h3>Já existe um exp_videos com estes dados cadastrados, tente novamente - aFile';
        return $_SESSION['dados'];
    }
    if(filter_var($_SESSION['route'][2])==0){
        // SE 0 INSERT
        $sql="INSERT into exp_videos (nId ,nId_expositor ,aFile) values ('', '".$pr[':NID_EXPOSITOR']."', '".$pr[':AFILE']."')";
    } else {
        // SE >0 UPDATE
        $sql="UPDATE exp_videos set nId_expositor='".$pr[':NID_EXPOSITOR']."', aFile='".$pr[':AFILE']."' where nId='".$pr[':NID']."' limit 1";
    }
    $r=SqlQuery($sql);
    $_SESSION['view']='list';
    $_SESSION['erro_no']=1;
    $_SESSION['erro']='<h3>SALVO COM SUCESSO</h3>exp_videos ID:'.$db->lastInsertId();
    return exp_videos_list();
}

//EXCLUI CADASTRO
function exp_videos_exclui(){
    global $db;
    $_SESSION['view']='list';
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $r=SqlQuery("select * from exp_videos where nId=".$pr[':id']." limit 1");
    if($r->rowCount()<>1){
        $_SESSION['erro_no']='2';
        $_SESSION['erro']='ERRO: Validação da Exclusão não Aceita';
        return exp_videos_list();
    } else {
        $r=SqlQuery("DELETE from exp_videos where nId=".$pr[':id']." limit 1");
        $_SESSION['erro_no']='1';
        $_SESSION['erro']='SUCESSO: Excluído Com Sucesso';
        return exp_videos_list();
    }
}
?>