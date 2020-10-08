<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED'); 
logado('SELLER');
$_SESSION['dados']=$_POST;
if(!isset($_SESSION['route'][1]) or $_SESSION['route'][1]=='list'){
    $_SESSION['dados']=exp_produtct_list();
} elseif($_SESSION['route'][1]=='novo'){
    $_SESSION['dados']=exp_produtct_novo();
} elseif($_SESSION['route'][1]=='atualiza'){
    $_SESSION['dados']=exp_produtct_atualiza();
} elseif($_SESSION['route'][1]=='save'){
    $_SESSION['dados']=exp_produtct_salva();
} elseif($_SESSION['route'][1]=='exclui'){
    $_SESSION['dados']=exp_produtct_exclui();
} elseif($_SESSION['route'][1]=='mostra'){
    $_SESSION['dados']=exp_produtct_mostra();
}else {
    // VIEW PADRÃO ou MOSTRA QUE NÃO EXISTE se for DEV
    if(AMBIENTE == 'DEVELOPER') {
        print_r($_SESSION['route']);
      } else {
        $_SESSION['dados']=exp_produtct_list();
      }
}

//LISTAGEM DA TABELA
function exp_produtct_list(){
    global $db;
    $_SESSION['view']='list';
    $data['titulo']="Photos of product details";
    $sql="SELECT count(nId) as Total FROM exp_produtct where nId_expositor='".$_SESSION['sel_id']."'";
    $r=SqlQuery($sql);
    $l=$r->fetch(PDO::FETCH_ASSOC); 
    $data['total']=$l['Total'];
    $sql="SELECT nId, aFile FROM exp_produtct where nId_expositor='".$_SESSION['sel_id']."' ORDER BY nId";
    $r=SqlQuery($sql);
    $data['registros']=$r->RowCount();
    while($l = $r->fetch(PDO::FETCH_ASSOC)) {
        $data['listagem'][$l['nId']]=$l;
    }
    return $data;
}

//NOVO CADASTRO - DADOS EM BRANCO
function exp_produtct_novo(){
    global $db;
    $_SESSION['view']='form';
    $msg['titulo']='New Photo from Product Details';
    $msg['nId']=0; // -- PRI.
    $msg['nId_expositor']=$_SESSION['sel_id']; // ID DO EXPOSITOR
    $msg['aFile']=''; //Nome do Arquivo -- UNI.
    return $msg;
}

//SALVA CADASTRO - FAZ O INSERT ou UPDATE CONFORME O ID
function exp_produtct_salva(){
    global $db;
    $_SESSION['dados']['titulo']='Error - Verify data';
    $_SESSION['view']='list';
    $pr[':NID']=filter_input(INPUT_POST, 'nId', FILTER_SANITIZE_NUMBER_INT);
    $pr[':NID_EXPOSITOR']=filter_input(INPUT_POST, 'nId_expositor', FILTER_SANITIZE_NUMBER_INT);
    //VARIAS IMAGENS DOS PRODUTOS
    $nm = md5(uniqid(rand(), true)); // gera ID único para as imagens
     $pr[':APRODUCTS']=array(); // array de imagens
     if(count($_FILES['aFile'])>0){
         $ft=$_FILES['aFile'];
     } else {
         $_SESSION['view']='form';
         $_SESSION['erro_no']='2';
         $_SESSION['erro']="PRODUCTS PHOTO must be compulsory";
         deltmp($del);
         return exp_produtct_novo();
     }
     $c=count($ft['name']);
     for($n=0; $n<$c; $n++){
         $name=slug($ft['name'][$n]);
         $temp=$ft['tmp_name'][$n];
         if(move_uploaded_file($temp,"./../img/exp-produto/prod-$n-$nm-".$name)){
             $pr[':APRODUCTS'][]="img/exp-produto/prod-$n-$nm-".$name;
             $del[]="img/exp-produto/prod-$n-$nm-".$name;
         }
     }
     if(filter_var($_SESSION['route'][2])==0){
         // SE 0 INSERT
         foreach($pr[':APRODUCTS'] as $k){
            $r=SqlQuery("INSERT into `exp_produtct` (`nId`, `nId_expositor`, `aFile`) VALUES ('', '".$pr[':NID_EXPOSITOR']."', '$k');");
        }
     } else {
        // SE >0 UPDATE
        $_SESSION['view']='form';
        $_SESSION['erro_no']=2;
        $_SESSION['erro']='<h3>ERRO:</h3>No Update Photos Avaiable';     
        deltmp($del);
        return exp_produtct_novo();
     }
    $_SESSION['view']='list';
    $_SESSION['erro_no']=1;
    $_SESSION['erro']='<h3>SALVO COM SUCESSO</h3>exp_produtct ID:'.$db->lastInsertId();
    return exp_produtct_list();
}

//EXCLUI CADASTRO
function exp_produtct_exclui(){
    global $db;
    $_SESSION['view']='list';
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $r=SqlQuery("select * from exp_produtct where nId=".$pr[':id']." limit 1");
    $l=$r->fetch(PDO::FETCH_ASSOC);
    if($r->rowCount()<>1){
        $_SESSION['erro_no']='2';
        $_SESSION['erro']='ERRO: Validação da Exclusão não Aceita';
        return exp_produtct_list();
    } else {
        @unlink(_FS.$l['aFile']);
        $r=SqlQuery("DELETE from exp_produtct where nId=".$pr[':id']." limit 1");
        $_SESSION['erro_no']='1';
        $_SESSION['erro']='SUCESSO: Excluído Com Sucesso';
        return exp_produtct_list();
    }
}

function deltmp($fss = array()){
    foreach($fss as $f){
        if(!unlink($f)){
            __out("<h3>ERROR</h3> Fail during images manipulation - $f",200);
            return false;    
        } else {
            if(AMBIENTE == 'DEVELOPER') {
                echo "EXCLUIDO: $f";
            } else {
                echo "<script>console.log('EXCLUIDO: $f');</script>";
                // se for fora do DEV, exclui silenciosamente
            }
        }
    }
    return true;
}
?>