<div >
	<div class="row">
	<?php 
		$no = ($paging['current']-1) * $paging['limit'] ;
		$status = '';
		foreach($list->result_array() as $row)
		{
			$no++;
			
		?>
		<div class="col-md-4">
			<div class="card">
		      <div class="card-body">
		        <h4 class="card-title"><?= $row['judul']; ?></h4>
		        <p class="card-text">
		        	<div class="row mt-12" style="margin-left: 0px;">
                    <?= custom_echo($row['isi_content'],200).'...'; ?>
                      </div>
		        </p>
		        <div class="wrapper">
                    <a href="javascript:void(0)" class="btn btn-outline-primary btn-block" onclick="
						copyDetail(<?= $row['id']; ?>);
						">Detail</a>
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
