
<script type="text/javascript" src="<?= base_url();?>assets/ui-member/js/freeze-table.js"></script>
<script type="text/javascript">
	$(function () {
		TableResponsive();

		$('#funnel').freezeTable({
         'scrollBar': false,
         'freezeHead': false,
         'freezeColumn': false,
         'freezeColumnHead': false
        });
	});	
	function TableResponsive(){
		$('#trafic').freezeTable({
         'scrollBar': true,
         'headWrapStyles': {'top': '45px','width': '100px'},
         'columnNum' : 1,
        });

        
	}

	$( window ).resize(function() {
	  TableResponsive();
	})
</script>
    <div class="table-with-scrollbar" id="trafic" style='width: 100%;'>
<table class="table table-bordered table-hover menu" style="background-color: #cccbcb;min-width: 100%;" id="tech-companies-1" >
	<thead >
		<tr >
			<th style="width: 1%font-weight: bold;">No </th>
			<th style="font-weight: bold;">Pixel</th>
			<th style="font-weight: bold;">Alamat IP</th>
			<th style="font-weight: bold;">User Agent</th>
			<th style="font-weight: bold;">Tanggal</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no = 0;
		$status = '';
		foreach($list->result_array() as $row)
		{
			$no++;
			
		?>
		<tr>
			<td><?= $no?></td>
			<td><?=$row['pixel']?></td>
			<td><?=$row['ip_address']?></td>
			<td><?=$row['user_agent']?></td>
			<td><?=$row['tanggal']?></td>				
		</tr>
		<?php }?>
	</tbody>
	
</table>
<?=$paging['list']?>
</div>