
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
        <button class="btn btn-primary" id="tambah_data"  onclick="tambah()">Tambah Barang Baru</button> 
<div class="table-responsive">
<table id="tbl_datanya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>
              <th width="10px">Id Barang</th>                         
              <th>Barang</th>                     
              <th>Masuk</th>                                                                    
              <th class='warning'>Qty</th>                     
              <th class='warning'>Gudang</th>                     
              <th class='warning'>Act</th>
              
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        $gud = "";
        foreach ($gudang as $g) {
          $gud.="<option value='$g->id_gudang'>$g->nama_gudang</option>";
        }
        foreach($all as $x)
        {
          $no++;
            
            echo (" 
              
              <tr>
                <td>$no</td>
                <td id='id_barang'>$x->id</td>
                <td>$x->nama_barang</td>    
                <td id='qty_awal'>$x->masuk</td>    
                         
                <td class='warning'>
                  <input class='form-control' name='qty' type='number' id='qty'>                  
                </td>
                <td class='warning'>
                  <select class='form-control' name='id_gudang' required id='id_gudang'>
                    <option value=''>--pilih--</option>
                    $gud;
                  </select>
                </td>

                <td class='warning'>
                  <button class='btn btn-danger btn-xs' type='button' id='beli' onclick='go_beli($(this))'>Masuk</button>
                </td>
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
  </table>
</div>
<div style="text-align: right;">

</div>
<div style="display: none;" id="t4_kalkulasi"></div>



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
        <h4 class="modal-title">Form Penambahan Barang Baru</h4>
      </div>
      <div class="modal-body">
          <form id="form_tambah_admin">
            <input type="hidden" name="id" id="id" class="form-control" readonly="readonly">            

            <div class="col-sm-4">Nama Barang</div>
            <div class="col-sm-8"><input type="text" name="nama_barang" id="nama_barang" required="required" class="form-control" placeholder="nama_barang"></div>
            <div style="clear: both;"></div><br>        

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
hanya_nomor(".nomor");
function buang_titik(mystring)
{
  return (mystring.replace(/\./g,''));
}


function tambah()
{
  if(confirm("Pastikan belum ada barang di table lalu tambahkan. Anda yakin?"))
  {
  	$("#myModal").modal('show');	
  }     
}


$("#form_tambah_admin").on("submit",function(){
  

  $("#t4_info_form").html('Loading...');  
  var ser = $(this).serialize();

  $.post("<?php echo base_url()?>index.php/"+classnya+"/simpan_form",ser,function(x){
    console.log(x);
    
      $("#t4_info_form").html("<div class='alert alert-success'>Berhasil.</div>").fadeIn().delay(3000).fadeOut();

      setTimeout(function(){
        $("#myModal").modal('hide');
      },3000);
    
  })

  return false;
})

function go_beli(ini)
{
  
    
    var qty = buang_titik(ini.parent().parent().find("#qty").val());
    var id_barang  = ini.parent().parent().find("#id_barang").text();
    var id_gudang = ini.parent().parent().find("#id_gudang").val();
    //console.log((harga_beli));
    
    if(qty == "")
    {
      ini.parent().parent().find("#qty").focus();
      alert("Qty tidak boleh kosong!!!");
      
      return false;
    }

    if(id_gudang =="")
    {
      ini.parent().parent().find("#id_gudang").focus();
      alert("Gudang harus dipilih!");
      return false;
    }

    //$("#myModal_beli").modal('show');

    if(confirm("Anda yakin?"))
    {
      var ser = {id_barang:id_barang,qty:qty,id_gudang:id_gudang};
      $.post("<?php echo base_url()?>index.php/"+classnya+"/go_simpan_sementara",ser,function(x){
        console.log(x);
        alert("Barang telah ditambahkan.");
        eksekusi_controller('<?php echo base_url()?>index.php/barang/form_barang_sementara','Barang Masuk');
      })
    }

}



$("#myModal").on("hidden.bs.modal", function () {
  eksekusi_controller('<?php echo base_url()?>index.php/barang/form_barang_sementara','Barang Masuk');
});




function formatRupiah(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}


$(document).ready(function(){

  $('#tbl_datanya').dataTable();

});
$("#judul2").html("DataTable "+document.title);

</script>
