<script type="text/javascript">
	$(function () {
      	$('#MemberName').html(' > '+'<?= $DataMember['nama']; ?>'+' Detail Member');
  });
</script>
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>No</th>
			<th>Name</th>
			<th>Email</th>
			<th>No Telpn</th>
			<th>*</th>
		</tr>
	</thead>
	<tbody>
		<?php 
				if ($Upline1['id']) {
					?>
						<tr>
							<td>1</td>
							<td><?= $Upline1['nama']?></td>
							<td><?= $Upline1['email']?></td>
							<td><?= $Upline1['nomor_telepon']?></td>
							<td>
								<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="DetailUpline('<?= $Upline1['id'] ?>')">View Detail</a>
							</td>
							
						</tr>
					<?php
				}
		 ?>

		<?php 
				if ($Upline2['id']) {
					?>
						<tr>
							<td>2</td>
							<td><?= $Upline2['nama']?></td>
							<td><?= $Upline2['email']?></td>
							<td><?= $Upline2['nomor_telepon']?></td>
							<td>
								<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="DetailUpline('<?= $Upline2['id'] ?>')">View Detail</a>
							</td>
							
						</tr>
					<?php
				}
		 ?>


		<?php 
				if ($Upline3['id']) {
					?>
						<tr>
							<td>3</td>
							<td><?= $Upline3['nama']?></td>
							<td><?= $Upline3['email']?></td>
							<td><?= $Upline3['nomor_telepon']?></td>
							<td>
								<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="DetailUpline('<?= $Upline3['id'] ?>')">View Detail</a>
							</td>
							
						</tr>
					<?php
				}
		 ?>


		<?php 
				if ($Upline4['id']) {
					?>
						<tr>
							<td>4</td>
							<td><?= $Upline4['nama']?></td>
							<td><?= $Upline4['email']?></td>
							<td><?= $Upline4['nomor_telepon']?></td>
							<td>
								<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="DetailUpline('<?= $Upline4['id'] ?>')">View Detail</a>
							</td>
							
						</tr>
					<?php
				}
		 ?>

	</tbody>
</table>