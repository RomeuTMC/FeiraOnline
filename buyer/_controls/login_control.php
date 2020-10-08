<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
if($_SESSION['route'][0]<>'login'){
  //se foi chamado padrão
  $_SESSION['erro_no']=0;
  $_SESSION['erro']='PRIMEIRO ACESSO DO USUÁRIO';
  $_SESSION['login']=FALSE;
  $_SESSION['control']='login';
  $_SESSION['view']='list';
} else {
    if(!isset($_POST['login']) or !isset($_POST['senha'])) {
        //se NÃO VEIO O LOGIN, o VIEW é mantido
        $_SESSION['erro_no']=2;
        $_SESSION['erro']='E-MAIL e SENHA devem ser preenchidos';
        $_SESSION['login']=FALSE;
        $_SESSION['control']='login';
        $_SESSION['view']='list';
    } else {
        $sql='SELECT nId, wNome, wLogin FROM administradores WHERE wLogin= :user AND sSenha =SHA1(:passw) limit 1';
        $pr[':user']=filter_input(INPUT_POST, 'login', FILTER_SANITIZE_EMAIL);
        $pr[':passw']=filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
        unset($_POST['login']);
        unset($_POST['senha']);
        $r=SqlQuery($sql,$pr);
        unset($pr);
        if ($r->rowCount() == 1) {
            // se possui resultado
            $r = $r->fetch(PDO::FETCH_ASSOC);
            $_SESSION['control']='dashboard';
            $_SESSION['view']='list';    
            $_SESSION['erro_no']=1;
            $_SESSION['erro']='USUÁRIO LOGADO COM SUCESSO';
            $_SESSION['login']='ADMIN'; //DIGITE O NOME DO PERFIL DE USUÁRIO
            $_SESSION['adm_nome']=$r['wNome'];
            $_SESSION['adm_email']=$r['wLogin'];
            $_SESSION['adm_id']=$r['nId'];
            $_SESSION['menu']=monta_menu($r['nId']);
        } else {
            $sql='SELECT nId, wNome, wLogin FROM administradores WHERE wLogin= :user limit 1';
            $pr[':user']=filter_input(INPUT_POST, 'login', FILTER_SANITIZE_EMAIL);
            $r=SqlQuery($sql,$pr);
            unset($pr);
            if ($r->rowCount() == 1) {
                //se tem EMAIL cacastrado
                $_SESSION['erro_no']=2;
                $_SESSION['erro']='ERRO NO LOGIN - USUÁRIO OU SENHA INVÁLIDOS';
                $_SESSION['control']='login';
                $_SESSION['view']='list';        
            } else {
                $_SESSION['erro_no']=2;
                $_SESSION['erro']='ERRO NO LOGIN - USUÁRIO NÃO CADASTRADO';
                $_SESSION['control']='login';
                $_SESSION['view']='list';        
            } //fim do EMAIL CADASTRADO
        } //fim do LOGIN_INVALIDO
    } //fim do isset()
} // fim do else (route<>login)

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