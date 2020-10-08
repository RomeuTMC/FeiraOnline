<?php if (!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
logado('ADMIN');
$dados=$_SESSION['dados'];
?>
<div style="width:80%;height:450px;margin:0 auto;">
    <script src="https://html5-chat.com/script/25952/<?=$dados['help']; ?>"></script>
</div>
<!-- Para Abrir em uma Janela A Parte, clique com o BOTÃO DIREITO sobre o link e selecione ABRIR EM NOVA JANELA -->