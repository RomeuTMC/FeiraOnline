<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED'); ?>

<!-- Translate -->
<div class="flagsTranslate">
  <a href="https://www.thailatintrademeet.com/">EN</a>
  <a href="https://www.thailatintrademeet.com/main/pt">BR</a>
  <a href="https://www.thailatintrademeet.com/main/es" style="color: #FDB31C">ES</a>
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
              <a class="nav-link" href="#about">Sobre la Feria</a>
            </li>
            <li class="nav-item mr-3">
              <a class="nav-link" href="#awards">Premios</a>
            </li>
            <li class="nav-item mr-3 d-none">
              <a class="nav-link" href="#expo">Exhibitor</a>
            </li>
            <li class="nav-item mr-3">
              <a class="nav-link" href="#contact">Contacto</a>
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
                Suscribirse <img src="<?= URL ?>/img/arrow-right.svg" alt="" class="btn-arrow">
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
        <h2 class="text-subtitle">(Viajes de Lujo y Luna de Miel): Edición Latinoamérica</h2>
      </div>
    </div><!-- end row infos -->
  </section>
</section><!-- end top-page -->
<section class="time">
  <div class="container">
    <div class="row py-5 d-flex align-items-center">
      <div class="col-md-6 d-flex flex-column justify-content-center text-center text-lg-left">
        <h1 class="text-time-big" style="font-size: 4rem;">Fechas del Evento</h1>
        <p class="text-subtime">02 y 03 de Septiembre 2020 <br>(Miércoles y Jueves)</p>
        <small class="text-subtime-small mb-5">11:00 am -14:00 pm (BR/AR Time GMT-3)</small>
        <div class="row d-flex justify-content-between p-3">
          <div class="alert alert-secondary" role="alert" style="width: 30rem;">
            <h4 class="alert-heading font-weight-bold">Seminario Web 1</h4>
            <hr>
            <p class="card-text time" style="font-size:.9rem;">Horario -> 11:00-11:30 am (Zona Horaria BR/AR , GMT-3)
            </p>
            <p class="card-text time" style="font-size:.9rem;">Horario -> 10:00-10:30 am (Zona Horaria CL, GMT-4)</p>
            <p class="card-text time" style="font-size:.9rem;">Horario -> 09:00-09:30 am (Zona Horaria CO/PE, GMT-5)</p>
          </div> <!-- card 01 -->
          <div class="alert alert-secondary" role="alert" style="width: 30rem;">
            <h4 class="alert-heading font-weight-bold">Citas Preprogramadas</h4>
            <hr>
            <p class="card-text time" style="font-size:.9rem;">Horario -> 11:40 am - 13:00 pm (Zona Horaria BR/AR ,
              GMT-3)</p>
            <p class="card-text time" style="font-size:.9rem;">Horario -> 10:40 am -12:00 pm (Zona Horaria CL, GMT-4)
            </p>
            <p class="card-text time" style="font-size:.9rem;">Horario -> 09:40-11:00 am (Zona Horaria CO/PE, GMT-5)</p>
          </div> <!-- card 02 -->
          <div class="alert alert-secondary" role="alert" style="width: 30rem;">
            <h4 class="alert-heading font-weight-bold">Seminario Web 2 </h4>
            <hr>
            <p class="card-text time" style="font-size:.9rem;">Horario -> 13:15- 14:00 pm (Zona Horaria BR/AR , GMT-3)
            </p>
            <p class="card-text time" style="font-size:.9rem;">Horario -> 12:15-13:00 pm (Zona Horaria CL, GMT-4)</p>
            <p class="card-text time" style="font-size:.9rem;">Horario -> 11:15 am-12:00 pm (Zona Horaria CO/PE, GMT-5)
            </p>
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
            <p class="text-about">Sobre la</p>
            <h1 class="text-about-big">Feria</h1>
            <p class="description-about">El Amazing Thailand Virtual Trade Meet (Luxury and Honeymoon): Latin America
              Chapter es la primera edición de la feria en línea organizada por la Autoridad de Turismo de Tailandia
              para profesionales del turismo en Sudamérica. Esta es una oportunidad única para que su empresa conozca un
              poco más sobre Tailandia y algunas de sus mejores empresas de la industria de viajes (como hoteles,
              atracciones, proveedores de servicios, etc.) en la misma plataforma de negocios. Registre ahora mismo su
              empresa y garantice su participación. Tenga en cuenta que el período de registro es del 07 al 21 de agosto
              de 2020. <br><br>Se solicita a los participantes que completen el formulario de registro en línea haciendo
              clic en Registrarse y registrándose como Comprador (Buyer). Su aplicación es muy importante, ya que nos
              ayuda a identificar sus necesidades e intereses.</p>
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
        <h1 class="event-title mb-5">Participa y compite por la oportunidad de ganar:</h1>
        <div class="card">
          <div class="card-body">
            <h5 class="card-title font-weight-bold">Un viaje para 2 personas a Tailandia incluyendo boletos aéreos.</h5>
            <p class="card-text">(Salida desde São Paulo / GRU incluyendo 6 [seis] noches de alojamiento en Bangkok;
              Traslados y City Tour). Se aplican restricciones.</p>
            <hr>
            <h5 class="card-title font-weight-bold">Participe para ganar una de las 15 tarjetas de regalo:</h5>
            <p class="card-text">Valoradas en R$ 300.00 (o el equivalente de Usd 60.00 [sesenta dólares] en los otros
              países sudamericanos para su uso en cualquier establecimiento del Grupo Pão de Açúcar en Brasil y/o
              Tiendas Jumbo y/o Carullo en los otros países participantes.</p>
            <br><br>
            <small>* Los participantes serán elegibles para el sorteo, habiendo completado su horario completo de citas
              preprogramadas, así como los seminarios en línea asignados a ellos.</small>
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
        <h2 class="contact-title">¿Necesita ayuda?</h2>
        <h3 class="contact-subtitle">Contáctenos</h3>
      </div>
      <div class="col-md-12 col-lg-5">
        <form id="contactForm" action="https://www.thailatintrademeet.com/contato/save/0" method="POST">
          <input type="hidden" name="redirect" value="https://www.thailatintrademeet.com">
          <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="cName" class="form-control">
          </div><!-- nome -->
          <div class="form-group">
            <label>Correo Electrónico</label>
            <input type="email" name="cEmail" id="email" class="form-control" required>
            <small id="emailHelp" class="form-text text-muted">No compartiremos sus datos con nadie.</small>
          </div> <!-- email -->
          <div class="form-group">
            <label>Teléfono Móvil</label>
            <input type="text" name="cTel" class="form-control">
          </div><!-- nome -->
          <div class="form-group">
            <label>Mensaje</label>
            <textarea type="textarea" name="tMensagem" class="form-control"></textarea>
          </div><!-- nome -->
          <button type="submit" class="btn btn-primary submitContact">
            Enviar <img src="https://www.thailatintrademeet.com/img/arrow-right-black.svg" alt=""
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
        <h5 class="modal-title text-center w-100 font-weight-light text-uppercase" id="exampleModalLabel">Participa y
          compite por la oportunidad de ganar:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="https://thailatintrademeet.com/img/popUp-es.jpg" alt="" class="img-fluid">
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