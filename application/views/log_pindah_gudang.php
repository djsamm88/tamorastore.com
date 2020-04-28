
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
          <h3 class="box-title">Data</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

<div class="table-responsive">
<table id="tbl_newsnya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>
               <th width="100px">Tgl</th>
                <th>Nama Barang</th>
                <th>Gudang Lama</th>
                <th>Gudang Baru</th>
                <th>Jumlah</th>
                <th>Oleh</th>
                <th>Catatan</th>
              
              
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
                <td>$x->tgl</td>
                <td>$x->nama_barang</td>
                <td>$x->nama_gudang_lama</td>
                <td>$x->nama_gudang_baru</td>
                <td>$x->jumlah</td>
                <td>$x->nama_admin</td>
                <td>$x->catatan</td>
                
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
  </table>
</div>


        </div>
        
      </div>
      <!-- /.box -->

</section>
    <!-- /.content -->



<script>

$(document).ready(function(){

  $('#tbl_newsnya').dataTable();

});
</script>
