
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
          <h3 class="box-title" id="judul2"></h3>

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
<table id="tbl_datanya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th width="50px">NO.</th>           
              <th>Id paket</th>
              <th>Nama paket</th>
              <th>Tgl umroh</th>
              <th>Kuota</th>              
              <th>Jamaah</th>             
              <th>Harga</th>            
              <th>Fee Leader</th> 
              <th>Action</th>                     
              
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        foreach($all as $x)
        {
          $btn = "<button class='btn btn-warning btn-xs btn-block' onclick='pilih_jamaah(\"$x->id\",\"$x->nama_paket\");return false;'>Pilih Jamaah</button>
                  ";

          $no++;
            
          $total = $x->harga_paket;
            echo (" 
              
              <tr>
               <td>$no</td>
               <td>$x->id/".bulantahunromawi($x->tgl_umroh)." SNR</td>               
               <td>$x->nama_paket</td>
              <td>".tglindo($x->tgl_umroh)."</td>
              <td>".rupiah($x->kuota)."</td>
              <td>".rupiah($x->jumlah)."</td>
              <td>".rupiah($total)."</td>
              <td>".rupiah($x->fee_leader)."</td>
            
                <td>
                  $btn
                </td>
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
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="judul_modal">Form Data</h4>
      </div>
      <div class="modal-body" id="bodyModal">
          

          <div style="clear: both;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script>

console.log("<?php echo $this->router->fetch_class();?>");
var classnya = "<?php echo $this->router->fetch_class();?>";

$('.datepicker').datepicker({
  autoclose: true,
  format: 'yyyy-mm-dd' 
})
hanya_nomor(".nomor");




function pilih_jamaah(id,nama_paket)
{
  $("#judul_modal") .html("Detail `"+nama_paket+"`");
  $("#bodyModal").find("#id_paket_hidden").val(id);
  table_jamaah(id);
  $("#myModal").modal('show');
}


function table_jamaah(id)
{
  $.get("<?php echo base_url()?>index.php/"+classnya+"/table_jamaah/"+id,function(ev){
      
      $("#bodyModal").html(ev);
      
  })
}




$("#myModal").on("hidden.bs.modal", function () {
  eksekusi_controller('<?php echo base_url()?>index.php/'+classnya+'/data_paket',document.title);
});

$(document).ready(function(){

  $('#tbl_datanya').dataTable();

});
$("#judul2").html("DataTable "+document.title);
</script>
