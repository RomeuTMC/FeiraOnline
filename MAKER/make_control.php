<?php
if(!isset($_GET['table'])){ 
    echo "DEFINA ?table=tabela_do_banco - para criar um formulário para a tabela selecionada";
    die('--');
  }
  header('Content-Type: text/plain; charset=utf-8');
  require_once("./../_configure.php"); // Carrega as funções e configurações globais
  define('MAKER',URL.'MAKER');
  $r=SqlQuery('SELECT COLUMN_NAME, COLUMN_COMMENT,COLUMN_KEY,DATA_TYPE
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_NAME="'.$_GET['table'].'" ');
  $fs=array();
  $n=0;
  while($l = $r->fetch(PDO::FETCH_ASSOC)) {
      $fs[$n]=$l;
      // captura qual a coluna é PRIMARY
      if($l['COLUMN_KEY']=='PRI'){
          $PRI=$l['COLUMN_NAME'];
      }
      // captura a lista de colunas únicas, para checagem
      if($l['COLUMN_KEY']=='UNI'){
        $UNI[]=$l['COLUMN_NAME'];
    }
    $n++;
  }
  echo '<?php if(!isset($TRUE) or ($TRUE<>\'index.php\')) die(\'LOCKED\'); 
logado();
$_SESSION[\'dados\']=$_POST;
if(!isset($_SESSION[\'route\'][1]) or $_SESSION[\'route\'][1]==\'list\'){
    $_SESSION[\'dados\']='.$_GET['table'].'_list();
} elseif($_SESSION[\'route\'][1]==\'novo\'){
    $_SESSION[\'dados\']='.$_GET['table'].'_novo();
} elseif($_SESSION[\'route\'][1]==\'atualiza\'){
    $_SESSION[\'dados\']='.$_GET['table'].'_atualiza();
} elseif($_SESSION[\'route\'][1]==\'save\'){
    $_SESSION[\'dados\']='.$_GET['table'].'_salva();
} elseif($_SESSION[\'route\'][1]==\'exclui\'){
    $_SESSION[\'dados\']='.$_GET['table'].'_exclui();
} elseif($_SESSION[\'route\'][1]==\'mostra\'){
    $_SESSION[\'dados\']='.$_GET['table'].'_mostra();
}else {
    // VIEW PADRÃO ou MOSTRA QUE NÃO EXISTE se for DEV
    if(AMBIENTE == \'DEVELOPER\') {
        print_r($_SESSION[\'route\']);
      } else {
        $_SESSION[\'dados\']='.$_GET['table'].'_list();
      }
}

//LISTAGEM DA TABELA
function '.$_GET['table'].'_list(){
    global $db;
    $_SESSION[\'view\']=\'list\';
    $data[\'titulo\']="Cadastro de '.$_GET['table'].'";
    $sql="SELECT count('.$PRI.') as Total FROM '.$_GET['table'].'";
    $r=SqlQuery($sql);
    $l=$r->fetch(PDO::FETCH_ASSOC); 
    $data[\'total\']=$l[\'Total\'];
    $sql="SELECT '.$PRI.' ';
    // insere na listagem todas as variaveis unicas, para posterior edição
    foreach($UNI as $v){
        echo ','.$v.' ';
    }
    echo 'FROM '.$_GET['table'].' ORDER BY '.$PRI.'";
    $r=SqlQuery($sql);
    $data[\'registros\']=$r->RowCount();
    while($l = $r->fetch(PDO::FETCH_ASSOC)) {
        $data[\'listagem\'][$l[\''.$PRI.'\']]=$l;
    }
    return $data;
}

//NOVO CADASTRO - DADOS EM BRANCO
function '.$_GET['table'].'_novo(){
    global $db;
    $_SESSION[\'view\']=\'form\';
    $msg[\'titulo\']=\'Incluir '.$_GET['table'].'\';'.PHP_EOL;
// verifica se for PRIMARY coloca valor de EUTOINCREMENTO, senão, deixa em branco
foreach($fs as $f){
    if($f['COLUMN_NAME']==$PRI){
        echo '    $msg[\''.$f['COLUMN_NAME'].'\']=0; //'.$f['COLUMN_COMMENT'].' -- '.$f['COLUMN_KEY'].'.'.PHP_EOL;
    } else {
        echo '    $msg[\''.$f['COLUMN_NAME'].'\']=\'\'; //'.$f['COLUMN_COMMENT'].' -- '.$f['COLUMN_KEY'].'.'.PHP_EOL;
    }
}
echo '    return $msg;
}

//ATUALIZA CADASTRO - DADOS DO ID ESPECIFICADO
function '.$_GET['table'].'_atualiza(){
    global $db;
    $_SESSION[\'view\']=\'form\';
    $msg[\'titulo\']=\'Alterar '.$_GET['table'].'\';'.PHP_EOL;
    //verifica se o dado enviado é compativel com o esperado
    echo '    $pr[\':id\']=filter_var($_SESSION[\'route\'][2]);
    $sql="SELECT * FROM '.$_GET['table'].' where '.$PRI.'=".$pr[\':id\']." limit 1";
    $r=SqlQuery($sql);
    $l = $r->fetch(PDO::FETCH_ASSOC);'.PHP_EOL;
// cria o ARRAY de chave=>valor para todos os campos da tabela
foreach($fs as $f){
   echo '    $msg[\''.$f['COLUMN_NAME'].'\']=$l[\''.$f['COLUMN_NAME'].'\']; //'.$f['COLUMN_COMMENT'].' -- '.$f['COLUMN_KEY'].'.'.PHP_EOL;
}
echo '    return $msg;
}

//SALVA CADASTRO - FAZ O INSERT ou UPDATE CONFORME O ID
function '.$_GET['table'].'_salva(){
    global $db;
    $_SESSION[\'dados\'][\'titulo\']=\'Erro - Verifique Dados\';
    $_SESSION[\'view\']=\'list\';'.PHP_EOL;
    // FAZ o FILTRO SANITIZE, CONFORME O TIPO, no loop de entrada para TODOS OS CAMPOS
    foreach($fs as $f){
        echo '    $pr[\':'.strtoupper($f['COLUMN_NAME']).'\']=filter_input(INPUT_POST, \''.$f['COLUMN_NAME'].'\', ';
        //coloca o FILTER conforme o TIPO DE DADOS BASICO
        if($f['DATA_TYPE']=='varchar' 
            or $f['DATA_TYPE']=='char' 
            or $f['DATA_TYPE']=='tinytext'
            or $f['DATA_TYPE']=='text' 
            or $f['DATA_TYPE']=='mediumtext' 
            or $f['DATA_TYPE']=='longtext'
            ){
            echo 'FILTER_SANITIZE_STRING';
        } elseif ($f['DATA_TYPE']=='blob' 
            or $f['DATA_TYPE']=='mediumblob' 
            or $f['DATA_TYPE']=='longblob'
            ){
            echo 'FILTER_SANITIZE_SPECIAL_CHARS';
        } elseif ($f['DATA_TYPE']=='tinyint' 
            or $f['DATA_TYPE']=='smallint' 
            or $f['DATA_TYPE']=='mediumint' 
            or $f['DATA_TYPE']=='int' 
            or $f['DATA_TYPE']=='bigint'
            ){
            echo 'FILTER_SANITIZE_NUMBER_INT';
        } elseif ($f['DATA_TYPE']=='float' 
            or $f['DATA_TYPE']=='double' 
            or $f['DATA_TYPE']=='decimal'){
            echo 'FILTER_SANITIZE_NUMBER_FLOAT';
        } else {
            echo 'FILTER_UNSAFE_RAW,FILTER_DEFAULT';
        }
        echo ');'.PHP_EOL;
    }
    // percorre os UNICOS e faz a VERIFICAÇÃO
    foreach($UNI as $u){
        echo '    $r=SqlQuery("SELECT '.$u.', '.$PRI.' from '.$_GET['table'].' where '.$u.'=\'".$pr[\':'.strtoupper($u).'\']."\' and '.$PRI.'<>\'".$pr[\':'.strtoupper($PRI).'\']."\' limit 1");
    if($r->rowCount()>0){
        //se JÁ EXISTE wNome
        $_SESSION[\'view\']=\'form\';
        $_SESSION[\'erro_no\']=2;
        $_SESSION[\'erro\']=\'<h3>NÃO SALVO</h3>Já existe um '.$_GET['table'].' com estes dados cadastrados, tente novamente - '.$u.'\';
        return $_SESSION[\'dados\'];
    }'.PHP_EOL;
    }
    // CRIA O SQL DE INSERÇÃO ou de UPDATE conforme o valor de ID
    echo '    if(filter_var($_SESSION[\'route\'][2])==0){
        // SE 0 INSERT
        $sql="INSERT into '.$_GET['table'].' ('.$fs[0]['COLUMN_NAME'];
        $n=0;
        $c=count($fs)-1;
        while($n<$c){
            $n++;
            echo ' ,'.$fs[$n]['COLUMN_NAME'];
        }
        //lista de campos
        echo ') values (';
        //lista de valores
        $n=0;
        $c=count($fs);
        while($n<$c){
            if($n<>0){ echo ', ';}
            if($fs[$n]['COLUMN_NAME']=="$PRI"){
                echo '\'\'';
            } else {
                echo '\'".$pr[\':'.strtoupper($fs[$n]['COLUMN_NAME']).'\']."\'';
            }
            $n++;
        }
        echo ')";
    } else {
        // SE >0 UPDATE
        $sql="UPDATE '.$_GET['table'].' set ';
        //lista CAMPO e VALOR
        $n=0;
        $c=count($fs);
        while($n<$c){
            if($fs[$n]['COLUMN_NAME']=="$PRI"){

            } else {
                echo $fs[$n]['COLUMN_NAME'].'=\'".$pr[\':'.strtoupper($fs[$n]['COLUMN_NAME']).'\']."\'';
                if($n<$c-1){ echo ', '; }    
            }
            $n++;
        }
        echo ' where ';
        echo $PRI.'=\'".$pr[\':'.strtoupper($PRI).'\']."\'';
        echo ' limit 1";
    }
    $r=SqlQuery($sql);
    $_SESSION[\'view\']=\'list\';
    $_SESSION[\'erro_no\']=1;
    $_SESSION[\'erro\']=\'<h3>SALVO COM SUCESSO</h3>'.$_GET['table'].' ID:\'.$db->lastInsertId();
    return '.$_GET['table'].'_list();
}

//EXCLUI CADASTRO
function '.$_GET['table'].'_exclui(){
    global $db;
    $_SESSION[\'view\']=\'list\';
    $pr[\':id\']=filter_var($_SESSION[\'route\'][2]);
    $r=SqlQuery("select * from '.$_GET['table'].' where '.$PRI.'=".$pr[\':id\']." limit 1");
    if($r->rowCount()<>1){
        $_SESSION[\'erro_no\']=\'2\';
        $_SESSION[\'erro\']=\'ERRO: Validação da Exclusão não Aceita\';
        return '.$_GET['table'].'_list();
    } else {
        $r=SqlQuery("DELETE from '.$_GET['table'].' where '.$PRI.'=".$pr[\':id\']." limit 1");
        $_SESSION[\'erro_no\']=\'1\';
        $_SESSION[\'erro\']=\'SUCESSO: Excluído Com Sucesso\';
        return '.$_GET['table'].'_list();
    }
}

//MOSTRA 1 CADASTRO
function '.$_GET['table'].'_mostra(){
    global $db;
    $_SESSION[\'view\']=\'form\';
    $data[\'titulo\']=\'Mostrar '.$_GET['table'].'\';
    $pr[\':id\']=filter_var($_SESSION[\'route\'][2]);
    $r=SqlQuery("select * from '.$_GET['table'].' where '.$PRI.'=".$pr[\':id\']." limit 1");
    if($r->rowCount()<>1){
        $_SESSION[\'erro_no\']=\'2\';
        $_SESSION[\'view\']=\'list\';
        $_SESSION[\'erro\']=\'ERRO: CADASTRO NÃO LOCALIZADO\';
        return '.$_GET['table'].'_list();
    } else {
        $data[\'registros\']=$r->RowCount();
        $data[\'read\']=\'SIM\';
        while($l = $r->fetch(PDO::FETCH_ASSOC)) {
';
            //lista as variaveis
            foreach($fs as $f){
                echo '            $data[\''.$f['COLUMN_NAME'].'\']=$l[\''.$f['COLUMN_NAME'].'\']; //'.$f['COLUMN_COMMENT'].' -- '.$f['COLUMN_KEY'].'.'.PHP_EOL;
            }
            echo '
        }
        return $data;
    }
}
?>';