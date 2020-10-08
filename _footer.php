<?php
if (!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
$_SESSION['rtStop'] = microtime(true);
$time = $_SESSION['rtStop']-$_SESSION['rtStart'];
$_SESSION['exec_time']="".round($time,'3')." - Segundos";
?>

<footer class="footer-page py-5">
  <div class="container">
    <div class="row">
      <div class="col d-flex justify-content-center">
        <a href="https://www.instagram.com/PROMAGNO/" target="_blank">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="https://www.instagram.com/PROMAGNO/" target="_blank">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="https://api.whatsapp.com/send?phone=5511963394482&amp;text=Estou%20com%20algumas%20d%C3%BAvidas%2C%20podem%20me%20auxiliar%3F" target="_blank">
          <i class="fab fa-whatsapp"></i>
        </a>
      </div>
    </div>
    <!-- <div class="row">
    <div class="w-100 text-center">
            <div id="google_translate_element"></div>
        </div>
    </div>
  </div> -->
</footer><!-- end footer -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold w-100 text-center" id="exampleModalLabel">Selecione um dos perfis abaixo e faço seu login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col d-flex justify-content-center">
            <div class="card" style="width: 20rem;">
              <img src="<?= URL ?>/img/img-buyer.jpg" class="card-img-top" alt="...">
              <div class="card-body">
              <?php if(date("Y-m-d")>DATA_FIM_CADASTRO){ ?>
                <a href="https://tmccomunicacao.com.br/feiraonline/buyer" class="btn btn-primary btn-lg btn-block py-4 bg-secondary border-0" role="button" aria-pressed="true"> Visitante</a>
              <?php } else { ?>
                <a href="https://tmccomunicacao.com.br/feiraonline/cliente" class="btn btn-primary btn-lg btn-block py-4 bg-secondary border-0" role="button" aria-pressed="true"> Visitante</a>
              <?php } ?>
              </div>
            </div> <!-- 01 -->
          </div>
          <div class="col d-flex justify-content-center">
            <div class="card" style="width: 20rem;">
              <img src="<?= URL ?>/img/img-seller.jpg" class="card-img-top" alt="...">
              <div class="card-body">
              <?php if(date("Y-m-d")>DATA_FIM_CADASTRO){ ?>
                <a href="https://tmccomunicacao.com.br/feiraonline/seller" class="btn btn-primary btn-lg btn-block py-4 bg-secondary border-0" role="button" aria-pressed="true">Expositor</a>
                <?php } else { ?>
                <a href="https://tmccomunicacao.com.br/feiraonline/expositor" class="btn btn-primary btn-lg btn-block py-4 bg-secondary border-0" role="button" aria-pressed="true">Expositor</a>
                <?php } ?>
              </div>
            </div> <!-- 02 -->
          </div>
        </div>

      </div>
    </div>
  </div>
</div><!-- end modal -->
<script>
  $(document).ready(function () {

    $(window).scroll(function () {
      let scroll = $(window).scrollTop();
      if (scroll >= 100) {
        $('.navbar').addClass('bgAnchor');
        $('.btn-in').addClass('bgIn');
        $('.navbar-brand').addClass('navbarbrandSize');
      } else {
        $('.navbar').removeClass('bgAnchor');
        $('.btn-in').removeClass('bgIn');
        $('.navbar-brand').removeClass('navbarbrandSize');
      }
    });

    let offsetHeight = document.getElementById('navigation').offsetHeight;

    $('a[href*="#"]')
      // Remove links that don't actually link to anything
      .not('[href="#"]')
      .not('[href="#0"]')
      .click(function (event) {
        // On-page links
        if (
          location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
          location.hostname == this.hostname
        ) {
          // Figure out element to scroll to
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
          // Does a scroll target exist?
          if (target.length) {
            // Only prevent default if animation is actually gonna happen
            event.preventDefault();
            $('html, body').animate({
              scrollTop: target.offset().top - offsetHeight
            }, 1000, function () {
              // Callback after animation
              // Must change focus!
              var $target = $(target);
              $target.focus();
              if ($target.is(":focus")) { // Checking if the target was focused
                return false;
              } else {
                $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                $target.focus(); // Set focus again
              };
            });
          }
        }
      });

    // validate contact form home
    $('#contactForm').validate({
      rules: {
        email: {
          required: true,
          email: true,
        },
      },
      messages: {
        email: 'Please enter a valid email address',
      },
    });
  });
</script>

<?php
  if(AMBIENTE == "DEVELOPER"){
    __out("SAIDA FINALIZADA COM SUCESSO", 200);
  } else {
    echo "";
  }
?>
