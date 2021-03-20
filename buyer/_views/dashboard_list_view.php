<?php if (!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
logado('BUYER');
$dados=$_SESSION['dados'];
//print_r($dados);
?>

<!-- ARQUIVOS DO 3D -->
<div id="pano"></div>

<div id="sceneList">
  <ul class="scenes">

    <a href="javascript:void(0)" class="scene" data-id="0-credenciamento-a">
      <li class="text">Credenciamento A</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="1-credenciamento-b">
      <li class="text">Credenciamento B</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="2-credenciamento-c">
      <li class="text">Credenciamento C</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="3-avenida-a---01">
      <li class="text">Avenida A - 01</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="4-avenida-a---02">
      <li class="text">Avenida A - 02</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="5-avenida-a---03">
      <li class="text">Avenida A - 03</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="6-avenida-a---04">
      <li class="text">Avenida A - 04</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="7-avenida-a---05">
      <li class="text">Avenida A - 05</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="8-avenida-a---06">
      <li class="text">Avenida A - 06</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="9-avenida-a---07">
      <li class="text">Avenida A - 07</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="10-avenida-a---08">
      <li class="text">Avenida A - 08</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="11-avenida-a---09">
      <li class="text">Avenida A - 09</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="12-avenida-a---10">
      <li class="text">Avenida A - 10</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="13-avenida-a---11">
      <li class="text">Avenida A - 11</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="14-avenida-a---12">
      <li class="text">Avenida A - 12</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="15-rua-09---1">
      <li class="text">Rua 09 - 1</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="16-rua-08---1">
      <li class="text">Rua 08 - 1</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="17-rua-07---1">
      <li class="text">Rua 07 - 1</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="18-rua-06---1">
      <li class="text">Rua 06 - 1</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="19-avenida-b---01">
      <li class="text">Avenida B - 01</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="20-avenida-b---02">
      <li class="text">Avenida B - 02</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="21-avenida-b---03">
      <li class="text">Avenida B - 03</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="22-avenida-b---04">
      <li class="text">Avenida B - 04</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="23-avenida-b---05">
      <li class="text">Avenida B - 05</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="24-avenida-b---06">
      <li class="text">Avenida B - 06</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="25-avenida-b---07">
      <li class="text">Avenida B - 07</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="26-avenida-b---08">
      <li class="text">Avenida B - 08</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="27-avenida-b---09">
      <li class="text">Avenida B - 09</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="28-avenida-b---10">
      <li class="text">Avenida B - 10</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="29-avenida-b---11">
      <li class="text">Avenida B - 11</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="30-avenida-b---12">
      <li class="text">Avenida B - 12</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="31-loja-a04">
      <li class="text">LOJA A04</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="32-loja-a05">
      <li class="text">LOJA A05</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="33-loja-a06">
      <li class="text">LOJA A06</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="34-loja-a08">
      <li class="text">LOJA A08</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="35-loja-a09">
      <li class="text">LOJA A09</li>
    </a>

    <a href="javascript:void(0)" class="scene" data-id="36-loja-a12">
      <li class="text">LOJA A12</li>
    </a>

  </ul>
</div>

<div id="titleBar">
  <h1 class="sceneName"></h1>
</div>

<a href="javascript:void(0)" id="autorotateToggle">
  <img class="icon off" src="https://tmccomunicacao.com.br/feira-3d/img/play.png">
  <img class="icon on" src="https://tmccomunicacao.com.br/feira-3d/img/pause.png">
</a>

<a href="javascript:void(0)" id="fullscreenToggle">
  <img class="icon off" src="https://tmccomunicacao.com.br/feira-3d/img/fullscreen.png">
  <img class="icon on" src="https://tmccomunicacao.com.br/feira-3d/img/windowed.png">
</a>

<a href="javascript:void(0)" id="sceneListToggle">
  <img class="icon off" src="https://tmccomunicacao.com.br/feira-3d/img/expand.png">
  <img class="icon on" src="https://tmccomunicacao.com.br/feira-3d/img/collapse.png">
</a>

<a href="javascript:void(0)" id="viewUp" class="viewControlButton viewControlButton-1">
  <img class="icon" src="https://tmccomunicacao.com.br/feira-3d/img/up.png">
</a>
<a href="javascript:void(0)" id="viewDown" class="viewControlButton viewControlButton-2">
  <img class="icon" src="https://tmccomunicacao.com.br/feira-3d/img/down.png">
</a>
<a href="javascript:void(0)" id="viewLeft" class="viewControlButton viewControlButton-3">
  <img class="icon" src="https://tmccomunicacao.com.br/feira-3d/img/left.png">
</a>
<a href="javascript:void(0)" id="viewRight" class="viewControlButton viewControlButton-4">
  <img class="icon" src="https://tmccomunicacao.com.br/feira-3d/img/right.png">
</a>
<a href="javascript:void(0)" id="viewIn" class="viewControlButton viewControlButton-5">
  <img class="icon" src="https://tmccomunicacao.com.br/feira-3d/img/plus.png">
</a>
<a href="javascript:void(0)" id="viewOut" class="viewControlButton viewControlButton-6">
  <img class="icon" src="https://tmccomunicacao.com.br/feira-3d/img/minus.png">
</a>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
  integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>

<script src="https://tmccomunicacao.com.br/feira-3d/vendor/es5-shim.js"></script>
<script src="https://tmccomunicacao.com.br/feira-3d/vendor/eventShim.js"></script>
<script src="https://tmccomunicacao.com.br/feira-3d/vendor/classList.js"></script>
<script src="https://tmccomunicacao.com.br/feira-3d/vendor/requestAnimationFrame.js"></script>
<script src="https://tmccomunicacao.com.br/feira-3d/vendor/screenfull.min.js"></script>
<script src="https://tmccomunicacao.com.br/feira-3d/vendor/bowser.min.js"></script>
<script src="https://tmccomunicacao.com.br/feira-3d/vendor/marzipano.js"></script>

<script src="https://tmccomunicacao.com.br/feira-3d/data.js"></script>
<script src="https://tmccomunicacao.com.br/feira-3d/index.js"></script>


<!-- <div class="lobby"> -->

  <?php include_once ('header-user.php'); ?>
  <?php include_once ('navigation-dock-user.php'); ?>

  <div class="modal fade" id="modalPresentationMovie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center w-100 font-weight-light text-uppercase" id="exampleModalLabel">Welcome -
            Amazing Thailand Virtual Trade Meet</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <iframe width="640" height="360" src="https://www.youtube.com/embed/F1JpGJTdvuo" frameborder="0"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>


<!-- </div> -->
<!-- end lobby -->

<script>
  // $("#modalPresentationMovie").modal('show');
  $('.modal').each(function () {
    let src = $(this).find('iframe').attr('src');

    $(this).on('click', function () {

      $(this).find('iframe').attr('src', '');
      $(this).find('iframe').attr('src', src);

    });
  });
</script>