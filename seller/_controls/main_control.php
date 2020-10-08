<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
if($_SESSION['route'][1]<>'login'){
  //se foi chamado padrão
  $_SESSION['erro_no']=0;
  $_SESSION['erro']='Primeiro acesso do usuário';
  $_SESSION['login']='FALSE-PRIMEIROACESSO';
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
        $sql='SELECT exp_delegate.nId, sPassw,aWhereby, cName as cCompany, cNome, expositores.nId as expo, fPhoto FROM expositores, exp_delegate WHERE expositores.nId=exp_delegate.nId_expositor and exp_delegate.cEmail= :user limit 1';
        $pr[':user']=filter_input(INPUT_POST, 'login', FILTER_SANITIZE_EMAIL);
        $pass_recebido=sha1(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING));
        unset($_POST['login']);
        unset($_POST['senha']);
        $r=SqlQuery($sql,$pr);
        $l=$r->fetch(PDO::FETCH_ASSOC);
        if($r->rowCount()<1){
            $_SESSION['erro_no']=2;
            $_SESSION['erro']='Usuário não cadastrado, tente novamente.';
            $_SESSION['control']='main';
            $_SESSION['login']='FALSE-USUARIO';
            $_SESSION['view']='list';
        } else {
            //se não tem usuário
            if (!password_verify($pass_recebido,$l['sPassw'])) {
                // se localizou o usuário, e senha é inválida
                $_SESSION['erro_no']=2;
                $_SESSION['erro']='Usuário ou senha inválidos';
                $_SESSION['login']='FALSE-SENHAERRO';
                $_SESSION['control']='main';
                $_SESSION['view']='list';
            } else {
                // se possui resultado, e senha é válida
                $_SESSION['control']='dashboard';
                $_SESSION['erro_no']=1;
                $_SESSION['view']='list';
                $_SESSION['erro']='Usuário logado com sucesso';
                $_SESSION['login']='SELLER'; //DIGITE O NOME DO PERFIL DE USUÁRIO
                $_SESSION['sel_nome']=$l['cNome'];
                $_SESSION['sel_emp']=$l['cCompany'];
                $_SESSION['sel_email']=$l['cEmail'];
                $_SESSION['sel_id']=$l['expo'];
                $_SESSION['sel_foto']=$l['fPhoto'];
                $_SESSION['sala']=$l['aWhereby'];
                $_SESSION['sel_delegate']=$l['nId'];
                header("Location:".ADMIN.'dashboard');
            }//fim do password_verify()
        } //fim do EXISTE LOGIN
    } //fim do isset() dados para login
} // fim do (route<>login)
?>