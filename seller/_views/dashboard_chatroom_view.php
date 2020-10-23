<?php if (!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
logado('SELLER');
$dados=$_SESSION['dados'];
include_once('topo.php');
?>

<style>
/* .wrapperChat {
    margin: 0 auto;
    width: calc(80vw - 100px) !important;
    height: 100%;
} */
.footer-page {
    display: none !important;
}
</style>
<div>
    <div class="row">
        <div class="col">
            <div style="width:1000px;height:80vh;margin:0 auto;">
                <script src="https://html5-chat.com/script/25952/<?=$dados['chat']; ?>"></script>
            </div>
        </div>
    </div>
</div>