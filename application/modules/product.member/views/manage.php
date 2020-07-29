<link href="<?= base_url();?>assets/ui-member/css/video-js.css" rel="stylesheet">

<script src="<?= base_url();?>assets/ui-member/js/videojs-ie8.min.js"></script>
<script src='https://vjs.zencdn.net/7.6.0/video.js'></script>
<script type="text/javascript">
$(function () {
        hideProgres();
        pageLoadKategori(1);
  });
  function pageLoadKategori(pg)
  { 
    showProgres();
    $.post(base_url(1)+'/product.member/manage/page_kategori/'+pg
      ,$('#filter_content').serialize()
      ,function(result) {
        $('#resultContent').html(result);
        $('#resultContent').show();
        hideProgres();
      }         
      ,"html"
    );
  }

  function lihatProduk(pg)
  { 
    showProgres();
    $.post(base_url(1)+'/product.member/manage/page/'+pg
      ,{
        KategoriProduk : $('#KategoriProduk').val()
        }
      ,function(result) {
        $('#resultContent').hide();
        $('#resultContentProduk').html(result);
        $('#resultContentProduk').show();
        hideProgres();
      }         
      ,"html"
    );
  }

  function DetailProduk(id)
  { 
    showProgres();
    $.post(base_url(1)+'/product.member/manage/DetailProduk'
      ,{
        id : id
        }
      ,function(result) {
        $('#resultContent').hide();
        $('#resultContentProduk').hide();
        $('#resultContentDetail').html(result);
        $('#resultContentDetail').show();
        hideProgres();
      }         
      ,"html"
    );
  }

  function backTolist() {
      $('#resultContent').show();
      $('#resultContentProduk').hide();
      $('#resultContentDetail').hide();
      pageLoadKategori(1);
  }

  function backTolistProduct() {
      $('#resultContent').hide();
      $('#resultContentProduk').show();
      $('#resultContentDetail').hide();
      lihatProduk(1);
  }

  function addToCart(id)
  { 
    showProgres();
    $.post(base_url(1)+'/product.member/manage/addToCart'
      ,{
        id : id,
        qtyProduk : $('#qtyProduk').val()
      }
      ,function(result) {
        if (result.error) {
            showDangerToast(result.error);
            refreshCart();
        }else{
            showSuccessToast(result.message);
            refreshCart();
            backTolistProduct();
        }
      }         
      ,"json"
    );
  } 


</script>
<input type="hidden" name="KategoriProduk" id="KategoriProduk">
 <div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><?=$title?></h4>
          <div classs="row">
          	<div class="col-md-12">
          		<div id="resultContent"></div>
              <div id="resultContentProduk"></div>
              <div id="resultContentDetail"></div>
		    	   </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
