<style type="text/css">
  .text-white {
    color: #fff;
  }
  .nopadding {
    padding: 0;
    margin: 5px 0;
  }
  .user-panel .panel-default {
    padding: 5px;
  }
  .wrap {
    font-size: 11px;
    width: 100%;
    word-wrap: break-word !important;
  }
  .padFilter {
    margin-top: 12px;
    margin-bottom: 12px;
  }
  #modalUbahDealer {
    margin-top: 2em;
  }

</style>
<script type="text/javascript">
  //  $(document).ready(function(){
    // $(".select2").select2();
  // });

  function setDataDealer(kode,name) {
    if(confirm("Tampilkan Data Dealer Sebagai : "+ name)){
      $.post(site_url+'main/main/setAsDealer'
      ,{t_kodeDealer : kode}
      ,function(obj) {
        window.location.reload(true);
      },"html");
    }
  }
</script>
<div class="user-panel">
	<div class="panel-default text-white">
		<div class="wrap">
      <?php $dataDealer = $this->session->userdata['Dealer'];  ?>
      <p><b><?= $dataDealer['Nama']; ?></b><br>
      <?= $dataDealer['KodeDealer']." - ".$dataDealer['IDAHM']; ?><p>
      <p><?= $dataDealer['Alamat']; ?> <br>
      <?= $dataDealer['email']; ?> <br>
      <?= $dataDealer['TeleponPerusahaan']; ?> </p>
    </div>
    <?php if($this->session->userdata('Operator')['fidMsOperatorGroup'] == 1){ ?>
      <button class="btn btn-success btn-xs pull-right" data-toggle="modal" data-target="#modalUbahDealer">Ubah Dealer</button><br><br>
    <?php } ?>
	</div>
</div>

<div class="modal fade" id="modalUbahDealer" role="dialog" aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel"><b>Tampilkan Data Sebagai Dealer.</b></h5>
      </div>
      <div class="modal-body">
        <table class="table table-hover table-border">
          <thead">
            <tr>
              <th>Kode Dealer</th>
              <th>Nama Dealer</th>
              <th>Pilih</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($dealer->result_array() as $key) { ?>
              <tr>
                <td><?= $key['KodeDealer']; ?></td>
                <td><?= $key['Nama']; ?></td>
                <td><button class="btn btn-xs btn-info" onclick="setDataDealer('<?= $key['KodeDealer']; ?>','<?= $key['Nama']; ?>')">Pilih</button></td>
              </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
          <!-- search form
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form> -->
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
	<?= $this->menu->build();?> 
</ul>