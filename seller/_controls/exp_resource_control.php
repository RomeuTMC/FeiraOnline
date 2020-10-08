<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED'); 
logado('SELLER');
$_SESSION['dados']=$_POST;
if(!isset($_SESSION['route'][1]) or $_SESSION['route'][1]=='list'){
    $_SESSION['dados']=exp_resouce_list();
} elseif($_SESSION['route'][1]=='novo'){
    $_SESSION['dados']=exp_resouce_novo();
} elseif($_SESSION['route'][1]=='atualiza'){
    $_SESSION['dados']=exp_resouce_atualiza();
} elseif($_SESSION['route'][1]=='save'){
    $_SESSION['dados']=exp_resouce_salva();
} elseif($_SESSION['route'][1]=='exclui'){
    $_SESSION['dados']=exp_resouce_exclui();
} elseif($_SESSION['route'][1]=='mostra'){
    $_SESSION['dados']=exp_resouce_mostra();
}else {
    // VIEW PADRÃO ou MOSTRA QUE NÃO EXISTE se for DEV
    if(AMBIENTE == 'DEVELOPER') {
        print_r($_SESSION['route']);
      } else {
        $_SESSION['dados']=exp_resouce_list();
      }
}

//LISTAGEM DA TABELA
function exp_resouce_list(){
    global $db;
    $_SESSION['view']='list';
    $data['titulo']="Resources for download";
    $sql="SELECT count(nId) as Total FROM exp_resouce where nId_expositor='".$_SESSION['sel_id']."'";
    $r=SqlQuery($sql);
    $l=$r->fetch(PDO::FETCH_ASSOC); 
    $data['total']=$l['Total'];
    $sql="SELECT nId, aFile, descricao, title FROM exp_resouce where nId_expositor='".$_SESSION['sel_id']."' ORDER BY nId";
    $r=SqlQuery($sql);
    $data['registros']=$r->RowCount();
    while($l = $r->fetch(PDO::FETCH_ASSOC)) {
        $data['listagem'][$l['nId']]=$l;
    }
    return $data;
}

//NOVO CADASTRO - DADOS EM BRANCO
function exp_resouce_novo(){
    global $db;
    $_SESSION['view']='form';
    $msg['titulo']="New resources for download";
    $msg['nId']=0; // -- PRI.
    $msg['nId_expositor']=$_SESSION['sel_id']; // -- ID DO EXPOSITOR
    $msg['aFile']=''; //Nome do Arquivo -- UNI.
    $msg['descricao']=''; //Describe Our Content File -- .
    $msg['title']=''; //Title or Name To Link File -- .
    return $msg;
}

//ATUALIZA CADASTRO - DADOS DO ID ESPECIFICADO
function exp_resouce_atualiza(){
    global $db;
    $_SESSION['view']='form';
    $msg['titulo']="Update resources for download";
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $sql="SELECT * FROM exp_resouce where nId=".$pr[':id']." limit 1";
    $r=SqlQuery($sql);
    $l = $r->fetch(PDO::FETCH_ASSOC);
    $msg['nId']=$l['nId']; // -- PRI.
    $msg['nId_expositor']=$l['nId_expositor']; // -- MUL.
    $msg['aFile']=$l['aFile']; //Nome do Arquivo -- UNI.
    $msg['descricao']=$l['descricao']; //Describe Our Content File -- .
    $msg['title']=$l['title']; //Title or Name To Link File -- .
    return $msg;
}

//SALVA CADASTRO - FAZ O INSERT ou UPDATE CONFORME O ID
function exp_resouce_salva(){
    global $db;
    $_SESSION['dados']['titulo']='Error - Verify Data';
    $_SESSION['view']='list';
    $pr[':NID']=filter_input(INPUT_POST, 'nId', FILTER_SANITIZE_NUMBER_INT);
    $pr[':NID_EXPOSITOR']=filter_input(INPUT_POST, 'nId_expositor', FILTER_SANITIZE_NUMBER_INT);
    $pr[':DESCRICAO']=filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING,FILTER_FLAG_ENCODE_HIGH);
    $pr[':TITLE']=filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING,FILTER_FLAG_ENCODE_HIGH);
    //TRATA O ARQ_NAME E SALVA
    $nm = md5(uniqid(rand(), true)); // gera ID único para os arquivos
    $pr[':AFILE']='';
    if(count($_FILES['aFile'])>0){
        $ft=$_FILES['aFile'];
    } else {
        $_SESSION['view']='list';
        $_SESSION['erro_no']='2';
        $_SESSION['erro']="File Resource must be compulsory";
        return exp_resouce_list();
    }
    $name=slug($ft['name']); //PATHINFO_EXTENSION 
    $ext=pathinfo($ft['name'],PATHINFO_EXTENSION);
    if(move_uploaded_file($ft['tmp_name'],"./../res/res-$nm-".$name.'.'.$ext)){
        $pr[':AFILE']="res/res-$nm-".$name.'.'.$ext;
    }
    if(filter_var($_SESSION['route'][2])==0){
        // SE 0 INSERT
        $sql="INSERT into exp_resouce (nId ,nId_expositor ,aFile ,descricao ,title) values ('', '".$pr[':NID_EXPOSITOR']."', '".$pr[':AFILE']."', '".$pr[':DESCRICAO']."', '".$pr[':TITLE']."')";
    } else {
        // SE >0 UPDATE
        $sql="UPDATE exp_resouce set nId_expositor='".$pr[':NID_EXPOSITOR']."', aFile='".$pr[':AFILE']."', descricao='".$pr[':DESCRICAO']."', title='".$pr[':TITLE']."' where nId='".$pr[':NID']."' limit 1";
    }
    $r=SqlQuery($sql);
    $_SESSION['view']='list';
    $_SESSION['erro_no']=1;
    $_SESSION['erro']='<h3>SALVO COM SUCESSO</h3>ID:'.$db->lastInsertId();
    return exp_resouce_list();
}

//EXCLUI CADASTRO
function exp_resouce_exclui(){
    global $db;
    $_SESSION['view']='list';
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $r=SqlQuery("select * from exp_resouce where nId=".$pr[':id']." limit 1");
    if($r->rowCount()<>1){
        $_SESSION['erro_no']='2';
        $_SESSION['erro']='ERRO: Validação da Exclusão não Aceita';
        return exp_resouce_list();
    } else {
        @unlink(_FS.$l['aFile']);
        $r=SqlQuery("DELETE from exp_resouce where nId=".$pr[':id']." limit 1");
        $_SESSION['erro_no']='1';
        $_SESSION['erro']='SUCESSO: Excluído Com Sucesso';
        return exp_resouce_list();
    }
}

//MOSTRA 1 CADASTRO
function exp_resouce_mostra(){
    global $db;
    $_SESSION['view']='form';
    $data['titulo']="Details from resource data";
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $r=SqlQuery("select * from exp_resouce where nId=".$pr[':id']." limit 1");
    if($r->rowCount()<>1){
        $_SESSION['erro_no']='2';
        $_SESSION['view']='list';
        $_SESSION['erro']='ERRO: CADASTRO NÃO LOCALIZADO';
        return exp_resouce_list();
    } else {
        $data['registros']=$r->RowCount();
        $data['read']='SIM';
        while($l = $r->fetch(PDO::FETCH_ASSOC)) {
            $data['nId']=$l['nId']; // -- PRI.
            $data['nId_expositor']=$l['nId_expositor']; // -- MUL.
            $data['aFile']=$l['aFile']; //Nome do Arquivo -- UNI.
            $data['descricao']=$l['descricao']; //Describe Our Content File -- .
            $data['title']=$l['title']; //Title or Name To Link File -- .

        }
        return $data;
    }
}
?>