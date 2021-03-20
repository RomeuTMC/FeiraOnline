<?php if(!isset($TRUE) or ($TRUE<>"index.php")) die("LOCKED"); 
logado('ADMIN');
$dados=$_SESSION['dados']; 
?>
<div class="d-flex flex-row">
  <div class="col mx-auto">
    <div class="table-responsive">
      <form method="POST" action="<?php echo(ADMIN."administrador/save/".$dados['nId']);?>" id="id_form_administradores" name="form_administradores">
      <fieldset class="frm_field">
        <legend><?php echo($dados['titulo']);?></legend>
                <input type="hidden" id="id_nId" name="nId" value="<?php echo($dados['nId']);?>">
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Nome Completo</label>
                <input type="text" class="form-control" id="id_wNome" name="wNome" value="<?php echo($dados['wNome']);?>" maxlength=150>
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">E-Mail de Login</label>
                <input type="text" class="form-control" id="id_wLogin" name="wLogin" value="<?php echo($dados['wLogin']);?>" maxlength=150 autocomplete="username">
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Senha</label>
                <input type="password" class="form-control" id="id_sSenha" name="sSenha" value="<?php echo($dados['sSenha']);?>" maxlength=15 autocomplete="new-password">
              </div>
              <div class="form-group p-2">
                <label for="message-text" class="col-form-label">Confirmação de Senha</label>
                <input type="password" class="form-control" id="id_sSenha2" name="sSenha2" value="<?php echo($dados['sSenha']);?>" maxlength=15>
              </div>
              <div class="form-group">
                <label for="ShowS" class="col-form-label">Mostrar Senha</label>
                <input type="checkbox" onclick="MostraSenha()" id="ShowS">
              </div>
        <div class="form-group">
          <button type='button' class="btn btn-secondary" onclick="ClickCancel()">Cancelar</Button>
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </fieldset>
      </form>
    </div>
  </div>
</div>

<script languege="javascript">
function ClickCancel(){
  Swal.fire({
        title: "Confirmar Cancelamento?",
        html: "Ao confirmar, <b>TODAS</b> as alterações desta tela serão perdidas. Confirma?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonText: "Cancelar",
        confirmButtonText: 'Confirmar!'
      })
      .then((result) => {
        if (result.value) {
          spinner.show();
          window.location.href = '<?php echo(ADMIN."/administrador"); ?>'
        }
      });
}

$("#id_form_administradores").validate({
    submitHandler: function(form) {
      // do other things for a valid form
      spinner.show();
      id_form_administradores.submit();    
    },
    rules: {
      wNome: {
        required: true,
        minlength: 6,
        maxlength: 150
      },
      wLogin: {
        required: true,
        minlength: 6,
        maxlength: 150
      },
      sSenha: {
        required: true,
        minlength: 6,
        maxlength: 15
      },
      sSenha2: {
        required: true,
        minlength: 6,
        maxlength: 15,
        equalTo: "#id_sSenha"
      }
    },
    messages: {
      wNome: {
        required: "Campo Obrigatório",
        minlength: "Tamanho mínimo 6 Caracteres",
        maxlength: "Tamanho Máximo 150 Caracteres"
      },
      wLogin: {
        required: "Campo Obrigatório",
        minlength: "Tamanho Minimo 6 Caracteres",
        maxlength: "Tamanho Máximo 15 Caracteres"
      },
      sSenha: {
        required: "Campo Obrigatório",
        minlength: "Tamanho Mínimo 6 Caracteres",
        maxlength: "Tamanho Máximo 15 Caracteres",
      },
      sSenha2: {
        required: "Campo Obrigatório",
        minlength: "Tamanho Mínimo 6 Caracteres",
        maxlength: "Tamanho Máximo 15 Caracteres",
        equalTo: "Campos Senha devem ser IDÊNTICOS"
      }
    }
  });

  function MostraSenha() {
    var x = document.getElementById('id_sSenha');
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
    var x = document.getElementById('id_sSenha2');
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
</script>