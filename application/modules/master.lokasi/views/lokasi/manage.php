<script type="text/javascript">
	$(function () {
        hideProgres();
        pageLoadLokasi(1);
		
		
	});
	function pageLoadLokasi(pg)
	{	
		showProgres();
		$.post(site_url+'master.lokasi/lokasi/page/'+pg
			,$('#filter_content').serialize()
			,function(result) {
				$('#resultContent').html(result);
				hideProgres();
			}					
			,"html"
		);
	}
	
	function show_filter()
	{
		var tp = $('#effect').val();
		if(tp==1){
			$( "#toggle_filter" ).toggle( "blind","down" );
			$( "#toggle_filter_browse" ).toggle( "blind","down" );
			$('#sipb_effect').val(2);
		}else{
			$( "#toggle_filter" ).toggle( "blind","down" );
			$( "#toggle_filter_browse" ).toggle( "blind","down" );
			$('#effect').val(1);
		}
		
	}
	function input(id)
	{
		$('#form-main').hide();
		$('#form-input').show();
		//
		showProgres();
		$.post(site_url+'master.lokasi/lokasi/input'
			,{t_lokasi : id}
			,function(result) {
				$('#form-input').html(result);
				hideProgres();
			}					
			,"html"
		);
	}
	
	function delete_confirm(id)
    {
	   var options = {
			title: 'Warning',
			message: "Anda yakin akan menghapus Data : <code>"+id+"</code>?"
		};
		eModal.confirm(options).then(function callback(){
		  //jika OK
			showProgres();
			$.post(site_url+'master.lokasi/lokasi/delete'
					,{t_lokasi : id}
					,function(result) {
						// hideProgres();
						if(result.error){
							toastr.error(result.error,'Error');
							hideProgres();
						}else{
							toastr.success(result.message,'Save');
							hideProgres();
							pageLoadLokasi(1);
						}
					}					
					,"json"
				);
		},    function callbackCancel(){
		  //JIKA CANCEL
		});
    }
	function show_lokasi_list()
	{
		$('#form-main').show();
		$('#form-input').hide();
		
	}
</script>
<div id="form-main">
	<section class="content-header">
		<h1>
			<?=$title?> <small> </small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)" onclick="loadMainContent('dashboard')"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Lokasi</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12" >
				<div class="box">
					<div class="box-header">
						<div class="row">
							<div class="col-sm-4">
								<div class="btn-group">
									<button type="button" class="btn btn-default">Print</button>
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span>
									<span class="sr-only">Toggle Dropdown</span>
									</button>
									<ul class="dropdown-menu" role="menu">
									<li><a href="#" onClick="printPDF();">Cetak PDF</a></li>
									<li><a href="#" onClick="exportExcel();">Export Excel</a></li>
									</ul>
								</div>
								<div class="btn-group">
									<button type="button" class="btn btn-info" onclick="input()">New</button>
								</div>
							</div>
							<div class="box-tools">
								<div class="input-group pull-right" style="width: 100px;">
									<button type="button" class="btn btn-warning" onClick="show_filter()">Show Filter</button>
								</div>
							</div>
						</div>
						<form id="filter_content" method="post" action="<?= base_url()?>/master.lokasi/lokasi/manage/export_to_excel">
							<div hidden>
							<input name="t_effect" id="effect" value="1">
							</div>
							<div id="toggle_filter" hidden>
								<div class="row">
									<div class="form-group">
										<div class="col-sm-6">
											<label>Search</label>
											<input type="text" class="form-control" id="search_key" name="t_search_key" placeholder="" value="" onkeydown="if (event.keyCode == 13) pageLoadLokasi(1)">
										</div>
									</div>
									
								</div>
								
							</div>
						</form>
							
						<div class="row" id="toggle_filter_browse" hidden>
							<div class="form-group">
								<div class="input-group pull-right" style="width: 100px;">
									<button type="button" class="btn btn-primary" onClick="pageLoadLokasi(1)">Browse</button>
									
								</div>
							</div>
						</div>
					</div>
					<div class="box-body table-responsive no-padding">
						<div class="box-body">
							<div id="resultContent"></div>
						</div>
					</div><!-- /.box-body -->
				</div>
			</div>
		</div>
	</section>
</div>

<div id="form-input">
</div>
