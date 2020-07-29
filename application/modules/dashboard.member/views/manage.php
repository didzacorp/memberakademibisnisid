<link href="<?= base_url();?>assets/ui-member/css/video-js.css" rel="stylesheet">

<script src="<?= base_url();?>assets/ui-member/js/videojs-ie8.min.js"></script>
<script src='https://vjs.zencdn.net/7.6.0/video.js'></script>
 <div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title" > 
          	<span><?= $news['judul']; ?></span> 
          	<a href="javascript:void(0)" class="btn btn-warning btn-sm pull-right" onclick="backToList(); " style="font-size: 12px;"> Kembali</a>
          </h4>
          <div class="row">
            <div class="col-md-12">
              <video id='dashboard-video' class='video-js' controls='false' preload='auto' style="width: 100%;height: 300px;" 
              poster='https://ak4.picdn.net/shutterstock/videos/1008749414/thumb/1.jpg' data-setup='{}'>
                <source src='<?= $news['source_video']; ?>' type='video/mp4'>
                <p class='vjs-no-js'>
                  To view this video please enable JavaScript, and consider upgrading to a web browser that
                  <a href='https://videojs.com/html5-video-support/' target='_blank'>supports HTML5 video</a>
                </p>
              </video>
            </div>
            <div class="col-md-12">
              <?=  base64_decode($news['isi_content']); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</div>
<script type="text/javascript">
  $(function () {
        videojs("dashboard-video");
  });
</script>