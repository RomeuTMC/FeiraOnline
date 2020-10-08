<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
$dados=$_SESSION['dados'];
?>
<!-- Translate -->
<div class="flagsTranslate d-none">
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
          <img src="./img/logoAmazing.png" alt="">
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
            <li class="nav-item mr-3 d-none">
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
              <a class="nav-link dropdown-toggle ml-5 btn-in" data-toggle="modal" data-target="#"
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
      <div class="container d-flex flex-wrap flex-column text-center">
        <h1 class="text-title">COUROMODA  <span style="border:4px solid #FFF;line-height:90px;padding:0 12px;">Online</span></h1>
        <h2 class="text-subtitle" style="font-size: 2rem;">O seu evento com mais alcance!</h2>
      </div>
    </div><!-- end row infos -->
  </section>
</section><!-- end top-page -->
<section class="time">
  <div class="container">
    <div class="row py-5 d-flex align-items-center">
      <div class="col-md-12 d-flex flex-column justify-content-center text-center text-lg-left">
        <h1 class="text-time-big" style="font-size: 4rem;">Datas do Evento</h1>
        <p class="text-subtime">02 e 03 de Setembro 2020</p>
        <br>
        <div class="row d-flex justify-content-between p-3">
          <div class="alert alert-secondary" role="alert" style="width: 25rem;">
            <h4 class="alert-heading font-weight-bold">Primeiro Webinar</h4>
            <hr>
            <p class="card-text time">Agenda -> 11:00-11:30 AM</p>
            <p class="card-text time">Agenda -> 10:00-10:30 AM</p>
            <p class="card-text time">Agenda -> 09:00-09:30 AM</p>
          </div> <!-- card 01 -->
          <div class="alert alert-secondary" role="alert" style="width: 25rem;">
            <h4 class="alert-heading font-weight-bold">Reuniões pré-agendadas</h4>
            <hr>
            <p class="card-text time">Agenda -> 11:40 AM- 13:00 PM</p>
            <p class="card-text time">Agenda -> 10:40 AM -12:00 PM</p>
            <p class="card-text time">Agenda -> 09:40-11:00 AM</p>
          </div> <!-- card 02 -->
          <div class="alert alert-secondary" role="alert" style="width: 25rem;">
            <h4 class="alert-heading font-weight-bold">Segundo Webinar</h4>
            <hr>
            <p class="card-text time">Agenda -> 13:15- 14:00 PM</p>
            <p class="card-text time">Agenda -> 12:15-13:00 PM</p>
            <p class="card-text time">Agenda -> 11:15 am-12:00 PM</p>
          </div> <!-- card 03 -->
        </div>
      </div>
      <div class="col-md-6 d-none">
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
                  <img src="./img/f1.png" class="img-fluid" alt="">
                </div>
                <div class="swiper-slide">
                  <img src="./img/f2.png" class="img-fluid" alt="">
                </div>
                <div class="swiper-slide">
                  <img src="./img/f3.png" class="img-fluid" alt="">
                </div>
                <div class="swiper-slide">
                  <img src="./img/f4.png" class="img-fluid" alt="">
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
            <p class="description-about">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
              <br></br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum feugiat molestie felis non porttitor. Fusce eget dignissim ipsum. Fusce venenatis quam eget felis varius finibus. Integer non placerat velit, nec luctus leo. </p>
          </div>
        </div>
      </div>
    </div><!-- end col -->
  </div>
</section><!-- end about -->
<div id="expo" class="d-none"></div>
<section class="exp">
  <div class="container">
    <div class="row">
      <div class="col">
        <h1 class="title-expo my-5 font-weight-bold text-center text-lg-left">expositores</h1>
      </div>
    </div>
    <div class="row">
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
        <h5 class="d-none modal-title text-center w-100 font-weight-light text-uppercase d-none" id="exampleModalLabel">PARTICIPE E
          TENHA A CHANCE DE GANHAR A:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <img src="<?= URL ?>/img/ganhadoresPopUp.jpg" alt="" class="img-fluid">
      </div>
    </div>
  </div>
</div><!-- end modal -->
<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script>
  $(document).ready(function () {
    // $("#modalAwards").modal('show');
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