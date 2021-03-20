<?php
require_once("./../_configure.php"); // Carrega as funções e configurações globais
require_once(_FS."_auth.php"); //Verifica se esta LOGADO, se não está DIRECIONA PARA LOGIN
//APAGA as mensagens com mais de 1 hora
$r=SqlQuery("DELETE from chats where times<date_add(now(), interval -100 day)");
if(isset($_SESSION['chat_ut'])){
    $now=$_SESSION['chat_ut'];
} else {
    $r=SqlQuery("SELECT now() as chat_ut");
    $now=$r->fetch(PDO::FETCH_ASSOC);
    $_SESSION['chat_ut']=$now;
}
//Abre o Chat
$sala=filter_input(INPUT_GET, 'sala', FILTER_SANITIZE_NUMBER_INT);
if($sala==''){
    $sala='000';
}
$sala=str_pad($sala,3,'0', STR_PAD_LEFT);
$user=filter_input(INPUT_GET, 'user', FILTER_SANITIZE_STRING);
if($user==''){
    $user='NO NAME';
}
$stat=filter_input(INPUT_GET, 'stat', FILTER_SANITIZE_STRING);
if($stat==''){
    $stat='CLI';
}
$r=SqlQuery("SELECT id, mensagem as texto, user, times, status, now() as chat_ut FROM chats where sala='$sala' order by times asc");
if($r->rowCount()>0){
    while($l=$r->fetch(PDO::FETCH_ASSOC)){
        $msg[]=$l;
        $uid=str_pad($l['id'],10,'0', STR_PAD_LEFT);
    }
} else {
    $msg[0]['texto']='Escreva sua Mensagem e Clique em enviar. Muito Obrigado!';
    $msg[0]['user']='BEM VINDO';
    $msg[0]['times']=date('Y-m-d H:i:s');
    $msg[0]['status']='ADM';
    $uid=str_pad(1,10,'0', STR_PAD_LEFT);
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta charset="UTF-8">
        <meta local='CHAT-SALA:<?php echo $_GET['sala'];?>'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title><?php echo SISTEM; ?></title>
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-176447911-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-176447911-1');
</script>
        <link rel="shortcut icon" href="<?php echo URL;?>img/favicon.png" />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha256-L/W5Wfqfa0sdBNIKN9cG6QA5F2qx4qICmU2VgLruv9Y=" crossorigin="anonymous" />
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap4.min.css"
            integrity="sha256-F+DaKAClQut87heMIC6oThARMuWne8+WzxIDT7jXuPA=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
            integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
        <link href="<?php echo URL;?>/css/global.css" rel="stylesheet">
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha256-WqU1JavFxSAMcLP2WIOI+GB2zWmShMI82mTpLDcqFUg=" crossorigin="anonymous"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js" integrity="sha512-VXhyn2yTlj6eL4eipgFzMYQVOR+6R4sNi0r7spOGrzlhnWSX3V6NJfROAFWygj43k28MiOblwFYK44KLPpmIDA==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
            integrity="sha256-Kg2zTcFO9LXOc7IwcBx1YeUBJmekycsnTsq2RuFHSZU=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
            integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="<?php echo URL;?>js/main.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"
            integrity="sha256-t5ZQTZsbQi8NxszC10CseKjJ5QeMw5NINtOXQrESGSU=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/dataTables.bootstrap4.min.js"
            integrity="sha256-hJ44ymhBmRPJKIaKRf3DSX5uiFEZ9xB/qx8cNbJvIMU=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css" integrity="sha512-LhZScx/m/WBAAHyiPnM+5hcsmCMjDDOgOqoT9wyIcs/QUPm6YxVNGZjQG5iP8dhWMWQAcUUTE3BkshtrlGbv2Q==" crossorigin="anonymous" />
        <!-- slider -->
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
        <style>
            .main_chat {
                width: 800px;
                height: 500px;
                overflow-y: scroll;
            }
        </style>
        <!-- end slider -->
    </head>

    <body data-spy="scroll" data-target=".navbar" data-offset="170">
        <div class='main_chat' id='mms'>
            <?php
    foreach($msg as $m){
        echo '<div class=\'msg '.$m['status'].'\'>';
        echo '<b>'.$m['user'].'</b> <span>'.$m['times'].'</span> <p>'.$m['texto'].'</p>';
        echo '</div>';
    }
    ?>
        </div>
        <div class='msg_chat'>
            <form id='form' action='#' onsubmit="return submitFormChat()">
                <input type='hidden' id=sala name='sala' value='<? echo $sala; ?>'>
                <input type='hidden' id=user name='user' value='<? echo $user; ?>'>
                <input type='hidden' id=uid name='uid' value='<? echo $uid; ?>'>
                <input type='hidden' id=stat name='stat' value='<? echo $stat; ?>'>
                <div class="form-group">
                    <label for="texto"></label>
                    <input type='text' class="form-control" name="mensagem" id="mensagem" max-width=250 required
                        placeholder='Digite aqui a sua mensagem e pressione <ENTER> para enviar' value='' onkeypress='envia( e );'>
                </div>
                <button type="button" name="submit" id="submit" class="btn btn-primary btn-lg btn-block d-none">ENVIAR</button>
                <script>
                    var myVar = setInterval(update_msg, 10000);

                    function submitFormChat() {
                        if ($("#mensagem").val() != '') {
                            $.ajax({
                                url: 'msg.php', // url where to submit the request
                                type: "POST", // type of action POST || GET
                                dataType: 'json', // data type
                                data: $("#form").serialize(), // post data || get data
                                success: function (r) {
                                    // you can see the result from the console
                                    // tab of the developer tools
                                    //alert('mensagem');
                                    $("#uid").attr('value', r['uid']);
                                    $("#mensagem").val('');
                                    updt_mens(r);
                                },
                                error: function (xhr, resp, text) {
                                    console.log(xhr, resp, text);
                                }
                            })
                        }
                        // alert('Submit button pressed');
                        return false; //do not submit the form
                    }


                    function update_msg() {
                        vuid = $("#uid").val();
                        vsala = $("#sala").val();
                        vuser = $("#user").val();
                        vstat = $("#stat").val();
                        //dados={uid:vuid, sala:vsala, user:vuser, stat:vstat};
                        $.ajax({
                            url: 'new.php?uid=' + vuid + '&sala=' + vsala + '&user=' + vuser + '&stat=' +
                                vstat, // url where to submit the request
                            type: "POST", // type of action POST || GET
                            dataType: 'json', // data type
                            data: $("#form").serialize(),
                            success: function (u) {
                                // you can see the result from the console
                                // tab of the developer tools
                                //alert('atualiza');
                                $("#uid").attr('value', u['uid']);
                                updt_mens(u);
                            },
                            error: function (xhr, resp, text) {
                                console.log(xhr, resp, text);
                            }
                        });
                    }

                    function updt_mens(valores) {
                        //console.log(valores);
                        var nvht = '';
                        jQuery.each(valores, function (i, valo) {
                            nvht = nvht + '<div class=\'msg ' + valo['status'] + '\'>';
                            nvht = nvht + '<b>' + valo['user'] + '</b> <span>' + valo['times'] + '</span> <p>' +
                                valo['texto'] + '</p>';
                            nvht = nvht + '</div>';
                        });
                        $('#mms').html(nvht);
                        $("#uid").attr('value', valores['uid']);
                        $("#mms").animate({
                            scrollTop: $('#mms')[0].scrollHeight - $('#mms')[0].clientHeight
                        }, 1);
                    }

                    function envia(e) {
                        if (e.keyCode == 13) {
                            alert('ENTER');
                            return false;
                        }
                        return true;
                    }
                </script>
            </form>
        </div>
        <p> </p>
    </body>

</html>
<?php
    require_once(_FS."_footer.php"); // Finaliza o script fechando as conexões e dando a saida do DEBUG
?>