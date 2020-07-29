<?php 

	if ($HitoryTraining['status'] != 'SELESAI') {
		?>
		<style type="text/css">
			.video-js .vjs-progress-control{
				display: none !important;
			}
		</style>
		<?php
	}

 ?>


<script type="text/javascript">
	$(function () {
	      myPlayer = videojs("training-video<?= $list['id']; ?>");

	      <?php 
	      	if ($HitoryTraining['status'] != 'SELESAI') {
	      		?>
	      			myPlayer.currentTime('<?= $time_seconds; ?>'); 
	      		<?php
	      	}
	      ?>
	      
	      $("#videoContent<?= $list['id']; ?>").show();
	});
</script>
 <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title" > 
          	<input type="hidden" name="idTraining" id="idTraining" value="<?= $list['id']; ?>">
          	<span><?= $list['judul_materi']; ?></span> 
          	<a href="javascript:void(0)" class="btn btn-warning btn-sm pull-right" onclick="loadMainContentMember('/training.member/manage');" style="font-size: 12px;"> Kembali</a>
          </h4>
          <div class="row">
            <div class="col-md-12" style="display: none;" id="videoContent<?= $list['id']; ?>">
              <video id='training-video<?= $list['id']; ?>' onclick="setVideo()" class='video-js' controls='false' preload='auto' style="width: 100%;" 
                poster='<?= $list['thumbnail']; ?>' data-setup='{}'>
                  <source src='<?= $list['video_souce']; ?>' type='video/mp4'>
              </video>
            </div>
            <div class="col-md-12">
              <?=  base64_decode($list['deskripsi_materi']); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript">
	

	var TelahDitonton;
  	var video = videojs('training-video<?= $list['id']; ?>').ready(function(){
  	var player = this;
	  player.on('ended', function() {
	    showSuccessToast('Training Selesai, Silahkan Tonton Training Selanjutnya..');
	    TelahDitonton = 'Sudah';
	  });
	});

  function setVideo() {
    var player = videojs("training-video<?= $list['id']; ?>");
    if (TelahDitonton != 'Sudah') {
      if (player.play()) {
        setInterval('getLastWatched()', 1000);
      }else {

      }
    }else{}
  }

   function getLastWatched()
    {
      var player = videojs("training-video<?= $list['id']; ?>");
      if (player.currentTime() != player.duration()) {
      	console.log(player.currentTime());
      	$.post(base_url(1)+'/training.member/manage/saveLastWatched'
		    ,{
		    	idTraining : $("#idTraining").val(),
		    	currentTime : player.currentTime(),
		    },function(result) {
		    }         
		    ,"json"
		);
      }
      
    }
    
</script>

