
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 id="judul">
        Selamat datang di POS
        <small></small>
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
<div class="table-responsive">              
<table id="tbl_datanya_barang" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>                                          
              <th>Tanggal</th>                                    
              <th>Kode Trx.</th>                                              
              <th>Saldo</th>                                                   
              <th>Sub Total</th>                                                   
              <th>Total</th>                     
              <th>Status</th>                     
              <th>Bukti Transfer</th>                     
              
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        foreach($all as $x)
        {
          $no++;

      $url_bukti  = "<a href='".base_url()."uploads/$x->bukti_transfer' target='blank'>$x->bukti_transfer</a>";
      $btn_upload = "<a href='#' class='btn btn-xs btn-block btn-warning' onclick='upload_bukti($x->grup_penjualan);return false;'>Upload Bukti</a>";
      $bukti = $x->bukti_transfer==""?$btn_upload:$url_bukti;
            
            echo (" 
              
              <tr>
                <td>$no</td>                                
                <td>".($x->tgl_transaksi)."</td>                
                <td>$x->grup_penjualan</td>                                
                <td align=right>".rupiah($x->saldo)."</td>                                
                <td align=right>".rupiah($x->total)."</td>                                
                <td align=right>".rupiah($x->total-$x->saldo-$x->diskon+($x->harga_ekspedisi+$x->transport_ke_ekspedisi))."</td>                
                <td>
                 <span class='label label-warning'>Menunggu</span>
                 <a href='#' onclick='lihat_detail($x->grup_penjualan);return false;'>Lihat detail</a>
                </td>
                <td>
                 $bukti
                 
                </td>                                 
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
<div id="myModalDetail" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detail</h4>
      </div>
      <div class="modal-body">
            <ul class='products-list product-list-in-box' id="t4_produk">

            </ul>

          <div style="clear: both;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>





<!-- Modal -->
<div id="myModalUploadBukti" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Bukti Transfer</h4>
      </div>
      <div class="modal-body">
          <form id="form_upload_bukti">
            <input type="hidden" name="grup_penjualan" id="grup_penjualan" class="form-control" readonly="readonly">            

          <div class="col-sm-4">Gambar</div>
            <div class="col-sm-8">
              <input class="form-control" name="gambar" id="gambar" type="file" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" onchange="readURL(this)">
              <span id="t4_gbr_onload"></span>
            </div>
            <div style="clear: both;"></div><br>

            <div id="t4_info_form_bukti"></div>
            <button type="submit" class="btn btn-primary"> Upload </button>
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


function upload_bukti(grup_penjualan)
{

  $("#grup_penjualan").val(grup_penjualan);
  $("#myModalUploadBukti").modal('show');
  return false;
}


function readURL(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {      
        $("#t4_gbr_onload").html("<img src='"+e.target.result+"' style='width:200px;' class='img img-responsive'>");          
      };

      reader.readAsDataURL(input.files[0]);
  }
}


$("#form_upload_bukti").on("submit",function(){
  var ser = $(this).serialize();

      $.ajax({
            url: "<?php echo base_url()?>index.php/"+classnya+"/go_upload_bukti",
            type: "POST",
            contentType: false,
            processData:false,
            data:  new FormData(this),
            beforeSend: function(){
                //alert("sedang uploading...");
            },
            success: function(e){
                console.log(e);
                $("#t4_info_form_bukti").html("<div class='alert alert-success'>Berhasil.</div>").fadeIn().delay(3000).fadeOut();
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


function lihat_detail(grup_penjualan)
{
  $("#t4_produk").empty();
  $.get("<?php echo base_url()?>index.php/barang/pesanan_by_group/"+grup_penjualan,function(e){
      console.log(e);
      var temp = 
      $.each(e,function(a,b){
        console.log(b);
        var template = "<li class='item'>"+
                      "<div class='product-img'>"+formatRupiah(b.harga_jual)+"</div>"+
                      "<div class='product-info'>"+
                        "<a href='javascript:void(0)' class='product-title'>"+b.jumlah+
                          "<span class='label label-warning pull-right'>"+formatRupiah(b.sub_total_jual)+"</span></a>"+
                          "<span class='product-description'>"+b.nama_barang+"</span>"+
                      "</div>"+
                    "</li>";

            $("#t4_produk").append(template);
      })
      $("#myModalDetail").modal('show');
  })
  return false;
}

function hapus_pending(group_penjualan)
{
  if(confirm("Anda yakin?"))
  {
    $.get("<?php echo base_url()?>index.php/barang/hapus_pending/"+group_penjualan,function(){
        eksekusi_controller('<?php echo base_url()?>index.php/barang/lap_pending/','Penjualan Pending');  
      })
  }
  
}

$(document).ready(function(){

  $('#tbl_datanya_barang').dataTable();

});
$("#judul2").html("DataTable "+document.title);


function formatRupiah(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}


$("#myModalUploadBukti").on("hidden.bs.modal", function () {
  eksekusi_controller('<?php echo base_url()?>index.php/'+classnya+'/pesanan_member',document.title);
});


</script>
