<script type="text/javascript">
$(function () {
        hideProgres();
        pageLoadLead(1);
  });
  function pageLoadLead(pg)
  { 
    showProgres();
    $.post(base_url(1)+'/lead.member/manage/page/'+pg
      ,$('#filter_content').serialize()
      ,function(result) {
        $('#inputContent').hide();
        $('#resultContent').html(result);
        hideProgres();
      }         
      ,"html"
    );
  }
  
  function inputLead()
  { 
    showProgres();
    $.post(base_url(1)+'/lead.member/manage/inputLead/'
      // ,{
      //   KategoriProduk : $('#KategoriProduk').val()
      //   }
      ,function(result) {
        $('#resultContent').hide();
        $('#inputContent').html(result);
        $('#inputContent').show();
        hideProgres();
      }         
      ,"html"
    );
  }

  function saveLead()
  { 
    showProgres();
    $.post(base_url(1)+'/lead.member/manage/saveLead'
      ,{
        nama : $('#namaPendaftar').val(),
        email : $('#emailPendaftar').val(),
      }
      ,function(result) {
        if (result.error) {
            showDangerToast(result.error);
        }else{
            showSuccessToast(result.message);
            backTolist();
        }
      }         
      ,"json"
    );
  } 

  function backTolist() {
      $('#resultContent').show();
      $('#inputContent').hide();
      pageLoadLead(1);
  }

</script>
 <div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div classs="row">
          	<div class="col-md-12">
          		<div id="resultContent"></div>
               <div id="inputContent"></div>
		    	   </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
