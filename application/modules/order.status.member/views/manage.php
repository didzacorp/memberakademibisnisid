<script type="text/javascript">
$(function () {
        hideProgres();
        pageLoadOrder(1);
  });
  function pageLoadOrder(pg)
  { 
    showProgres();
    $.post(base_url(1)+'/order.status.member/manage/page/'+pg
      ,$('#filter_content').serialize()
      ,function(result) {
        $('#resultContent').html(result);
        hideProgres();
      }         
      ,"html"
    );
  }
 
  function pageLoadOrderDetail(pg)
  { 
    showProgres();
    $.post(base_url(1)+'/order.status.member/manage/pageDetail/'+pg
      ,{
        idTransaksi: $('#idTransaksi').val()
      }
      ,function(result) {
        $('#DetailTransaksi').html(result);
        hideProgres();
      }         
      ,"html"
    );
  }

  function konfirmasiOrder(id)
  { 

    bootbox.confirm({
        message: "Sudah Lakukan pembayaran? Jika sudah tekan tombol Yes",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
          if (result == true) {
            showProgres();
            $.post(base_url(1)+'/order.status.member/manage/konfirmasiOrder'
              ,{
                id : id
              }
              ,function(result) {
                if (result.error) {
                    showDangerToast(result.error);
                }else{
                    showSuccessToast(result.message);
                    pageLoadOrder(1);
                }
              }         
              ,"json"
            );
          }
        }
    });


  }

  function DetailOrder(id,nama) {
    $('#DetailOrder').modal('show');
    $('#DetailTitle').html(id);
    getDataOrder(id);
  }

  function getDataOrder(id)
  { 
    showProgres();
    $.post(base_url(1)+'/order.status.member/manage/getDataOrder'
      ,{
        id : id
      }
      ,function(result) {
        if (result.error) {
            showDangerToast(result.error);
        }else{
            $('#idTransaksi').val(id);
            pageLoadOrderDetail(1);
            $('#namaTransaksi').html(result.dataTransaksi.nama_pembeli);
            $('#alamatTransaksi').html(result.dataTransaksi.alamat_pengiriman+',');
            $('#kecamatanTransaksi').html(result.dataTransaksi.kecamatan_pengiriman+',');
            $('#kotaTransaksi').html(result.dataTransaksi.kota_pengiriman+',');
            $('#provinsiTransaksi').html(result.dataTransaksi.provinsi_pengiriman+'.');

            $('#emailTransaksi').html(result.dataTransaksi.email_pembeli);
            $('#noTelpnTransaksi').html(result.dataTransaksi.nomor_telepon);

            $('#TanggalTransaksi').html(result.dataTransaksi.tanggal);
            $('#pengirimanTransaksi').html(result.dataTransaksi.service_pengiriman);
            $('#NoResi').html(result.dataTransaksi.nomor_resi);
            
            $('#totalTransaksi').html(formatNumber(result.dataTransaksi.total));
            $('#diskonTransaksi').html(formatNumber(result.dataTransaksi.diskon));
            $('#ongkirTransaksi').html(formatNumber(result.dataTransaksi.ongkir));
            $('#grandTotalTransaksi').html(formatNumber(result.dataTransaksi.sub_total));
            $('#TotalPayment').html(formatNumber(parseInt(result.dataTransaksi.sub_total)+parseInt(result.dataTransaksi.kode_unik)));

            
        }
      }         
      ,"json"
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
