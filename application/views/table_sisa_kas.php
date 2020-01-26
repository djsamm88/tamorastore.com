
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
          <h3 class="box-title" id="judul2">Sisa Kas Sekarang</h3>

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
          $debet = 0;
          $kredit = 0;
          $saldo = 0;
          foreach ($kas as $key) {
            if($key->jenis=='masuk')
            {
              $debet+=$key->jumlah;
            }

            if($key->jenis=='keluar')
            {
              $kredit+=$key->jumlah;
            }

            
          }

          $saldo=$debet-$kredit;

          ?>
            

          <div class="row">
            <div class="col-sm-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>Rp.<?php echo rupiah($debet)?></h3>

                  <p>Total Debet</p>
                </div>
                <div class="icon">
                  <i class="fa fa-dollar"></i>
                </div>
                
              </div>
            </div>
            <!-- ./col -->
            <div class="col-sm-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>Rp.<?php echo rupiah($kredit)?></h3>

                  <p>Total Kredit</p>
                </div>
                <div class="icon">
                  <i class="fa fa-dollar"></i>
                </div>
                
              </div>
            </div>
            <!-- ./col -->
            <div class="col-sm-12">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>Rp.<?php echo rupiah($saldo)?></h3>

                  <p>Saldo Akhir</p>
                </div>
                <div class="icon">
                  <i class="fa fa-money"></i>
                </div>
                
              </div>
            </div>


        </div>


      </div>
      <!-- /.box -->
    </div>



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

         <table class="table table-bordered">
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
                    <td>$key->id_group</td>
                    <td>$key->nama</td>
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
    <!-- /.content -->
<script type="text/javascript">
  $("html, body").animate({ scrollTop: 0 }, "slow");
</script>