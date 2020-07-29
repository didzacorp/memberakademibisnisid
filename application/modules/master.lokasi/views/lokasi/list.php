<table class="table table-bordered table-hover menu">
	<thead>
		<tr>
			<th>No </th>
			<th>Lokasi</th>
			<th>Kapasitas</th>
			<th>Action</th>
			
		</tr>
	</thead>
	<tbody>
		<?php 
		$no = ($paging['current']-1) * $paging['limit'] ;
		$status = '';
		foreach($list->result_array() as $row)
		{
			$no++;
			
		?>
		<tr>
			<td><?= $no?></td>
			<td><?=match_key($row['Lokasi'],$key['search_key'])?></td>
			<td><?=$row['Kapasitas']?></td>
			<td>
				<div class="input-group-btn">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action <span class="fa fa-caret-down"></span></button>
					<ul class="dropdown-menu">
						<li><a href="#" onClick="input('<?= encode($row['Lokasi'])?>')">Edit</a></li>
						<li><a href="#" onClick="delete_confirm('<?=$row['Lokasi']?>')">Delete</a></li>
					</ul>
				</div>
			</td>
			
		</tr>
		<?php }?>
	</tbody>
	
</table>
<?=$paging['list']?>
