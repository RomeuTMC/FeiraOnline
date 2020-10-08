<?php
require_once("./../_configure.php"); // Carrega as funções e configurações globais
//$r=SqlQuery("DELETE from chat where times<now() limit 1");
//APAGA as mensagens com mais de 1 hora
$r=SqlQuery("DELETE from chats where times<date_add(now(), interval -100 day)");
$sala=filter_input(INPUT_POST, 'sala', FILTER_SANITIZE_NUMBER_INT);
if($sala==''){
    $sala='000';
}
$sala=str_pad($sala,3,'0', STR_PAD_LEFT);
$user=filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
if($user==''){
    $user='NO NAME';
}
$stat=filter_input(INPUT_POST, 'stat', FILTER_SANITIZE_STRING);
if($stat==''){
    $stat='CLI';
}
$mensagem=filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING);
if($mensagem<>''){
    //se veio mensagem, verifica se é flood
    $r=SqlQuery("INSERT INTO `chats` (`id`, `sala`, `user`, `mensagem`, `status`, `times`) VALUES (NULL, '$sala', '$user', '$mensagem', '$stat', null)");
    $uid=$db->lastInsertId();
} else {
    $uid=filter_input(INPUT_POST, 'uid', FILTER_SANITIZE_NUMBER_INT);
}
$r=SqlQuery("SELECT id, mensagem as texto, user, times, status, now() as chat_ut FROM chats where sala='$sala' order by times asc");
if($r->rowCount()>0){
    while($l=$r->fetch(PDO::FETCH_ASSOC)){
        $msg[]=$l;
        $uid=str_pad($l['id'],10,'0', STR_PAD_LEFT);
        $_SESSION['chat_ut']=$l['chat_ut'];
    }    
} else {
    $msg[0]['texto']='Escreva sua Mensagem e Clique em enviar. Muito Obrigado!';
    $msg[0]['user']='BEM VINDO';
    $msg[0]['times']=date('Y-m-d H:i:s');
    $msg[0]['status']='ADM';
    $uid=str_pad(1,10,'0', STR_PAD_LEFT);
    $_SESSION['chat_ut']=date('Y-m-d H:i:s');
}
header("content-type: application/json;charset=UTF-8");
header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400');
echo json_encode($msg);
exit(200);
?>