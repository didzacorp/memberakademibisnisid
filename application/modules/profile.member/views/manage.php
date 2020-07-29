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
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Profile</h4>
          <div classs="row">
          	<div class="col-md-12">
              <!-- <h4>Profile</h4> -->
          		<form class="forms-sample">
                  <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="text" class="form-control" id="exampleInputName1" placeholder="Name" value="<?= $profile['nama'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail3">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email" value="<?= $profile['email'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail3">Nomor Telpn</label>
                    <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email" value="<?= $profile['nomor_telepon'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputCity1">Alamat</label>
                    <textarea class="form-control"><?= $profile['alamat'] ?></textarea>
                  </div>
                  <!-- <button type="submit" class="btn btn-success mr-2">Ubah Profile</button> -->
                </form>
		    	   </div>
          </div>
        </div>
        <div class="card-footer" style="background: white;">
           <button type="submit" class="btn btn-warning mr-2">Ubah Profile</button>
        </div>
      </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Rekening</h4>
          <div classs="row">
             <div class="col-md-12">
              <!-- <h4>Rekening</h4> -->
                <form class="forms-sample">
                  <div class="form-group">
                    <label for="exampleInputEmail3">Nama Rekening</label>
                    <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email" value="<?= $profile['nama_rekening'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail3">Nama Bank</label>
                    <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email" value="<?= $profile['nama_bank'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail3">Nomor Rekening</label>
                    <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email" value="<?= $profile['nomor_rekening'] ?>" readonly>
                  </div>
                  

                </form>
             </div>
          </div>
        </div>
        <div class="card-footer" style="background: white;">
          <button class="btn btn-primary">Ubah Rekening</button>
        </div>
      </div>
    </div>
  </div>
</div>
