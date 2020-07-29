<script type="text/javascript" src="<?= base_url();?>assets/ui-member/js/freeze-table.js"></script>
<script type="text/javascript">
	$(function () {
		TableResponsive();
	});	
	function TableResponsive(){
		$('#chart').freezeTable({
         'scrollBar': true,
         'headWrapStyles': {'top': '45px','width': '100px'},
         'columnNum' : 0,
        });
	}
	$( window ).resize(function() {
	  TableResponsive();
	})
</script>
<div class="table-with-scrollbar" id="chart" style='width: 100%;'>
<table class="table table-bordered table-hover menu">
	<thead>
		<tr>
			<th style="width: 1%; font-weight: bold;">No </th>
			<th style="font-weight: bold;">Nama</th>
			<th style="font-weight: bold;">Harga</th>
			<th style="font-weight: bold;">Diskon</th>
			<th style="font-weight: bold; width: 13%">Jumlah</th>
			<th style="font-weight: bold;">Total</th>
			<th style="width: 15%; font-weight: bold;">#</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no = 0;
		foreach($list->result_array() as $row)
		{
			$no++;
			
		?>
		<tr>
			<td><?= $no?></td>
			<td><?=$row['nama_produk']?></td>
			<td><?= number_format($row['harga']);?></td>
			<td><?= number_format($row['diskon']);?></td>
			<td><input type="number"  min='1' name="jumlahProduk<?= $no; ?>" id="jumlahProduk<?= $no; ?>" class="form-control" readonly value="<?=$row['jumlah']?>"></td>
			<td><?= number_format($row['total']);?></td>			
			<td> 
				<a style="display: none;" id="btnSave<?= $no; ?>"  class="btn btn-success btn-xs" href="javascript:void(0)" onclick="saveProduk('<?= $row['id']; ?>','<?= $no; ?>')" >
                  <i class="  icon-doc menu-icon"></i>
				</a>
				<a id="btnEdit<?= $no; ?>" class="btn btn-warning btn-xs" href="javascript:void(0)" onclick="editProduk('<?= $row['id']; ?>','<?= $no; ?>')">
                  <i class=" icon-note menu-icon"></i>
				</a>
				<a class="btn btn-danger btn-xs" href="javascript:void(0)" onclick="deleteProduk('<?= $row['id']; ?>')">
                  <i class="icon-trash menu-icon"></i>
				</a>
            </td>			
		</tr>
		<?php }?>
	</tbody>
	
</table>
<?=$paging['list']?>

<script type="text/javascript">
	function editProduk(id,no) {
		$('#jumlahProduk'+no).prop('readonly', false);
		$('#btnEdit'+no).hide();
		$('#btnSave'+no).show();
	}

	function saveProduk(id,no) {
		showProgres();
		$('#jumlahProduk'+no).prop('readonly', true);
		$('#btnEdit'+no).show();
		$('#btnSave'+no).hide();
	    $.post(base_url(1)+'/cart.member/manage/saveProduk'
	      ,{
	        id : id,
	        jumlahProduk : $('#jumlahProduk'+no).val()
	      }
	      ,function(result) {
	        if (result.error) {
	            showDangerToast(result.error);
	            refreshCart();
	        }else{
	            showSuccessToast(result.message);
	            refreshCart();
	            pageLoadCart(1);
	        }
	      }         
	      ,"json"
	    );
		
	}
	function deleteProduk(id,nama='') {
		swal({
		  title: "Hapus produk " +nama,
		  text: "Anda yakin hapus produk " +nama+' ?',
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((willDelete) => {
			$.post(base_url(1)+'/cart.member/manage/deleteProduk'
		      ,{
		        id : id
		      }
		      ,function(result) {
		        if (result.error) {
		            swal(result.error);
		            refreshCart();
		        }else{
		        	swal(result.message, {
				      icon: "success",
				    });
		            refreshCart();
		            pageLoadCart(1);
		        }
		      }         
		      ,"json"
		    );

		});
	}
</script>

</div>