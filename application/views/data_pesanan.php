
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
              <th>Sub Total</th>                                                   
              <th>Total</th>                     
              <th>Status</th>                     
              
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        foreach($all as $x)
        {
          $no++;
            
            echo (" 
              
              <tr>
                <td>$no</td>                                
                <td>".($x->tgl_transaksi)."</td>                
                <td>$x->grup_penjualan</td>                                
                <td align=right>".rupiah($x->total)."</td>                                
                <td align=right>".rupiah($x->total-$x->diskon+($x->harga_ekspedisi+$x->transport_ke_ekspedisi))."</td>                
                <td>
                 <span class='label label-warning'>Menunggu</span>
                 <a href='#' onclick='lihat_detail($x->grup_penjualan);return false;'>Lihat detail</a>
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


<script>
console.log("<?php echo $this->router->fetch_class();?>");
var classnya = "<?php echo $this->router->fetch_class();?>";


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

</script>
