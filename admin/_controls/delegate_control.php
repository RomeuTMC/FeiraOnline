<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED'); 
logado('ADMIN');
$_SESSION['dados']=$_POST;
if(!isset($_SESSION['route'][1]) or $_SESSION['route'][1]=='senha'){
    $_SESSION['dados']=delegate_senha();
} elseif($_SESSION['route'][1]=='senhasave'){
    $_SESSION['dados']=delegate_save();
}else {
    // VIEW PADRУO ou MOSTRA QUE NУO EXISTE se for DEV
    if(AMBIENTE == 'DEVELOPER') {
        header('Location:'.ADMIN.'dashboard');
      } else {
        $_SESSION['dados']=array();
        header('Location:'.ADMIN.'dashboard');
      }
}
function delegate_senha(){
    global $db;
    $_SESSION['view']='senha';
    $msg['titulo']='Alterar Senha de Delegate';
    $pr[':id']=filter_var($_SESSION['route'][2]);
    $sql="SELECT * FROM exp_delegate where nId=".$pr[':id']." limit 1";
    $r=SqlQuery($sql);
    $l = $r->fetch(PDO::FETCH_ASSOC);
    $msg['nId']=$l['nId']; //ID -- PRI.
    $msg['nId_expositor']=$l['nId_expositor']; //ID xpositor -- .
    $msg['cNome']=$l['cNome']; //Complete Name -- .
    $msg['cEmail']=$l['cEmail']; //Mail for login -- UNI.
    $msg['sPassw']=$l['sPassw']; //Password -- .
    $msg['cPhone']=$l['cPhone']; //Personal Phone -- .
    $msg['eAdm']=$l['eAdm']; // -- .
    $msg['fPhoto']=$l['fPhoto']; // -- .
    return $msg;
}

function delegate_save(){
    $pr[':NID']=filter_input(INPUT_POST, 'nId', FILTER_SANITIZE_NUMBER_INT);
    $pr[':CPASSW']=filter_input(INPUT_POST, 'sPassw', FILTER_SANITIZE_STRING);
    $pr[':CPASSW']=password_hash(sha1($pr[':CPASSW']), PASSWORD_DEFAULT);
    if(!$_POST['sPassw']==''){
        $sql="UPDATE exp_delegate set sPassw='".$pr[':CPASSW']."' where nId='".$pr[':NID']."' limit 1";
        $r=SqlQuery($sql);
    }
    if($_FILES['Photo']['error']==0){
        $r=SqlQuery("SELECT nId, fPhoto from exp_delegate where nId='".$pr[':NID']."' limit 1");
        $l = $r->fetch(PDO::FETCH_ASSOC);
        @unlink(_FS.$l['fPhoto']);
        $nm = md5(uniqid(rand(), true)); // gera ID único para as imagens
         //Imagem LOGO
         $pr[':FPHOTO']='';
         $ft=$_FILES['Photo'];
         $name=slug($ft['name']);
         if(move_uploaded_file($ft['tmp_name'],"./../img/exp-dele/dele-$nm-".$name)){
             $pr[':FPHOTO']="img/exp-dele/dele-$nm-".$name;
         }
         $sql="UPDATE exp_delegate set fPhoto='".$pr[':FPHOTO']."' where nId='".$pr[':NID']."' limit 1";
        $r=SqlQuery($sql);
    }
    return true;
}
?>