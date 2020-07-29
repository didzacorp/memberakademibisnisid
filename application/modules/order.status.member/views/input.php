<script type="text/javascript">
	$(function () {
		$(".select2").select2();
		   
	});		
	function save()
	{
		showProgres();
		$('#load').button('loading');
		$.post(site_url+'master.lokasi/lokasi/save'
			,$('#formContent').serialize()
			,function(result) {
				hideProgres();
				if (result.message)
				{
					$('#load').button('reset');
					toastr.success(result.message,'Save');
					pageLoadLokasi(1);
					show_lokasi_list();
					// input(result.Lokasi);					
				}else
				{
					// clean error sign
					$("#formContent").find('*').removeClass("has-error");
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
					// show error message
					$('#load').button('reset');
					toastr.error(result.error,'Error');
				}
			}					
			,"json"
		);
	}
	
</script>
<section class="content-header">
	<h1>
		Data Lokasi <small></small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#" onclick="loadMainContent('dashboard')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li>Master Lokasi</li>
		<li><a href="#" onclick="show_lokasi_list()">Lokasi</a></li>
		<li class="active">Input</li>
	</ol>
</section>
<section class="content" >
	<div class="row">
		<div class="col-md-4">
		</div>
		<div class="col-md-4">
			<div class="box box-default">
				<form id="formContent">
					<input type="hidden" id="lokasi_current" name="t_lokasi_current" value="<?= encode($lokasi['Lokasi'])?>"/>
					<div class="box-body">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Lokasi</label>
									<div class="input-group col-md-12"> 
										<input type="text" <?=$lokasi['Lokasi']?'readonly':''?> class="form-control" id="lokasi" name = "t_lokasi" placeholder="Lokasi" value="<?= $lokasi['Lokasi']?>">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Kapasitas</label>
									<div class="input-group col-md-12"> 
										<input type="number" min="0" class="form-control"  id="kapasitas" name="t_kapasitas" placeholder="Kapasitas" value="<?= $lokasi['Kapasitas']?>">
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</form>
				<div class="box-footer">
					<button type="submit" class="btn btn-warning" onclick="show_list();">Close</button>
					<button type="submit" class="btn btn-info pull-right" onclick="save();" id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Loading...">Submit</button>
				</div>
			</div>
		</div>
	</div>
</section>