<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= get_myconf('app_name')?></title>
	<link rel="shortcut icon" href="<?= site_url()?>assets/images/icon/honda_motor_logo.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <script>
        var site_url = "<?= site_url().get_language()?>/";
        // var site_url = "<?= site_url()?>";
		// alert(site_url);
      </script>
    <!--custom scripts for my Method-->
    <script src="<?= base_url();?>assets/custom/js/my_scripts.js"></script>
    <link rel="stylesheet" href="<?= base_url();?>assets/custom/css/my_custom.css">
    <!-- Bootstrap 3.3.5 -->
    <link href="<?= base_url();?>assets/LTE/bootstrap/css/bootstrap.css" rel="stylesheet" />
     <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url();?>assets/LTE/thirdparty/font-awesome/css/font-awesome.min.css">
    <!--- Animated class from
    <link href="<?= base_url();?>assets/inspinia/css/animate.css" rel="stylesheet">
    --->
     <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url();?>assets/assets/ionicons/css/ionicons.min.css">
    <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="<?= base_url();?>assets/LTE/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/LTE/plugins/fullcalendar/fullcalendar.print.css" media="print">
    <!-- Theme style -->
    <link href="<?= base_url();?>assets/LTE/dist/css/AdminLTE.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url();?>assets/LTE/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/LTE/plugins/select2/select2-bootstrap.css">

    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link href="<?= base_url();?>assets/LTE/dist/css/skins/_all-skins.min.css" rel="stylesheet" />
    <!-- iCheck -->
    <link href="<?= base_url();?>assets/LTE/plugins/iCheck/flat/blue.css" rel="stylesheet" />
    <link href="<?= base_url();?>assets/LTE/plugins/iCheck/all.css" rel="stylesheet" />
    <!-- Morris chart -->
    <link href="<?= base_url();?>assets/LTE/plugins/morris/morris.css" rel="stylesheet" />
    <!-- jvectormap -->
    <link href="<?= base_url();?>assets/LTE/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet"/>
    <!-- Date Picker -->
    <link href="<?= base_url();?>assets/LTE/plugins/datepicker/datepicker3.css" rel="stylesheet"/>
    <link href="<?= base_url();?>assets/LTE/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>
    <!-- Daterange picker -->
    <link href="<?= base_url();?>assets/LTE/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet"/>
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="<?= base_url();?>assets/LTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet"/>
	<!-- Morris charts -->
	<link rel="stylesheet" href="<?= base_url();?>assets/LTE/plugins/morris/morris.css">
	<!-- Bootstrap Color Picker -->
	<link rel="stylesheet" href="<?=base_url()?>assets/LTE/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
	
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<style>
.upperCase{
	text-transform: uppercase;
}
	</style>
  <body class="hold-transition skin-blue sidebar-mini fixed">
    <div class="wrapper">
      <header class="main-header">       
        <?php echo $this->load->view('tpl_header'); ?>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->          
              <?php echo $this->load->view('tpl_sidebar'); ?>        
        </section>
        <!-- /.sidebar -->
      </aside>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
			<div id="main-content">
            </div>
			<!-- Progress icon -->
			<div class="overlay" id="progres_cont" >
				<i class="fa fa-refresh fa-spin" style="left: 40%;top: 100px;"></i>
			</div>
      </div>
      <footer class="main-footer">
         <?php echo $this->load->view('tpl_footer'); ?>
      </footer>
<!-- Control Sidebar Right-->
         <?php echo $this->load->view('tpl_sidebar_right'); ?>    
      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?= base_url();?>assets/LTE/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <!-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> -->
   <script src="<?= base_url();?>assets/assets/jquery-slimscroll/jquery-ui-1.9.2.custom.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
       <!-- Notif -->
   <script src="<?= base_url();?>assets/assets/gritter/js/jquery.gritter.js"></script>
   <script src="<?= base_url();?>assets/js/bootbox.js"></script>
   <script src="<?= base_url();?>assets/js/bootbox.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?= base_url();?>assets/LTE/bootstrap/js/bootstrap.js"></script>
    <!-- Morris.js charts -->
    <script src="<?= base_url();?>assets/assets/raphael/js/raphael-min.js"></script>
    <!-- Sparkline -->
    <script src="<?= base_url();?>assets/LTE/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?= base_url();?>assets/LTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?= base_url();?>assets/LTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?= base_url();?>assets/LTE/plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="<?= base_url();?>assets/assets/moment/js/moment.min.js"></script>
    <script src="<?= base_url();?>assets/LTE/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="<?= base_url();?>assets/LTE/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="<?= base_url();?>assets/LTE/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?= base_url();?>assets/LTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="<?= base_url();?>assets/LTE/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?= base_url();?>assets/LTE/plugins/fastclick/fastclick.min.js"></script>
    <!-- LTE App -->
    <script src="<?= base_url();?>assets/LTE/dist/js/app.min.js"></script>
    <script src="<?= base_url();?>assets/assets/highcarts/highcharts.js"></script>
    <script src="<?= base_url();?>assets/assets/highcarts/highcharts-3d.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- AdminLTE for demo purposes -->

    
    <!-- Toastr style -->
    <link href="<?= base_url();?>assets/LTE/plugins/toastr/toastr.min.css" rel="stylesheet">
    <!-- Toastr -->
    <script src="<?= base_url();?>assets/LTE/plugins/toastr/toastr.min.js"></script>
  
  <!-- END EXTENDED -->
    <!-- Select2 -->
    <script src="<?= base_url();?>assets/LTE/plugins/select2/select2.min.js"></script>
  
    <!-- InputMask -->
    <script src="<?= base_url();?>assets/LTE/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="<?= base_url();?>assets/LTE/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?= base_url();?>assets/LTE/plugins/input-mask/jquery.inputmask.extensions.js"></script>
	
	   <script src="<?= base_url();?>assets/LTE/plugins/chartjs/Chart.min.js"></script>
   
    <script src="<?= base_url();?>assets/assets/eModal/dist/eModal.min.js"></script>
    <script src="<?= base_url();?>assets/LTE/plugins/iCheck/icheck.min.js"></script>
	<!-- Morris.js charts -->
    <script src="<?= base_url();?>assets/LTE/plugins/morris/morris.min.js"></script>
	<!-- Flot charts -->
    <script src="<?= base_url();?>assets/LTE/plugins/flot/jquery.flot.js"></script>
    <script src="<?= base_url();?>assets/LTE/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?= base_url();?>assets/LTE/plugins/flot/jquery.flot.pie.js"></script>
    <!-- jQuery Knob -->
	<script src="<?= base_url();?>assets/LTE/plugins/knob/jquery.knob.js"></script>
	<!-- bootstrap color picker -->
	<script src="<?=base_url()?>assets/LTE/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <!-- fullCalendar 2.2.5 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
  <script src="<?=base_url()?>assets/LTE/plugins/fullcalendar/fullcalendar.min.js"></script>
    
	<script src="<?= base_url();?>assets/js/upclick.js"></script>
	<script src="<?= base_url();?>assets/js/jquery.maskMoney.min.js"></script>
	<script src="<?= base_url();?>assets/js/jquery.mask.js"></script>
  
	<script src="<?= base_url();?>assets/js/bootstrap-switch.js"></script>
	<!-- JS file -->
	<script src="<?= base_url();?>assets/assets/EasyAutocomplete-1.3.5/jquery.easy-autocomplete.min.js"></script> 
	<!-- CSS file -->
	<link rel="stylesheet" href="<?= base_url();?>assets/assets/EasyAutocomplete-1.3.5/easy-autocomplete.min.css"> 
	<!-- Additional CSS Themes file - not required-->
	<link rel="stylesheet" href="<?= base_url();?>assets/assets/EasyAutocomplete-1.3.5/easy-autocomplete.themes.min.css"> 
    
	
	<input  id="content_now" hidden></input>
   <script type="text/javascript">
   var myNotify;
    $(document).ready(function(){
        <?php
        if ($menu['idAppMenu'])
        {
          echo 'loadMainContent(\''.$menu['URL'].'\');';
        }
        ?>
        // loadMainContent('dashboard');
        toastr.options = {
        closeButton: true,
        progressBar: false,
        showMethod: 'slideDown',
        positionClass: 'toast-top-right',
        timeOut: 1500
    			};
        hideProgres();
      // notify();
      // listNotify();
	});
      
 function modalview(uri,judul)
   {
      var options = {
           url: site_url +uri,
           title:judul,
           size: eModal.size.xl,
           // subtitle: 'smaller text header',
           buttons: [
               // {text: 'Save', style: 'info', close: true, click: eventA},
               // {text: 'Cancel', style: 'danger', close: true, click: eventB},
               // {text: 'WARNING', style: 'warning', close: true, click: eventC}
           ]
      };

   function eventA()
   {
    pesan_success('okeh');
   }
   function eventB()
   {
    pesan_error('info');
   }
   function eventC()
   {
      pesan.warning('Warning');
   }
      // modal
      eModal.ajax(options);
   }
	function notify() {
		$.post(site_url+'inventory/rfs_nrfs/rfs_nrfs/get_notify'
			,{}
			,function(result) {
				$('#counterNotif').text(result.counter)
				$('#counterNotif2').text(result.counter)
				if(result.counter <= 0){
					$('#counterNotif').removeClass('pulse-button');
					// stopNotify();
				}
				else{
					$('#counterNotif').addClass('pulse-button');
				}
			}					
			,"json"
		);
		myNotify = setTimeout(function(){ notify(); }, 10000);
		
		
	}
	function listNotify() {
		$.post(site_url+'inventory/rfs_nrfs/rfs_nrfs/list_notify'
			,{}
			,function(result) {
				$('#notifyResult').html(result)
			}					
			,"html"
		);
		setTimeout(function(){ listNotify(); }, 10000);
		
	}
	
	// function stopNotify() {
		// clearTimeout(myNotify);
	// }
   </script>
</body>


 
</html>
