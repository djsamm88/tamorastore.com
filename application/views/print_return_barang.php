<link rel="stylesheet" href="<?php echo base_url()?>bower_components/bootstrap/dist/css/bootstrap.min.css">
<style>
body{
  font-size: 12px;
}
table{
    border-collapse: collapse;
}
table tr td, th  { 
  
  font-size: 12px; padding:5px;
  

}
table th{
      text-align: center;
        border: 1px solid black;

      
    }

td {
      
      padding:5px;
        border: 1px solid black;

      
    }
</style>

  
  <div class="text-center" style="font-weight:bold;font-size: 14">      
      LAPORAN BARANG RETURN
  </div>

<table id="tbl_datanya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>
              <th width="10px">Id Barang</th>           
              <th>Barang</th>                                           
              <th>Jumlah</th>                     
              <th>Total Uang kembali</th>                     
              <th>Dari</th>                     
              <th>No HP</th>                     
              <th>Kondisi</th>                     
              <th>Gudang</th>                     
              <th>Keterangan</th>                     
              <th>Tgl</th>                     
                                  
              
              
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
                <td>$x->id</td>
                <td>$x->nama_barang</td>                
                <td>$x->jumlah</td>                
                <td>".rupiah($x->uang_kembali)."</td>                
                <td>$x->nama_pembeli</td>                
                <td>$x->hp_pembeli</td>                
                <td>$x->kondisi</td>                
                <td>$x->nama_gudang</td>                
                <td>$x->ket</td>                
                <td>$x->tgl_trx</td>                
                
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
  </table>
