<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Kode Dealer</th>
			<th>Kode</th>
			<th>Nama Lokasi</th>
			<?php if($this->session->userdata('Operator')['fidMsOperatorGroup'] == 1){ ?>
			<th>*</th>
			<?php } ?>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no = ($paging['current']-1) * $paging['limit'] ;
		foreach($list->result_array() as $row)
		{
			$no++;
			
		?>
		<tr>
			<td><?= $row['KodeDealer']?></td>
			<td><?= match_key($row['Code'],$key['code'])?></td>
			<td><?= match_key($row['Description'],$key['description'])?></td>
			<?php if($this->session->userdata('Operator')['fidMsOperatorGroup'] == 1){ ?>
			<td>
				<div class="input-group-btn">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action <span class="fa fa-caret-down"></span></button>
					<ul class="dropdown-menu">
						<li><a href="#" onClick="gudang_input('<?= encode($row['Code'])?>')">Preview</a></li>
						<!--li><a href="#" onClick="alert('On Progress')">Delete</a></li-->
					</ul>
				</div>
			</td>
			<?php } ?>
		</tr>
		<?php }?>
	</tbody>
</table>
<?=$paging['list']?>
