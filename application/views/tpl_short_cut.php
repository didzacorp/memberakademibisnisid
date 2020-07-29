<div class="row">
	<?php
	$group_name = '-none-';
	$col_num = 1;
	foreach ($list->result_array() as $mn)
	{
		if ($group_name != $mn['GroupName'] && $mn['GroupName'])
		{
			?>
			</div>
			<h3 class="page-header"><?= $mn['GroupName'] ?></h3>
			<div class="row">
			<?php
			$col_num = 1;
		}
		$onClick = 'okl';
		if ($mn['OnClick'])
		{	
			$onClick = $mn['OnClick'];
		}else
		{
			$onClick = "alert('Short cut ".$mn['Title']." belum aktif')";			
		}
		$col_class = 'col-md-'.$mn['ColumnWidth'];
		?>
			<div class="<?= $col_class?>">
				<div class="box info-box box-warning <?= $mn['Color']?>" id="box<?= $mn['idAppShortCut']?>" 
				inner-url = "<?= $mn['InnerInfoURL']?>" onclick="<?= $onClick ?>">
					<span class="info-box-icon"><i class="fa <?= $mn['Icon']?>"></i></span>
					<div class="info-box-content ">
						<span class="info-box-text"><?= $mn['Title']?></span>
						<span class="info-box-number">0</span>
							<div class="progress">
								<div class="progress-bar" style="width: 0%"></div>
							</div>
							<span class="progress-description"><?= $mn['Description']?>
							</span>
						</div>
		        <div class="overlay">
		          <i class="fa fa-refresh fa-spin"></i>
		        </div>
		      </div>
		    </div>
		<?php 
		$group_name = $mn['GroupName'];
		$col_num++;
	}
	?>
</div>
<script type="text/javascript">
$(function () {
	<?php
	foreach ($list->result_array() as $mn)
	{
		if ($mn['InnerInfoURL'])
			{
				?>
				inner_info_load('<?= $mn['idAppShortCut']?>');
				<?php
			}else{
				?>
				remove_overlay('<?= $mn['idAppShortCut']?>');
				<?php
			}
	}
	?>
});
	function remove_overlay(id)
	{
		$('#box'+id+' .overlay').remove();
		$('#box'+id).removeClass("box");

	}
	function inner_info_load(id)
	{
		var obj = '';
		var url = '';
		obj = '#box'+id;
		url = $(obj).attr("inner-url");
		$.post(site_url+url
			,{}
			,function(result) {
				if (result.message == 'Loaded')
				{

					remove_overlay(id);
					$(obj+' .info-box-number').text(result.title);
					$(obj+' .progress-bar').css('width',result.progress+'%');
					if (result.status)
					{
						$(obj+' .progress-description').text(result.status);
					}
				}
			}					
			,"json"
			);
	}
</script>
<h3 class="page-header" hidden>sample</h3>
<div class="row" hidden>
	<div class="col-md-3">
      <div class="box box-danger">
        <div class="box-header">
          <h3 class="box-title">Item</h3>
        </div>
        <div class="box-body">
          Loading
        </div>
        <div class="overlay">
          <i class="fa fa-refresh fa-spin"></i>
        </div>
      </div>
    </div>

    <div class="col-md-3">
	  <div class="info-box bg-red >
		<span class="info-box-icon"><i class="fa fa-star-o"></i></span>
		<div class="info-box-content ">
			<span class="info-box-text">Judul</span>
			<span class="info-box-number">100</span>
			<div class="progress">
				<div class="progress-bar" style="width: 78%"></div>
			</div>
			<span class="progress-description"> Prosgress message
			</span>
			
		</div>
	  </div>
	</div>
</div>