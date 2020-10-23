<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
if($_SESSION['route'][1]<>'login'){
  //se foi chamado padrão
  $_SESSION['erro_no']=0;
  $_SESSION['erro']='PRIMEIRO ACESSO DO USUÁRIO';
  $_SESSION['control']='main';
  $_SESSION['view']='list';
} else {
    //se foi chamado o login, verifica se veio os campos
    if(!isset($_POST['login']) or !isset($_POST['senha'])) {
        //se NÃO VEIO O LOGIN, o VIEW é mantido
        $_SESSION['erro_no']=2;
        $_SESSION['erro']='E-MAIL e SENHA devem ser preenchidos';
        $_SESSION['login']='FALSE-logincontrol';
        $_SESSION['control']='main';
        $_SESSION['view']='list';
    } else {
        //se veio os dados, puxa os dados pelo login do banco de dados
        $sql='SELECT nId, wNome, wLogin, sSenha FROM administradores WHERE wLogin= :user limit 1';
        $pr[':user']=filter_input(INPUT_POST, 'login', FILTER_SANITIZE_EMAIL);
        $pass_recebido=sha1(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING));
        unset($_POST['login']);
        unset($_POST['senha']);
        $r=SqlQuery($sql,$pr);
        $l=$r->fetch(PDO::FETCH_ASSOC);
        if($r->rowCount()<1){
            $_SESSION['erro_no']=2;
            $_SESSION['erro']='ERRO NO LOGIN - USUÁRIO NÃO CADASTRADO';
            $_SESSION['control']='main';
            $_SESSION['login']='FALSE-USUARIO';
            $_SESSION['view']='list';        
        } else {
            //se não tem usuário
            if (!password_verify($pass_recebido,$l['sSenha'])) {
                // se localizou o usuário, e senha é inválida
                $_SESSION['erro_no']=2;
                $_SESSION['erro']='ERRO NO LOGIN - USUÁRIO OU SENHA INVÁLIDOS';
                $_SESSION['login']='FALSE-SENHAERRO';
                $_SESSION['control']='main';
                $_SESSION['view']='list';        
            } else {
                // se possui resultado, e senha é válida
                $_SESSION['control']='dashboard';
                $_SESSION['view']='list';    
                $_SESSION['erro_no']=1;
                $_SESSION['erro']='USUÁRIO LOGADO COM SUCESSO';
                $_SESSION['login']='ADMIN'; //DIGITE O NOME DO PERFIL DE USUÁRIO
                $_SESSION['adm_nome']=$l['wNome'];
                $_SESSION['adm_email']=$l['wLogin'];
                $_SESSION['adm_id']=$l['nId'];
                $_SESSION['menu']=monta_menu($l['nId']);
                header("Location:".URL."admin/dashboard");
            }//fim do password_verify()
        } //fim do EXISTE LOGIN
    } //fim do isset() dados para login
} // fim do (route<>login)

function monta_menu($adm=1){
    if($adm<=1){ //se for o ROOT ou quiser pegar TODOS OS MENUS
         $sql="select wMenu, nId from adm_menu order by wMenu";
         $pr[0]=0;
    } else {
         $sql="select wMenu, m.nId from adm_menu as m,adm_item as i,administrador_permissoes as p 
         where m.nId=i.nId_menu and p.nId_administrador=:adm group by m.nId order by m.wMenu";
         $pr[':adm']=$adm;
    }
    $r=SqlQuery($sql,$pr);
    unset($pr);
    $itens=null;
    while($l = $r->fetch(PDO::FETCH_ASSOC)){
        if($adm<=1){ //se for o ROOT ou quiser pegar TODOS OS MENUS
             $sql="select i.nId,i.wItem,i.uUrl,i.wDescricao from adm_item as i where i.nId_menu=:menu order by wItem";
             $pr[':menu']=$l['nId'];
        } else {
             $sql="select i.nId,i.wItem,i.uUrl,i.wDescricao from adm_item as i,administrador_permissoes as p where i.nId_menu=:menu and p.nId_administrador=:adm and i.nId=p.nId_item group by i.nId order by i.wItem";
             $pr[':menu']=$l['nId'];
             $pr[':adm']=$adm;
        }
        $s=SqlQuery($sql,$pr);
        unset($pr);
        if($s->rowCount() >0){
           $i=0;
           while($l2 = $s->fetch(PDO::FETCH_ASSOC)){
                $itens[$i]['id']=$l2['nId'];
                $itens[$i]['item']=$l2['wItem'];
                $itens[$i]['endpoint']=$l2['uUrl'];
                $itens[$i]['desc']=$l2['wDescricao'];
                $i++;
           }
           $menu[$l['wMenu']]=$itens;
           unset($itens);
        }
    }
    return $menu;
}
?>