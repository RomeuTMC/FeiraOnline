<?php if (!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
logado('SELLER');
$dados=$_SESSION['dados'];
include_once('topo.php');
?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="font-weight-bold"><?php echo($dados['titulo']); ?></h1><a href="#" onclick="show_info_app()" class="ml-5 btn btn-danger">INSTRUCTIONS</a>
      </div>
      <!-- <div class="table-responsive"> -->
      <script>
function show_info_app(){
  Swal.fire({
        title: "Attention !",
        html: "<h2>Basic Requirements</h3>To ensure the success of your appointment use the browser compatible with the platform:<br><br>- Google Chrome<br>The official browser for appointmens technologie<br><br>After opening the appointment be sure to enable and allow the camera and microphone by the browser.<br><br><span>If the appointment access link is disabled during opening hours, press the <b>[Ctrl]+[F5]</b><i>(Command + Shift + R) On macOs </i> to reload the page.</span><br><br>Have a Nice Appointment !",
        icon: "warning",
        showCancelButton: false,
        confirmButtonColor: "#d33",
        confirmButtonText: "OK"
      });
}
</script>
        <table class="table table-striped">
          <thead class="thead-dark">
            <tr>
              <th>Date</th>
              <th>Time</th>
              <th>Buyer</th>
              <th>Evaluation</th>
              <th>Link Access Meeting</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($dados['apoints'] as $v){ ?>
            <tr>
              <td class="py-4 align-middle"><?php echo($v['eDay']);?></td>
              <td class="py-4 align-middle"><?php echo($v['tHora']);?> - BRA<br>
              <?php
              $time=explode(':',$v['tHora']);
              $h=$time[0]+10;
              if($h>=24){ $h=$h-24;}
              echo($h.':'.$time[1]); ?> - THA</td>
              <td class="py-4 align-middle"><?php echo($v['cCompany']);?></td>
              <td class="py-4 align-middle"><?php echo($v['avaliacao']);?></td>
              <td class="py-4 align-middle" style="width: 20rem;">
              <a href="#" onClick="window.open('<?php echo(ADMIN.'dashboard/agenda/'.$v['nId']); ?>', '_blank')" class='btn btn-secondary <?php 
      $ta=date('Y-m-d H:i');
      $tm='2020-'.$v['eDay'].' '.$v['tHora'];
      //echo $ta.'___'.$tm;
      if($tm>$ta){ echo 'disabled2'; } ?>'>Link access appointment</a>
              <a href="#" onClick="window.open('<?php echo(ADMIN.'dashboard/avpos/'.$v['nId']); ?>', '_blank')"  class='btn btn-primary'><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>

      </div>
    </main>
  <!-- </div> -->
</div>
<script>
show_info_app();
</script>