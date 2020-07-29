<?php 
	$no = ($paging['current']-1) * $paging['limit'] ;
	foreach ($listHistory->result_array() as $row) {
		$no++;
	?>			
		<tr>
			<td><?= $no; ?></td>
			<td><?= number_format($row['jumlah_member'])?></td>
			<td><?= humanize_date($row['tanggal'])?></td>
			<td><?= number_format($row['komisi_referal'])?></td>
			<td><?= number_format($row['komisi_penjualan'])?></td>
			<td><?= number_format($row['omset_penjualan']) ?></td>					
		</tr>
	<?php
	}
 ?>
 <tr>
 	<td colspan="6">
 		<?=$paging['list']?>
 	</td>
 </tr>