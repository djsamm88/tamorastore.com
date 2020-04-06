
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 id="judul">
        
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
          <h3 class="box-title">Data</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
              
  <table id="tbl_newsnya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>
               <th width="100px">id_pelanggan</th>
                <th>nama_pembeli</th>
                <th>email_pembeli</th>
                <th>hp_pembeli</th>
                <th>tgl_daftar</th>
                <th>tgl_trx_terakhir</th>
                <th>saldo</th>
              <th>Action</th>
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        foreach($all as $x)
        {
          $btn = "<button class='btn btn-warning btn-xs btn-block' onclick='utang($x->id_pelanggan);return false;'>Utang</button>
                  <button class='btn btn-danger btn-xs btn-block' onclick='piutang($x->id_pelanggan);return false;'>Piutang</button>    ";
          $no++;

            echo (" 
              
              <tr>
                <td>$no</td>
                <td>$x->id_pelanggan</td>
                <td>$x->nama_pembeli</td>
                <td>$x->email_pembeli</td>
                <td>$x->hp_pembeli</td>
                <td>$x->tgl_daftar</td>
                <td>$x->tgl_trx_terakhir</td>
                <td>".rupiah($x->saldo)." <br> <button class='btn btn-primary btn-xs btn-block' onclick='detail($x->id_pelanggan)'>Detail</button></td>
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
        <h4 class="modal-title">Form <span id="judul_modal"></span></h4>
      </div>
      <div class="modal-body">
          <form id="form_trx">
            <input type="hidden" name="id_pelanggan" id="id_pelanggan" class="form-control" readonly="readonly">
            <input type="hidden" name="id_group" id="id_group" class="form-control" readonly="readonly">
            
            <div class="col-sm-4 judul">nama</div>
            <div class="col-sm-8">
              <input class="form-control" name="nama_pembeli" id="nama_pembeli" readonly>
            </div>
            <div style="clear:both"></div>
            <br>


            <div class="col-sm-4 judul">Jumlah</div>
            <div class="col-sm-8">
              <input class="form-control nomor" name="jumlah" id="jumlah" type="text">
            </div>
            <div style="clear:both"></div>
            <br>


            <div class="col-sm-4 judul">Keterangan</div>
            <div class="col-sm-8">
              <textarea class="form-control" name="keterangan" id="keterangan" required></textarea>
            </div>
            <div style="clear:both"></div>
            <br>


            <div class="col-sm-4 judul">Gambar bukti</div>
            <div class="col-sm-8">
              <input class="form-control" name="url_bukti" id="url_bukti" type="file" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps">
            </div>
            <div style="clear:both"></div>
            <br>





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
$('.datepicker').datepicker({
  autoclose: true,
  format: 'yyyy-mm-dd' 
})
hanya_nomor(".nomor");
/***** menghapus garis bawah ******/
$('.judul,th').text(function(i, text) {    
    return text.replace(/_/g, ' ');
});
/***** menghapus garis bawah ******/

/***** membesarkan ******/
$('.judul,th').text(function(i, text) {
    return text.toUpperCase();    
});
/***** membesarkan ******/



$(document).ready(function(){

  $('#tbl_newsnya').dataTable();

});

function detail(id_pelanggan)
{
  
  eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/laporan_jurnal_pelanggan/'+id_pelanggan,'Transaksi Pelanggan');
}

function utang(id_pelanggan)
{
  $("#id_group").val("17");

  $.get("<?php echo base_url()?>index.php/pelanggan/by_id/"+id_pelanggan,function(e){
    //console.log(e[0].id_desa);
    $("#id_pelanggan").val(e[0].id_pelanggan);
    $("#nama_pembeli").val(e[0].nama_pembeli);
    
    
  })
  $("#myModal").modal('show');
  $("#judul_modal").html("<b>Utang</b>");
}



function piutang(id_pelanggan)
{
  $("#id_group").val("18");

  $.get("<?php echo base_url()?>index.php/pelanggan/by_id/"+id_pelanggan,function(e){
    //console.log(e[0].id_desa);
    $("#id_pelanggan").val(e[0].id_pelanggan);
    $("#nama_pembeli").val(e[0].nama_pembeli);
    
    
  })
  $("#myModal").modal('show');
  $("#judul_modal").html("<b>Piutang</b>");
}

$("#form_trx").on("submit",function(){
  $("#t4_info_form").html("");
  $.ajax({
            url: "<?php echo base_url()?>index.php/pelanggan/simpan_trx",
            type: "POST",
            contentType: false,
            processData:false,
            data:  new FormData(this),
            beforeSend: function(){
                //alert("sedang uploading...");
            },
            success: function(e){
                console.log(e);
                
                $("#t4_info_form").html("<div class='alert alert-success'>Sukses! "+e+"</div>");
                
            },
            error: function(er){
                $("#info").html("<div class='alert alert-warning'>Ada masalah! "+er+"</div>");
            }           
       });
  return false;
})


$("#myModal").on("hidden.bs.modal", function () {
  eksekusi_controller('<?php echo base_url()?>index.php/pelanggan/transaksi','Data Pelanggan');
});
</script>
