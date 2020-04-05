
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
              
      <table id="tbl_newsnya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>
               <th width="100px">id_gudang</th>
                <th>nama_gudang</th>
                <th>reminder</th>                
                <th>View</th>                
              
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        foreach($gudang as $x)
        {
          $btn = "<button class='btn btn-warning btn-xs' onclick='tampil($x->id_gudang);return false;'>Tampil</button>";
          $no++;

            echo (" 
              
              <tr>
                <td>$no</td>
                <td>$x->id_gudang</td>
                <td>$x->nama_gudang</td>
                <td>".rupiah($x->reminder)."</td>                
                <td>
                  $btn
                </td>
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
  </table>

<hr>
  <b>Data Stok</b>
  <div class="table-responsive">
  <table id="tbl_stok" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>
               <th width="100px">Id barang</th>
                <th>Nama barang</th>
                <th>Stok Barang</th>                
                <th>Reminder</th>                
                <th>Gudang</th>                
              
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        foreach($stok->result() as $s)
        {
          
          $no++;

            echo (" 
              
              <tr>
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
</div>


        </div>
        
      </div>
      <!-- /.box -->

</section>
    <!-- /.content -->




<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form</h4>
      </div>
      <div class="modal-body">
          

          <div style="clear: both;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script>
$(document).ready(function(){

  $('#tbl_stok').dataTable();

});

function tampil(id_gudang)
{
  eksekusi_controller('<?php echo base_url()?>index.php/barang/stok_gudang/'+id_gudang,'Stok Gudang');return false;
}
</script>
