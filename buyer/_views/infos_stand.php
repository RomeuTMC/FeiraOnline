<!-- Modal -->
<div class="modal fade" id="infoAbout" tabindex="-1" aria-labelledby="infoAbout" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title font-weight-bold" id="exampleModalLabel">About Us</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <b>Company:</b> <?php echo ($dados['Infos']['cName']); ?><br>
        <b>Address:</b> <?php echo ($dados['Infos']['cAddress']); ?><br>
        <b>Country:</b> <?php echo ($dados['Infos']['cCountry']); ?><br>
        <b>Postal Code:</b> <?php echo ($dados['Infos']['cPostCode']); ?><br>
        <b>Phone Number:</b> <?php echo ($dados['Infos']['cPhone1']); ?><br>
        <b>Phone Number:</b> <?php echo ($dados['Infos']['cPhone2']); ?><br>
        <b>Website:</b> <a href='<?php echo ($dados['Infos']['cWeb']); ?>'
          target=_blank><?php echo ($dados['Infos']['cWeb']); ?></a><br>
        <br>
        <div class="card">
          <div class="card-header">
            <b>Company Description</b>
          </div>
          <div class="card-body">
            <p class="card-text"><?php echo ($dados['Infos']['tDescription']); ?></p>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="infoProduct" tabindex="-1" aria-labelledby="infoProduct" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title font-weight-bold" id="exampleModalLabel">Photos of Products</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php foreach($dados['Products'] as $k => $v){
        ?><img src='<?php echo(URL.$v); ?>'>
        <?
      } ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="infoVideo" tabindex="-1" aria-labelledby="infoVideo" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title font-weight-bold" id="exampleModalLabel">Videos</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body d-flex flex-wrap justify-content-around">
        <?php foreach($dados['Videos'] as $k => $v){ ?>
        <div style="width:45%;">
        <iframe id="<?php echo $v['aFile']; ?>" width="560" height="315" src="https://www.youtube.com/embed/<?php echo $v['aFile']; ?>"
          frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen></iframe></div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="infoResource" tabindex="-1" aria-labelledby="infoResource" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title font-weight-bold" id="exampleModalLabel">Resources</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group">
          <?php foreach($dados['Resources'] as $k => $v){ ?>
          <li class="list-group-item">
            <?php echo '<a href=\''.URL.$v['aFile'].'\' target=_new>'.$v['title'].'</a><br>'.$v['descricao']; ?>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="chatStand" tabindex="-1" aria-labelledby="chatStand" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title font-weight-bold" id="exampleModalLabel">Chat</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div style="width:1000px;height:450px;margin:0 auto;">
          <script src="https://html5-chat.com/script/25952/<?=$dados['chat']; ?>"></script>
        </div>
      </div>
    </div>
  </div>
</div>
