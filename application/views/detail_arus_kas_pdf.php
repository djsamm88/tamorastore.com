<link rel="stylesheet" href="<?php echo base_url()?>bower_components/bootstrap/dist/css/bootstrap.min.css">
<style>
body{
  font-size: 12px;
}

table tr td, th  { 
  
  font-size: 12px; padding:5px;
  

}
table th{
      text-align: center;
      
    }

td {
      
      padding:5px;
      
    }
</style>

    
    <div class="text-center" style="font-weight:bold;font-size: 14">      
        ARUS KAS DETAIL <?php echo strtoupper(@$all[0]->group_trx)?> TANGGAL <?php echo tglindo($tgl_awal)?> S/D <?php echo tglindo($tgl_akhir)?>
    </div>
    <br>

          
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

