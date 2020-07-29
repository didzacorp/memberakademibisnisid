<script type="text/javascript">
	$(function () {
        show("main_container");
	});
	function show(cont)
	{
		hide_all();
		$("#"+cont).show();
		if ($("#"+cont).html().length <= 10)
			load_data(cont);
	}
	function hide_all()
	{
		$('#main_container').hide();
		$('#gudang_container').hide();
		$('#lokasi_container').hide();
		$('#finance_comp_container').hide();
		$('#acc_ksu_container').hide();
		$('#no_cont_container').hide();
	}
	function load_data(cont)
	{
		showProgres();
		var url = '';
		if (cont == 'main_container')
			return;
		if (cont == 'gudang_container')
			url = 'master.lokasi/gudang/manage';
		if (cont == 'lokasi_container')
			url = 'master.lokasi/lokasi/manage';
		if (cont == 'finance_comp_container')
			url = 'master.lokasi/finance_comp/manage';
		if (cont == 'acc_ksu_container')
			url = 'master.lokasi/acc_ksu/manage';
		if (cont == 'no_cont_container')
			url = 'master.lokasi/container/manage';
		
		$.post(site_url+url
				,{}
				,function(result) {
					$('#'+cont).html(result);
					hideProgres();
				}					
				,"html"
			);
	}
</script>
<div id="main_container">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
		Lokasi
		<small>database lokasi</small>
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="#" onclick="loadMainContent('dashboard');"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Manage</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<?= $this->menu->build_short_cut(104);?>
	</section><!-- /.content -->
</div>
<div id="gudang_container">

</div>
<div id="lokasi_container">
	
</div>
<div id="finance_comp_container">
	
</div>
<div id="acc_ksu_container">
	
</div>
<div id="no_cont_container">
	
</div>
