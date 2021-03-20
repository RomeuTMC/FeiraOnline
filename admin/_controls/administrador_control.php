<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED'); 
logado('ADMIN');
$_SESSION['dados']=$_POST;
if(!isset($_SESSION['route'][1]) or $_SESSION['route'][1]=='list'){
    $_SESSION['dados']=administrador_list();
} elseif($_SESSION['route'][1]=='novo'){
    $_SESSION['dados']=administrador_novo();
} elseif($_SESSION['route'][1]=='atualiza'){
    $_SESSION['dados']=administrador_atualiza();
} elseif($_SESSION['route'][1]=='save'){
    $_SESSION['dados']=administrador_salva();
} elseif($_SESSION['route'][1]=='exclui'){
    $_SESSION['dados']=administrador_exclui();
} elseif($_SESSION['route'][1]=='acesso'){
    $_SESSION['dados']=administrador_acesso();
} elseif($_SESSION['route'][1]=='permissoes'){
    $_SESSION['dados']=administrador_permissoes();
}else {
    // VIEW PADRÃO ou MOSTRA QUE NÃO EXISTE se for DEV
    if(AMBIENTE == 'DEVELOPER') {
        print_r($_SESSION['route']);
      } else {
        $_SESSION['dados']=administrador_list();
      }
}

function administrador_list(){
    $_SESSION['view']='list';
    $sql="SELECT count(nId) as Total FROM administradores";
    $r=SqlQuery($sql);
    $l=$r->fetch(PDO::FETCH_ASSOC); 
    $data['total']=$l['Total'];
    $sql="SELECT nId, wNome, wLogin FROM administradores ORDER BY nId";
    $r=SqlQuery($sql);
    $data['registros']=$r->RowCount();
    while($l = $r->fetch(PDO::FETCH_ASSOC)) {
        $data['listagem'][$l['nId']]=$l;
    }
    return $data;
}

function administrador_novo(){
    $_SESSION['view']='form';
    $msg['titulo']='Incluir Administrador';
    $msg['nId']=0;
    $msg['wNome']='';
    $msg['wLogin']='';
    $msg['sSenha']='';
    return $msg;
}

function administrador_salva(){
    global $db;
    $_SESSION['view']='list';
    $_SESSION['dados']['titulo']='Administrador Erro - Verifique Dados';
    $pr[':id']=filter_input(INPUT_POST, 'nId', FILTER_SANITIZE_NUMBER_INT);
    $pr[':nome']=filter_input(INPUT_POST, 'wNome', FILTER_SANITIZE_STRING);
    $pr[':login']=filter_input(INPUT_POST, 'wLogin', FILTER_SANITIZE_EMAIL);
    $pr[':senha']=sha1(filter_input(INPUT_POST, 'sSenha', FILTER_SANITIZE_STRING));
    $pr[':senha']=password_hash($pr[':senha'],PASSWORD_DEFAULT);
    if($pr[':id']==1){
        $_SESSION['erro_no']=3;
        $_SESSION['erro']='<h3>ROOT</h3>Este Usuário não Pode ser Alterado!';
        return administrador_list();
    }
    if($_SESSION['route'][2]=='0'){
        //se 0 é INCLUI
        $r=SqlQuery("select nId from administradores where wNome='".$pr[':nome']."'");
        if($r->rowCount()>0){
            //se JÁ EXISTE wNome
            $_SESSION['view']='form';
            $_SESSION['erro_no']=2;
            $_SESSION['erro']='<h3>NÃO SALVO</h3>Já existe um usuário com este nome cadastrado, selecione outro e tente novamente';
            return $_SESSION['dados'];
        } else {
            $r=SqlQuery("select nId from administradores where wLogin='".$pr[':login']."'");
            if($r->rowCount()>0){
                //se JA EXISTE E-MAIL
                $_SESSION['view']='form';
                $_SESSION['erro_no']=2;
                $_SESSION['erro']='<h3>NÃO SALVO</h3>Já existe um usuário com este E-Mail cadastrado, selecione outro e tente novamente';
                return $_SESSION['dados'];    
            } else {
                //SE ESTA TUDO OK, SALVA NO BANCO
                unset($pr[':id']);
                $sql="INSERT INTO administradores (nId, wNome, wLogin, sSenha) VALUES ('',:nome,:login,:senha)";
                $r=SqlQuery($sql,$pr);
                $_SESSION['view']='list';
                $_SESSION['erro_no']=1;
                $_SESSION['erro']='<h3>SALVO COM SUCESSO</h3>Usuário criado com o ID:'.$db->lastInsertId();
                return administrador_list();
            }
        }
    } else {
         // é UPDATE ID=$route[2]
         //captura dados pelo ID
         $pr[':id']=filter_var($_SESSION['route'][2]);
         $r=SqlQuery("select * from administradores where nId='".$pr[':id']."' limit 1");  
         if($r->rowCount()==0){
             //SE não tem, abre novo cadastro
             $_SESSION['erro_no']='3';
             $_SESSION['erro']=='Administrador Não Cadastrado, faça novo cadastro!';
             return administrador_novo();
         } else {
            $l=$r->fetch(PDO::FETCH_ASSOC);
            if($pr[':login']==$l['wLogin']){
                $sql="update administradores set wNome='".$pr[':nome']."', sSenha=sha1('".$pr[':senha']."') where nId='".$pr[':id']."' limit 1";
                $r=SqlQuery($sql);
                $_SESSION['erro_no']=1;
                $_SESSION['erro']='Atualizado Com Sucesso!';
                return administrador_list();
            } else {
                $r=SqlQuery("select nId from administradores where wLogin='".$pr[':login']."' ");
                if($r->rowCount()>0){
                    //se JA EXISTE E-MAIL
                    $_SESSION['view']='form';
                    $_SESSION['erro_no']=2;
                    $_SESSION['erro']='<h3>NÃO SALVO</h3>Já existe um usuário com este E-Mail cadastrado!';
                    return $_SESSION['dados'];
                } else {
                    $sql="update administradores set wNome='".$pr[':nome']."', sSenha=sha1('".$pr[':senha']."'), wLogin='".$pr[':login']."' where nId='".$pr[':id']."' limit 1";
                    $r=SqlQuery($sql);
                    $_SESSION['erro_no']=1;
                    $_SESSION['erro']='Atualizado Com Sucesso!';
                    return administrador_list();
                }
            }
        } 
    }//endif ATUALIZA/NOVO
    return FALSE;    
}

function administrador_atualiza(){
    global $db;
    $_SESSION['view']='form';
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $msg['titulo']='Atualiza Administrador - ID:';
    $r=SqlQuery("select * from administradores where nId='".$pr[':id']."' limit 1");  
    if($r->rowCount()==0){
        $_SESSION['erro_no']=3;
        $_SESSION['erro']='Administrador Não Cadastrado, faça novo cadastro!';
        return administrador_novo();
    } else {
        $l=$r->fetch(PDO::FETCH_ASSOC);
        $msg['titulo']='Atualiza Administrador - ID:'.$l['nId'];
        $msg['nId']=$l['nId'];
        $msg['wNome']=$l['wNome'];
        $msg['wLogin']=$l['wLogin'];
        $msg['sSenha']='';
        return $msg;    
    }
}

function administrador_exclui(){
    global $db;
    $_SESSION['view']='list';
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $pr[':login']=filter_var($_SESSION['route'][3]);
    if($pr[':id']==1){
        $_SESSION['erro_no']='3';
        $_SESSION['erro']='<h3>ROOT</h3> Administrador Root Não Pode Ser Excluído ou alterado!';
        return administrador_list();
    }
    $r=SqlQuery("select * from administradores where nId='".$pr[':id']."' and wLogin='".$pr[':login']."' limit 1");
    if($r->rowCount()<>1){
        $_SESSION['erro_no']='2';
        $_SESSION['erro']='ERRO: Validação da Exclusão não Aceita';
        return administrador_list();
    } else {
        $r=SqlQuery("DELETE from administrador_permissoes where nId_administrador='".$pr[':id']."'");
        $r=SqlQuery("DELETE from administradores where nId='".$pr[':id']."' and wLogin='".$pr[':login']."' limit 1");
        $_SESSION['erro_no']='1';
        $_SESSION['erro']='SUCESSO: Administrador Excluído Com Sucesso';
        return administrador_list();
    }
}

function administrador_acesso(){
    global $db;
    $_SESSION['view']='acesso';
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $r1=SqlQuery("select nId, wNome from administradores where nId='".$pr[':id']."' limit 1");  
    $l1=$r1->fetch(PDO::FETCH_ASSOC);
    $menu['titulo']="Escolha as Permissões de: ID-".$l1['nId'].' - '.$l1['wNome'];
    $menu['nId_administrador']=$l1['nId'];
    $r=SqlQuery("select nId, wMenu from adm_menu order by wMenu");
   $itens=null;
   while($l=$r->fetch(PDO::FETCH_ASSOC)){
       $r2=SqlQuery("select nId, nId_menu, wItem, wDescricao, uUrl from adm_item as i where i.nId_menu='".$l['nId']."' order by wItem");
       if($r2->rowCount()>0){
            $i=0;
            while($l2=$r2->fetch(PDO::FETCH_ASSOC)){
                $itens[$i]['id']=$l2['nId'];
                $itens[$i]['item']=$l2['wItem'];
                $itens[$i]['endpoint']=$l2['uUrl'];
                $itens[$i]['desc']=$l2['wDescricao'];
                $i++;
           }
           $menu['menu'][$l['wMenu']]=$itens;
           unset($itens);
        }
   }
   return $menu;
}

function administrador_permissoes(){
    $pr[':id_adm']=filter_input(INPUT_POST, 'nId_administrador', FILTER_SANITIZE_NUMBER_INT);
    $ar[':ids']=filter_var_array($_POST['nId_item'], FILTER_SANITIZE_NUMBER_INT);
    $pr[':ids']=$ar;
    $pr[':id']=filter_var($_SESSION['route'][2]);
    if($pr[':id_adm']==1){
        $_SESSION['erro_no']='3';
        $_SESSION['erro']='<h3>ROOT</h3> Administrador Root Não Pode Ser Excluído ou alterado!';
        return administrador_list();
    }
    if($pr[':id_adm']<>$pr[':id']){
        $_SESSION['erro_no']='2';
        $_SESSION['erro']='ERRO: Validação da Exclusão não Aceita';
        return administrador_list();
    }
    $r=SqlQuery("select nId, wNome from administradores where nId='".$pr[':id_adm']."' limit 1");
    if($r->rowCount()<1){
        $_SESSION['erro_no']='2';
        $_SESSION['erro']='Administrador Inválido Para Receber Novas Permissões de Acesso';
        return administrador_list();
    }
    $r=SqlQuery("DELETE from administrador_permissoes where nId_administrador='".$pr[':id_adm']."'");
    $ids=($pr[':ids'][':ids']);
    foreach ($pr[':ids'][':ids'] as $k => $v) {
        $r=SqlQuery("INSERT into administrador_permissoes (nId, nId_administrador, nId_item) values ('','".$pr[':id_adm']."', '".$v."')");
    }
    $_SESSION['erro_no']='1';
    $_SESSION['erro']='Permissões Salvas com Sucesso!';
    return administrador_list();
}
?>