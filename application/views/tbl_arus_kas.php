
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
          <h3 class="box-title" id="judul2">Transaksi</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

         <table class="table table-bordered" id="tbl_arus_kas">
           <thead>
             <tr>
                <th>No.</th>
                <th>Id.Trx</th>
                <th>Group Trx</th>
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
              foreach ($laporan_group as $key) {
                $no++;
                $total+=$key->saldo;
                $tot_debet+=$key->debet;
                $tot_kredit+=$key->kredit;

                echo "
                  <tr>
                    <td>$no</td>
                    <td id='id_group'>$key->id_group</td>
                    <td><a id='detail'>$key->nama</a></td>
                    <td style='text-align:right'>".rupiah($key->debet)."</td>
                    <td style='text-align:right'>".rupiah($key->kredit)."</td>
                    <td style='text-align:right'>".rupiah($key->saldo)."</td>
                  <tr>
                ";
              }
             ?>
             <tr>
                <td colspan='3' style='text-align:right'><b>Total</b></td>
                <td style='text-align:right'><b>Rp.<?php echo rupiah($tot_debet)?></b></td>
                <td style='text-align:right'><b>Rp.<?php echo rupiah($tot_kredit)?></b></td>
                <td style='text-align:right'><b>Rp.<?php echo rupiah($total)?></b></td>
             </tr>
           </tbody>
         </table>

      </div>
      <!-- /.box -->
    </div>


</section>




    <!-- Main content -->
<section class="content container-fluid" style="display: none;" id="sec_detail">
<div class="box">
        <div class="box-header with-border">
          <h3 class="box-title" id="judul2">Detail Transaksi <span id="nama_paket"></span></h3>

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
          <form id="go_trx_kas">
              <input type="hidden" name="id_group" id="id_group_input" class="form-control">
              <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="tgl_awal" id="tgl_awal"  value="<?php echo date('Y-m-').'01'?>" >
              </div>
              <div class="col-sm-5">
                <input type="text" class="form-control datepicker" name="tgl_akhir" id="tgl_akhir"  value="<?php echo date('Y-m-d')?>">
              </div>
              <div class="col-sm-2">
                <input type="submit" class="btn btn-primary btn-block" value="Go">
              </div>
          </form>
          <div style="clear: both"></div>
        </div>

        <div id="t4_detail"></div>


 </div>


<input type="button" class="btn btn-primary" value="Download" id="download_pdf">
</div>
</section>


    <!-- /.content -->
<script type="text/javascript">
$('.datepicker').datepicker({
  autoclose: true,
  format: 'yyyy-mm-dd' 
})

  $("#tbl_arus_kas").on("click","tbody tr td #detail",function(){
    var id_group = $(this).parent().parent().find('#id_group').text();
    var nama_paket = $(this).text();


    $("#sec_detail").fadeIn();
    $("#nama_paket").html(": "+nama_paket+"");
    $("#id_group_input").val(id_group);
    console.log(id_group);
    
    var ser = $("#go_trx_kas").serialize();
    $.get("<?php echo base_url()?>index.php/laporan_keuangan/detail_arus_kas",ser,function(a){
      $("#t4_detail").html(a);



        $("html, body").animate({ scrollTop: $(document).height() }, 1000);
      
    })

  return false;

  })

$("#go_trx_kas").on("submit",function(){
  $.get("<?php echo base_url()?>index.php/laporan_keuangan/detail_arus_kas",$(this).serialize(),function(a){
      $("#t4_detail").html(a);
    })

  return false;
})

$("#download_pdf").on("click",function(){
  var ser = $("#go_trx_kas").serialize();
  var url="<?php echo base_url()?>index.php/laporan_keuangan/detail_arus_kas_pdf/?"+ser;
  window.open(url);

  return false;
})


  $("html, body").animate({ scrollTop: 0 }, "slow");
</script>