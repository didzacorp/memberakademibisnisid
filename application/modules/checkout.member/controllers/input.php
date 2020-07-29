<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css"> 
<style type="text/css">
	div.dm-wrapperDiv div.dm-innerDiv {
	    border-bottom: 1px solid #ffffff;
	    background-color: #ffffff;
	}
</style>
<script type="text/javascript">
	var $myFuelGauge;
	$(function () {

		$("#FieldSubPekerjaan").hide();
		$myFuelGauge = $("div#fuel-gauge").dynameter({
		    width: 200,
		    label: 'fuel',
		    value: <?= $sa['BensinSaatIni'] ? : '0.0'; ?>,
		    min: 0.0,
		    max: 100.0,
		    unit: '%',
		    regions: { // Value-keys and color-refs
		      0.5: 'error',
		      10.5: 'warn',
		      30.5: 'normal'
		    }
		  });

		  // jQuery UI slider widget
		  $('div#fuel-gauge-control').slider({
		    min: 0.0,
		    max: 100.0,
		    value: <?= $sa['BensinSaatIni'] ? : '0.0'; ?>,
		    step: .1,
		    slide: function (evt, ui) {
		      $myFuelGauge.changeValue((ui.value).toFixed(1));
		      $("#BensinSaatIni").val(ui.value);
		    }
		  });
		  <?php 
		  	if ($KodeBooking) {
		  		?>
		  			$("#kode_booking").val('<?=$KodeBooking; ?>');
		  			if ($("#kode_booking").val()) {
						$("#RegularSelect").val('');
						$("#BookingSelect").show();
						$("#RegularSelect").hide();
					}else{
						$("#BookingSelect").val('');
						$("#RegularSelect").show();
						$("#BookingSelect").hide();
					}
		  		<?php
		  	}else{
		  		?>
		  				$("#BookingSelect").val('');
						$("#RegularSelect").show();
						$("#BookingSelect").hide();
		  		<?php
		  	}
		   ?>
		
		

		onKeyPress('booking');
		onKeyPress('NoMesin');
		getCustomer('<?= $sa['FKIDPembawaMotor']?>','pengantar');
		getCustomer('<?= $sa['FKIDPemakaiMotor']?>','pemakai');
		getCustomer('<?= $sa['FKIDCustomer']?>','pemilik');
		//
		$(".select2").select2();
	});


	function checkDataSA(param) {
		if(param == 'noPolisi'){
			var NoSA = $('#no_polisi').val();						
		}else if(param == 'NoMesin'){
			var NoSA = $('#no_mesin').val()
		}else if(param == 'NoRangka'){
			var NoSA = $('#no_rangka').val();
		}

		$.post(site_url+'h2.service.man_work.order/serviceadvisor/checkDataSA'
			,{
				NoSA : NoSA,
				param : param,
			}
			,function(result) {
				if (result.dataSA.IDServiceAdvisor) {
					$('#no_mesin').val(result.dataSA.NoMesin);
					$('#no_rangka').val(result.dataSA.NoMesin);
					$('#no_polisi').val(result.dataSA.NoPolisi);

					$("#Tipe_Motor").val(result.dataSA.TipeMotor);
					$(".select2").select2();
					get_warna(result.dataSA.TipeMotor,result.dataSA.KodeWarna);
					
					$('#info_checkCDB').html('');

					// if (result.dataRecall.JenisRecall == '1') {
					// 	$('#info_checkRecall').html('Soft Recall');
					// }else if (result.dataRecall.JenisRecall == '2') {
					// 	$('#info_checkRecall').html('Hard Recall');
					// }else{
					// 	$('#info_checkRecall').html('');
					// }
					
					// $('#no_telpon').val(result.dataCDB.NoHP);
     //                $('#nama_customer').val(result.dataUSTK.NamaKTP);
     //                $('#alamat_ktp').val(result.dataUSTK.AlamatKTP);
                    $('#tahunKendaraan').val(result.dataSA.Tahun);

                    // $('#NoKTP').val(result.dataCDB.NoKTPNPWP);
                 
				  	
                    // if (result.dataCDB.Pekerjaan == '2') {
                    //     $("#Pekerjaan").val('2');
                    //     checkPekerjaan(2);
                    //     $("#SubPekerjaan").val(result.dataCDB.Pekerjaan).trigger('change');
                    //     $(".select2").select2();
                    // }else if (result.dataCDB.Pekerjaan == '4'){
                    //     $("#Pekerjaan").val('4');
                    //     checkPekerjaan(4);
                    //     $("#SubPekerjaan").val(result.dataCDB.Pekerjaan).trigger('change');
                    //     $(".select2").select2();
                    // }else{
                    //     $('#Pekerjaan').val(result.dataCDB.Pekerjaan);
                    // }
                    
                    getCustomer(result.getCust.IDCustomer,'pemilik');

					$('#historyBtn').attr("disabled", false);
				}else{
					if(param == 'noPolisi'){
						onKeyPress('noPolisi');						
					}else if(param == 'NoMesin'){
						onKeyPress('NoMesin');
					}else if(param == 'NoRangka'){
						onKeyPress('NoRangka');
					}
				}
		}, "json");
	}

	// function removeSpaces(string) {
	//  return string.split(' ').join('');
	// }

	function onKeyPress(jenis,param='') {
		$('#customerFormTitle').html();
		if (jenis === 'customer') {
			if (param == 'pengantar') {
				$('#customerFormTitle').html('Pengantar');
				var jenis_customer = $('#customerFormTitle').html();

				var pengantar_id_customer = $("#pengantar_id_customer").val();
				getCustomer(pengantar_id_customer,jenis_customer.toLowerCase());
			
			}else if(param == 'pemakai'){
				$('#customerFormTitle').html('Pemakai');
				var jenis_customer = $('#customerFormTitle').html();

				var pemakai_id_customer = $("#pemakai_id_customer").val();
				getCustomer(pemakai_id_customer,jenis_customer.toLowerCase());
				
				// getDataCustomer(pemakai_id_customer,'1');
			
			}else if (param == 'pemilik') {
				$('#customerFormTitle').html('Pemilik');
				var jenis_customer = $('#customerFormTitle').html();

				var pemilik_id_customer = $("#pemilik_id_customer").val();
				getCustomer(pemilik_id_customer,jenis_customer.toLowerCase());
			
			}else{}
			
		}else if (jenis === 'noPolisi') {
			var no_polisi = $("#no_polisi").val();
			checkNoPolisi(no_polisi);
		}else if (jenis === 'NoMesin') {
			$('#info_checkCDB').html('');
			$('#info_checkRecall').html('');
			var no_mesin = $("#no_mesin").val();
			// $("#no_rangka").val('');
			if (no_mesin !='') {
				checkCDB(no_mesin,0);
			}
			
		}else if (jenis === 'NoRangka') {
			$('#info_checkCDB').html('');
			$('#info_checkRecall').html('');
			var no_rangka = $("#no_rangka").val();
			// $("#no_mesin").val('');
			if (no_rangka !='') {
				checkCDB(0,no_rangka);
			}
			
		}else{
			var no_booking = $("#kode_booking").val();
			if (no_booking != "") {
				clearInput();
			  	getDataNoBooking(no_booking);	
			}
			
		
		}
	}
	
	function checkCDB(NoMesin=0,NoRangka=0) {
		$.post(site_url+'h2.service.man_work.order/serviceadvisor/checkCDB'
			,{
				NoMesin : NoMesin,
				NoRangka : NoRangka,
			}
			,function(result) {
				if(result.error){
					toastr.error(result.error,'Error');
				}
				
				if(result.dataSL.NoRangka != ''){
					console.log('ADA');
					$("#no_mesin").val(result.dataSL.NoEngineLengkap);
					$("#no_rangka").val(result.dataSL.NoRangka);
					$("#Tipe_Motor").val(result.dataSL.KodeModel);
					$(".select2").select2();
					get_warna(result.dataSL.KodeModel,result.dataSL.KodeWarna);
					
					if (result.NoPolisi.Nopol) {
						$("#no_polisi").val(result.NoPolisi.Nopol);
					}else{
						$("#no_polisi").val('<?= $sa['NoPolisi']; ?>');
					}
					// checkNoPolisi(result.NoPolisi.Nopol);
					// console.log('a');
					$('#info_checkCDB').html('');

					if (result.dataRecall.JenisRecall == '1') {
						$('#info_checkRecall').html('Soft Recall');
					}else if (result.dataRecall.JenisRecall == '2') {
						$('#info_checkRecall').html('Hard Recall');
					}else{
						$('#info_checkRecall').html('');
					}
					

					$('#no_telpon').val(result.dataCDB.NoHP);
                    $('#nama_customer').val(result.dataUSTK.NamaKTP);
                    $('#alamat_ktp').val(result.dataUSTK.AlamatKTP);
                    $('#tahunKendaraan').val(result.dataFM.TahunProduksi);

                    // $("#kota").val(result.kabupaten.NamaKabupaten).trigger('change');
                    // $("#kecamatan").val(result.kecamatan.NamaKecamatan).trigger('change');
                    // $("#kelurahan").val(result.kelurahan.NamaKelurahan).trigger('change');
                    

                    $('#NoKTP').val(result.dataCDB.NoKTPNPWP);
                 
				  	
                    if (result.dataCDB.Pekerjaan == '2') {
                        $("#Pekerjaan").val('2');
                        checkPekerjaan(2);
                        $("#SubPekerjaan").val(result.dataCDB.Pekerjaan).trigger('change');
                        $(".select2").select2();
                    }else if (result.dataCDB.Pekerjaan == '4'){
                        $("#Pekerjaan").val('4');
                        checkPekerjaan(4);
                        $("#SubPekerjaan").val(result.dataCDB.Pekerjaan).trigger('change');
                        $(".select2").select2();
                    }else{
                        $('#Pekerjaan').val(result.dataCDB.Pekerjaan);
                    }
                    
                    getCustomer(result.customer.IDCustomer,'pemilik');
                    if (result.customer == '0') {
                    	customerSave();
                    	checkCDB(NoMesin,NoRangka);
                    }
                    
      //               if (result.dataSA.JenisAntrian) {
				  // 			if ($("#kode_booking").val()) {
						// 		$("#RegularSelect").val('');
						// 		$("#BookingSelect").show();
						// 		$("#RegularSelect").hide();
						// 		$("#BookingSelect").val(result.dataSA.JenisAntrian);
						// 	}else{
						// 		$("#BookingSelect").val('');
						// 		$("#RegularSelect").show();
						// 		$("#BookingSelect").hide();
						// 		$("#RegularSelect").val(result.dataSA.JenisAntrian);
						// 	}
				  // 	}else{
		  		// 		$("#BookingSelect").val('');
						// $("#RegularSelect").show();
						// $("#BookingSelect").hide();
				  // 	}
				  $('#historyBtn').attr("disabled", false);

				}else{
					$('#info_checkRecall').html('');
					// alert('test....');
					$("#Tipe_Motor").val(result.dataSL.KodeModel);
					$(".select2").select2();
					get_warna(result.dataSL.KodeModel,result.dataSL.KodeWarna);
					// console.log('b');
					$('#info_checkCDB').html('Data Tidak Terdaftar');
					$('#historyBtn').attr("disabled", true);
				}
				
						
		}, "json");
	}

	function open_NoBooking() {
		$('#noBookingModal').modal();
		search_NoBooking(1);
	}
	function checkRecall(NoRangka) {
		$('#checkRecallModal').modal();
		checkNoteRecall(NoRangka);
	}

	function retrieve_NoBooking(val){
		$('#noBookingModal').modal('hide');
		getDataNoBooking(val);
	}

	function open_Customer(jns) {
		$('#getCustomerModal').modal();
		if (jns === '0') {
			$('#customerFormTitle').html('Pengantar');
		}else if (jns === '1') {
			$('#customerFormTitle').html('Pemakai');
		}else if (jns === '2') {
			$('#customerFormTitle').html('Pemilik');
		}else{}
		
		search_Customer(1);
	}

	function retrieve_Customer(val){
		$('#getCustomerModal').modal('hide');
		// getCustomer(val,'pengantar');
		var jenis_customer = $('#customerFormTitle').html();
		getCustomer(val,jenis_customer.toLowerCase());
	}

	function checkNoPolisi(val){
		

		$.post(site_url+'h2.service.man_work.order/serviceadvisor/checkNoPolisi'
			,{
				noPolisi : val,
			}
			,function(result) {
				if(result.dataNoPol.NoRangka){
					var	no_rangka = result.dataNoPol.NoRangka.split(' ').join('');
					var	no_mesin = result.dataNoPol.NoMesin.split(' ').join('');
					$('#no_polisi').val(val);
					$('#no_rangka').val(no_rangka);
					$('#no_mesin').val(no_mesin);
					checkCDB(no_mesin,no_rangka);
					$('#historyBtn').attr("disabled", false);
					// var options = {
					// 	title: 'Success',
					// 	message: "Nomor Polisi "+val+" Terdaftar"
					// };
					// eModal.alert(options).then(function callback(){
					  
					// });
				}else{
					$('#no_polisi').val(val);
					$('#historyBtn').attr("disabled", true);
					$('#info_checkNoPol').html("Nomor Polisi Baru");
					// var options = {
					// 	title: 'Warning',
					// 	message: "Nomor Polisi "+val+" Tidak Terdaftar"
					// };
					// eModal.alert(options).then(function callback(){
					  
					// });
				}
				
						
		}, "json");
	}
	function getDataNoBooking(val){
		// $("#WarningBooking").html('');
		$.post(site_url+'h2.service.man_work.order/serviceadvisor/getDataNoBooking'
			,{
				noBooking : val,
			}
			,function(result) {
				// $("#WarningBooking").html('<span clas="fa fa-refresh fa-spin"></span>');
				if(result.statusBooking == '2'){
					$("#WarningBooking").html('');
					$("#RegularSelect").val('');
					$("#BookingSelect").val('BOOK');
					$("#no_booking").val(result.DataBooking.IDBooking);
					$("#kode_booking").val(result.DataBooking.KodeBooking);
					getCustomer(result.DataBooking.FKIDCustomer,'pemilik');
					// $("#no_polisi").val(result.DataBooking.NoPolisi);
					checkNoPolisi(result.DataBooking.NoPolisi);
					$("#keluhan").val(result.DataBooking.KeluhanCust);
					$("#Tipe_Motor").val(result.DataBooking.TipeMotor);
					$(".select2").select2();
					// $('#Tipe_Motor').trigger('change');
					get_warna(result.DataBooking.TipeMotor,result.DataBooking.WarnaMotor);
					$("#BookingSelect").show();
					$("#RegularSelect").hide();

				}else if(result.statusBooking == '3'){
					$("#BookingSelect").val('');
					$("#RegularSelect").val('REG');
					$("#WarningBooking").html("Nomor Booking "+val+" Terdaftar Untuk Tanggal "+result.WaktuService);
					
					$("#no_booking").val(result.DataBooking.IDBooking);
					$("#kode_booking").val(result.DataBooking.KodeBooking);
					getCustomer(result.DataBooking.FKIDCustomer,'pemilik');

					checkNoPolisi(result.DataBooking.NoPolisi);
					$("#keluhan").val(result.DataBooking.KeluhanCust);
					$("#Tipe_Motor").val(result.DataBooking.TipeMotor);
					$(".select2").select2();
					
					$("#RegularSelect").show();
					$("#BookingSelect").hide();
				}else if(result.statusBooking == '1'){
					$("#BookingSelect").val('');
					$("#RegularSelect").val('REG');
					$("#WarningBooking").html("Nomor Booking "+val+" Sudah Terdaftar diSA");
					
					$("#RegularSelect").show();
					$("#BookingSelect").hide();
				}else{
					$("#BookingSelect").val('');
					$("#RegularSelect").val('REG');
					$("#WarningBooking").html("Nomor Booking "+val+" Tidak Ditemukan");
					
					$("#RegularSelect").show();
					$("#BookingSelect").hide();
					// var options = {
					// 	title: 'Warning',
					// 	message: "Nomor Booking "+val+" Tidak Ditemukan"
					// };
					// eModal.alert(options).then(function callback(){
					  
					// });
				}
				// $("#WarningBooking").html(' ');
				
						
		}, "json");
	}
	// function getDataNoBooking(val){
	// 	// $("#WarningBooking").html('');
	// 	$.post(site_url+'h2.service.man_work.order/serviceadvisor/getDataNoBooking'
	// 		,{
	// 			noBooking : val,
	// 		}
	// 		,function(result) {
	// 			// $("#WarningBooking").html('<span clas="fa fa-refresh fa-spin"></span>');
	// 			if(result.DataBooking.IDBooking){
	// 				$("#WarningBooking").html('');
	// 				$("#RegularSelect").val('');
	// 				$("#BookingSelect").val('BOOK');
	// 				$("#no_booking").val(result.DataBooking.IDBooking);
	// 				$("#kode_booking").val(result.DataBooking.KodeBooking);
	// 				getCustomer(result.DataBooking.FKIDCustomer,'pemilik');
	// 				// $("#no_polisi").val(result.DataBooking.NoPolisi);
	// 				checkNoPolisi(result.DataBooking.NoPolisi);
	// 				$("#keluhan").val(result.DataBooking.KeluhanCust);
	// 				$("#Tipe_Motor").val(result.DataBooking.TipeMotor);
	// 				$(".select2").select2();
	// 				// $('#Tipe_Motor').trigger('change');
	// 				get_warna(result.DataBooking.TipeMotor,result.DataBooking.WarnaMotor);
	// 				$("#BookingSelect").show();
	// 				$("#RegularSelect").hide();

	// 			}else{
	// 				$("#BookingSelect").val('');
	// 				$("#RegularSelect").val('REG');
	// 				$("#WarningBooking").html("Nomor Booking "+val+" Tidak Ditemukan");
					
	// 				$("#RegularSelect").show();
	// 				$("#BookingSelect").hide();
	// 				// var options = {
	// 				// 	title: 'Warning',
	// 				// 	message: "Nomor Booking "+val+" Tidak Ditemukan"
	// 				// };
	// 				// eModal.alert(options).then(function callback(){
					  
	// 				// });
	// 			}
	// 			// $("#WarningBooking").html(' ');
				
						
	// 	}, "json");
	// }
	
	// function getDataCustomer(val,jenis){
	// 	$.post(site_url+'h2.service.man_work.order/serviceadvisor/getDataCustomer'
	// 		,{
	// 			noCustomer : val,
	// 			jenis : jenis,
	// 		}
	// 		,function(result) {
	// 			if(result.DataBooking.IDBooking){
	// 				var jenis = $('#customerFormTitle').html();
	// 				getCustomer(result.IDCustomer,jenis.toLowerCase());
	// 			}else{
	// 				// $("#LabelDeskripsiPartnumber").html('Part tidak ditemukan');
	// 			}
				
						
	// 	}, "json");
	// }

	function search_NoBooking(pg=1){
		var IDBookingModal = $('#IDBookingModal').val();
		var KodeBookingModal = $('#KodeBookingModal').val();
		var NoPolisiModal = $('#NoPolisiModal').val();
		// if(NamaPart != ''){
			$('#search_NoBooking').button('loading');
			$.post(site_url+'h2.service.man_work.order/serviceadvisor/search_NoBooking/'+pg
				,{
					KodeBookingModal : KodeBookingModal,
					IDBookingModal : IDBookingModal,
					NoPolisiModal : NoPolisiModal
				}
				,function(obj) {
				$("#bookingTable").html(obj);
				$('#search_NoBooking').button('reset');
			}, "html");
		// } else {
		// 	toastr.error("Silahkan Isi Nama Atau Nomor Warna/Tipe.",'Error');
		// }
	}

	function checkNoteRecall(NoRangka){
			$.post(site_url+'h2.service.man_work.order/serviceadvisor/checkNoteRecall'
				,{
					NoRangka : NoRangka
				}
				,function(result) {
				$("#catatanRecalModal").html(result.dataRecall);
			}, "json");
	}

	function search_Customer(pg=1){
		var noCustomerModal = $('#noCustomerModal').val();
		var namaCustomerModal = $('#namaCustomerModal').val();
		var noTelpnModal = $('#noTelpnModal').val();
		var jenis_customer = $('#customerFormTitle').html();

		if (jenis_customer === "Pengantar") {
			var jenisCust = 0;
		}else if (jenis_customer === "Pemakai") {
			var jenisCust = 1;
		}else if (jenis_customer === "Pemilik") {
			var jenisCust = 2;
		}else{}

		// if(NamaPart != ''){
			$('#search_Customer').button('loading');
			$.post(site_url+'h2.service.man_work.order/serviceadvisor/search_Customer/'+pg
				,{
					noCustomerModal : noCustomerModal,
					namaCustomerModal : namaCustomerModal,
					noTelpnModal : noTelpnModal,
					// jenisCust : jenisCust,
				}
				,function(obj) {
				$("#customerTable").html(obj);
				$('#search_Customer').button('reset');
			}, "html");
		// } else {
		// 	toastr.error("Silahkan Isi Nama Atau Nomor Warna/Tipe.",'Error');
		// }
	}

	function get_warna(KodeType,KodeWarna=0) {
		$.post(site_url+'penjualan.spk/spk/manage/get_Warna'
			,{t_KodeType: KodeType}
			,function(obj) {
			if(!obj.error){
				$('#kode_warna').html(obj.Warna).trigger("liszt:updated");
				$("#kode_warna").val(KodeWarna);
				// if(obj.KodeWarna){
					// $('#WarnaMotor').val(obj.KodeWarna).trigger('change');
				// }
				// $('#stockWarna').addClass('hide');
				// $('#btnBookingIndent').hide();
			}
		}, "json");
	}
	function serviceAdvisorSave(){
		$('#load').button('loading');
		$.post(site_url+'h2.service.man_work.order/serviceadvisor/save'
				,$('#serviceAdvisorForm').serialize()
				,function(result) {
					if (result.message){
						toastr.success(result.message,'Save');
						// serviceAdvisorInput(result.IDServiceAdvisor);
						// serviceAdvisorClose();
						// serviceAdvisorList(1);
						serviceAdvisorDetail(result.IDServiceAdvisor);
					}else{
						toastr.error(result.error,'Error');
					}
					$('#load').button('reset');
				}					
				,"json"
			);
	}
	function getCustomer(id,jenis){
		if (!id){
			$('#'+jenis+'_container').html(' ');
			return false;
		}

		if (jenis === "pengantar") {
			var jenisCust = 0;
		}else if (jenis === "pemakai") {
			var jenisCust = 1;
		}else if (jenis === "pemilik") {
			var jenisCust = 2;
		}else{}

		var customerInfo = '';
		var idCustomer = '';
		// $.post(site_url+'h2.service.man_work.order/serviceadvisor/get_customer/'+id
		$.post(site_url+'h2.crm/customer/customer/get'
				,{
					tIDCustomer:id,
					// jenis_customer:jenisCust,
				}
				,function(result) {
					if (result.message){
						customerInfo = '<b>'+result.customer.NamaCustomer+'</b><br>'
						alamat = result.customer.AlamatTerakhir+' / &nbsp';
						alamat = alamat + result.customer.AlamatKTP+',&nbsp';
						alamat = alamat + result.customer.Kelurahan+',&nbsp';
						alamat = alamat + 'kec. '+result.customer.Kecamatan+',&nbsp';
						alamat = alamat + 'kab. '+result.customer.Kota+'&nbsp';
						customerInfo = customerInfo + '<i class="fa fa-home"></i>&nbsp'+alamat+'&nbsp&nbsp&nbsp';
						customerInfo = customerInfo + '<i class="fa fa-mobile-phone"></i>&nbsp'+result.customer.NoTelpon+'&nbsp&nbsp&nbsp';
						customerInfo = customerInfo + '<i class="fa fa-envelope-o"></i>&nbsp'+result.customer.AlamatEmail+'&nbsp&nbsp&nbsp';
						idCustomer = result.customer.IDCustomer;
					}else{
						var options = {
							title: 'Warning',
							message: "Kode Pengantar "+id+" Tidak Ada"
						};
						eModal.alert(options).then(function callback(){
						  
						});

						customerInfo = '';
						idCustomer = '';
					}
					$('#'+jenis+'_container').html(customerInfo);
					$('#'+jenis+'_id_customer').val(idCustomer);
				}					
				,"json"
			);
	} 
	function detailPengantar(jenis){
		if (jenis === 'info') {
			$("#jenis_customer").val('');
			$('#customerFormTitle').html('Pengantar');
			detailCustomer($('#pengantar_id_customer').val());
			// $("#customerForm :input").attr("disabled", true);
			$("#jenis_customer").val('0');
			$("#id_customer").val($('#pengantar_id_customer').val());
		}else if (jenis === 'new') {
			$("#jenis_customer").val('');
			$('#customerFormTitle').html('Pengantar');
			// detailCustomer();
			$('#customerModal').modal();
			$("#customerForm :input").attr("disabled", false);
			$("#id_customer").val('');
			$("#kota").val('');
			$("#kecamatan").val('');
			$("#kelurahan").val('');
			$(".select2").select2();

			$('#customerForm')[0].reset();
			$("#jenis_customer").val('0');
		}
		
	}
	function detailPemakai(jenis){
		if (jenis === 'info') {
			$("#jenis_customer").val('');
			$('#customerFormTitle').html('Pemakai');
			detailCustomer($('#pemakai_id_customer').val());
			// $("#customerForm :input").attr("disabled", true);
			$("#jenis_customer").val('1');
			$("#id_customer").val($('#pengantar_id_customer').val());
		}else if (jenis === 'new') {
			$("#jenis_customer").val('');
			$('#customerFormTitle').html('Pemakai');
			// detailCustomer();
			$('#customerModal').modal();
			$("#customerForm :input").attr("disabled", false);
			$("#id_customer").val('');
			$("#kota").val('');
			$("#kecamatan").val('');
			$("#kelurahan").val('');
			$(".select2").select2();

			$('#customerForm')[0].reset();
			$("#jenis_customer").val('1');
		}

		// $('#customerFormTitle').html('Pemakai');
		// detailCustomer($('#pemakai_id_customer').val());
		// $("#jenis_customer").val('1');
	} 
	function detailPemilik(jenis){
		if (jenis === 'info') {
			$("#jenis_customer").val('');
			$('#customerFormTitle').html('Pemilik');
			detailCustomer($('#pemilik_id_customer').val());
			// $("#customerForm :input").attr("disabled", true);
			$("#jenis_customer").val('2');
			$("#id_customer").val($('#pengantar_id_customer').val());
		}else if (jenis === 'new') {
			$("#jenis_customer").val('');
			$('#customerFormTitle').html('Pemilik');
			detailCustomer();
			$('#customerModal').modal();
			$("#customerForm :input").attr("disabled", false);
			$("#id_customer").val('');
			$("#kota").val('');
			$("#kecamatan").val('');
			$("#kelurahan").val('');
			$(".select2").select2();

			$('#customerForm')[0].reset();
			$("#jenis_customer").val('2');
		}

		// $('#customerFormTitle').html('Pemilik');
		// detailCustomer($('#pemilik_id_customer').val());
		// $("#jenis_customer").val('2');
	} 
	function detailCustomer(id)
	{
		$.post(site_url+'h2.crm/customer/customer/get'
				,{
					tIDCustomer:id,
					jenis_customer:$("#jenis_customer").val(),
				}
				,function(result) {
					if (result.message){
						$('#id_customer').val(result.customer.IDCustomer);
						$('#nama_customer').val(result.customer.NamaCustomer);
						$('#no_telpon').val(result.customer.NoTelpon);
						$('#email').val(result.customer.AlamatEmail);
						$('#alamat_terakhir').val(result.customer.AlamatTerakhir);
						$('#alamat_ktp').val(result.customer.AlamatKTP);
						$('#NoKTP').val(result.customer.NoKTP);

						var retriveCust = result.customer.fidMsPekerjaan;

						if (retriveCust) {
							if (retriveCust.charAt(0) == '2') {
				            // alert(retriveCust);
					            $("#Pekerjaan").val('2');
					            checkPekerjaan(2);
					            $("#SubPekerjaan").val(retriveCust).trigger('change');
					            $(".select2").select2();
					        }else if (retriveCust.charAt(0) == '4') {
					            $("#Pekerjaan").val('4');
					            checkPekerjaan(4);
					            $("#SubPekerjaan").val(retriveCust).trigger('change');
					            $(".select2").select2();
					        }else{
					            $("#Pekerjaan").val(retriveCust);
					            $(".select2").select2();
					            $("#FieldSubPekerjaan").hide();
					        }
						}
				        

						getKabupaten($('#provinsi').val(),result.customer.Kota);
						getKecamatan(result.customer.Kota,result.customer.Kecamatan);
						getKelurahan(result.customer.Kecamatan,result.customer.Kelurahan);


						$('#kode_pos').val(result.customer.KodePos);
						$('#customerModal').modal();
					}else{
						$('#id_customer').val('');
						$('#nama_customer').val('');
						$('#no_telpon').val('');
						$('#email').val('');
						$('#alamat_terakhir').val('');
						$('#alamat_ktp').val('');
						$('#kelurahan').val(0);
						$('#kelurahan').trigger('change');
						$('#kecamatan').val(0);
						$('#kecamatan').trigger('change');
						$('#kota').val('');
						$('#kode_pos').val('');
						$('#customerModal').modal();
						getKabupaten($('#provinsi').val());
					}
					
				}					
				,"json"
			);
	}

	function customerSave(){
		$.post(site_url+'h2.crm/customer/customer/save'
				,$('#customerForm').serialize()
				,function(result) {
					if (result.message){
						var jenis = $('#customerFormTitle').html();
						getCustomer(result.IDCustomer,jenis.toLowerCase());

						if ($("#pemilik_id_customer").val() == jenis.toLowerCase() ) {
							getCustomer('<?= $sa['FKIDCustomer']?>','pemilik');
						}

						if ($("#pengantar_id_customer").val() == jenis.toLowerCase() ) {
							getCustomer('<?= $sa['FKIDPembawaMotor']?>','pengantar');
						}

						if ($("#pemakai_id_customer").val() == jenis.toLowerCase() ) {
							getCustomer('<?= $sa['FKIDPemakaiMotor']?>','pemakai');
						}
						
					}else{
						
					}
				}					
				,"json"
			);
	}

	function showHistoryMotor(){
		var NoRangka = $('#no_rangka').val();
		if (NoRangka == '') {
			toastr.error('No Rangka belum diisi','Error');
		}else{
			$('#motorHistoryContainer').hide();
			$('#serviceAdvisorInputContainer').hide();
			$.post(site_url+'h2.service.man_work.order/motor/get_history'
					,{NoRangka : NoRangka}
					,function(result) {
						$('#motorHistoryContainer').show();
						$('#motorHistoryContainer').html(result);
					}					
					,"html"
				);
		}
	}

	function getFromBooking(){
		$('#bookingModal').modal();
		
	}

	function serviceAdvisorClose(){
		showWOContainer('serviceAdvisorManageContainer');
	}

	function clearInput() {
		$("#no_polisi").val('');
		$("#Tipe_Motor").val('');
		$('#Tipe_Motor').trigger('change');
		$("#kode_warna").val('');
		$("#pengantar_id_customer").val('');
		getCustomer('','pengantar');
	}

	function getKabupaten(value,id_kabupaten=0)
	{
		showProgres();
		$.post(site_url+'h2.service.man_work.order/serviceadvisor/get_data_kabupaten'
			,{
				t_fid_kabupaten :id_kabupaten,
				t_fid_propinsi : value
			}
			,function(obj) {
				hideProgres();
				$('#kota').html(obj).trigger("liszt:updated");
				if (typeof retriveCust !== 'undefined')
				{
					if(retriveCust.fidMsKabupaten) {
						$("#kota").val(retriveCust.fidMsKabupaten).trigger('change');
					}
				}
			}					
			,"html"
			);
	}

	function getKecamatan(value,id_kecamatan=0)
	{
		showProgres();
		$.post(site_url+'h2.service.man_work.order/serviceadvisor/get_data_kecamatan'
			,{
				t_fid_kecamatan :id_kecamatan,
				t_fid_propinsi : $('#propinsi').val(),
				t_fid_kabupaten : value
		}
		,function(obj) {
			hideProgres();
			$('#kecamatan').html(obj).trigger("liszt:updated");
			if (typeof retriveCust !== 'undefined')
			{
				if(retriveCust.fidMsKecamatan) {
					$("#kecamatan").val(retriveCust.fidMsKecamatan).trigger('change');
				}
			}
		}					
		,"html"
		);
	}

	function getKelurahan(value,id_kelurahan=0)
	{
		showProgres();
		$.post(site_url+'h2.service.man_work.order/serviceadvisor/get_data_kelurahan'
			,{
				t_fid_kelurahan : id_kelurahan,
				t_fid_propinsi : $('#propinsi').val(),
				t_fid_kabupaten : $('#kota').val(),
				t_fid_kecamatan : value
		}
		,function(obj) {
			hideProgres();
			$('#kelurahan').html(obj).trigger("liszt:updated");
			if (typeof retriveCust !== 'undefined')
			{
				if(retriveCust.fidMsKelurahan) {
					$("#Kelurahan").val(retriveCust.fidMsKelurahan).trigger('change');
				}
			}
		}					
		,"html"
		);
	}
</script>
<section class="content-header">
	<h1>
		Service Advisor
		<small></small>
	</h1>
	<ol class="breadcrumb">
		<?php if ($sa['IDServiceAdvisor']){?>
		<li><a href="#" onclick="serviceAdvisorInput('<?= $sa['IDServiceAdvisor'] ?>')"><i class="fa fa-dashboard"></i> <?= $sa['IDServiceAdvisor'] ?></a></li>
		<li><?= humanize_mdate($sa['WaktuSA'],'%d %M %y %h:%i:%s') ?></li>
		<?php }?>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<form id="serviceAdvisorForm" method="post">
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab_1" data-toggle="tab">Informasi</a></li>
							<li ><a href="#tab_2" data-toggle="tab">Keluhan</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_1">
								<input type="text" id="idServiceAdvisor" name="t_idServiceAdvisor" hidden value="<?= $sa['IDServiceAdvisor'] ?>">
							<div class="row">
								<div class="form-group">
									<div class="col-sm-2">
										<label> No Booking </label>
										<div class="input-group">
											<input type="text" onkeydown="if(event.keyCode == 13)onKeyPress('booking')" class="form-control pull-right" id="kode_booking" value="<?= $booking['KodeBooking']?>" name="t_kode_booking">
											<input type="hidden" class="form-control pull-right" id="no_booking" value="<?= $sa['fidCustBooking']?>" name="t_no_booking">
											<span class="input-group-btn">
												<button class="btn btn-primary btn-flat" type="button" title="check detail history motor" onclick="open_NoBooking()"><i class="fa fa-search"></i></button>
											</span>
										</div>
									</div>
									<div class="col-sm-2">
										<label> Jenis Antrian </label>
											<select class="form-control" id="BookingSelect" name="BookingSelect">
												<option value="BOOK" selected>Booking</option>
												<option value="FT">Fast track</option>
											</select>
											<select class="form-control" id="RegularSelect" name="RegularSelect">
												<option value="REG" selected>Regular</option>
												<option value="FT">Fast track</option>
											</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<span id="WarningBooking" style="font-weight: bold;font-style: italic;"> </span>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="form-group">
									<div class="col-sm-2">
										<label> No Polisi </label>
										<div class="input-group">
											<input type="text" class="form-control pull-right" id="no_polisi" onblur="$(this).val($(this).val().replace(/\s/g,''))" value="<?= $sa['NoPolisi']?>" name="t_no_polisi" onkeydown="if(event.keyCode == 13){$(this).val($(this).val().replace(/\s/g,''));checkDataSA('noPolisi')}if (event.keyCode == 32){ return false};" style="text-transform:uppercase">
											<span class="input-group-btn">
												<button class="btn btn-warning btn-flat" type="button" id="historyBtn" title="check detail history motor" onclick="showHistoryMotor()" disabled="disabled"><i class="fa fa-list-ol"></i></button>
											</span>
										</div>
									</div>
									<div class="col-sm-2">
										<label> No Mesin </label>
										<div class="input-group">
											<input type="text" class="form-control pull-right" id="no_mesin" onblur="$(this).val($(this).val().replace(/\s/g,''));checkDataSA('NoMesin');" value="<?= $sa['NoMesin']?>" name="t_no_mesin"  onkeydown="if(event.keyCode == 13){$(this).val($(this).val().replace(/\s/g,''));checkDataSA('NoMesin');}if (event.keyCode == 32){return false;} "  style="text-transform:uppercase" >
										</div>
									</div>
									<div class="col-sm-2">
										<label> No Rangka </label>
										<div class="input-group">
											<input type="text" class="form-control pull-right" id="no_rangka" onblur="$(this).val($(this).val().replace(/\s/g,''));checkDataSA('NoRangka');" value="<?= $sa['NoRangka']?>" name="t_no_rangka" onkeydown="if(event.keyCode == 13){$(this).val($(this).val().replace(/\s/g,''));checkDataSA('NoRangka');}if (event.keyCode == 32){ return false;}" style="text-transform:uppercase">
										</div>
									</div>
									<div class="col-sm-3">
										<label> Tipe </label>
										<select class="form-control select2" style="width: 100%;" id="Tipe_Motor" name="t_tipe_motor" onChange="get_warna(this.value)">
											<option>-Pilih-</option>
											<?php 
											foreach($type->result_array() as $row)
											{
												?>
												<option value="<?= $row['KodeType']?>" <?= ($sa['TipeMotor']==$row['KodeType']?'selected':'') ?> ><?= $row['KodeType'].'-'.$row['NamaPasar'].' | '.$row['DeskripsiType']?></option>
												<?php
											}
											?>
										</select>
									</div>
									<div class="col-sm-3">
										<label> Warna </label>
										<select class="form-control select2" style="width: 100%;" id="kode_warna" name="t_kode_warna">
											<option>-Pilih-</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-2">
									<label class="text-success" id="info_checkNoPol">  </label> 
								</div>
								<div class="col-md-2">
									<label class="text-danger" id="info_checkCDB">  </label> 
								</div>

								<div class="col-md-8">
									<label class="text-danger" id="info_checkRecall" onclick="checkRecall($('#no_rangka').val())">  </label> 
								</div>

							</div>
							<div class="row">
								<div class="col-sm-2">
									<label> Tahun </label>
									<input type="text" name="tahunKendaraan" id="tahunKendaraan" maxlength="4" class="form-control" value="<?= $sa['Tahun']; ?>">
								</div>
								<div class="col-sm-3">
									<label> Alasan Ke AHASS </label>
									<select class="form-control select2" style="width: 100%;" id="AlasanKeAHASS" name="AlasanKeAHASS">
										<option value="0">-Pilih-</option>
										<?php 
										foreach($alasanKeAhass->result_array() as $row)
										{
											?>
											<option value="<?= $row['idAlasanKeAhass']?>" <?= ($sa['AlasanKeAHASS']==$row['idAlasanKeAhass']?'selected':'') ?> ><?= $row['AlasanKeAhass']; ?></option>
											<?php
										}
										?>
									</select>
								</div>
								<div class="col-sm-3">
									<label> Aktivitas </label>
									<select class="form-control select2" style="width: 100%;" id="aktivitas" name="aktivitas">
										<option value="0">-Pilih-</option>
										<?php 
										foreach($aktivitas->result_array() as $row)
										{
											?>
											<option value="<?= $row['idAktivitasH2']?>" <?= ($sa['idAktivitas']==$row['idAktivitasH2']?'selected':'') ?> ><?= $row['Aktivitas']; ?></option>
											<?php
										}
										?>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<div class="col-sm-2">
										<label> Pemilik </label>
										<div class="input-group">
											<input type="text" class="form-control pull-right" id="pemilik_id_customer" value="" name="t_pemilik_id_customer" onkeydown="if(event.keyCode == 13)onKeyPress('customer','pemilik')">
											<span class="input-group-btn">
												<button class="btn btn-info btn-flat" type="button" onclick="open_Customer('2')"><i class="fa fa-search"></i></button>
											</span>
										</div>
									</div>
									<div class="col-sm-2" style="padding: 0;">
										<label>&nbsp</label><br>
										<a class="btn btn-md btn-success" href="#" title="klik untuk lihat detail" onclick="detailPemilik('new')" ><i class="fa fa-plus"></i> Baru </a>
									</div>
									<div class="col-sm-8">
										<label>&nbsp</label><br>
										<a id="pemilik_container" href="#" title="klik untuk lihat detail" onclick="detailPemilik('info')"></a>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<div class="col-sm-2">
										<label> Pengantar </label>
										<div class="input-group">
											<input type="text" class="form-control pull-right" id="pengantar_id_customer" value="" name="t_pengantar_id_customer" onkeydown="if(event.keyCode == 13)onKeyPress('customer','pengantar')">
											<span class="input-group-btn">
												<button class="btn btn-info btn-flat" type="button" onclick="open_Customer('0')"><i class="fa fa-search"></i></button>
											</span>
										</div>
									</div>
									<div class="col-sm-2" style="padding: 0;">
										<label>&nbsp</label><br>
										<a class="btn btn-md btn-primary" href="#" title="klik untuk lihat detail" onclick="getCustomer($('#pemilik_id_customer').val(),'pengantar');" > = Pemilik </a>
										<a class="btn btn-md btn-success" href="#" title="klik untuk lihat detail" onclick="detailPengantar('new')" ><i class="fa fa-plus"></i> Baru </a>
									</div>
									<div class="col-sm-8">
										<label>&nbsp</label><br>
										<a id="pengantar_container" href="#" title="klik untuk lihat detail" onclick="detailPengantar('info')"></a>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<div class="col-sm-2">
										<label> Pemakai </label>
										<div class="input-group">
											<input type="text" class="form-control pull-right" id="pemakai_id_customer" value="" name="t_pemakai_id_customer" onkeydown="if(event.keyCode == 13)onKeyPress('customer','pemakai')">
											<span class="input-group-btn">
												<button class="btn btn-info btn-flat" type="button" onclick="open_Customer('1')"><i class="fa fa-search"></i></button>
											</span>
										</div>
									</div>
									<div class="col-sm-2" style="padding: 0;">
										<label>&nbsp</label><br>
										<a class="btn btn-md btn-primary" href="#" title="klik untuk lihat detail" onclick="getCustomer($('#pemilik_id_customer').val(),'pemakai');" > = Pemilik </a>
										<a class="btn btn-md btn-success" href="#" title="klik untuk lihat detail" onclick="detailPemakai('new')" ><i class="fa fa-plus"></i> Baru </a>
									</div>
									<div class="col-sm-8">
										<label>&nbsp</label><br>
										<a id="pemakai_container" href="#" title="klik untuk lihat detail" onclick="detailPemakai('info')"></a>
									</div>
								</div>
							</div>
							</div>

							<div class="tab-pane" id="tab_2">
								<div class="row">
									<div class="form-group">
										<div class="col-sm-4">
											<label>Bensin Saat Ini</label>
											<div id="fuel-gauge" style="margin-left: 19%;margin-right: 19%;"></div>
											<br>
											<div id="fuel-gauge-control"></div>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="form-group">
										<div class="col-sm-4">
											<label>KM Saat Ini</label>
											<input type="text" class="form-control" id="KMSaatIni" value="<?= $sa['KMSaatIni'] ? : '0'?>" name="KMSaatIni">
										</div>
										<div class="col-sm-4">
											<label>Hubungan Pemilik Dengan Pembawa</label>
											<input type="text" class="form-control pull-right" id="HubunganPemilik" value="<?= $sa['HubunganPemilik']?>" name="HubunganPemilik">
											<input type="hidden" class="form-control pull-right" id="BensinSaatIni" value="<?= $sa['BensinSaatIni']?>" name="BensinSaatIni">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="form-group">
										<div class="col-sm-4">
											<label>Keluhan Konsumen</label>
											<textarea class="form-control" rows="3" placeholder="" id="keluhan" name="t_kebutuhan_konsumen"><?= $sa['KebutuhanKonsumen']?></textarea>
										</div>
										<div class="col-sm-4">
											<label>Analisa Service Advisor</label>
											<textarea class="form-control" rows="3" placeholder="" id="keluhanSA" name="t_hasil_analisa_sa"><?= $sa['HasilAnalisaSA']?></textarea>
										</div>
										<div class="col-sm-4">
											<label>Saran Mekanik</label>
											<textarea class="form-control" rows="3" placeholder="" id="saranMekanik" name="t_saran_mekanik"><?= $sa['SaranMekanik']?></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
<!-- 
						<form id="serviceAdvisorForm" method="post"> -->
							
							
							
								
						</form>
						<div class="box-footer">
							<a href="javascript:void(0);" class="btn btn-warning" onclick="serviceAdvisorClose();">Close</a>
							<a href="javascript:void(0);" class="btn btn-info pull-right" onclick="serviceAdvisorSave();" id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Loading...">Save</a>
						</div>
					</div>
					
			</div>
		</div>
	</div>
</section>
<div class="modal fade" id="customerModal" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <b id="customerFormTitle">Customer</b>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  		<form type="post" id="customerForm">
			<input type="text" id="id_customer" name="t_id_customer" hidden>
    		<div class="row">
    			<div class="col-sm-5">
    				<label>Nama</label>
					<input type="text" class="form-control" id="nama_customer" name="t_nama_customer" style="text-transform:uppercase">
					<input type="hidden" class="form-control" id="jenis_customer" name="t_jenis_customer" style="text-transform:uppercase">
    			</div>
    			<div class="col-sm-3">
    				<label>No telp</label>
						<input type="text" class="form-control" id="no_telpon" name="t_no_telpon" placeholder="Nomor Telepon">
    			</div>
    			<div class="col-sm-4">
    				<label>Email</label>
						<input type="text" class="form-control" id="email" name="t_alamat_email" placeholder="Email">
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-sm-6">
	                <label>Jenis Pekerjaan</label>
	                <select class="form-control select2" id="Pekerjaan" name="t_Pekerjaan" style="width: 100%;" onchange="checkPekerjaan(this.value)">
	                    <?php foreach($pekerjaan->result_array() as $row){
	                        if(in_array($row['Code'], array('N','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16'))){
	                            ?>
	                            <option value="<?=$row['Code']?>"><?=($row['Description']!="NULL")? $row['Description']:"Pilih";?></option>
	                    <?php } } ?>
	                </select>
    			</div>
    			<div class="col-sm-6" id="FieldSubPekerjaan">
    				<label>SUB Pekerjaan</label>
	                <select class="form-control select2" id="SubPekerjaan" name="t_SubPekerjaan" style="width: 100%;">
	                    <option value="0">Pilih</option>
	                </select>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-sm-6">
	                <label>No KTP</label>
	                <input type="text" class="form-control" id="NoKTP" name="NoKTP" placeholder="No KTP">
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-sm-8">
    				<label>Alamat</label>
						<input type="text" class="form-control" id="alamat_ktp" name="t_alamat_ktp">
    			</div>

    			<div class="col-sm-4">
    				<label>Kota / Kabupaten</label>
						<input type="hidden" class="form-control" id="provinsi" name="t_provinsi" value="7200">
						<select class="form-control select2" id="kota" name="t_kota" style="width: 100%;" onchange="getKecamatan(this.value)">
							<option value="0">Pilih</option>
						</select>
    			</div>
				
    			
    		</div>
			<div class="row">
    			<div class="col-sm-5">
    				<label>Kecamatan</label>
					<select class="form-control select2" id="kecamatan" name="t_kecamatan" style="width: 100%;" onchange="if(this.value != 0) {getKelurahan(this.value)}">
						<option value="0">Pilih</option>
					</select>
    			</div>

    			<div class="col-sm-5">
    				<label>Kelurahan</label>
					<select class="form-control select2" id="kelurahan" name="t_kelurahan" style="width: 100%;">
						<option value="0">Pilih</option>
					</select>
    			</div>
    			
				<div class="col-sm-2">
    				<label>Kode POS</label>
					<input type="text" class="form-control" id="kode_pos" name="t_kode_pos" style="text-transform:uppercase">
    			</div>
    			
    		</div>
			</form>

      </div>
      <div class="modal-footer">
	  		<div class="form-group">
				<div class="input-group pull-right" style="width: 100px;">
					<button type="button" class="btn btn-success" onClick="customerSave()" data-dismiss="modal" >Save</button>
				</div>
			</div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="bookingModal" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <b>Booking</b>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  		<form type="port" id="bookingForm">
			<input type="text" id="id_customer" name="t_id_customer" hidden>
    		<div class="row">
    			<div class="col-sm-3">
    				<label>Kode Booking</label>
					<input type="text" class="form-control" id="kode_booking" name="t_kode_booking" style="text-transform:uppercase">
    			</div>
    		</div>
			</form>

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="checkRecallModal" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <b>Catatan Recall</b>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  		
    		<div class="row">
    			<div class="col-sm-12">
					<h4>
						<i>
							<label id="catatanRecalModal"></label>
						</i>
					</h4>
    			</div>
    		</div>

      </div>
    </div>
  </div>
</div>