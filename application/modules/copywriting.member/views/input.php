<style>
#imagePreview {
    width: 180px;
    height: 180px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
	
});
function gudang_save()
	{
		showProgres();
		$('#load').button('loading');
		$.post(site_url+'master.lokasi/gudang/manage/save'
			,$('#gudang_input_form').serialize()
			,function(result) {
				hideProgres();
				if (result.message)
				{
					toastr.success(result.message,'Save');
					$('#KodeDealerCurrent').val(result.KodeDealer);
					$('#CodeCurrent').val(result.Code);
					setTimeout(function () {
						$('#load').button('reset');
					}, 2000);
				}else{
					// clean error sign
					$("#gudang_input_form").find('*').removeClass("has-error");
					$('.error-obj-blocked').remove();
					// sign object that blocked
					var blockObj = result.blocked_object;
					var objName = '';
					var objMsg = '';
					if (blockObj.length > 0)
					{
						for (obj in blockObj)
						{
							objName = blockObj[obj].obj_name;
							$("input[name="+objName+"]").parent().parent().addClass('has-error');
							$("input[name="+objName+"]").parent().parent().append('<p class="pull-right text-red error-obj-blocked">'+blockObj[obj].obj_msg+'</p>');
						}
					}
					toastr.error(result.error,'Error');
					setTimeout(function () {
						$('#load').button('reset');
					}, 2000);
				}
			}					
			,"json"
		);
	}
</script>
<section class="content-header">
	<h1>
		Master Gudang
	</h1>
	<ol class="breadcrumb">
		<li><a href="#" onclick="show('main_container')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#" onClick="show('main_container')">Lokasi</a></li>
		<li><a href="#" onclick="show_gudang_list()"> Gudang</a></li>
		<?php if ($gudang['KodeDealer']) {?>
		<li><a href="#" onclick="gudang_input('<?= encode($gudang['KodeDealer'])?>')"><?= $gudang['Code']?></a></li>
		<?php }else{?>
		<li class="active">Input</li>
		<?php }?>
	</ol>
</section>
<?php
// $gudang['TypeCode'] = '';
// $gudang['TypeName'] = '';
?>
<section class="content" >
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<form class="form-horizontal" id="gudang_input_form">
					<input type="hidden" id="KodeDealerCurrent" name="t_KodeDealerCurrent" value="<?= encode($gudang['KodeDealer'])?>">
					<input type="hidden" id="CodeCurrent" name="t_CodeCurrent" value="<?= encode($code) ?>">
					<div class="box-body">
							<div class="form-group">
									<label class="col-sm-2">Dealer</label>
									<div class="col-sm-4">
										<div class="input-group col-sm-12"> 
											<select class="form-control select2" id="KodeDealer" name="t_KodeDealer">
												<option value="0">Pilih</option>
												<?php
													foreach($dealer->result_array() as $row){
														$kodeDealer = $gudang['KodeDealer'];
														if(!$kodeDealer) {
															$kodeDealer = $this->session->userdata('Dealer')['KodeDealer'];
														}
												?>
													<option value="<?=$row['KodeDealer']?>" <?= $row['KodeDealer'] == $kodeDealer? 'selected':''; ?>><?=$row['Nama']?></option>
													<?php }?>
											</select>
										</div>
									</div>
							</div>
							<div class="form-group">
									<label class="col-sm-2">Kode Gudang</label>
									<div class="col-sm-2">
										<input type="text" class="form-control" id="Code" name="t_Code" placeholder="name" value="<?= $gudang['Code']?>">
									</div>
							</div>
							<div class="form-group">
									<label class="col-sm-2">Nama Lokasi</label>
									<div class="col-sm-4">
										<textarea type="text" class="form-control" placeholder="Enter ..." name="t_Description"><?= $gudang['Description']?></textarea>
									</div>
							</div>
							
						
					</div><!-- /.box-body -->
				</form>
				<div class="box-footer">
					<a href="javascript:void(0);" class="btn btn-warning" onclick="show_gudang_list();">Close</a>
					<a href="javascript:void(0);" class="btn btn-info pull-right" onclick="gudang_save();" id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Loading...">Save</a>
				</div>
			</div>
		</div>
	</div>
</section>