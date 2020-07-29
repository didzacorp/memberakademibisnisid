<div >
	<div class="row">
	<?php 
		$no = ($paging['current']-1) * $paging['limit'] ;
		$status = '';

		$aktifVideo = array();
		for ($i=0; $i < ($limitStep+1); $i++) { 

			$aktifVideo['video'.($i+1)] = 'aktif';
			// echo $aktifVideo[$i];
		}

		foreach($list->result_array() as $row)
		{
			
			$no++;
			
		?>
		<?php 
    		if ($row['statusHistory'] == 'SELESAI') {
    			$color 	= 'success';
    			$text 	= '<span class="text-success"> Training Selesai </span>';
    		}else{
    			$color = 'primary';
    			$text 	= '<span class="text-info"> Prosess Training '.$row['jam'].'</span>';
    		}
    	 ?>
		<div class="col-md-4">
			<div class="card">
		      <img class="card-img-top img-responsive rounded" style="height: 250px;" src="<?= $row['thumbnail'] ?>" alt="<?= $row['judul_materi']; ?>.jpg" >
		      <div class="card-body">
		        <h4 class="card-title"><?= $row['judul_materi']; ?></h4>
		        <h7><?=$text ?></h7>
		        <p class="card-text">

		        	<div class="row mt-2">
                    <div class="col-6">
                      <div class="wrapper">
                        <h5 class="mb-1">Tontonan</h5>
                        <h4 class="mb-1"><strong><?= $row['wajib_tonton'] ?></strong></h4>
                      </div>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                      <div class="wrapper">
                        <h5 class="mb-1">Durasi</h5>
                        <h4 class="mb-1"><strong><?= $row['durasi_video'] ?></strong></h4>

                      </div>
                    </div>
                  </div>
		        </p>
		        <div class="wrapper">
		        	<?php 
		        		// print_r($aktifVideo);
		        		if ($aktifVideo['video'.($no)]?? '') {
		        			?>
		        				<a href="javascript:void(0)" class="btn btn-outline-<?= $color; ?> btn-block" onclick="
								tontonTraining(<?= $row['id']; ?>);
								">Tonton</a>
		        			<?php
		        		}else{
		        			?>
		        				<a href="javascript:void(0)" class="btn btn-outline-danger btn-block">
		        				 <i class="icon-lock menu-icon"></i>
								</a>
		        			<?php
		        		}

		        	 ?>
                    
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
