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
      <img src='<?php echo base_url()?>assets/kep_surat.png' width='100%'><br>
        SLIP SERAH TERIMA BARANG                        
    </div>
    <br>


<table class="table table-bordered">
	<tr>
		<td width="30%">Nama</td><td><?php echo $jamaah->nama?></td>
	</tr><tr>
		<td>No.Identitas</td><td><?php echo $jamaah->no_identitas?></td>
	</tr><tr>
		<td>Id.Paket</td><td><?php echo $paket->id?>/<?php echo bulantahunromawi($paket->tgl_umroh)?>/ SNR</td>
	</tr><tr>
		<td>Nama Paket</td><td><?php echo $paket->nama_paket?></td>
		
	</tr>
</table>


<table id="tbl_datanya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>                    
              <th>Barang</th>                                   
              <th>Qty</th>   
              <th style="text-align: right;">Harga SubTotal</th>
                                                     
                              
              
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        foreach($trx as $h)
        {
          
          $no++;
            
            echo ("               
              <tr>
                <td>$no</td>                
                <td>$h->nama_barang</td>                                
                <td>$h->jumlah</td>                
                <td style='text-align: right;'>".rupiah($h->harga)."</td>                
                
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
  </table>


