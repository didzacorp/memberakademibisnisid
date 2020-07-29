<script type="text/javascript">
$(function () {
       
        hideProgres();
        pageLoadCheckout(1);
        getProvinsi();
         $('.select2').select2();
  });
  function pageLogAlamat(pg)
  { 
    showProgres();
    $.post(base_url(1)+'/checkout.member/manage/pageLogAlamat/'+pg
      ,function(result) {
        $('#historyLogAlamat').html(result);
        hideProgres();
      }         
      ,"html"
    );
  }

  function pageLoadCheckout(pg)
  { 
    showProgres();
    $.post(base_url(1)+'/checkout.member/manage/page/'+pg
      ,$('#filter_content').serialize()
      ,function(result) {
        $('#resultContent').html(result);
        hideProgres();
      }         
      ,"html"
    );
  } 

  function getProvinsi(id='')
  { 
    $('#tambahLogAlamat').hide();
    showProgres();
    $.post(base_url(1)+'/checkout.member/manage/getProvinsi'
      ,{
        id : id
      }
      ,function(result) {
        if (result.error) {
            showDangerToast(result.error);
        }else{
            $('#ProvinsiPembeli').html('');
            var JSONObject = JSON.parse(result.provinsi);
            $('#ProvinsiPembeli').append(new Option('-- Pilih --' ,0));
            for (var i = 0; i < JSONObject.length; i++) {
              $('#ProvinsiPembeli').append(new Option(JSONObject[i]["province"], JSONObject[i]["province_id"]));
            }
            $('.select2').select2();
        }
      }         
      ,"json"
    );
  }

  function getKota(idProv='',id='')
  { 
    getCost();
    getOngkir();
    showProgres();
    $.post(base_url(1)+'/checkout.member/manage/getKota'
      ,{
        idProv : idProv,
        id : id,
      }
      ,function(result) {
        if (result.error) {
            showDangerToast(result.error);
        }else{
            $('#KotaPembeli').html('');
            var JSONObject = JSON.parse(result.kota);
            $('#KotaPembeli').append(new Option('-- Pilih --' ,0));
            for (var i = 0; i < JSONObject.length; i++) {
              $('#KotaPembeli').append(new Option(JSONObject[i]["city_name"], JSONObject[i]["city_id"]));
            }
            $('.select2').select2();
        }
      }         
      ,"json"
    );
  }

  function getCost(destination='',weight='')
  { 
    getOngkir();   
    $('#servicePengiriman').html('');
    $('#layananPengiriman').html('');
    
    getOngkir(destination,weight,0); 
    showProgres();
    $.post(base_url(1)+'/checkout.member/manage/getCost'
      ,{
        destination : destination,
        weight : weight,
      }
      ,function(result) {
        if (result.error) {
            showDangerToast(result.error);
        }else{
            $('#tambahLogAlamat').show();
            var JSONObject = JSON.parse(result.biaya);
            console.log(JSONObject[0]['costs']);
            
            $('#layananPengiriman').append(new Option(JSONObject[0]['name'], JSONObject[0]['code']));
            for (var i = 0; i < JSONObject[0]['costs'].length; i++) {
              $('#servicePengiriman').append(new Option(JSONObject[0]['costs'][i]['description'], i));
            }
        }
      }         
      ,"json"
    );
  }

  function getOngkir(destination='',weight='',id=0)
  { 
    $('#estimasiPengiriman').html('');
    $('#hargaOngkir').val('');
    showProgres();
    $.post(base_url(1)+'/checkout.member/manage/getCost'
      ,{
        destination : destination,
        weight : weight,
      }
      ,function(result) {
        if (result.error) {
            showDangerToast(result.error);
        }else{
            var JSONObject = JSON.parse(result.biaya);
            $('#estimasiPengiriman').html(JSONObject[0]['costs'][id]['cost'][0]['etd']+' Hari');
            $('#hargaOngkir').val(JSONObject[0]['costs'][id]['cost'][0]['value']);
        }
      }         
      ,"json"
    );
  } 


  function TransaksiCheckout() {
    showProgres();
    $.post(base_url(1)+'/checkout.member/manage/TransaksiCheckout'
      ,{
        NamaPembeli : $('#NamaPembeli').val(),
        EmailPembeli : $('#EmailPembeli').val(),
        NoTelpnPembeli : $('#NoTelpnPembeli').val(),
        AlamatPembeli : $('#AlamatPembeli').val(),
        ProvinsiPembeli : $("#ProvinsiPembeli option:selected").html(),
        KotaPembeli : $("#KotaPembeli option:selected").html(),
        KecamatanPembeli : $('#KecamatanPembeli').val(),
        layananPengiriman : $('#layananPengiriman').val(),
        servicePengiriman : $("#servicePengiriman option:selected").html(),
        hargaOngkir : $('#hargaOngkir').val(),
        totalCart : $('#totalCart').val(),
        diskonCart : $('#diskonCart').val(),
      }
      ,function(result) {
        if (result.error) {
            showDangerToast(result.error);
        }else{
            showSuccessToast(result.message);
            refreshCart();
            loadMainContentMember('/order.status.member/manage')
        }
      }         
      ,"json"
    );
  }

  function saveAlamat() {
    showProgres();
    $.post(base_url(1)+'/checkout.member/manage/saveAlamat'
      ,{
        NamaAlamat : $('#namaAlamat').val(),
        AlamatPembeli : $('#AlamatPembeli').val(),
        ProvinsiPembeli : $("#ProvinsiPembeli").val(),
        KotaPembeli : $("#KotaPembeli").val(),
        KecamatanPembeli : $('#KecamatanPembeli').val(),
      }
      ,function(result) {
        if (result.error) {
            showDangerToast(result.error);
        }else{
            showSuccessToast(result.message);
            $('#TambahAlamat').modal('hide');
            $('#namaAlamat').val('');
        }
      }         
      ,"json"
    );
  }

  function HistoryAlamat() {
    $('#HistoryAlamat').modal('show');
    pageLogAlamat(1);
  }

  function TambahkanAlamat() {
    $('#TambahAlamat').modal('show');
    
    $("#alamatPembeli").val($('#AlamatPembeli').val());
    $("#provinsiAlamat").val($("#ProvinsiPembeli option:selected").html());
    $("#kotaAlamat").val($("#KotaPembeli option:selected").html());
    $("#kecamatanAlamat").val($('#KecamatanPembeli').val());
  }
  
  function getHistory(id)
  { 
    showProgres();
    $.post(base_url(1)+'/checkout.member/manage/getHistory'
      ,{
        id : id
      }
      ,function(result) {
        if (result.error) {
            showDangerToast(result.error);
        }else{
            $("#AlamatPembeli").val(result.alamat.alamat);
            $("#KecamatanPembeli").val(result.alamat.kecamatan);            
            // $("#ProvinsiPembeli option:selected").val();
            // $("#KotaPembeli").val(result.alamat.kota);
            // $("#KotaPembeli option:selected").val();
            
            $("#ProvinsiPembeli").val(result.alamat.provinsi);
            $('#ProvinsiPembeli').select2().trigger('change');
            // $('.select2').select2();
            // getKota(result.alamat.provinsi);

            // $("#KotaPembeli").val(result.alamat.kota);
            // $('#KotaPembeli').select2().trigger('change');
            // $('.select2').select2();
            


            // $('#KotaPembeli').select2().trigger('change');
           

            $('#HistoryAlamat').modal('hide');
            console.log(result.alamat.kota+'-'+result.alamat.provinsi);

            getCost(result.alamat.kota,$('#berat').val());
            setTimeout(function(){
              $("#KotaPembeli").val(result.alamat.kota);
              $('#KotaPembeli').select2().trigger('change');
              $('.select2').select2();
            }, 2000);
            
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
          <h4 class="card-title"><?=$title?>
           
            <a href="javascript:void(0)" onclick="loadMainContentMember('/cart.member/manage');" class="btn btn-sm btn-warning pull-right"> Keranjang </a>
             <a href="javascript:void(0)" onclick="loadMainContentMember('/product.member/manage');" class="btn btn-sm btn-primary pull-right" style="margin-right: 1%;"> Produk </a>
          </h4>
          <hr>
          <div classs="row">
            <h5 class="card-title"> Data Pembeli </h5>
            <div class="row" style="margin-bottom: 1%;">
              <div class="col-md-3">Nama 
                <span class="pull-right"> : </span>
              </div>
              <!-- <div class="col-md-1"  style="max-width: 0% !important;">:</div> -->
              <div class="col-md-5" style="margin-bottom: 2%;">
                <input type="text" name="NamaPembeli" id="NamaPembeli" class="form-control">
              </div>
              <div class="col-md-4">
                <a  href="javascript:void(0)" class="btn btn-sm btn-primary" onclick="HistoryAlamat()">History Alamat</a>
                <a  href="javascript:void(0)" class="btn btn-sm btn-success" style="display: none;" id="tambahLogAlamat"  onclick="TambahkanAlamat()">Tambah Alamat</a>
              </div>
            </div>
            <div class="row" style="margin-bottom: 1%;">
              <div class="col-md-3">Email 
                <span class="pull-right"> : </span>
              </div>
              <!-- <div class="col-md-1"  style="max-width: 0% !important;">:</div> -->
              <div class="col-md-5">
                <input type="text" name="EmailPembeli" id="EmailPembeli" class="form-control">
              </div>
            </div>
            <div class="row" style="margin-bottom: 1%;">
              <div class="col-md-3">Nomor Telpn
                <span class="pull-right"> : </span>
              </div>
              <!-- <div class="col-md-1"  style="max-width: 0% !important;">:</div> -->
              <div class="col-md-5">
                <input type="text" name="NoTelpnPembeli" id="NoTelpnPembeli" class="form-control">
              </div>
            </div>
            <div class="row" style="margin-bottom: 1%;">
              <div class="col-md-3">Alamat 
                <span class="pull-right"> : </span>
              </div>
              <!-- <div class="col-md-1"  style="max-width: 0% !important;">:</div> -->
              <div class="col-md-5">
                <textarea name="AlamatPembeli" id="AlamatPembeli" class="form-control"></textarea>
              </div>
            </div>
            <div class="row" style="margin-bottom: 1%;">
              <div class="col-md-3">Provinsi
                <span class="pull-right"> : </span>
              </div>
              <!-- <div class="col-md-1"  style="max-width: 0% !important;">:</div> -->
              <div class="col-md-5">
                <select class="form-control select2" id='ProvinsiPembeli' onchange="getKota(this.value)">
                </select>
              </div>
            </div>
            <div class="row" style="margin-bottom: 1%;">
              <div class="col-md-3">Kota
                <span class="pull-right"> : </span>
              </div>
              <!-- <div class="col-md-1"  style="max-width: 0% !important;">:</div> -->
              <div class="col-md-5">
                <select class="form-control select2" id='KotaPembeli' onchange="getCost(this.value,$('#berat').val())">
                </select>
              </div>
            <!--   <div class="col-md-2">Kode Pos :</div>
              <div class="col-md-2">
                <input type="text" name="KodePOS" id="KodePOS" class="form-control" readonly>
              </div> -->
            </div>
            <div class="row" style="margin-bottom: 1%;">
              <div class="col-md-3">Kecamatan 
                <span class="pull-right"> : </span>
              </div>
              <!-- <div class="col-md-1"  style="max-width: 0% !important;">:</div> -->
              <div class="col-md-5">
                <input type="text" name="KecamatanPembeli" id="KecamatanPembeli" class="form-control">
              </div>
            </div>
            <div class="row" style="margin-bottom: 1%;">
              <div class="col-md-3">Layanan 
                <span class="pull-right"> : </span>
              </div>
              <!-- <div class="col-md-1"  style="max-width: 0% !important;">:</div> -->
              <div class="col-md-5">
                <select class="form-control select2" id='layananPengiriman'>
                </select>
              </div>
              <div class="col-md-4">
                <select class="form-control select2" id='servicePengiriman' onchange="getOngkir($('#KotaPembeli').val(),$('#berat').val(),this.value)">
                </select>
              </div>
            </div>
            <div class="row" style="margin-bottom: 1%;">
              <div class="col-md-3">Ongkir
                <span class="pull-right"> : </span>
              </div>
              <!-- <div class="col-md-1"  style="max-width: 0% !important;">:</div> -->
              <div class="col-md-3">
                <input type="text" name="hargaOngkir" id="hargaOngkir" class="form-control" readonly>
              </div>
              <div class="col-md-5">
                <label id="estimasiPengiriman"></label>
              </div>
            </div>

          	<div class="col-md-12">
          		<div id="resultContent"></div>
		    	  </div>

            <a href="javascript:void(0)" onclick="TransaksiCheckout();" class="btn btn-md btn-primary pull-right" style="margin-right: 1%;"> CheckOut </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

 <div class="modal fade" id="HistoryAlamat" tabindex="-1" role="dialog" aria-labelledby="HistoryAlamat" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="HistoryAlamat">History Alamat</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body"  style="padding: 1%;background: white;"> 
          <div class="container-fluid mt-5 d-flex justify-content-center w-100">
            <div class="table-responsive w-100">
                <table class="table">
                  <thead>
                    <tr class="bg-dark text-white">
                        <th>#</th>
                        <th>Nama History</th>
                        <th class="text-left">Alamat</th>
                        <th class="text-left">*</th>
                      </tr>
                  </thead>
                  <tbody id="historyLogAlamat">
                   
                  </tbody>
                </table>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

   <div class="modal fade" id="TambahAlamat" tabindex="-1" role="dialog" aria-labelledby="TambahAlamat" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header" style="padding: 1%;">
          <h5 class="modal-title" id="TambahAlamat" >Tambahkan Alamat Sebagai</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body"  style="padding: 1%;background: white;font-size: 13px;"> 
          <div class="row">
            <div class="col-md-12">
              <label>Nama Alamat *</label>
              <input type="text" name="namaAlamat" id="namaAlamat" class="form-control">
            </div>
            <div class="col-md-12">
              <label>Alamat</label>
              <textarea name="alamatPembeli" id="alamatPembeli" class="form-control" readonly></textarea>
            </div>
            <div class="col-md-12">
              <label>Provinsi</label>
              <input type="text" name="provinsiAlamat" id="provinsiAlamat" class="form-control" readonly>
            </div>
            <div class="col-md-12">
              <label>Kota</label>
              <input type="text" name="kotaAlamat" id="kotaAlamat" class="form-control" readonly>
            </div>
            <div class="col-md-12">
              <label>Kecamatan</label>
              <input type="text" name="kecamatanAlamat" id="kecamatanAlamat" class="form-control" readonly>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="javascript:void(0)" onclick="saveAlamat();"  class="btn btn-succes">Tambahkan</a>
          <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>