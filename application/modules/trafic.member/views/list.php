<script type="text/javascript" src="<?= base_url();?>assets/ui-member/js/freeze-table.js"></script>
<script type="text/javascript">
	$(function () {
		TableResponsive();
	});	
	function TableResponsive(){
		$('#funnel').freezeTable({
         'scrollBar': true,
         'headWrapStyles': {'top': '45px','width': '100px'},
         'columnNum' : 0,
        });
	}
	$( window ).resize(function() {
	  TableResponsive();
	})
</script>

 <script type="text/javascript">

  function detailTrafic(idFunnel) {
    $("#idFunnel").val(idFunnel);
    $('.collapse').collapse('hide');
    getListDetailTrafic();
  }

  function getListDetailTrafic(pg=''){
        // $('#search_customer').button('loading');
        showProgres();
        $.post(base_url(1)+'/trafic.member/manage/listTrafic/'+pg
            ,{
                idFunnel : $("#idFunnel").val(),
            }
            ,function(result) {
             $('#trafic'+$("#idFunnel").val()).html(result);
             $('#trafic'+$("#idFunnel").val()).collapse('show');
             hideProgres();
        }, "html");
        
    }
 </script>

<input type="hidden" id="idFunnel" name="idFunnel">
<div class="table-with-scrollbar" id="funnel" style='width: 100%;'>
<table class="table table-bordered table-hover menu">
	<thead>
		<tr>
			<th style="width: 1%; font-weight: bold;">No </th>
			<th style="font-weight: bold;">Nama Funnel</th>
			<th style="font-weight: bold;">Jumlah Trafic</th>
			<th style="font-weight: bold;">Link</th>
			<th style="font-weight: bold;">Status</th>
			<th style="width: 1%; font-weight: bold;">#</th>
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
			<td><?=$row['nama_funnel']?></td>
			<td><?=$row['JumlahTrafic']?></td>
			<td><?=$row['link'].'/'.$this->session->userdata('username').'/PIXEL'?></td>
			<td><?=$row['status']?></td>			
			<td> 
				<a class="btn btn-primary btn-xs" data-toggle="collapse" href="#trafic-<?=$row['id']?>" aria-expanded="false" aria-controls="trafic-<?=$row['id']?>" onclick="detailTrafic('<?= $row['id']; ?>')">
                  <i class=" icon-arrow-down menu-icon"></i>
				</a>
            </td>			
		</tr>
		<tr>
			<td colspan="5" style="padding: 0%;">
				<div id="trafic<?=$row['id']?>" class="collapse" role="tabpanel" >
				</div>
			</td>
		</tr>
		<?php }?>
	</tbody>
	
</table>
<?=$paging['list']?>
</div>
