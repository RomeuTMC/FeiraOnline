<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
if($_SESSION['route'][1]<>'login'){
  //se foi chamado padrão
  $_SESSION['erro_no']=0;
  $_SESSION['erro']='PRIMEIRO ACESSO DO USUÁRIO';
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
        $sql='SELECT nId, cCompany, ePerson, cPersonalName, cEmail, sPassw, fPhoto FROM clientes WHERE cEmail= :user limit 1';
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
            if (!password_verify($pass_recebido,$l['sPassw'])) {
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
                $_SESSION['login']='BUYER'; //DIGITE O NOME DO PERFIL DE USUÁRIO
                $_SESSION['buy_emp']=$l['cCompany'];
                $_SESSION['buy_email']=$l['cEmail'];
                $_SESSION['buy_foto']=$l['fPhoto'];
                $_SESSION['buy_id']=$l['nId'];
                $_SESSION['buy_name']=$l['cPersonalName'];
                $_SESSION['buy_completename']=$l['ePerson'].'. '.$l['cPersonalName'];
                header("Location:".ADMIN.'dashboard');
            }//fim do password_verify()
        } //fim do EXISTE LOGIN
    } //fim do isset() dados para login
} // fim do (route<>login)
?>