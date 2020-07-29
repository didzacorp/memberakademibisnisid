<div >
	<h5><?= $kategori['nama_kategori'] ?><a href="javascript:void(0)" onclick="backTolist()" class="btn btn-sm btn-warning pull-right"> Kembali </a></h5>

	<hr>
	<div class="row">
	<?php 
		$no = ($paging['current']-1) * $paging['limit'] ;
		$status = '';
		foreach($list->result_array() as $row)
		{
			$no++;
			 $media = json_decode($row['media']);
			 $type = $media[0]->type;
			 $source = $media[0]->sourceMedia;
		?>
		<div class="col-md-4">
			<div class="card" style="border: 1px solid #d6d6d6;margin-bottom: 5%;">
				<?php
					if ($type == 'VIDEO') {
						?>
							<iframe height="250"
							src="<?=  $source ?>">
							</iframe>
						<?php
					}else{
						?>
							<img class="card-img-top img-responsive rounded" style="height: 250px;" src="<?=  $source ?>">
						<?php
					}
				?>
		      <!-- <img class="card-img-top img-responsive rounded" style="height: 250px;" src=""> -->
		   <!--    <iframe height="250"
				src="https://www.youtube.com/embed/tgbNymZ7vqY">
				</iframe> -->
		      <div class="card-body">
		        <h4 class="card-title"><?= $row['nama_produk']; ?></h4>
		        <p class="card-text">
		        	<div class="row mt-5">
                    <div class="col-6">
                      <div class="wrapper">
                        <h5 class="mb-1">Harga</h5>
                        <h4 class="mb-1"><strong><?= number_format($row['harga']) ?></strong></h4>
                      </div>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                      <div class="wrapper">
                        <h5 class="mb-1">Harga Member</h5>
                        <h4 class="mb-1"><strong><?= number_format($row['harga_member']) ?></strong></h4>

                      </div>
                    </div>
                  </div>
		        </p>
		        <div class="wrapper">
                    <a href="javascript:void(0)" class="btn btn-outline-success btn-block" onclick="
						DetailProduk('<?= $row['id']; ?>');
						">Detail Produk</a>
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
