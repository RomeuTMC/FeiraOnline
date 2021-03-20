<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED'); ?>
<!-- Translate -->
<div class="flagsTranslate">
  <a href="https://www.thailatintrademeet.com/">EN</a>
  <a href="https://www.thailatintrademeet.com/main/pt" style="color: #FDB31C">BR</a>
  <a href="https://www.thailatintrademeet.com/main/es">ES</a>
</div>
<!-- end translate -->

<section class="top-page" id="init">
  <section class="container">
    <div class="row m-0">
      <nav class="navbar navbar-expand-lg fixed-top navbar-dark m-0" id="navigation">
        <a class="navbar-brand" href="#">
          <img src="https://www.thailatintrademeet.com/img/logoAmazing.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
          aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">

          <ul class="navbar-nav align-items-center ml-auto text-uppercase">

            <li class="nav-item mr-3">
              <a class="nav-link" href="#init">Home</a>
            </li>
            <li class="nav-item mr-3">
              <a class="nav-link" href="#about">Sobre</a>
            </li>
            <li class="nav-item mr-3">
              <a class="nav-link" href="#awards">Premiação</a>
            </li>
            <li class="nav-item mr-3 d-none">
              <a class="nav-link" href="#expo">Exhibitor</a>
            </li>
            <li class="nav-item mr-3">
              <a class="nav-link" href="#contact">Contato</a>
            </li>
            <?php if(date("Y-m-d")>DATA_FIM_CADASTRO){ ?>
            <li class="nav-item" data='DATA MAIOR'>
              <a class="nav-link dropdown-toggle text-lowercase ml-5 btn-in" data-toggle="modal" data-target="#"
                href="#exampleModal">
                Login <img src="<?= URL ?>/img/arrow-right.svg" alt="" class="btn-arrow">
              </a>
            </li> <?php
            } else { ?>
            <li class="nav-item">
              <a class="nav-link dropdown-toggle text-lowercase ml-5 btn-in" data-toggle="modal" data-target="#"
                href="#exampleModal">
                Inscreva-se <img src="https://www.thailatintrademeet.com/img/arrow-right.svg" alt="" class="btn-arrow">
              </a>
            </li><?php
            }
            ?>
          </ul>
        </div>
      </nav><!-- navigation -->
    </div> <!-- end row -->
    <div class="row">
      <div class="container d-flex flex-wrap flex-column">
        <h1 class="text-title">Amazing Thailand Virtual Trade Meet</h1>
        <h2 class="text-subtitle" style="font-size: 2rem;">(Viagens de Luxo e Lua de Mel): Edição Latino Americana</h2>
      </div>
    </div><!-- end row infos -->
  </section>
</section><!-- end top-page -->
<section class="time">
  <div class="container">
    <div class="row py-5 d-flex align-items-center">
      <div class="col-md-6 d-flex flex-column justify-content-center text-center text-lg-left">
        <h1 class="text-time-big" style="font-size: 4rem;">Datas do Evento</h1>
        <p class="text-subtime">02 e 03 de Setembro 2020 <br>(Quarta e Quinta-feira)</p>
        <small class="text-subtime-small mb-5">11:00 am -14:00 pm (BR/AR Time GMT-3)</small>
        <div class="row d-flex justify-content-between p-3">
          <div class="alert alert-secondary" role="alert" style="width: 30rem;">
            <h4 class="alert-heading font-weight-bold">Primeiro Webinar</h4>
            <hr>
            <p class="card-text time">Agenda -> 11:00-11:30 am (Fuso Horário BR/AR , GMT-3)</p>
            <p class="card-text time">Agenda -> 10:00-10:30 am (Fuso Horário CL, GMT-4)</p>
            <p class="card-text time">Agenda -> 09:00-09:30 am (Fuso Horário CO/PE, GMT-5)</p>
          </div> <!-- card 01 -->
          <div class="alert alert-secondary" role="alert" style="width: 30rem;">
            <h4 class="alert-heading font-weight-bold">Reuniões pré-agendadas</h4>
            <hr>
            <p class="card-text time">Agenda -> 11:40 am- 13:00 pm (BR/AR Time, GMT-3)</p>
            <p class="card-text time">Agenda -> 10:40 am -12:00 pm (CL Time, GMT-4</p>
            <p class="card-text time">Agenda -> 09:40-11:00 am (CO/PE Time, GMT-5)</p>
          </div> <!-- card 02 -->
          <div class="alert alert-secondary" role="alert" style="width: 30rem;">
            <h4 class="alert-heading font-weight-bold">Segundo Webinar</h4>
            <hr>
            <p class="card-text time">Agenda -> 13:15- 14:00 pm (BR/AR Time, GMT-3</p>
            <p class="card-text time">Agenda -> 12:15-13:00 pm (CL Time, GMT-4)</p>
            <p class="card-text time">Agenda -> 11:15 am-12:00 pm (CO/PE Time, GMT-5)</p>
          </div> <!-- card 03 -->
        </div>
      </div>
      <div class="col-md-6">
        <img src="https://www.thailatintrademeet.com/img/img-time.jpg" alt="Datas e horários" class="my-5 img-fluid">
      </div>
    </div>
  </div>
</section><!-- end time -->
<section class="about">
  <div class="row m-0">
    <div class="col-md-6 about-left d-none d-lg-block">
      <div class="container">
        <div class="row">
          <div class="col-9 offset-2">
            <!-- Slider main container -->
            <div class="swiper-container">
              <!-- Additional required wrapper -->
              <div class="swiper-wrapper">
                <!-- Slides -->
                <div class="swiper-slide">
                  <img src="https://www.thailatintrademeet.com/img/f1.png" class="img-fluid" alt="">
                </div>
                <div class="swiper-slide">
                  <img src="https://www.thailatintrademeet.com/img/f2.png" class="img-fluid" alt="">
                </div>
                <div class="swiper-slide">
                  <img src="https://www.thailatintrademeet.com/img/f3.png" class="img-fluid" alt="">
                </div>
                <div class="swiper-slide">
                  <img src="https://www.thailatintrademeet.com/img/f4.png" class="img-fluid" alt="">
                </div>
                <div class="swiper-slide">
                  <img src="https://www.thailatintrademeet.com/img/f5.png" class="img-fluid" alt="">
                </div>
                <div class="swiper-slide">
                  <img src="https://www.thailatintrademeet.com/img/f6.png" class="img-fluid" alt="">
                </div>
              </div>
            </div>
            <!--  -->
          </div>
        </div>
      </div>
    </div>
    <!-- end col -->
    <div id="about"></div>
    <div class="col-md-12 col-lg-6 about-right d-flex flex-column justify-content-center">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-9">
            <p class="text-about">Sobre a</p>
            <h1 class="text-about-big">Feira</h1>
            <p class="description-about">O Amazing Thailand Virtual Trade Meet (Luxury and Honeymoon): Lain America
              Chapter é a primeira feira de turismo virtual organizada pela Autoridade de Turismo da Tailândia – TAT
              para profissionais de turismo na América do Sul. Esta é uma oportunidade única para você e sua empresa
              conhecer um pouco mais sobre a Tailândia e seus melhores players no setor de viagens e turismo (incluindo
              hotéis, atrações turísticas, prestadores de serviços, etc.) sob uma mesma plataforma de negócios. Registre
              sua empresa hoje e garanta sua participação. O período de inscrição é de 07 a 21 de agosto de 2020.
              <br></br> Solicita-se aos participantes que preencham o formulário de inscrição on-line clicando em
              Inscreva-se e registrando-se como Comprador (Buyer). Sua inscrição é muito importante, pois nos ajuda a
              identificar suas necessidades e interesses.</p>
          </div>
        </div>
      </div>
    </div><!-- end col -->
  </div>
</section><!-- end about -->
<div id="awards"></div>
<section class="event d-flex flex-column justify-content-center">
  <div class="container ">
    <div class="row">
      <div class="col">
        <h1 class="event-title mb-5">Participe e concorra a uma chance de ganhar:</h1>
        <div class="card">
          <div class="card-body">
            <h5 class="card-title font-weight-bold">Uma viagem para 2 à Tailândia incluindo passagens aéreas.</h5>
            <p class="card-text">(Saída de São Paulo/GRU incluindo 6 [seis] noites de acomodação em Bangkok; Traslados e
              City Tour). Aplicam-se restrições.</p>
            <hr>
            <h5 class="card-title font-weight-bold">Participe para ganhar um dos 15 vale-compras:</h5>
            <p class="card-text">Valorado em R$ 300,00 (ou o equivalente à Usd 60.00 [sessenta dólares] nos demais
              países sul-americanos para uso em qualquer estabelecimento do Grupo Pão de Açúcar no Brasil e/ou Tiendas
              Jumbo e/ou Carullo nos demais países participantes.</p>
            <br><br>
            <small>* Os participantes serão elegíveis ao sorteio, tendo completado toda a sua agenda de compromissos
              pré-agendados, bem como os seminários on-line lhe designado.</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> <!-- end event -->
<div id="expo" class="d-none"></div>
<section class="exp d-none">
  <div class="container">
    <div class="row">
      <div class="col">
        <h1 class="title-expo my-5 font-weight-bold text-center text-lg-left">expositores</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 text-center">
        <img src="<?php URL ?>/img/temp-logo-expo.png" alt="" class="logo-expo w-100">
      </div>
      <div class="col-md-3 text-center">
        <img src="./img/temp-logo-expo.png" alt="" class="logo-expo w-100">
      </div>
      <div class="col-md-3 text-center">
        <img src="./img/temp-logo-expo.png" alt="" class="logo-expo w-100">
      </div>
      <div class="col-md-3 text-center">
        <img src="./img/temp-logo-expo.png" alt="" class="logo-expo w-100">
      </div>
      <div class="col-md-3 text-center">
        <img src="./img/temp-logo-expo.png" alt="" class="logo-expo w-100">
      </div>
      <div class="col-md-3 text-center">
        <img src="./img/temp-logo-expo.png" alt="" class="logo-expo w-100">
      </div>
      <div class="col-md-3 text-center">
        <img src="./img/temp-logo-expo.png" alt="" class="logo-expo w-100">
      </div>
      <div class="col-md-3 text-center">
        <img src="./img/temp-logo-expo.png" alt="" class="logo-expo w-100">
      </div>
      <div class="col-md-3 text-center">
        <img src="./img/temp-logo-expo.png" alt="" class="logo-expo w-100">
      </div>
      <div class="col-md-3 text-center">
        <img src="./img/temp-logo-expo.png" alt="" class="logo-expo w-100">
      </div>
      <div class="col-md-3 text-center">
        <img src="./img/temp-logo-expo.png" alt="" class="logo-expo w-100">
      </div>
      <div class="col-md-3 text-center">
        <img src="./img/temp-logo-expo.png" alt="" class="logo-expo w-100">
      </div>
      <div class="col-md-3 text-center">
        <img src="./img/temp-logo-expo.png" alt="" class="logo-expo w-100">
      </div>
      <div class="col-md-3 text-center">
        <img src="./img/temp-logo-expo.png" alt="" class="logo-expo w-100">
      </div>
      <div class="col-md-3 text-center">
        <img src="./img/temp-logo-expo.png" alt="" class="logo-expo w-100">
      </div>
      <div class="col-md-3 text-center">
        <img src="./img/temp-logo-expo.png" alt="" class="logo-expo w-100">
      </div>
      <div class="col-md-3 text-center">
        <img src="./img/temp-logo-expo.png" alt="" class="logo-expo w-100">
      </div>
      <div class="col-md-3 text-center">
        <img src="./img/temp-logo-expo.png" alt="" class="logo-expo w-100">
      </div>
      <div class="col-md-3 text-center">
        <img src="./img/temp-logo-expo.png" alt="" class="logo-expo w-100">
      </div>
      <div class="col-md-3 text-center">
        <img src="./img/temp-logo-expo.png" alt="" class="logo-expo w-100">
      </div>
    </div>
  </div>
</section> <!-- end expo -->
<div id="contact"></div>
<section class="contact">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-7 text-center text-lg-left d-flex justify-content-center flex-column">
        <h2 class="contact-title">Precisa ajuda?</h2>
        <h3 class="contact-subtitle">Contate-nos</h3>
      </div>
      <div class="col-md-12 col-lg-5">
        <form id="contactForm" action="https://www.thailatintrademeet.com/contato/save/0" method="POST">
          <input type="hidden" name="redirect" value="https://www.thailatintrademeet.com">
          <div class="form-group">
            <label>Nome</label>
            <input type="text" name="cName" class="form-control">
          </div><!-- nome -->
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="cEmail" id="email" class="form-control" required>
            <small id="emailHelp" class="form-text text-muted">Não compartilharemos seus dados com ninguém.</small>
          </div> <!-- email -->
          <div class="form-group">
            <label>Telefone Celular</label>
            <input type="text" name="cTel" class="form-control">
          </div><!-- nome -->
          <div class="form-group">
            <label>Mensagem</label>
            <textarea type="textarea" name="tMensagem" class="form-control"></textarea>
          </div><!-- nome -->
          <button type="submit" class="btn btn-primary submitContact">
            enviar <img src="https://www.thailatintrademeet.com/img/arrow-right-black.svg" alt=""
              class="btn-arrow-black"></button>
        </form>
      </div>
    </div>
  </div>
</section><!-- end contact -->
<div class="modal fade" id="modalAwards" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center w-100 font-weight-light text-uppercase" id="exampleModalLabel">PARTICIPE E
          TENHA A CHANCE DE GANHAR A:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="https://thailatintrademeet.com/img/popUp-pt.jpg" alt="" class="img-fluid">
      </div>
    </div>
  </div>
</div><!-- end modal -->
<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script>
  $(document).ready(function () {
    $("#modalAwards").modal('show');
    var mySwiper = new Swiper('.swiper-container', {
      direction: 'vertical',
      initialSlide: 2,
      slidesPerView: 2,
      loop: true,
      spaceBetween: 320,
      autoplay: {
        delay: 0,
        disableOnInteraction: true,
      },
      speed: 20000
    });
  });
</script> <!-- end script -->
<?php include './_footer.php'; ?>