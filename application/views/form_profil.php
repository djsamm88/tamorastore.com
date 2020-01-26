
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 id="judul">
        Selamat datang di Sistem Informasi Manajemen Desa
        <small>Kab.Humbang Hasundutan</small>
      </h1>      
    </section>

    <!-- Main content -->
    <section class="content container-fluid" >

      <!--------------------------
        | Your Page Content Here |
        -------------------------->    
<!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title" id="judul2">Data Admin <small>Update terakhir : <?php echo $admin->time_admin?></small></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
              
<?php
$id_admin       = $admin->id_admin;
$nama_admin     = $admin->nama_admin;
$pass_admin     = $admin->pass_admin;
$user_admin     = $admin->user_admin;


$email_admin    = $admin->email_admin;
$telp_admin     = $admin->telp_admin;
?>



<form id="form_data_admin" >
<input name="id_admin" type="hidden" class="form-control" value="<?php echo $id_admin?>">
Nama Admin<br>
<input name="nama_admin" class="form-control" value="<?php echo $nama_admin?>">
<br>
Username:<br>
<input name="user_admin" class="form-control" required value="<?php echo $user_admin?>">
<br>
Password:<br>
<input name="pass_admin" type="password"class="form-control" required value="<?php echo $pass_admin?>">
<hr>
Telp:<br>
<input name="telp_admin" type="text"class="form-control" required value="<?php echo $telp_admin?>">
<br>
Email:<br>
<input name="email_admin" type="email"class="form-control" required value="<?php echo $email_admin?>">

<hr>
<br>
<div id="t4_info"></div>
<input type="submit" name="submit" class="btn btn-info btn-block" value="Update">
</form>


<script>
$("#form_data_admin").submit(function(){
  
  if(confirm("Anda yakin mengubah data login?")){
    
    $.post("<?php echo base_url()?>index.php/profil/simpan_form",$(this).serialize(),function(x){
    console.log(x);
    
    $("#t4_info").html("<div class='alert alert-success'>Berhasil di update.</div>").delay(5000).fadeOut();
  })
    
  }else{
    return false;
  }
  return false;
});


</script>
        
      </div>
      <!-- /.box -->

</section>
    <!-- /.content -->



