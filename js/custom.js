//title
(function () {
var original = document.title;
var timeout;

window.flashTitle = function (newMsg, howManyTimes) {
    function step() {
        document.title = (document.title == original) ? newMsg : original;

        if (--howManyTimes > 0) {
            timeout = setTimeout(step, 1000);
        };
    };

    howManyTimes = parseInt(howManyTimes);

    if (isNaN(howManyTimes)) {
        howManyTimes = 5;
    };

    cancelFlashTitle(timeout);
    step();
};

window.cancelFlashTitle = function () {
    clearTimeout(timeout);
    document.title = original;
};

}());




//*********************notification********************************************//
function onShowNotification () {
	console.log('notification is shown!');
}

function onCloseNotification () {
	console.log('notification is closed!');
}

function onClickNotification () {
	window.focus();
	console.log('notification was clicked!');
	
}

function onErrorNotification () {
	console.error('Error showing notification. You may need to request permission.');
}

function onPermissionGranted () {
	console.log('Permission has been granted by the user');
	doNotification();
}

function onPermissionDenied () {
	console.warn('Permission has been denied by the user');
}

var Notify = window.Notify.default;

function doNotification (nama,pesan,id) 
{
	var myNotification = new Notify(nama, {
		icon: 'http://www.pakpakbharatkab.go.id/imej/pakpaklogo.png',
		body: pesan,
		tag: id,
		notifyShow: onShowNotification,
		notifyClose: onCloseNotification,
		notifyClick: onClickNotification(),
		notifyError: onErrorNotification,
		timeout: 100
	});

	myNotification.show();
}

if (!Notify.needsPermission) {
	//doNotification();
	//doNotification('sam','limb pesan disini','12');
	//alert('');
} else if (Notify.isSupported()) {
	Notify.requestPermission(onPermissionGranted, onPermissionDenied);
}
//*********************notification********************************************//






function loading(disini)
{
	$(disini).html("<div id='loading'><center><span class='fa fa-spinner'></span> Loading...</center></div>");
	//$(disini).append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
	
	
}

function loading_hide(disini)
{
	$(disini).find("#loading").remove();
	
}



function updateURL(newurl,judul) 
{
  if (history.pushState)
  {          
	  window.history.pushState({path:newurl},judul,newurl);
	  document.title = judul;

	   window.onpopstate = function() {
                var url      = window.location.href; 
                
                
                $.get(url,function(q){
                                    $('body').html('');
                                    $('body').html(q);
                                    $('html, body').animate({ scrollTop: 0 }, 'fast');
                                });
            };
  }

  $("html, body").animate({ scrollTop: 0 }, "slow");
  
  
}


function eksekusi_controller(method,judul)
{
	//var newurl = BASE_PATH+'read.php?q='+judul.toLowerCase();
	//updateURL(newurl,judul);	
	document.title=judul;
	$(".content-wrapper").empty();
	$.get(method,function(e){
				
		$(".content-wrapper").html(e);
		$("#judul").html(judul);
	})
	
	
	
}




function loading_cool(disini)            
{
	
	$(disini).after('<div class="overlay" id="loading_cool"><i class="fa fa-refresh fa-spin"></i></div>');
	
}

function loading_cool_hide(disini)            
{
	
	$(disini).next(".overlay").remove();
	
}


function hanya_alphanumeric(input)
{
	

	$(input).keypress(function (e) {
		var regex = new RegExp("^[a-zA-Z0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if (regex.test(str)) {
			return true;
		}

		e.preventDefault();
		return false;
	});
		
		
}


function rupiah(x)
{
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}


function hanya_nomor(input)
{
		
	$(input).keyup(function(event) {

	  // skip for arrow keys
	  if(event.which >= 37 && event.which <= 40) return;

	  // format number
	  $(this).val(function(index, value) {
	    return value
	    .replace(/\D/g, "")
	    .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
	    ;
	  });
	});

}
