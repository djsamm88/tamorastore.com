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

  <b>Data Stok Gudang</b>
  <div class="table-responsive">
  <table id="tbl_stok" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>
               <th width="100px">Id barang</th>
                <th>Nama barang</th>
                <th>Stok Barang</th>                
                <th>Data Reminder</th>                
                <th>Gudang</th>                
                   
              
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        foreach($stok->result() as $s)
        {
          
          $class  = $s->reminder > $s->qty?"danger":"";


          $no++;

            echo (" 
              
              <tr class='$class'>
                <td>$no</td>
                <td>$s->id</td>
                <td>$s->nama_barang</td>
                <td>$s->qty</td>
                <td>$s->reminder</td>
                <td>$s->nama_gudang</td>
                
                
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
  </table>