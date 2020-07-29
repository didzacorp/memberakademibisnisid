<script type="text/javascript" src="<?= base_url();?>assets/ui-member/js/freeze-table.js"></script>
<script type="text/javascript">
	$(function () {
		TableResponsive();
	});	
	function TableResponsive(){
		$('#order').freezeTable({
         'scrollBar': true,
         'headWrapStyles': {'top': '45px','width': '100px'},
         'columnNum' : 0,
        });
	}
	$( window ).resize(function() {
	  TableResponsive();
	})
</script>
<input type="hidden" name="idTransaksi" id="idTransaksi">
<div class="table-with-scrollbar" id="order" style='width: 100%;'>
<table class="table table-bordered table-hover menu">
	<thead>
		<tr>
			<th style="width: 1%; font-weight: bold;">No </th>
			<th style="font-weight: bold;">Order ID</th>
			<th style="font-weight: bold;">Description</th>
			<th style="font-weight: bold;">GrandTotal</th>
			<th style="font-weight: bold;">Status</th>
			<th style="width: 1%; font-weight: bold;">#</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no = 0;
		$status = '';
		foreach($list->result_array() as $row)
		{
			$no++;
			
		?>
		<tr>
			<td><?= $no?></td>
			<td>#<?=$row['id']?></td>
			<td><?=$row['jenis_transaksi']?></td>
			<td><?= number_format($row['total']);?></td>
			<td><?=$row['status']?></td>			
			<td style="text-align: center;"> 
				<?php 

					if ($row['status'] != 'TERKONFIRMASI' && $row['status'] != 'MENUNGGU KONFIRMASI') {
						?>
							<a href="javascript:void(0)" class="btn btn-warning btn-sm" style="margin-bottom: 3%;" onclick="konfirmasiOrder('<?=$row['id']?>')">Konfirmasi</a>
						<?php
					}

				 ?>
				
				<a href="javascript:void(0)" class="btn btn-info btn-sm" onclick="DetailOrder('<?=$row['id']?>','<?=$row['nama_pembeli']?>')" > 
					Detail Order
				</a>
            </td>			
		</tr>
		<?php }?>
	</tbody>
	
</table>
<?=$paging['list']?>
</div>

 <div class="modal fade" id="DetailOrder" tabindex="-1" role="dialog" aria-labelledby="DetailOrder" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="DetailOrder">Transaksi&nbsp;&nbsp;#TRS-<span id="DetailTitle"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body"  style="padding: 1%;background: white;"> 
          <div class="tab-minimal tab-minimal-success">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-2-1" data-toggle="tab" href="#home-2-1" role="tab" aria-controls="home-2-1" aria-selected="true"><i class="mdi mdi-home-outline"></i>Payment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-2-2" data-toggle="tab" href="#profile-2-2" role="tab" aria-controls="profile-2-2" aria-selected="false"><i class="mdi mdi-account-outline"></i>Invoice</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="home-2-1" role="tabpanel" aria-labelledby="tab-2-1">
                    <div  class="col-12 col-md-12">
                      <div  class="card bg-success text-center">
                          <div  class="card-header"> Request Pembelian Produk  telah diterima </div>
                          <div  class="card-body">
                              <h4  class="card-title">Proses Pembelian Produk Telah Di Catat Dengan Order Id : <strong >#79701</strong></h4>
                              <p  class="card-text"><strong >Segera Lakukan Pembayaran Untuk menyelesaikan Proses ini Sebesar :</strong></p>
                              <h3 ><strong >IDR<span id='TotalPayment'>.00</strong></h3>
                              <h6 >KE Rekening</h6>
                              <h4 >BCA No.Rek 6041678787 Cab.Alam Sutera a/n P.T Sinergi Rezeki Ananta</h4>
                              <p  class="card-text">note : kami menambahkan nominal sebesar <strong >125</strong> untuk memudahkan proses konfirmasi transaksi.</p>
                              <h4 >Setelah melakukan pembayaran segera konfirmasi Pesanan Anda di menu Order</h4>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="profile-2-2" role="tabpanel" aria-labelledby="tab-2-2">
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="card px-2">
                              <div class="card-body">
                                  <!-- <div class="container-fluid">
                                    <h3 class="text-right my-5">Transaksi&nbsp;&nbsp;#INV-17</h3>
                                    <hr>
                                  </div> -->
                                  <div class="container-fluid d-flex justify-content-between">
                                    <div class="col-lg-3 pl-0">
                                      <p class="mt-2 mb-2"><b id="namaTransaksi"></b></p>
                                      <p><span id='alamatTransaksi'></span>
                                        <br><span id='kecamatanTransaksi'></span>
                                        <br><span id='kotaTransaksi'></span>
                                        <br><span id='provinsiTransaksi'></span>
                                      </p>
                                    </div>
                                    <div class="col-lg-3 pr-0">
                                      <p class="mt-2 mb-2 text-right"><b>Kontak Pembeli</b></p>
                                      <p class="text-right">
                                        <span id='emailTransaksi'></span>
                                        <br> <span id='noTelpnTransaksi'></span>
                                      </p>
                                    </div>
                                  </div>
                                  <div class="container-fluid d-flex justify-content-between">
                                    <div class="col-lg-3 pl-0">
                                      <p class="mb-0 mt-2">Tanggal Transaksi : <span id='TanggalTransaksi'></span></p>
                                      <p>Layanan Pengiriman : <span id='pengirimanTransaksi'></span></p>
                                      <p>No Resi : <span id='NoResi'></span></p>
                                    </div>
                                  </div>
                                  <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                                    <div class="table-responsive w-100">
                                        <table class="table">
                                          <thead>
                                            <tr class="bg-dark text-white">
                                                <th>#</th>
                                                <th>Produk</th>
                                                <th class="text-right">Harga</th>
                                                <th class="text-right">Jumlah</th>
                                                <th class="text-right">Diskon</th>
                                                <th class="text-right">Total</th>
                                              </tr>
                                          </thead>
                                          <tbody id="DetailTransaksi">
                                           
                                          </tbody>
                                        </table>
                                      </div>
                                  </div>
                                  <div class="container-fluid mt-5 w-100">
                                    <p class="text-right mb-2">Sub - Total : <span id='totalTransaksi'></p>
                                    <p class="text-right mb-2">Diskon : <span id='diskonTransaksi'></p>
                                    <p class="text-right">Ongkir : <span id='ongkirTransaksi'></p>
                                    <h4 class="text-right mb-5">Grand Total : <span id='grandTotalTransaksi'></h4>
                                    <hr>
                                  </div>
                                  <!-- <div class="container-fluid w-100">
                                    <a href="#" class="btn btn-primary float-right mt-4 ml-2"><i class="mdi mdi-printer mr-1"></i>Print</a>
                                    <a href="#" class="btn btn-success float-right mt-4"><i class="mdi mdi-telegram mr-1"></i>Send Transaksi</a>
                                  </div> -->
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>