<link href="<?= base_url();?>assets/ui-member/css/video-js.css" rel="stylesheet">

<script src="<?= base_url();?>assets/ui-member/js/videojs-ie8.min.js"></script>
<script src='https://vjs.zencdn.net/7.6.0/video.js'></script>
<script type="text/javascript">
$(function () {
        hideProgres();
        pageLoadTraining(1);
        $('#MemberName').html('');
  });
  function pageLoadTraining(pg)
  { 
    showProgres();
    $.post(base_url(1)+'/training.member/manage/page/'+pg
      ,$('#filter_content').serialize()
      ,function(result) {
        $('#resultContent').html(result);
        hideProgres();
      }         
      ,"html"
    );
  }

  function tontonTraining(id)
  { 
    showProgres();
    $.post(base_url(1)+'/training.member/manage/tontonTraining'
      ,{
        id : id
      }
      ,function(result) {
        $('#resultContent').hide();
        $('#resultContentTonton').show();
        $('#resultContentTonton').html(result);
        hideProgres();
      }         
      ,"html"
    );
  }

  function backToList() {
       $('#resultContent').show();
        $('#resultContentTonton').hide();
        pageLoadTraining(1);
  }

  
</script>
<div class="content-wrapper">
  <div>
    <div id="resultContent" style="padding: 1%;">
      
    </div>
    <div id="resultContentTonton">
      
    </div>
  </div>
</div>