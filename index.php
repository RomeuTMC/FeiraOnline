<?php
require_once("_configure.php"); // Carrega as funções e configurações globais
require_once(_FS."_auth.php"); //Verifica se esta LOGADO, se não está DIRECIONA PARA LOGIN
require_once(_FS."_route.php"); //TRATA a VARIAVEL $route para chamar o VIEW e CONTROL padrão
if(file_exists(_FS."_controls/".$_SESSION['control']."_control.php")){
    require_once(_FS."_controls/".$_SESSION['control']."_control.php");
} else {
    if(AMBIENTE == 'DEVELOPER'){
        echo ($_SESSION['control']."_control.php");
    } else {
        $_SESSION['control']='dashboard';
        $_SESSION['view']='list';
        $_SESSION['erro_no']='2';
        $_SESSION['erro']='CHAMADA PARA PROCEDIMENTO INVÁLIDO';
    }
}
if(isset($_GET['erro_no'])){
    $_SESSION['erro']=filter_var($_GET['erro'],515);
    $_SESSION['erro_no']=filter_var($_GET['erro_no'],519);
}
?>
<!DOCTYPE html>

    <head>
        <meta charset="UTF-8">
        <meta local='RAIZ'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta name="google-site-verification" content="lwhjBq1Newn4vJWEU1Lx_0zaKWPWd4GlgDgg8PpPgL8" />
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-176447911-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-176447911-1');
</script>
        <title><?php echo SISTEM; ?></title>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script> -->
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
        <!-- end slider -->

    </head>

    <body data-spy="scroll" data-target=".navbar" data-offset="170">
        <div id="loader" style="display: block;"></div>
        <script>
            var spinner = $('#loader');
            spinner.hide();
        </script>
        <header><?php echo(show_erro()); $_SESSION['erro']=0;?>
            <script>
                if (eShow == 'S') {
                    Swal.fire({
                        title: sTitulo,
                        html: sMens,
                        icon: sIcon,
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'Close'
                    })
                }
            </script>
        </header>
        <section>
            <div class=main>
                <?php
               //INCLUI CONFORME A CHAMADA DO ROTEAMENTO
               if(file_exists(_FS."_views/".$_SESSION['control'].'_'.$_SESSION['view']."_view.php")){
                require_once(_FS."_views/".$_SESSION['control'].'_'.$_SESSION['view']."_view.php");
               } else {
                if(AMBIENTE == 'DEVELOPER') {
                    echo "VIEW INEXISTENTE->".$_SESSION['control'].'_'.$_SESSION['view']."_view.php";
                  } else {
                    require_once(_FS."_views/dashboard_list"."_view.php");
                  }
               }
            ?>
            </div>
        </section>

<!--
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
 -->


    </body>

</html>
<?php
    require_once(_FS."_footer.php"); // Finaliza o script fechando as conexões e dando a saida do DEBUG
?>