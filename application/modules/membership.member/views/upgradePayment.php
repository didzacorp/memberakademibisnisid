<div class="row">
  <div class="col-12 col-md-12">
        <a href="javascript:void(0)" onclick="backTolist()" class="btn btn-sm btn-warning pull-right"> Kembali </a>
        <br>
  </div>
</div>
<div  class="col-12 col-md-12">
      <div  class="card bg-success text-center">
          <div  class="card-header"> Request Upgrade Member  telah diterima </div>
          <div  class="card-body">
              <h4  class="card-title">Proses Upgrade Member Telah Di Catat Dengan Order Id : <strong >#<?= $transaksi['id'] ?></strong></h4>
              <p  class="card-text"><strong >Segera Lakukan Pembayaran Untuk menyelesaikan Proses ini Sebesar :</strong></p>
              <h3 ><strong >IDR <?= number_format($transaksi['kode_unik'] + $transaksi['total']); ?>.00</strong></h3>
              <h6 >KE Rekening</h6>    
              <h4 >BCA No.Rek 6041678787 Cab.Alam Sutera a/n P.T Sinergi Rezeki Ananta</h4>
              <p  class="card-text">note : kami menambahkan nominal sebesar <strong >125</strong> untuk memudahkan proses konfirmasi transaksi.</p>
              <h4 >Setelah melakukan pembayaran segera konfirmasi Pesanan Anda di menu Order</h4>
          </div>
      </div>
  </div>