<script type="text/javascript">
$(function () {
        hideProgres();
        pageLoadCart(1);
  });
  function pageLoadCart(pg)
  { 
    showProgres();
    $.post(base_url(1)+'/cart.member/manage/page/'+pg
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
          <h4 class="card-title"><?=$title?>
           
            <a href="javascript:void(0)" onclick="loadMainContentMember('/checkout.member/manage');" class="btn btn-sm btn-primary pull-right"> CheckOut </a>
             <a href="javascript:void(0)" onclick="loadMainContentMember('/product.member/manage');" class="btn btn-sm btn-success pull-right" style="margin-right: 1%;"> Tambah Produk </a>
          </h4>
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
