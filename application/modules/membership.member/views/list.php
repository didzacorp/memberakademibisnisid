<script type="text/javascript" src="<?= base_url();?>assets/ui-member/js/freeze-table.js"></script>
<script type="text/javascript">
	$(function () {
		pageHistory(1);
		TableResponsive();
	});	
	function TableResponsive(){
		$('#membership').freezeTable({
         'scrollBar': true,
         'headWrapStyles': {'top': '45px','width': '100px'},
         'columnNum' : 0,
        });

        $('#membershipHistory').freezeTable({
         'scrollBar': true,
         'headWrapStyles': {'top': '45px','width': '100px'},
         'columnNum' : 0,
        });
	}
	$( window ).resize(function() {
	  TableResponsive();
	})

  function pageHistory(pg)
  { 
    showProgres();
    $.post(base_url(1)+'/membership.member/manage/pageHistory/'+pg
      // ,{
      //   id_member :$('#id_member').val()
      // }
      ,function(result) {
        $('#tableHistory').html(result);
        hideProgres();
      }         
      ,"html"
    );
  }
</script>

<table  style="margin-bottom:0px;width: 100%">
<tbody >
    <tr >
        <th >
            <h4 > <b>Lisensi : Basic</b></h4>
        </th>
        <th  class="text-right">
        	<a  class="btn btn-warning" href="javascript:void(0)" onclick="upgradeMember()"> Upgrade Lisensi</a>
        </th>
    </tr>
</tbody>
</table>
<hr>
<div class="row">
<div class="col-lg-12">
  <h5>Komisi Bulan Ini</h5></div>
<div class="col-lg-6" style="margin-bottom: 1%;">
  <div class="card text-white bg-primary text-right">
      <h6 class="card-header">Komisi Referral</h6>
      <div class="card-body pb-0">
          <h4 class="mb-0">Rp <?= number_format($komisi['komisi_referal']) ?></h4>
          <p>Member baru : <?= number_format($komisi['jumlah_member']) ?></p>
      </div>
  </div>
</div>
<div class="col-lg-6" style="margin-bottom: 1%;">
  <div class="card text-white bg-info text-right">
      <h6 class="card-header">Komisi Penjualan</h6>
      <div class="card-body pb-0">
          <h4 class="mb-0">Rp <?= number_format($komisi['komisi_penjualan'])?></h4>
          <p>Omset : <?= number_format($komisi['omset_penjualan']) ?></p>
      </div>
  </div>
</div>
<div class="col-lg-12" style="margin-bottom: 1%;">
  <div class="card text-white bg-warning
 text-right">
      <h6 class="card-header">Total Commission</h6>
      <div class="card-body pb-0">
          <!---->
          <h4 class="mb-0">Rp <?= number_format($komisi['komisi_referal'] + $komisi['komisi_penjualan'])?></h4>
          <!---->
          <p></p>
      </div>
  </div>
</div>
</div>

<div class="table-with-scrollbar" id="membershipHistory" style='width: 100%;'>
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>No</th>
			<th>Jumlah Member</th>
			<th>Tanggal</th>
			<th>Komisi Referal</th>
			<th>Komisi Penjualan</th>
			<th>Omset Penjualan</th>
		</tr>
	</thead>
	<tbody id="tableHistory">
	</tbody>
</table>
</div>
<br>
<div class="table-with-scrollbar" id="membership" style='width: 100%;'>
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>No</th>
			<th>Name</th>
			<th>Email</th>
			<th>No Telpn</th>
			<th>Tim Member</th>
			<th>*</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$no = 0; 
			foreach ($list->result_array() as $row) {
				$no++;
			?>
				<tr>
					<td><?= $no; ?></td>
					<td><?= $row['nama']?></td>
					<td><?= $row['email']?></td>
					<td><?= $row['nomor_telepon']?></td>
					<td><?= $row['total_upline1'] ?></td>
					<td>
						<a href="javascript:void(0)" class="btn btn-warning btn-sm" 
						onclick="
						$('#id_member').val('<?= $row['id']?>');
						$('#MemberName').append(' > <a href=\'javascript:void(0)\'>'+'<?= $row['nama']; ?>'+'</a>');
						pageLoadMemberShip(1);
						
						"
						>View Detail</a>
					</td>
					
				</tr>
			<?php
			}
		 ?>
	</tbody>
</table>
</div>