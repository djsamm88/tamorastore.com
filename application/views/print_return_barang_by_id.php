<link rel="stylesheet" href="<?php echo base_url()?>bower_components/bootstrap/dist/css/bootstrap.min.css">
<style>
body{
  font-size: 12px;
  padding: 50px;
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
  .col-sm-4{
    width: 30%;
  }
  .col-sm-8{
   width: 70%; 
  }
</style>
<?php 
  $x = $all[0];
?>

<body>
  
  <div class="text-center" style="font-weight:bold;font-size: 14">      
      BUKTI BARANG RETURN
  </div>
  <table id="tbl_datanya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
    <tr>
      <td width="30%">Tgl</td><td><?php echo $x->tgl_trx?></td>
    </tr>


    <tr>
      <td width="30%">Kepada</td><td><?php echo $x->nama_pembeli?></td>
    </tr>

    <tr>
      <td width="30%">No.HP</td><td><?php echo $x->hp_pembeli?></td>
    </tr>


  </table>
    

<table id="tbl_datanya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>
              <th width="10px">Id Barang</th>           
              <th>Barang</th>                                           
              <th>Jumlah</th>                     
              <th>Total Uang kembali</th>                                   
              <th>Kondisi</th>                     
              <th>Keterangan</th>                     
              
              
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
                <td>$x->kondisi</td>                                        
                <td>$x->ket</td>                                
                
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
  </table>

</body>
