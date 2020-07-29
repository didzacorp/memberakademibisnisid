var site_url = window.location.href;

function base_url(segment){
   // get the segments
   pathArray = window.location.pathname.split( '/' );
   // find where the segment is located
   indexOfSegment = pathArray.indexOf(segment);
   // make base_url be the origin plus the path to the segment
   return window.location.origin + pathArray.slice(0,indexOfSegment).join('/');
}
function loadMainContent(url)
{
	showProgres();
	$.post(site_url+url
			,{}
			,function(result) {
				$('#main-panel').html(result);
				$('#content_now').val(url);
				hideProgres();
			}					
			,"html"
		);
}

function loadMainContentMember(url)
{
	showProgres();
	$.post(base_url(1)+url
			,{}
			,function(result) {
				$('#main-panel').html(result);
				$('#content_now_member').val(url);
				hideProgres();
			}					
			,"html"
		);
}

function setTitle(cTitle)
{
	$('#title-cont').html(cTitle);
}

function showProgres()
{
	$('#loading').show();
}
function hideProgres()
{
	$('#loading').hide();
}
function success_message(msg)
{
		toastr.success('message');     
}
function error_message(msg)
{
       var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Failed!',
            // (string | mandatory) the text inside the notification
            text: msg,
            // (string | optional) the image to display on the left
            image: site_url+'../assets/img/Warning.png',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            //class_name: 'my-sticky-class'
        });
		// You can have it return a unique id, this can be used to manually remove it later using
        
         setTimeout(function(){

         $.gritter.remove(unique_id, {
         fade: true,
         speed: 'slow'
         });

         }, 6000)
         /**/
}
function validate_value(ob,message,ln)
{
	obj = $('#'+ob);
	obj.closest('div').removeClass("f_error");
	if (!obj.val() || (obj.val()==0) || ln)
	{
		var c_ln = obj.val().length;			
		if (ln && c_ln)
		{
			if (c_ln < ln)
			{
				message = 'Minimal '+ln+' character';
			}else
			{
				return true;
			}
		}
		var error_message = '<label for="'+ob+'" generated="true" class="error" style="">';
		if (!message)
		{
			error_message = error_message + 'This field is required';
		}else
		{
			error_message = error_message + message;
		}
		error_message = error_message + '</label>';
		obj.closest('div').addClass("f_error");
		obj.closest('div').append(error_message);
		
		nError = nError + 1;
		return false;
	}else
	{
		return true;
	}
}
// datepicker
function objDate(obj)
{
	$('#'+obj).datepicker({
            format: 'dd-mm-yyyy'
            ,autoclose: true
        });
	//$('#'+obj).datepicker(({format: "dd-mm-yyyy"}));
}

function numberOnly(evt) 
{
	var theEvent = evt || window.event;
	var key = theEvent.keyCode || theEvent.which;
	key = String.fromCharCode( key );
	var regex = /[0-9]|\./;
	if( !regex.test(key) ) 
	{
		theEvent.returnValue = false;
		if(theEvent.preventDefault) theEvent.preventDefault();
	}
}
// untuk merubah format angka menjadi mata uang
function thausand_spar(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}

function date_dbtoview(date){
	var d = new Date(date);
	var curr_date = d.getDate();
	var curr_month = d.getMonth() + 1; //Months are zero based
	var curr_year = d.getFullYear();
	return curr_date + "-" + curr_month + "-" + curr_year;
}

function toast(type,content) {
	bootoast({
	  message: content,
	  timeout: 2000,
	  position: 'top-right',
	  type: type,
	  timeoutProgress: false, // [false, 'top', 'bottom', 'background']
	});

	setTimeout(function(){
		$('.bootoast-container').remove();
	},3000);
}

function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}