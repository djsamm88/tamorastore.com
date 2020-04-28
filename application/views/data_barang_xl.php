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
MASTER BARANG
<table id="tbl_datanya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>
              <th width="10px">Id Barang</th>           
              <th>Barang</th>                     
              <th>Stok</th>                     
              <th>Harga Beli</th>                     
              <th>Harga Retail</th>                     
              <th>Harga Lusin</th>                     
              <th>Harga Koli</th>                     
              <th>Jumlah / Koli</th>                     
              <th>Reminder Gudang</th>                     
              
              
              
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
                <td>$x->qty</td>                
                <td>".rupiah($x->harga_pokok)."</td>                
                <td>".rupiah($x->harga_retail)."</td>                
                <td>".rupiah($x->harga_lusin)."</td>                
                <td>".rupiah($x->harga_koli)."</td>                
                <td>".rupiah($x->jum_per_koli)."</td>     
                <td>$x->reminder</td>                           
                
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
  </table>