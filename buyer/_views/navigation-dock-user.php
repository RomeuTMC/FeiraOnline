<script>
function show_info_app(){
  Swal.fire({
        title: "Atenção!",
        html: "<h2>Requisitos básicos</h3>Para garantir o sucesso do seu agendamento utilize o navegador compatível com a plataforma:<br><br>- Google Chrome<br>O navegador oficial das reuniões<br><br>Após abrir o compromisso, certifique-se de habilitar e permitir a câmera e o microfone pelo navegador.<br><br><span>Se o link de acesso ao compromisso estiver desativado durante o horário de funcionamento, pressione o botão <b>[Ctrl]+[F5]</b><i>(Command + Shift + R) On MacOs </i> <br>para recarregar a página.</span><br><br>Tenha uma boa reunião!",
        icon: "warning",
        showCancelButton: false,
        confirmButtonColor: "#d33",
        confirmButtonText: "OK"
      });
}
</script>
<div class="footer-user-content">
<div class="footer-user">
  <a href="#" aria-hidden="true"  data-toggle="modal" data-target="#HelpDeskModal" class="dock-link"><i class="fa fa-2x fa-commenting-o" aria-hidden="true"></i>Informações</a>
  <a href="#" aria-hidden="true"  data-toggle="modal" data-target="#AgendaModal" class="dock-link"><i class="fa fa-2x fa-book" aria-hidden="true"></i>Agenda</a>
  <a href="<?php echo(ADMIN."dashboard/");?>" class="dock-link"><i class="fa fa-2x fa-sitemap" aria-hidden="true"></i>Expo 3D</a>
  <a href="#" aria-hidden="true"  data-toggle="modal" data-target="#appointmentsModal" onclick='show_info_app()' class="dock-link"><i class="fa fa-2x fa-video-camera"></i>Reuniões</a>
  <!-- <a href="<?php echo(ADMIN."dashboard/stands");?>" class="dock-link"><i class="fa fa-2x fa-map-o" aria-hidden="true"></i>Stands</a> -->
  <!-- <a href="<?php echo(ADMIN."dashboard/");?>" class="dock-link"><i class="fa fa-2x fa-university" aria-hidden="true"></i> Booth</a> -->
  <a href="<?php echo(ADMIN."dashboard/webinar");?>" class="dock-link"><i class="fa fa-2x fa-laptop" aria-hidden="true"></i>Webinar</a>
  <a href="<?php echo(ADMIN."dashboard/networking");?>" class="dock-link"><i class="fa fa-2x fa-comments-o" aria-hidden="true"></i>Networking</a>
  <a href="<?php echo(ADMIN."dashboard/myaccount/".$dados['id']);?>" class="dock-link"><i class="fa fa-2x fa-cogs" aria-hidden="true"></i> Minha conta</a>
  <!-- <a href="exhibit.php" class="dock-link"><i class="fa fa-2x fa-sitemap" aria-hidden="true"></i> Hall</a> -->
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="appointmentsModal" tabindex="-1" aria-labelledby="appointmentsModal" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title font-weight-bold w-100" id="exampleModalLabel">Lista de reuniões</h3>
        <a href="#" onclick='show_info_app()' class="m-auto btn btn-danger">Instruções</a>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- INICIO DA AGENDA -->
<?php if(count($dados['apoints'])>0){ ?>

<div class='appointments'>
<table class='table'>
<thead class="thead-dark">
    <tr>
      <th scope="col">Day</th>
      <th scope="col">Hour</th>
      <th scope="col">Seller</th>
      <th scope="col">Avaliação</th>
      <th scope="col" style="width:10rem;">Access Meeting</th>
    </tr>
  </thead>
  <tbody>

<?php foreach($dados['apoints'] as $v){
  $idexpo=str_pad($v['expo'],3,'0', STR_PAD_LEFT);
  $idclie=str_pad($v['buye'],5,'0', STR_PAD_LEFT);
  ?>
    <tr>
      <th scope="row"><?php echo($v['eDay']);?></th>
      <td><?php echo($v['tHora']);?></td>
      <td><?php echo($v['cName']);?></td>
      <td><?php echo($v['avaliacao']);?></td>
      <td><a href="" onClick="window.open('<?php echo(URL.'salappts/?day='.$v['eDay'].'&start='.$v['tHora'].'&sala=help&user=cli'.$idclie.'&stat=CLI#thai'.$idexpo.'c'.$idclie); ?>', '_blank')" class='btn btn-success btn-block <?php
      $ta=date('Y-m-d H:i');
      $tm='2020-'.$v['eDay'].' '.$v['tHora'];
      //echo $ta.'___'.$tm;
      if($tm>$ta){ echo 'disabled2'; } ?>'>Access</a>
      <a href='https://www.thailatintrademeet.com/buyer/dashboard/stand/<?php echo $v['expo'];?>#open' target=_blank class='btn btn-success btn-block'>Go to Stand Chat</a>
    </tr>
<?php } ?>

</tbody>
</table>
</div>
<!-- FIM DA AGENDA -->
<?php } else {
  // caso não tenha a agenda ?>
  <!-- <p>SEM AGENDA</p> -->
<?php } ?>
      </div>

    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="HelpDeskModal" tabindex="-1" aria-labelledby="HelpDeskModal" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title font-weight-bold" id="exampleModalLabel">Help Desk</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div style="width:1000px;height:450px;margin:0 auto;">
      <script src="https://html5-chat.com/script/25952/<?=$dados['help']; ?>"></script>
      </div>
</div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="AgendaModal" tabindex="-1" aria-labelledby="AgendaModal" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title font-weight-bold" id="exampleModalLabel">Schedule</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row d-flex justify-content-center p-3">
      <div class="alert alert-secondary" role="alert" style="width: 25rem;">
            <h4 class="alert-heading font-weight-bold">Primeiro Webinar</h4>
            <hr>
            <p class="card-text time">Agenda -&gt; 11:00-11:30 AM</p>
            <p class="card-text time">Agenda -&gt; 10:00-10:30 AM</p>
            <p class="card-text time">Agenda -&gt; 09:00-09:30 AM</p>
          </div> <!-- card 01 -->

          <div class="alert alert-secondary" role="alert" style="width: 25rem;">
            <h4 class="alert-heading font-weight-bold">Reuniões pré-agendadas</h4>
            <hr>
            <p class="card-text time">Agenda -&gt; 11:40 AM- 13:00 PM</p>
            <p class="card-text time">Agenda -&gt; 10:40 AM -12:00 PM</p>
            <p class="card-text time">Agenda -&gt; 09:40-11:00 AM</p>
          </div> <!-- card 03 -->

          <div class="alert alert-secondary" role="alert" style="width: 25rem;">
            <h4 class="alert-heading font-weight-bold">Segundo Webinar</h4>
            <hr>
            <p class="card-text time">Agenda -&gt; 13:15- 14:00 PM</p>
            <p class="card-text time">Agenda -&gt; 12:15-13:00 PM</p>
            <p class="card-text time">Agenda -&gt; 11:15 am-12:00 PM</p>
          </div> <!-- card 02 -->

        </div>
      </div>
    </div>
  </div>
</div>