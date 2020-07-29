<div >
	<h5>Kategori</h5>
	<hr>
	<div class="row">
	<?php 
		$no = ($paging['current']-1) * $paging['limit'] ;
		$status = '';
		foreach($list->result_array() as $row)
		{
			$no++;
			
		?>
		<div class="col-md-4">
			<div class="card" style="border: 1px solid #d6d6d6;margin-bottom: 5%;">
		      <img class="card-img-top img-responsive rounded" style="height: 250px;" src="<?= $row['gambar'] ?>" alt="<?= $row['gambar']; ?>.jpg" >
		      <div class="card-body">
		        <h4 class="card-title"><?= $row['nama_kategori']; ?></h4>
		        
		        <div class="wrapper">
                    <a href="javascript:void(0)" class="btn btn-outline-primary btn-block" onclick="
                    	$('#KategoriProduk').val('<?= $row['id']; ?>');
						lihatProduk(1);
						">Lihat Produk</a>
				</div>
		      </div>
		    </div>
		</div>
	<?php
	 }
	?>
	</div>
</div>

<?=$paging['list']?>
