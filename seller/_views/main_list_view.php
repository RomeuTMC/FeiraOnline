<?php if(!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED'); ?>
        <div class=principal>
          <div class="container-fluid">
            <div class="row no-gutter">
              <div class="col-md-6 d-flex flex-column justify-content-center">
                <div class="login d-flex align-items-center py-5">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-9 col-lg-8 mx-auto">
                        <div class="w-100 text-center mb-5">
                          <img src="<?php echo URL;?>img/logo.png" alt="" class="m-16 d-md-none">
                        </div>
                        <h3 class="login-heading color-pink text-center text-md-left font-weight-bold">Expositor Login</h3>
                        <h1 class="login-heading mb-4 color-pink text-center text-md-left font-weight-bold"><?php echo SISTEM;?></h1>
                        <form method="POST" action="<?php echo(ADMIN.'main/login'); ?>" id="formLogin">
                          <div class="form-group">
                            <input type="email" name="login" id="name" class="form-control rounded-0 py-4"
                              placeholder="Enter your email" autocomplete="username">
                          </div>
                          <div class="form-group">
                            <input type="password" name="senha" id="senha" class="form-control rounded-0 py-4"
                              placeholder="Enter your password" autocomplete="current-password">
                          </div>
                          <div class="form-group form-check p-0">
                            <label class="form-check-label text-muted change-senha">
                              <input type="checkbox" class="mr-2" onclick="myFunction()">Mostrar Senha</label>
                          </div>
                          <button class="btn btn-lg btn-primary btn-block btn-login py-3 mb-2 border-0"
                            type="submit">Log in</button>
                        </form>
                        <p class="mt-5 mb-3 text-muted"><small><b><?= SISTEM." - ".SIS_VER; ?></b></small></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end col -->
              <div class="col-md-6 bg-image d-none d-md-block d-md-flex justify-content-center align-items-center d-md-flex">
                <img src="<?php echo URL;?>img/logoAmazing.png" alt="" class="pt-5 ">
                <div class="overlay-bg-image"></div>
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
          </div>
          <!-- end container -->

          <script>
            $(function () {
              $(window).resize(function () {
                const elem = $(this);
                $('.principal').height(elem.height());
              });
              $(window).resize();
            });

            function myFunction() {
              var x = document.getElementById("senha");
              if (x.type === "password") {
                x.type = "text";
              } else {
                x.type = "password";
              }
            }

            $("#formLogin").validate({
              rules: {
                username: {
                  required: true,
                  minlength: 2
                },
                password: {
                  required: true,
                  minlength: 5
                }
              },
              messages: {
                username: {
                  required: "Please enter a username",
                  minlength: "Your username must consist of at least 2 characters"
                },
                password: {
                  required: "Please provide a password"
                }
              }
            });
          </script>
        </div>