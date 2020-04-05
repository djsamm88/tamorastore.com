
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 id="judul">
        Selamat datang di Sistem Informasi 
        <small>UMROH</small>
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
          <h3 class="box-title" id="judul2"></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
              <button class="btn btn-primary" id="tambah_data"  onclick="tambah()">Tambah Data</button> 
<table id="tbl_datanya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>
              <th width="10px">Id Barang</th>           
              <th>Barang</th>                     
              <th>Stok</th>                     
              <th>Harga Beli</th>                     
              <th>Harga Retail</th>                     
              <th>Harga Lusin</th>                     
              <th>Harga Koli</th>                     
              <th>Jumlah / Koli</th>                     
              <th>Action</th>                     
              
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        foreach($all as $x)
        {
          $btn = "<button class='btn btn-warning btn-xs' onclick='edit($x->id);return false;'>Edit</button>
                  <button class='btn btn-danger btn-xs' onclick='hapus($x->id);return false;'>Hapus</button>    ";
          $no++;
            
            echo (" 
              
              <tr>
                <td>$no</td>
                <td>$x->id</td>
                <td>$x->nama_barang</td>                
                <td>$x->qty</td>                
                <td>".rupiah($x->harga_pokok)."</td>                
                <td>".rupiah($x->harga_retail)."</td>                
                <td>".rupiah($x->harga_lusin)."</td>                
                <td>".rupiah($x->harga_koli)."</td>                
                <td>".rupiah($x->jum_per_koli)."</td>                
                <td>
                  $btn
                </td>
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
  </table>


        </div>
        
      </div>
      <!-- /.box -->

</section>
    <!-- /.content -->




<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form Data</h4>
      </div>
      <div class="modal-body">
          <form id="form_tambah_admin">
            <input type="hidden" name="id" id="id" class="form-control" readonly="readonly">            

            <div class="col-sm-4">Nama Barang</div>
            <div class="col-sm-8"><input type="text" name="nama_barang" id="nama_barang" required="required" class="form-control" placeholder="nama_barang"></div>
            <div style="clear: both;"></div><br>
        
        <div class="col-sm-4">Harga Beli</div>
            <div class="col-sm-8"><input type="text" name="harga_pokok" id="harga_pokok" required="required" class="form-control nomor" placeholder="harga_pokok" ></div>
            <div style="clear: both;"></div><br>
        
      <div class="col-sm-4">Harga Retail</div>
            <div class="col-sm-8"><input type="text" name="harga_retail" id="harga_retail" required="required" class="form-control nomor" placeholder="harga_retail"></div>
            <div style="clear: both;"></div><br>
        

        <div class="col-sm-4">Harga Lusin</div>
            <div class="col-sm-8"><input type="text" name="harga_lusin" id="harga_lusin" required="required" class="form-control nomor" placeholder="harga_lusin"></div>
            <div style="clear: both;"></div><br>


        <div class="col-sm-4">Harga Koli</div>
            <div class="col-sm-8"><input type="text" name="harga_koli" id="harga_koli" required="required" class="form-control nomor" placeholder="harga_koli"></div>
            <div style="clear: both;"></div><br>



        <div class="col-sm-4">Jumlah/Koli</div>
            <div class="col-sm-8"><input type="text" name="jum_per_koli" id="jum_per_koli" required="required" class="form-control nomor" placeholder="jum_per_koli" ></div>
            <div style="clear: both;"></div><br>
        

            <div id="t4_info_form"></div>
            <button type="submit" class="btn btn-primary"> Simpan </button>
          </form>

          <div style="clear: both;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script>
console.log("<?php echo $this->router->fetch_class();?>");
var classnya = "<?php echo $this->router->fetch_class();?>";


hanya_nomor(".nomor");
function edit(id)
{
  $.get("<?php echo base_url()?>index.php/"+classnya+"/by_id/"+id,function(e){
    //console.log(e[0].id);
    $("#id").val(e[0].id);
    $("#nama_barang").val(e[0].nama_barang);
    $("#harga_retail").val(e[0].harga_retail);
    $("#harga_lusin").val(e[0].harga_lusin);
    $("#harga_koli").val(e[0].harga_koli);
    $("#jum_per_koli").val(e[0].jum_per_koli);
    $("#harga_pokok").val(e[0].harga_pokok);
    console.log(e[0].qty);
    if(e[0].qty!="0")
    {      
      $('#harga_pokok').prop('readonly', false);
    }else{
      $('#harga_pokok').prop('readonly', true);
    }
    
  })
  $("#myModal").modal('show');
}

function tambah()
{
    $("#id").val('');
    
    
  $("#myModal").modal('show');
}

function hapus(id)
{
  if(confirm("Anda yakin menghapus?"))
  {
    $.get("<?php echo base_url()?>index.php/"+classnya+"/hapus/"+id,function(e){
      eksekusi_controller('<?php echo base_url()?>index.php/'+classnya+'/data',document.title);
    })  
  }
  
}

$("#form_tambah_admin").on("submit",function(){
  $("#t4_info_form").html('Loading...');
  if($("#pass_admin").val() != $("#conf_pass_admin").val())
  {
    
    $("#t4_info_form").html("<div class='alert alert-warning'>Password dan Confirm Password tidak sama.</div>").fadeIn().delay(3000).fadeOut();
    return false;
  }

  var ser = $(this).serialize();

  $.post("<?php echo base_url()?>index.php/"+classnya+"/simpan_form",ser,function(x){
    console.log(x);
    
      $("#t4_info_form").html("<div class='alert alert-success'>Berhasil.</div>").fadeIn().delay(3000).fadeOut();

      setTimeout(function(){
        $("#myModal").modal('hide');
      },3000);
    
  })

  return false;
})


$("#myModal").on("hidden.bs.modal", function () {
  eksekusi_controller('<?php echo base_url()?>index.php/'+classnya+'/data',document.title);
});

$(document).ready(function(){

  $('#tbl_datanya').dataTable();

});
$("#judul2").html("DataTable "+document.title);
</script>
