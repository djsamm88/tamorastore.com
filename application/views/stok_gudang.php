
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
               <th width="100px">id gudang</th>
                <th>nama gudang</th>
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

          $yg_warning = $this->m_barang->m_notif_stok($x->id_gudang)->num_rows();

          $rem = $yg_warning>0?"<span class='label label-danger'>$yg_warning</span>":"0";
          

          $no++;

            echo (" 
              
              <tr>
                <td>$no</td>
                <td>$x->id_gudang</td>
                <td>$x->nama_gudang</td>
                <td>$rem</td>                
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
                <th>Data Reminder</th>                
                <th>Gudang</th>                
                <th>Action</th>                
              
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        foreach($stok->result() as $s)
        {
          
          $class  = $s->reminder > $s->qty?"danger":"";
          $pindah = $s->reminder > $s->qty?"":"<button class='btn btn-primary btn-xs' onclick='pindahkan($s->id,$s->id_gudang)'>Pindahkan</button>";



          $no++;

            echo (" 
              
              <tr class='$class'>
                <td>$no</td>
                <td>$s->id</td>
                <td>$s->nama_barang</td>
                <td>$s->qty</td>
                <td>$s->reminder</td>
                <td>$s->nama_gudang</td>
                <td>$pindah</td>
                
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
        <h4 class="modal-title">Form Pindah Gudang</h4>
      </div>
      <div class="modal-body">
          

            <div class="col-sm-4 judul">Nama Barang</div>
            <div class="col-sm-8">                  
              <span id="nama_barang_pind">
            </div>
            <div style="clear:both"></div>

            <div class="col-sm-4 judul">Dari Gudang</div>
            <div class="col-sm-8" >
              <span id="dari_gudang"></span>                            
            </div>
            <div style="clear:both"></div>

          <form id="form_pindah">

            <input type="hidden" name="id_barang" id="id_barang" class="form-control" readonly="readonly">
            <input type="hidden" name="id_gudang_lama" id="id_gudang_lama" class="form-control" readonly="readonly">
            
            <div class="col-sm-4 judul">Ke gudang</div>
            <div class="col-sm-8">
              <select class="form-control" name="id_gudang" id="id_gudang" required>
                <option value=''>--- Pilih Gudang tujuan ---</option>
                <?php 
                  foreach ($this->m_gudang->m_data() as $gud) {
                    echo "<option value='$gud->id_gudang'>$gud->nama_gudang</option>";
                  }
                ?>
              </select>
            </div>
            <div style="clear:both"></div>
            <br>


            <div class="col-sm-4 judul">Jumlah </div>
            <div class="col-sm-8">              
              <input class="form-control nomor" name="jumlah" id="jumlah" required>
              <span id="t4_max_pindah"></span>
            </div>
            <div style="clear:both"></div>
            <br>



            <div id="t4_info_form"></div>
            <button type="submit" class="btn btn-primary"> Simpan </button>
          </form>

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

function pindahkan(id_barang,id_gudang)
{

  $.get("<?php echo base_url()?>index.php/barang/stok_gudang_by_id/?id_barang="+id_barang+"&id_gudang="+id_gudang,function(e){
      console.log(e);
      var max=e[0].qty;
      $("#t4_max_pindah").html("<i><small><font color=red>Maximal:"+max+"</font></small></i>");
      $("#nama_barang_pind").html("<b>"+e[0].nama_barang+"</b>");
      $("#dari_gudang").html("<b>"+e[0].nama_gudang+"</b>");
      
      

      $("#id_barang").val(e[0].id);
      $("#id_gudang_lama").val(id_gudang);      
      $("#myModal").modal('show');
  })
}


$("#form_pindah").on("submit",function(){
  $("#t4_info_form").html('Loading...');
  

  var ser = $(this).serialize();

  $.post("<?php echo base_url()?>index.php/barang/pindah_gudang",ser,function(x){
    console.log(x);
    
      $("#t4_info_form").html("<div class='alert alert-success'>Berhasil.</div>").fadeIn().delay(3000).fadeOut();

      setTimeout(function(){
        $("#myModal").modal('hide');
      },3000);
    
  })

  return false;
})


function tampil(id_gudang)
{
  eksekusi_controller('<?php echo base_url()?>index.php/barang/stok_gudang/'+id_gudang,'Stok Gudang');return false;
}


$("#myModal").on("hidden.bs.modal", function () {
  eksekusi_controller('<?php echo base_url()?>index.php/barang/stok_gudang/1','Stok Gudang');return false;
});
</script>
