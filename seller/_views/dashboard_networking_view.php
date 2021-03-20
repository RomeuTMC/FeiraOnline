<?php if (!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
logado('SELLER');
$dados=$_SESSION['dados'];
include_once('topo.php');
?><center>
<a href='https://html5-chat.com/chat/25952/<?=$dados['enc']; ?>' target=_new>ABRIR CHAT</a>
<div style="max-width:500px;margin:0 auto;">
    <div class="row">
        <div class="col">
            <div style="width:1000px;height:450px;margin:0 auto;">
                <script src="https://html5-chat.com/script/25952/<?=$dados['enc']; ?>"></script>
            </div>
        </div>
    </div>
</div>