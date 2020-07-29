<script type="text/javascript">
	$(function () {
        hideProgres();
        pageLoadGudang(1);
		
		
	});
	function pageLoadGudang(pg)
	{	
		showProgres();
		$.post(site_url+'master.lokasi/gudang/manage/page/'+pg
			,$('#filterContentGudang').serialize()
			,function(result) {
				$('#resultContentGudang').html(result);
				hideProgres();
			}					
			,"html"
		);
	}
	
	function show_filterGudang()
	{
		var tp = $('#effectGudang').val();
		if(tp==1){
			$( "#toggle_filterPeruntukanMotor" ).toggle( "blind","down" );
			$( "#toggle_filterPeruntukanMotor_browse" ).toggle( "blind","down" );
			$('#effectGudang').val(2);
		}else{
			$( "#toggle_filterPeruntukanMotor" ).toggle( "blind","down" );
			$( "#toggle_filterPeruntukanMotor_browse" ).toggle( "blind","down" );
			$('#effectGudang').val(1);
		}
		
	}
	function gudang_input(code)
	{
		$('#gudang_list_container').hide();
		$('#gudang_input_container').show();
		//
		showProgres();
		$.post(site_url+'master.lokasi/gudang/manage/input'
			,{t_Code : code}
			,function(result) {
				$('#gudang_input_container').html(result);
				hideProgres();
			}					
			,"html"
		);
	}
	
	function delete_confirm(code)
    {
	   var options = {
			title: 'Warning',
			message: "Anda yakin akan menghapus Data : "+code+"?"
		};
		eModal.confirm(options).then(function callback(){
		  //jika OK
			showProgres();
			$.post(site_url+'master.lokasi/gudang/manage/delete'
					,{t_Code : code}
					,function(result) {
						// hideProgres();
						if(result.error){
							toastr.error(result.error,'Error');
							hideProgres();
						}else{
							toastr.success(result.message,'Save');
							hideProgres();
							pageLoadGudang(1);
						}
					}					
					,"json"
				);
		},    function callbackCancel(){
		  //JIKA CANCEL
		});
    }
	function show_gudang_list()
	{
		$('#gudang_list_container').show();
		$('#gudang_input_container').hide();
		
	}
</script>
<div id="gudang_list_container">
	<section class="content-header">
		<h1>
			Master Gudang
		</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)" onclick="loadMainContent('dashboard')"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="javascript:void(0);" onClick="show('main_container')">Lokasi</a></li>
			<li class="active">Gudang</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12" >
				<div class="box">
					<div class="box-header">
						<div class="row">
							<div class="col-sm-8">
								<!--div class="btn-group">
									<button type="button" class="btn btn-default">Print</button>
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span>
									<span class="sr-only">Toggle Dropdown</span>
									</button>
									<ul class="dropdown-menu" role="menu">
									<li><a href="#" onClick="printPDF();">Cetak PDF</a></li>
									<li><a href="#" onClick="exportExcel();">Export Excel</a></li>
									</ul>
								</div> -->
								<?php if($this->session->userdata('Operator')['fidMsOperatorGroup'] == 1){ ?>
								<div class="btn-group">
									<button type="button" class="btn btn-info" onclick="gudang_input()">New</button>
								</div>
								<?php } ?>
							</div>
							<div class="col-sm-4">
								<div class="box-tools">
									<div class="input-group pull-right" style="width: 100px;">
										<button type="button" class="btn btn-warning" onClick="show_filterGudang()">Show Filter</button>
									</div>
								</div>
							</div>
						</div>
						<form id="filterContentGudang" method="post" action="<?= base_url()?>/master.lokasi/gudang/manage/export_to_excel">
							<div hidden>
							<input name="t_effectGudang" id="effectGudang" value="1">
							</div>
							<div id="toggle_filterPeruntukanMotor" hidden>
								<div class="row">
									<div class="form-group">
										<div class="col-sm-4">
											<label>Kode</label>
											<input type="text" class="form-control" id="Code" name="t_Code" placeholder="" value="" onkeydown="if (event.keyCode == 13) pageLoadGudang(1)">
										</div>
										<div class="col-sm-4">
											<label>Nama Lokasi</label>
											<input type="text" class="form-control" id="Description" name="t_Description" placeholder="" value="" onkeydown="if (event.keyCode == 13) pageLoadGudang(1)">
										</div>
									</div>
									
								</div>
								
							</div>
						</form>
							
						<div class="row" id="toggle_filterPeruntukanMotor_browse" hidden>
							<div class="form-group">
								<div class="input-group pull-right" style="width: 100px;">
									<button type="button" class="btn btn-primary" onClick="pageLoadGudang(1)">Browse</button>
									
								</div>
							</div>
						</div>
					</div>
					<div class="box-body table-responsive no-padding">
						<div class="box-body">
							<div id="resultContentGudang"></div>
						</div>
					</div><!-- /.box-body -->
				</div>
			</div>
		</div>
	</section>
</div>

<div id="gudang_input_container">
</div>
