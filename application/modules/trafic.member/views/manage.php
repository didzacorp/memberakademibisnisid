<script type="text/javascript">
$(function () {
        hideProgres();
        pageLoadFunnel(1);
  });
  function pageLoadFunnel(pg)
  { 
    showProgres();
    $.post(base_url(1)+'/trafic.member/manage/page/'+pg
      ,$('#filter_content').serialize()
      ,function(result) {
        $('#resultContent').html(result);
        hideProgres();
      }         
      ,"html"
    );
  }
</script>
 <div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><?=$title?></h4>
          <div classs="row">
          	<div class="col-md-12">
          		<div id="resultContent"></div>
		    	   </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
