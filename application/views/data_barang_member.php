
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
              <?php 
              if($this->session->userdata('level')=='1')//hanya admin
              {?>
              <button class="btn btn-primary" id="tambah_data"  onclick="tambah()">Tambah Data</button> 
              <?}?>
<div class="table-responisve">
<table id="tbl_datanya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>
              <th width="10px">Id Barang</th>           
              <th>Nama Barang</th>                                                                  
              <th>Gambar</th>                     
              
              
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
          if($this->session->userdata('level')!='1')//hanya admin
          {
            $x->harga_pokok=0;
            $btn="-";
          }
            echo (" 
              
              <tr>
                <td>$no</td>
                <td>$x->id</td>
                <td>$x->nama_barang</td>                                                                           
                <td><a target='blank' href='".base_url()."uploads/$x->gambar'>$x->gambar</a></td>                           
                
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
  </table>
</div>

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



        <div class="col-sm-4">Jumlah/Lusin</div>
            <div class="col-sm-8"><input type="text" name="jum_per_lusin" id="jum_per_lusin" required="required" class="form-control nomor" placeholder="jum_per_lusin" ></div>
            <div style="clear: both;"></div><br>
        


        <div class="col-sm-4">Jumlah/Koli</div>
            <div class="col-sm-8"><input type="text" name="jum_per_koli" id="jum_per_koli" required="required" class="form-control nomor" placeholder="jum_per_koli" ></div>
            <div style="clear: both;"></div><br>
        


        <div class="col-sm-4">Reminder Gudang</div>
            <div class="col-sm-8"><input type="text" name="reminder" id="reminder" required="required" class="form-control nomor" placeholder="reminder gudang" ></div>
            <div style="clear: both;"></div><br>


          <div class="col-sm-4">Gambar</div>
            <div class="col-sm-8">
              <input class="form-control" name="gambar" id="gambar" type="file" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps">
            </div>
            <div style="clear: both;"></div><br>

        <div class="col-sm-4">Berat</div>
            <div class="col-sm-8"><input type="number" name="berat" id="berat" class="form-control" placeholder="Berat (KG) ex: 0.1" min="0" pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" ></div>
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
    $("#jum_per_lusin").val(e[0].jum_per_lusin);

    $("#harga_pokok").val(e[0].harga_pokok);
    $("#reminder").val(e[0].reminder);
    $("#berat").val(e[0].berat);
    $("#gambar").val(e[0].gambar);
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
      eksekusi_controller('<?php echo base_url()?>index.php/barang/pesanan_member','Pesanan Member');
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

      $.ajax({
            url: "<?php echo base_url()?>index.php/"+classnya+"/simpan_form",
            type: "POST",
            contentType: false,
            processData:false,
            data:  new FormData(this),
            beforeSend: function(){
                //alert("sedang uploading...");
            },
            success: function(e){
                console.log(e);
                $("#t4_info_form").html("<div class='alert alert-success'>Berhasil.</div>").fadeIn().delay(3000).fadeOut();
                  setTimeout(function(){
                    $("#myModal").modal('hide');
                  },3000);

                
            },
            error: function(er){
                $("#t4_info_form").html("<div class='alert alert-warning'>Ada masalah! "+er+"</div>");
            }           
       });
  return false;
})


$("#myModal").on("hidden.bs.modal", function () {
  eksekusi_controller('<?php echo base_url()?>index.php/barang/pesanan_member','Pesanan Member');
});

$(document).ready(function(){

  $('#tbl_datanya').dataTable();

});
$("#judul2").html("DataTable "+document.title);
</script>
