
$(document).ready(function(){
	
	$("#wrapper").toggleClass("toggled");
		
	$("#aaaa").click(function() {			
	
		$("#wrapper").toggleClass("toggled");
		return false;
	});

	var a_wrapper = $("#wrapper ").on("click","a",function(){
		$("#wrapper").toggleClass("toggled");
		return true;
	});
	
	
	
	$("#home").on("click",function(){
		menu_awal();
		slide_show();
	});

	
	
	/********************************************cek url*************************************/
	var get_url      = window.location.href;
	var pagar = get_url.split("#");
	if(pagar[1]!==undefined)
	{
		var controller = pagar[1].split("/");
		var cont 	= controller[0];
		var idnya 	= controller[1];
		
		
		if(cont =="calendar")
		{
			calendar();
		}else if(cont =="news")
		{
			news(idnya);
			
		}else if(cont =="list_news")
		{
			list_news();
			
		}else if(cont =="produk")
		{
			produk(idnya);
		}else if(cont =="sub_page")
		{
			sub_page(idnya);
		}else if(cont =="page")
		{
			page(idnya);
		}else if(cont =="list_event")
		{
			list_event();
		}else if(cont =="event")
		{
			eventnya(idnya);
		}else if(cont =="kontak")
		{
			kontak();
		}else{
			//menu_awal();
			slide_show();
			
		}
		
	}else{
		//menu_awal();
		slide_show();
		
	}
	/********************************************cek url*************************************/
	
	
});


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

function calendar()
{
	$("#t4_slide_show").hide();
	iframe(url_assets+"fullcalendar/front.php","Agenda");

}
function kontak(newurl,judul)
{
	updateURL(newurl,judul); 	
	loading();
	$.get(url+"home/kontak",function(e){
		$("#isi").hide().html(e).fadeIn();
		hide_slide_show();
		loading_hide();
	});
	

}
function list_news(newurl,judul,id_kategori)
{
	updateURL(newurl,judul); 	
	loading();
	$.get(url+"home/list_news/"+id_kategori,function(e){
		$("#isi").hide().html(e).fadeIn();
		hide_slide_show();
		loading_hide();
	});
	

}

function atur_bahasa(in_en)
{
	loading();
	$.get(url+"home/atur_bahasa/"+in_en,function(e){
		location.reload();
		$("#isi").hide().html(e).fadeIn();
		loading_hide();
	});
}


function page(id_page,newurl,judul)
{
	loading();
	
	updateURL(newurl,judul);
	
	$.get(url+"home/page/"+id_page,function(e){
		window.scrollTo(0, 0);
		$("#isi").hide().html(e).fadeIn();
		hide_slide_show();
	loading_hide();
	});
	
	return false;
	

}



function sub_page(id_sub_page)
{
	loading();
	$.get(url+"home/sub_page/"+id_sub_page,function(e){
		window.scrollTo(0, 0);
		$("#isi").hide().html(e).fadeIn();
		hide_slide_show();
	loading_hide();
	});

}




function news(id_news,newurl,judul)
{
	updateURL(newurl,judul);
	loading();	
	$.get(url+"home/news/"+id_news,function(e){
		window.scrollTo(0, 0);
		$("#isi").hide().html(e).fadeIn();
		hide_slide_show();
	loading_hide();
	});
	return false;
}




function produk(id_produk,newurl,judul)
{
	updateURL(newurl,judul);
	loading();
	$.get(url+"home/produk/"+id_produk,function(e){
		window.scrollTo(0, 0);
		$("#isi").hide().html(e).fadeIn();
		hide_slide_show();
	loading_hide();
	});

}


function eventnya(id_event,newurl,judul)
{
	updateURL(newurl,judul);
	loading();
	$.get(url+"home/event/"+id_event,function(e){
		window.scrollTo(0, 0);
		$("#isi").hide().html(e).fadeIn();
		hide_slide_show();
	loading_hide();
	});

}


function list_event(newurl,judul)
{
	loading();
	updateURL(newurl,judul);
	$.get(url+"home/list_event",function(e){
		window.scrollTo(0, 0);
		$("#isi").hide().html(e).fadeIn();
		hide_slide_show();
	loading_hide();
	});

}


function list_video()
{
	loading();
	$.get(url+"home/list_video",function(e){
		window.scrollTo(0, 0);
		$("#isi").hide().html(e).fadeIn();
		hide_slide_show();
	loading_hide();
	});

}


function videonya(id_video)
{
	loading();
	$.get(url+"home/videonya/"+id_video,function(e){
		window.scrollTo(0, 0);
		$("#isi").hide().html(e).fadeIn();
		hide_slide_show();
	loading_hide();
	});

}




function go_to(id_togo){
	
	$('html,body').animate({scrollTop: $("#"+id_togo).offset().top},'slow');

}

function loading()
{
	$("#loading").fadeIn();	

}

function loading_hide()
{

	$("#loading").fadeOut();
	
}


//link hash
if(window.location.hash) 
{
  var link = window.location.hash.substr(1);

	if (typeof link == 'undefined' || typeof link == '') {
	  
	}else{
		//load_menu_hash(url+link);
	}
  
}else{
	//menu_awal();
	//load_menu_hash(url+"home/menu_awal");
}

function menu_awal()
{
	loading();
	$.get(url+"home/menu_awal",function(e){		
		$("#isi").hide().html(e).fadeIn();
	loading_hide();
	});

}



function slide_show()
{
	
	loading();
	$.get(url+"home/slide_show",function(e){		
		//alert(e);
		$("#t4_slide_show").hide().html(e).fadeIn();
	loading_hide();
	});

}

function hide_slide_show()
{
	$("#t4_slide_show").hide();
}



//iframe
function iframe(url,title)
{		
	loading();
		var event = '<iframe src="'+url+'" frameborder="0" scrolling="yes" style="border: 0; position:relative; width:100%; height:670px; padding:10px;"></iframe><hr>';		
		$("#isi").hide().html("<div class='alert alert-info text-center'>"+title+"</div>").append(event).fadeIn();
	loading_hide();
}
