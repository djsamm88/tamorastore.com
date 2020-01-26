
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
              <button class="btn btn-primary" id="tambah_data"  onclick="tambah()">Tambah Data</button> 
              <div class="table-responsive">
              <table id="tbl_datanya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
                    <thead>
                      <tr>
                            
                            <th width="50px">NO.</th>   
                            <th>Id</th>
                            <th>Nama Pengeluaran</th>
                            <th>Tgl</th>

                            <th>Action</th>                     
                            
                            
                      </tr>
                    </thead>
                    <tbody>
                      <?php         
                      $no = 0;
                      foreach($all as $x)
                      {
                        $btn = "<button class='btn btn-warning btn-xs' onclick='edit($x->id);return false;'>Edit</button>
                                <button class='btn btn-danger btn-xs' onclick='hapus($x->id);return false;'>Hapus</button>    ";
                        $no++;
                          
                      
                          echo (" 
                            
                            <tr>
                             <td>$no</td>
                             
                              <td>$x->id</td>
                              <td>$x->nama_pengeluaran</td>
                              <td>$x->tgl_update</td>
                            
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
        <h4 class="modal-title">Form Data</h4>
      </div>
      <div class="modal-body">
          <form id="form_tambah_admin">
            <input type="hidden" name="id" id="id" class="form-control" readonly="readonly">            

            
            <div class="col-sm-4" style="text-align:right">Nama Pemasukan</div>
            <div class="col-sm-8">
              <input class="form-control" placeholder="nama_pengeluaran" name="nama_pengeluaran" required id="nama_pengeluaran" >
            </div>
            <div style="clear:both"></div><br>


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

console.log("<?php echo $this->router->fetch_class();?>");
var classnya = "<?php echo $this->router->fetch_class();?>";

$('.datepicker').datepicker({
  autoclose: true,
  format: 'yyyy-mm-dd' 
})
hanya_nomor(".nomor");

function edit(id)
{
  $.get("<?php echo base_url()?>index.php/"+classnya+"/by_id/"+id,function(e){
    //console.log(e[0].id);
    $("#id").val(e[0].id);
    //$("#nomor_urut").val(e[0].nomor_urut);
    $("#nama_pengeluaran").val(e[0].nama_pengeluaran);
    
  })
  $("#myModal").modal('show');
}

function tambah()
{
    
  $("#myModal").modal('show');
}

function hapus(id)
{
  if(confirm("Anda yakin menghapus?"))
  {
    $.get("<?php echo base_url()?>index.php/"+classnya+"/hapus/"+id,function(e){
      eksekusi_controller('<?php echo base_url()?>index.php/'+classnya+'/data',document.title);
    })  
  }
  
}

$("#form_tambah_admin").on("submit",function(){
  $("#t4_info_form").html('Loading...');
  

  var ser = $(this).serialize();

  $.post("<?php echo base_url()?>index.php/"+classnya+"/simpan_form",ser,function(x){
    console.log(x);
    if(x=='1')
    {
      $("#t4_info_form").html("<div class='alert alert-success'>Berhasil.</div>").fadeIn().delay(3000).fadeOut();

      setTimeout(function(){
        $("#myModal").modal('hide');
      },3000);
    }
  })

  return false;
})


$("#myModal").on("hidden.bs.modal", function () {
  eksekusi_controller('<?php echo base_url()?>index.php/'+classnya+'/data',document.title);
});

$(document).ready(function(){

  $('#tbl_datanya').dataTable();

});
$("#judul2").html("DataTable "+document.title);
</script>
