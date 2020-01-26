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
	
	
	//menu
	
	$("#home").on("click",function(){
		menu_awal();
	});

	new_kontak();
});

function data_session_user()
{
	$.get(url+"admin/data_session_user",function(e){
	
		$("#isi").hide().html(e).fadeIn();
	
	});
}

/*---------------------------------------page------------------------------*/
function form_page(id_parent)
{
	//alert(id_parent);
	$.get(url+"admin/form_page/"+id_parent,function(e){
	
		$("#isi").hide().html(e).fadeIn();
	
	});
}

function data_page()
{
	loading();
	$.get(url+"admin/data_page",function(e){
	
		$("#isi").hide().html(e).fadeIn();
		loading_hide();
	
	});
}

function cancel_page()
{
	data_page();
}
function cancel_sub_page()
{
	data_sub_page();
}
function set_status_page(id_page)
{
	$.get(url+"admin/set_status_page/"+id_page,function(e){
			form_page();
			//alert(e);
		});	
}



function delete_page(id_page)
{
	if(confirm("Anda yakin menghapus?"))
	{
		$.get(url+"admin/delete_page/"+id_page,function(e){
			data_page();
			//alert(e);
		});
	}else{
		return false;
	}
}



/*---------------------------------------page------------------------------*/



/*---------------------------------------forum------------------------------*/

function data_forum()
{
	loading();
	$.get(url+"admin/data_forum",function(e){
	
		$("#isi").hide().html(e).fadeIn();
		loading_hide();
	
	});
}


function data_user()
{
	loading();
	$.get(url+"admin/data_user",function(e){
	
		$("#isi").hide().html(e).fadeIn();
		loading_hide();
	
	});
}


function tambah_user_forum()
{
	loading();
	$.get(url+"admin/tambah_user_forum",function(e){
	
		$("#isi").hide().html(e).fadeIn();
		loading_hide();
	
	});
}



function delete_forum(id_komentar)
{
	if(confirm("Anda yakin menghapus?"))
	{
		$.get(url+"admin/delete_forum/"+id_komentar,function(e){
			//alert(e);
			data_forum();
			//alert(e);
		});
	}else{
		return false;
	}
}



function del_user_forum(id_komentar)
{
	if(confirm("Anda yakin menghapus?"))
	{
		$.get(url+"admin/del_user_forum/"+id_komentar,function(e){
			//alert(e);
			data_forum();
			//alert(e);
		});
	}else{
		return false;
	}
}



/*---------------------------------------forum------------------------------*/


/*---------------------------------------news------------------------------*/
function form_news()
{
	$.get(url+"admin/form_news",function(e){
	
		$("#isi").hide().html(e).fadeIn();
	
	});
}

function data_news()
{
	loading();
	
	//$.get(url+"admin/data_news",function(e){
	$.get(url+"admin/data_tbl_news",function(e){
	
		$("#isi").hide().html(e).fadeIn();
		loading_hide();
	
	});
}

function eksekusi_controller(url)
{
	loading();
	$.get(url,function(e){
	
		$("#isi").hide().html(e).fadeIn();
		loading_hide();
	
	});
}



function cancel_news()
{
	data_news();
}
function cancel_sub_news()
{
	data_sub_news();
}
function set_status_news(id_news)
{
	$.get(url+"admin/set_status_news/"+id_news,function(e){
			form_news();
			//alert(e);
		});	
}



function delete_news(id_news)
{
	if(confirm("Anda yakin menghapus?"))
	{
		$.get(url+"admin/delete_news/"+id_news,function(e){
			data_news();
			//alert(e);
		});
	}else{
		return false;
	}
}

/*---------------------------------------news------------------------------*/



/*---------------------------------------produk------------------------------*/
function form_produk()
{
	$.get(url+"admin/form_produk",function(e){
	
		$("#isi").hide().html(e).fadeIn();
	
	});
}

function data_produk()
{
	loading();
	$.get(url+"admin/data_produk",function(e){
	
		$("#isi").hide().html(e).fadeIn();
		loading_hide();
	
	});
}

function cancel_produk()
{
	data_produk();
}
function cancel_sub_produk()
{
	data_sub_produk();
}
function set_status_produk(id_produk)
{
	$.get(url+"admin/set_status_produk/"+id_produk,function(e){
			form_produk();
			//alert(e);
		});	
}



function delete_produk(id_produk)
{
	if(confirm("Anda yakin menghapus?"))
	{
		$.get(url+"admin/delete_produk/"+id_produk,function(e){
			data_produk();
			//alert(e);
		});
	}else{
		return false;
	}
}



/*---------------------------------------produk------------------------------*/





/*---------------------------------------video------------------------------*/
function form_video()
{
	loading();
	$.get(url+"admin/form_video",function(e){
	
		$("#isi").hide().html(e).fadeIn();
		loading_hide();
	
	});
}

function data_video()
{
	loading();
	$.get(url+"admin/data_video",function(e){
	
		$("#isi").hide().html(e).fadeIn();
		loading_hide();
	
	});
}

function cancel_video()
{
	data_video();
}
function cancel_sub_video()
{
	data_sub_video();
}
function set_status_video(id_video)
{
	$.get(url+"admin/set_status_video/"+id_video,function(e){
			form_video();
			//alert(e);
		});	
}



function delete_video(id_video)
{
	if(confirm("Anda yakin menghapus?"))
	{
		$.get(url+"admin/delete_video/"+id_video,function(e){
			data_video();
			//alert(e);
		});
	}else{
		return false;
	}
}



/*---------------------------------------video------------------------------*/



/*---------------------------------------event------------------------------*/
function form_event()
{
	loading();
	$.get(url+"admin/form_event",function(e){
	
		$("#isi").hide().html(e).fadeIn();
		loading_hide();
	
	});
}

function data_event()
{
	loading();
	$.get(url+"admin/data_event",function(e){
	
		$("#isi").hide().html(e).fadeIn();
		loading_hide();
	
	});
}

function cancel_event()
{
	data_event();
}
function cancel_sub_event()
{
	data_sub_event();
}
function set_status_event(id_event)
{
	$.get(url+"admin/set_status_event/"+id_event,function(e){
			form_event();
			//alert(e);
		});	
}



function delete_event(id_event)
{
	if(confirm("Anda yakin menghapus?"))
	{
		$.get(url+"admin/delete_event/"+id_event,function(e){
			data_event();
			//alert(e);
		});
	}else{
		return false;
	}
}



/*---------------------------------------event------------------------------*/





/*---------------------------------------schedule------------------------------*/
function form_schedule()
{
	loading();
	$.get(url+"admin/form_schedule",function(e){
	
		$("#isi").hide().html(e).fadeIn();
		loading_hide();
	
	});
}

function data_schedule()
{
	loading();
	$.get(url+"admin/data_schedule",function(e){
	
		$("#isi").hide().html(e).fadeIn();
		loading_hide();
	
	});
}

function cancel_schedule()
{
	data_schedule();
}
function cancel_sub_schedule()
{
	data_sub_schedule();
}
function set_status_schedule(id_schedule)
{
	$.get(url+"admin/set_status_schedule/"+id_schedule,function(e){
			form_schedule();
			//alert(e);
		});	
}



function delete_schedule(id_schedule)
{
	if(confirm("Anda yakin menghapus?"))
	{
		$.get(url+"admin/delete_schedule/"+id_schedule,function(e){
			data_schedule();
			//alert(e);
		});
	}else{
		return false;
	}
}



/*---------------------------------------schedule------------------------------*/





/*---------------------------------------slide_show------------------------------*/
function form_slide_show()
{
	loading();
	$.get(url+"admin/form_slide_show",function(e){
	
		$("#isi").hide().html(e).fadeIn();
		loading_hide();
	
	});
}

function data_slide_show()
{
	loading();
	$.get(url+"admin/data_slide_show",function(e){
	
		$("#isi").hide().html(e).fadeIn();
		loading_hide();
	
	});
}

function cancel_slide_show()
{
	data_slide_show();
}
function cancel_sub_slide_show()
{
	data_sub_slide_show();
}
function set_status_slide_show(id_slide_show)
{
	$.get(url+"admin/set_status_slide_show/"+id_slide_show,function(e){
			form_slide_show();
			//alert(e);
		});	
}



function delete_slide_show(id_slide_show)
{
	if(confirm("Anda yakin menghapus?"))
	{
		$.get(url+"admin/delete_slide_show/"+id_slide_show,function(e){
			data_slide_show();
			//alert(e);
		});
	}else{
		return false;
	}
}



/*---------------------------------------slide_show------------------------------*/




/*---------------------------------------kontak------------------------------*/


function data_kontak()
{
	loading();
	$.get(url+"admin/data_kontak",function(e){
	
		$("#isi").hide().html(e).fadeIn();
		loading_hide();
	
	});
}

function set_status_kontak(id_kontak)
{
	$.get(url+"admin/set_status_kontak/"+id_kontak,function(e){
			data_kontak();
			//alert(e);
		});	
}



function delete_kontak(id_kontak)
{
	if(confirm("Anda yakin menghapus?"))
	{
		$.get(url+"admin/delete_kontak/"+id_kontak,function(e){
			data_kontak();
			//alert(e);
		});
	}else{
		return false;
	}
}


function new_kontak()
{
	loading();
	$.get(url+"admin/new_kontak",function(e){
			
			if(e>0)
			{
				$("#isi #t4count_kontak,#t4count_kontak_kiri").html("<a href='#admin/data_kontak'><font color=red><b><span class='glyphicon glyphicon-comment'></span> "+ e + "Pesan baru</b></font></a>");
			}else{
				$("#t4count_kontak,#t4count_kontak_kiri").html("<font><span class='glyphicon glyphicon-comment'></span> Tidak ada Pesan baru</font>");
			}
			loading_hide();		
	});
	
}

/*---------------------------------------kontak------------------------------*/



/*---------------------------------------data_sub_page------------------------------*/
function data_sub_page()
{	
	loading();
	$.get(url+"admin/data_sub_page",function(e){
	
		loading_hide();
		$("#isi").hide().html(e).fadeIn();
	
	});
}

function form_sub_page()
{
	loading();
	$.get(url+"admin/form_sub_page",function(e){
	
		$("#isi").hide().html(e).fadeIn();
		loading_hide();
	});
}


function delete_sub_page(sub_page_id)
{
	if(confirm("Anda yakin menghapus?"))
	{
		loading();
		$.get(url+"admin/delete_sub_page/"+sub_page_id,function(e){			
			data_sub_page();
			loading_hide();
		});
	}else{
		return false;
	}
}


function form_edit_sub_page(sub_page_id)
{	
	loading();
	$.get(url+"admin/form_edit_sub_page/"+sub_page_id,function(e){
		
		$("#isi").hide().html(e).fadeIn();
	loading_hide();
	});
}

/*---------------------------------------page------------------------------*/




/*---------------------------------------data_beranda------------------------------*/

function data_beranda()
{	
	loading();
	$.get(url+"admin/data_beranda/",function(e){
		
		//alert(e);
		$("#isi").hide().html(e).fadeIn();
	loading_hide();
	});
}

/*---------------------------------------data_beranda------------------------------*/


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

function load_menu_hash(url_target)
{
	$("#isi").hide();
	loading();
		if($("#isi").html(''))
		{
			$.get(url_target,function(e){
				if($("#isi").html(e))
				{
					loading_hide();
					$("#isi").fadeIn(1000);
				}
				
			});
		}
		
				
}

//link hash
if(window.location.hash) 
{
  var link = window.location.hash.substr(1);

	if (typeof link == 'undefined' || typeof link == '') {
	  
	}else{
		load_menu_hash(url+link);
	}
  
}else{
	//menu_awal();
	//load_menu_hash(url+"home/menu_awal");
}

function menu_awal()
{
	loading();
	$.get(url+"admin/menu_awal",function(e){
		
		$("#isi").hide().html(e).fadeIn();
	loading_hide();
	});

}


function calendar()
{	
	iframe(url_assets+"fullcalendar/admin.php","Kalender");

}

function ckfinder()
{	
	iframe(url_assets+"ckfinder/ckfinder_mod.php?CKEditor","File");

}

//iframe
function iframe(url,title)
{		
	loading();
		var event = '<iframe src="'+url+'" frameborder="0" scrolling="yes" style="border: 0; position:relative; width:100%; height:600px; padding:10px;"></iframe><hr>';		
		$("#isi").hide().html("<div class='alert alert-info text-center'><b>"+title+"</b></div>").append(event).fadeIn();
	loading_hide();
}
