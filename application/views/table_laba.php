
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
          <h3 class="box-title" id="judul2">Transaksi Laba Rugi</h3>

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
                  <input type="text" class="form-control datepicker" name="tgl_awal" id="tgl_awal"  value="<?php echo $tgl_awal ?>" >
              </div>
              <div class="col-sm-5">
                <input type="text" class="form-control datepicker" name="tgl_akhir" id="tgl_akhir"  value="<?php echo $tgl_akhir ?>">
              </div>
              <div class="col-sm-2">
                <input type="submit" class="btn btn-primary btn-block" value="Go">
              </div>
          </form>
          <div style="clear: both"></div>
        </div>
         <table class="table table-bordered" id="tbl_jurnal">
           <thead>
             <tr>
                <th>No.</th>
                <th>Id.Trx</th>
                <th>Tanggal</th>
                <th>Group Trx</th>
                <th>Keterangan</th>
                <th>Debet</th>
                <th>Kredit</th>
                <th>Saldo</th>
             </tr>
           </thead>
           <tbody>
             <?php 
             $no=0;         
             $total=0;    
             $tot_debet=0;
             $tot_kredit=0;
              foreach ($all as $key) {
                $no++;
                

                if($key->id_group=='8')
                {
                  $key->keterangan='[ harga_jual - (harga_beli + diskon) ] <br> '.$key->harga_jual.'- ('.$key->harga_beli.'+'.$key->diskon.')<br>'. $key->keterangan;
                  $key->saldo = $key->harga_jual - ($key->harga_beli + $key->diskon);
                  $key->kredit = $key->harga_beli + $key->diskon;
                }

                $total+=$key->saldo;
                $tot_debet+=$key->debet;
                $tot_kredit+=$key->kredit;

                echo "
                  <tr>
                    <td>$no</td>
                    <td>$key->id</td>
                    <td>".tglindo($key->tanggal)."</td>
                    <td>$key->group_trx</td>
                    <td>$key->keterangan</td>
                    <td style='text-align:right'>".rupiah($key->debet)."</td>
                    <td style='text-align:right'>".rupiah($key->kredit)."</td>
                    <td style='text-align:right'>".rupiah($key->saldo)."</td>
                  </tr>
                ";
              }
             ?>
             
           </tbody>
           <tfoot>
             <tr>
                <th colspan='5' style='text-align:right'><b>Total</b></th>
                <th style='text-align:right'><b>Rp.<?php echo rupiah($tot_debet)?></b></th>
                <th style='text-align:right'><b>Rp.<?php echo rupiah($tot_kredit)?></b></th>
                <th style='text-align:right'><b>Rp.<?php echo rupiah($total)?></b></th>
             </tr>
           </tfoot>
         </table>



      </div>

      <input type="button" class="btn btn-primary" value="Download" id="download_pdf">
      <!-- /.box -->
    </div>
</section>
    <!-- /.content -->

<script type="text/javascript">
  /*
  $(document).ready(function(){
    $('#tbl_jurnal').dataTable(
      {
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\Rp.,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 5 ).footer() ).html(
                'Rp.'+formatRupiah(pageTotal) +' (Rp.'+ formatRupiah(total) +')'
            );
        }
    } );
  })

*/
function formatRupiah(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
$('.datepicker').datepicker({
  autoclose: true,
  format: 'yyyy-mm-dd' 
})

$("#go_trx_jurnal").on("submit",function(){
    var tgl_awal   = $("#tgl_awal").val();
    var tgl_akhir  = $("#tgl_akhir").val();
    if( (new Date(tgl_awal).getTime() > new Date(tgl_akhir).getTime()))
    {
      alert("Perhatikan pengisian tanggal. Ada yang salah.");
      return false;
    }

    eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/laporan_laba/?tgl_awal='+tgl_awal+'&tgl_akhir='+tgl_akhir,'Laporan Laba Rugi');
  return false;
})

$("html, body").animate({ scrollTop: 0 }, "slow");



$("#download_pdf").on("click",function(){
  var ser = $("#go_trx_jurnal").serialize();
  var url="<?php echo base_url()?>index.php/laporan_keuangan/laporan_laba_pdf/?"+ser;
  window.open(url);

  return false;
})

</script>