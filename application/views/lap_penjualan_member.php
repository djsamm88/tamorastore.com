
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
          <div class="alert alert-info">
          <form id="go_trx_jurnal">
              <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="mulai" id="mulai"  value="<?php echo $mulai ?>" >
              </div>
              <div class="col-sm-5">
                <input type="text" class="form-control datepicker" name="selesai" id="selesai"  value="<?php echo $selesai ?>">
              </div>
              <div class="col-sm-2">
                <input type="submit" class="btn btn-primary btn-block" value="Go">
              </div>
          </form>          
          <div style="clear: both"></div>
          </div>

<div class="table-responsive">              
<table id="tbl_datanya_barang" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>                    
              <th>Kasir</th>                     
              <th>Tanggal</th>                                               
              <th>Kode Trx.</th>                     
              <th>Kepada</th>                     
              <th>Sub Total</th>                     
              <th>Diskon</th>                     
              <th>Ekspedisi</th>                     
              <th>Transport Ke Ekspedisi</th>                     
              <th>Saldo</th>                     
              <th>Total</th>                     
              <th>Struk</th>                     
              
              
        </tr>
      </thead>
      <tbody>
        <?php
        $total_all=0;         
        $no = 0;
        foreach($all as $x)
        {
          $total = $x->total-$x->saldo-$x->diskon+($x->harga_ekspedisi+$x->transport_ke_ekspedisi);
          $total_all+=$total;
          $no++;
            
            echo (" 
              
              <tr>
                <td>$no</td>                
                <td>".($x->nama_admin)." <br>".($x->email_admin)."</td>
                <td>".($x->tgl_transaksi)."</td>
                <td>$x->grup_penjualan</td>                
                <td>$x->nama_pembeli -[ $x->id_pelanggan ]</td>                
                <td align=right>".rupiah($x->total)."</td>                
                <td align=right>".rupiah($x->diskon)."</td>                
                <td align=right>".rupiah($x->harga_ekspedisi)."</td>                
                <td align=right>".rupiah($x->transport_ke_ekspedisi)."</td>                
                <td align=right>".rupiah($x->saldo)."</td>                
                <td align=right>".rupiah($total)."</td>                
                <td><a href='".base_url()."index.php/barang/struk_penjualan/".$x->grup_penjualan."' target='blank'>Print</a></td>                                
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
       <tfoot>
             <tr>
                <th colspan='10' style='text-align:right'><b>Total</b></th>
                <th style='text-align:right'><b>Rp.<?php echo rupiah($total_all)?></b></th>
             </tr>
           </tfoot>
  </table>
</div>


        </div>

        <input type="button" class="btn btn-primary" value="Download" id="download_pdf">
        
      </div>
      <!-- /.box -->

</section>
    <!-- /.content -->




<script>
console.log("<?php echo $this->router->fetch_class();?>");
var classnya = "<?php echo $this->router->fetch_class();?>";

$('.datepicker').datepicker({
  autoclose: true,
  format: 'yyyy-mm-dd' 
})


$("#go_trx_jurnal").on("submit",function(){
    var mulai   = $("#mulai").val();
    var selesai  = $("#selesai").val();
    if( (new Date(mulai).getTime() > new Date(selesai).getTime()))
    {
      alert("Perhatikan pengisian tanggal. Ada yang salah.");
      return false;
    }

    eksekusi_controller('<?php echo base_url()?>index.php/pelanggan/lap_penjualan_pelanggan/?mulai='+mulai+'&selesai='+selesai,'Laporan Penjualan');
  return false;
})



$("#download_pdf").on("click",function(){
  var ser = $("#go_trx_jurnal").serialize();
  var url="<?php echo base_url()?>index.php/pelanggan/lap_penjualan_pelanggan_excel/?"+ser;
  window.open(url);

  return false;
})

$(document).ready(function(){

  //$('#tbl_datanya_barang').dataTable();

});
$("#judul2").html("DataTable "+document.title);
</script>
