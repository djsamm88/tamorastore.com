
      <h1 id="judul">
        Laporan Penjualan <?php echo $mulai ?> s.d <?php echo $selesai." ".@$this->session->userdata('nama_admin') ?>
      </h1>      

<table border="1">
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