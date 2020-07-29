<table class="table table-bordered table-hover menu">
	<thead>
		<tr>
			<th style="width: 1%; font-weight: bold;">No </th>
			<th style="font-weight: bold;">Nama</th>
			<th style="font-weight: bold;">Harga</th>
			<th style="font-weight: bold;">Diskon</th>
			<th style="font-weight: bold; width: 13%">Jumlah</th>
			<th style="font-weight: bold;">Total</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no = 0;
		$berat = 0;
		$totalCart = 0;
		$diskonCart = 0;
		foreach($list->result_array() as $row)
		{
			$no++;
			$berat = $row['berat'] * $row['jumlah'];
			$totalCart = $totalCart + $row['total'];
			$diskonCart = $diskonCart + $row['diskon'];
		?>
		<tr>
			<td><?= $no?></td>
			<td><?=$row['nama_produk']?></td>
			<td><?= number_format($row['harga']);?></td>
			<td><?= number_format($row['diskon']);?></td>
			<td><?=$row['jumlah']?></td>
			<td><?= number_format($row['total']);?></td>			
				
		</tr>
		<?php }?>
	</tbody>
	
</table>
<?=$paging['list']?>
<input type="hidden" name="berat" id="berat" value="<?=$berat ?>">
<input type="hidden" name="totalCart" id="totalCart" value="<?=$totalCart ?>">
<input type="hidden" name="diskonCart" id="diskonCart" value="<?=$diskonCart ?>">