<?php $path = base_url();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="<?php echo base_url()?>bower_components/jquery/dist/jquery.min.js"></script>
	<script src="<?php echo $path?>bower_components/bootstrap/dist/js/bootstrap.js" type="text/javascript"></script>	
	<script src="<?php echo $path?>js/pace_loading.js" type="text/javascript"></script>	
	
	<script src="<?php echo $path?>js/base64.js" type="text/javascript"></script>		
	<link rel="stylesheet" type="text/css" href="<?php echo $path?>bower_components/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $path?>css/custom.css">
	

	<title><?php if(isset($title)): echo $title; endif;?></title>
	<script type="text/javascript">
				$(document).ajaxStart(function() { Pace.restart(); });
	</script>
	
<style>
#form_login tr td{
padding:10px;
}
#form_login{
border:1px solid #ddd;
border-radius: 10px;
background: #fff;
}
body{
	background: #f2f2f2;
}
</style>
</head>
<body >

<div id="loading">
	<div class="alert alert-warning text-center">
		<img src="<?php echo $path?>assets/bigLoader.gif" id="img_loading"><strong>Loading...</strong>
	</div>
</div>



		<div id="isi" class="container">	

		
		<h2><?php echo $title?> Administrator</h2>
		
			<form id="form_login_test" style="margin:0 auto;">
					<table id="form_login">
						<tr>
							<td>Username</td> <td> <input type="text" name="user_admin" placeholder="Username" class="form-control" required></td>
						</tr>
						<tr>
							<td>Password</td> <td> <input type="password" name="pass_admin"  class="form-control" placeholder="Password" required></td>
						</tr>
						<tr>
							<td>
								<span style="color:#000;" class="form-control">
											<span style="font-size: 16px;">
										
												<span style="font-family: comic sans ms,cursive;">
													<strong>
												<center ><span class="un_select" data-unselectable="unselectable content" id="t4_rand"><?php echo $random?></span></center> 
													</strong>
												</span>
											</span>
										</span>
								<center> <small><a id="reload_code">Sulit?</a></small></center>
							</td>
							<td>
								<input name="captcha" type="text" class="form-control" size="10" id="captcha" placeholder="Security Code" required /> 		
								<br>														
							</td>
						</tr>

						<tr>
							<td colspan="2"><div id="info_login"></div></td>
						</tr>
						<tr>
							<td colspan="2"><div id="reset_pass"></div></td>
						</tr>
						<tr>
							<td></td><td><input type="submit" value="Login &rarr;" name="login" class="btn btn-primary"></td>
						</tr>
							<?php
								if(isset($_GET['login']) || isset($_GET['loggedout'])){echo $info;}
							?>
							
						</table>
						
					</form>
			
		</div>
<div id="alternatif_isi" class="alert alert-info container text-center" style="display:none"></div>




<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reset Password</h4>
      </div>
      <div class="modal-body">
        <form id="form_reset">
        	<input type="email" name="email" id="cek_email_input" class="form-control" required="required" placeholder="Email">
        	<div id="t4_cek_em"></div>
        	<input type="submit" class="btn btn-primary" value="Reset">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<footer class="footer">
      <div class="container">
        <p class="text-muted">Copyright Medantechno.com</p>
      </div>
</footer>

<style type="text/css">
	.un_select{
		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}
</style>


<script>
var klik = 0;	
$("#form_login_test").submit(function(){	
	
	$.post("<?php echo base_url()?>index.php/login/cek_login",$(this).serialize(),function(e){
		//alert(e);
		
		if(e =='0')
		{
			var info="<div class='alert alert-danger'><b>Gagal login</b>: Cek Email, Password!</div>";
			$("#info_login").hide().html(info).fadeIn();
			klik+=1;



		}else if(e =='2')		
		{
			var info="<div class='alert alert-warning'><b>Gagal login</b>: [User belum aktif].</div>";
			$("#info_login").hide().html(info).fadeIn();
		}else if(e =='1')
		{
			var info="<div class='alert alert-success'><b>Sukses login</b>: Mohon tunggu!</div>";
			$("#info_login").hide().html(info).fadeIn();
			window.location.replace("<?php echo base_url()?>index.php/welcome");
		}else

		if(e=='5')
		{
			var info="<div class='alert alert-warning'><b>Gagal login</b>: [Kode Salah].</div>";
			$("#info_login").hide().html(info).fadeIn();
		}else{
			console.log(e);
		}
		
		cek();
		
	})
return false;	
});

$("#reload_code").on("click",function(){
	$.get("<?php echo base_url()?>index.php/login/new_rand",function(e){
		$("#t4_rand").html(e);
	});
})

$("#form_reset").on("submit",function(){
	$("#t4_cek_em").html("Loading...");
	$.post("<?php echo base_url()?>index.php/login/cek_email",$(this).serialize(),function(e){
			
			console.log(e);
			if(e == '0')
			{
				$("#t4_cek_em").html("Email tidak ditemukan.");
			}else{
				$("#t4_cek_em").html("<div class='alert aler-success'>Email reset sudah dikirim ke email anda. Silahkan buka paling lama 24 jam.</div>");
				$("#cek_email_input").val('');
			}
	})
	return false;
})


function cek()
{
	if(klik>3)
	{
		$("#reset_pass").html("<div class='alert alert-warning'>Anda ingin <a href='#' data-toggle='modal' data-target='#myModal'>Reset Password</a>?</div>");
	}	
}

function modalnya()
{
	$('#myModal').modal('toggle'); 
}

</script>
</body>
</html>
