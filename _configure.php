<?php
if(file_exists(__DIR__ .'/__dev.php')){
  define("AMBIENTE","DEVELOPER"); //DEVELOPER = Desenvolvimento - PRODUCT = Produção - HOMOL=Homologação
  include_once(__DIR__ .'/__dev.php');
} else {
  define("AMBIENTE","PRODUCT");
  include_once(__DIR__ .'/__hom.php');
}
// Não alterar após essa linha, somente cria as conexões e funções de saida
session_start();
define('LIVE','mj-lBMgzeU0'); //Digite a chave do INCORPORAR do YouTube
$TRUE=basename($_SERVER['SCRIPT_FILENAME']);
$_SESSION['server']=URL;
$_SESSION['SID']="Tmc.".md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
$_SESSION['rtStart'] = microtime(true);
if(AMBIENTE == "DEVELOPER"){
  //define errorlevel (tela) e LOG como verdadeiros
  error_reporting(E_ALL);
  ini_set("display_errors",TRUE);
  ini_set("error_log",_FS."ERROS.THAI");
} else {
  //define error_level=0 nenhum erro apresentado na tela, salva em arquivo.
  error_reporting(E_ALL);
  ini_set("display_errors",0);
  ini_set("error_log",_FS."USER.ERROR.THAI");
}
unset($_REQUEST);

//Conecta com o banco de dados, e seleciona a base de dados
$db=ConectDb();


// VERIFICA SE É CONEXÃO SEGURA, e ABRE O SISTEMA DE ROTEAMENTO
if(strtoupper($_SERVER['REQUEST_SCHEME'])!='HTTPS'){
  __out("1001 - Obrigatório o uso de HTTPS",406);
}
if(isset($_GET['route'])){
  $route = $_GET['route'];
  $route = explode('/',$route);
  $route = filter_var_array($route,FILTER_SANITIZE_URL);
} else {
  $route[0]='0';
}
$_SESSION['route']=$route;
$_SESSION['control']=0;
$_SESSION['view']=0;
$_SESSION['action']=0;

//CRIA AS FUNÇÕES GLOBAIS PARA O SISTEMA
//__out() - Similar a DIE(), porém com a saida formatada para USER ou DEV
function __out($_msg, $excode = 200){
    $_SESSION['rtStop'] = microtime(true);
    $time = $_SESSION['rtStop']-$_SESSION['rtStart'];
    $_SESSION['exec_time']="".round($time,'3')." - Segundos";
    $_SESSION['HTTP_ERRO']=$excode;
    $_SESSION['MENSAGEM']=$_msg;
    if(AMBIENTE == 'DEVELOPER'){
      http_response_code($excode);
      //echo "<pre><br>SESSION========================<br>";
      //print_r($_SESSION);
      //echo "<br>POST=========================<br>";
      //print_r($_POST);
      //echo "<br>GET=========================<br>";
      //print_r($_GET);
      echo "<erro data=\"";
      echo "===================";
      print_r($_SESSION);
      echo "===================";
      print_r($_GET);
      echo "===================";
      print_r($_POST);
      echo "\" >";
      exit($excode);
    } else {
      echo "<center><h1>UM ERRO OCORREU!</h1><h2>UMA FALHA IMPEDIU A EXECUÇÃO DE SUA SOLICITAÇÃO, A MENSAGEM RETORNADA PELO SISTEMA FOI:<br>$_msg</h2></center>";
      exit($excode);
    }
}

function ConectDb(){
  global $db;
  try {
    $dbhost=SERVERDB;
    $dbname=DBNAME;
    $dbuser=DBUSER;
    $dbpass=DBPASSW;
    $db = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
    //$db = mysqli_connect("$dbhost","$dbuser","$dbpass","$dbname");

// Check connection
//if ($mysqli -> connect_errno) {
// __out("Failed to connect to MySQL: " . $mysqli -> connect_error,503);
//}
  } catch (PDOException $e) {
    __out("ERRO! Banco de Dados: " . $e->getMessage(),503);
  }
  $r=SqlQuery("SET NAMES utf8");
  return $db;
}

//logado() permite o acesso se ta logado senão mostra tela de login
function logado($perfil = 'LOGON GENERICO'){
  if($_SESSION['login']!="$perfil"){
    $_SESSION['login']=$_SESSION['login'].'=FALSE-func-'.$perfil;
    __out('VOCÊ ESTÁ LOGADO COM O PERFIL ERRADO.<br><a href=https://tmccomunicacao.com.br/feiraonline/>ACESSE NOVAMENTE</a>',200);
    die('.');
    return false;
  } else {
    $_SESSION['login']="$perfil";
    return true;
  }
}
//SqlQuery() - Chamada, que já faz o tratamento de erro, e da a saida formatada
function SqlQuery($sql, array $pr = null){
  global $db;
  $r=$db->prepare("$sql");
  if (!$r->execute($pr)){
      $error= $r->errorInfo();
      if(AMBIENTE == 'DEVELOPER') {
        $erro="SQL ERRO:".$error[0].'-'.$error[1].'-'.$error[2];
      } else {
        $erro="SQL ERRO:".$error[1].'-'.$error[2];;
      }
      __out("$erro",504);
      return FALSE;
  };
  return $r;
}

function show_erro(){
  $erro = "<script>var sTitulo='WARNING!'; var sMens='" . 1 . "'; var sIcon='warning'; var eShow='N'</script>";
  if(isset($_SESSION['erro_no'])){
    if ($_SESSION['erro_no'] == 0) {
      //Se ERRO_NO for 0, NÃO TEM MENSAGEM
      $erro = "<script>var sTitulo='SUCCESS!'; var sMens='" . 'SEM ERRO' . "'; var sIcon='success'; var eShow='N'</script>";
    }elseif ($_SESSION['erro_no'] == 1) {
      //Se ERRO_NO for 1, FOI SUCESSO
      $erro = "<script>var sTitulo='SUCCESS!'; var sMens='" . $_SESSION['erro'] . "'; var sIcon='success'; var eShow='S'</script>";
    } elseif ($_SESSION['erro_no'] == 2) {
      //Se ERRO_NO for 2, Foi ERRO
      $erro = "<script>var sTitulo='ERROR!'; var sMens='" . $_SESSION['erro'] . "'; var sIcon='error'; var eShow='S'</script>";
    } elseif ($_SESSION['erro_no'] == 3) {
      //Se ERRO_NO for 1, FOI AVISO DE CUIDADO
      $erro = "<script>var sTitulo='WARNING!'; var sMens='" . $_SESSION['erro'] . "'; var sIcon='warning'; var eShow='S'</script>";
    } elseif ($_SESSION['erro_no'] == 4) {
      //Se ERRO_NO for 1, FOI AVISO DO USUÁRIO
      $erro = "<script>var sTitulo='ALERT!'; var sMens='" . $_SESSION['erro'] . "'; var sIcon='info'; var eShow='S'</script>";
    } elseif ($_SESSION['erro_no'] == 5) {
      //Se ERRO_NO for 1, FOI AVISO INDISPONÍVEL
      $erro = "<script>var sTitulo='FAIL!'; var sMens='" . $_SESSION['erro'] . "'; var sIcon='question'; var eShow='S'</script>";
    }
  } else {
    $erro = "<script>var sTitulo='vazio'; var sMens='" . ' ' . "'; var sIcon='question'; var eShow='N'</script>";
  }
  $_SESSION['erro_no']=0;
  return $erro;
}

function mk_select($nome_campo = 'nome', $valor=0, $lista_opcoes=array(), $script = '', $class=''){
  echo "<select name='$nome_campo' id='id_$nome_campo' class='form-control custom-select $class' ";
  if($script<>''){
     echo "onchange='$script();'";
  }
  echo ">";
  foreach($lista_opcoes as $k=>$v){
    echo "<option value='$k'";
    if($k==$valor){ echo 'selected';}
    echo ">".$v.'</option>';
  }
  echo '</select>';
  return true;
}

function mk_check($nome_campo = 'nome', $valor=array(), $lista_opcoes=array()){
  $n=0;
  foreach($lista_opcoes as $k=>$v){
    $n++;
    echo "<div class='check_block'><input type='checkbox' id='id_".$n."_$nome_campo' name='".$nome_campo."[]' value='$k'";
    foreach($valor as $v1=>$v2){
      if($k == $v2){
        echo ' checked ';
      }
    }
    echo ">";
    echo "<label for='id_".$n."_$nome_campo' class='custom-checkbox'>$v</label></div>";
  }
  return true;
}

function slug($text) {
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);   // replace não letter or digits by -
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text); // transliterate
  $text = preg_replace('~[^-\w]+~', '', $text); // remove unwanted characters
  $text = trim($text, '-'); // trim retira espaços em branco
  $text = preg_replace('~-+~', '-', $text); // remove duplicidades de replace
  $text = strtolower($text); // converte em minusculas
  if (empty($text)) {
    return 'n-a'; // retorna n-a se todos os caracteres forem substituidos (nome vazio)
  }
  return $text; // retorna o nome como deveria ser tratado
}

function printa($val,$aval=array()){
  if(is_array($val)){
    foreach($val as $k){
      echo $aval[$k].' / ';
    }
  } else {
    foreach($aval as $k=>$v){
      if($k==$val){
        echo $v;
      }
    }
  }
}

function getenumval($tbl, $colu){
  global $db;
  $r=SqlQuery("SELECT SUBSTRING(COLUMN_TYPE,5) as v FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='thaila52_meet' AND TABLE_NAME='$tbl' AND COLUMN_NAME='$colu'");
  $l=$r->fetch(PDO::FETCH_ASSOC);
  $l=trim(trim($l['v'],"()"));
  $l=str_getcsv($l, ',', "'");
  foreach($l as $k=>$v){
    $m[$v]=$v;
  }
  asort($m);
  return $m;
}

function eMail($email,$assunto,$file_html){
  $h  = "MIME-Version: 1.0\r\n";
  $h .= "Content-type: text/html; charset=utf-8\r\n";
  $h .= "From: ".EMAIL_FROM."\r\n";
  $html=file_get_contents(_FS."msgs/$file_html");
  if (mail($email, $assunto, $html, $h, "-f ".EMAIL)){
    return TRUE;
  } else {
    return FALSE;
  }
}

function eMailMsg($from='Another User <anotheruser@example.com>',$to='Another User <anotheruser@example.com>',$assunto = 'Assunto EMail',$msg=array()){
  $h  = "MIME-Version: 1.0\r\n"."Content-type: text/html; charset=utf-8\r\n"."From: ".$from."\r\n";
  $msge='';
  foreach($msg as $c=>$v){
    $msge="$msge $c : $v <br>";
  }
  $msge=$msge.'<br>Criado em:'.date('d/m/Y h:i:s').'<br><br>';
  if (mail($to, $assunto, $msge, $h, "-f ".$from)){
    return TRUE;
  } else {
    return FALSE;
  }
}
?>