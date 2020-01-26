
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
              
              <th>No</th>
              <th width="10px">Id Barang</th>                         
              <th>Barang</th>                     
              <th>Stok Awal</th>                                   
              <th>Harga Pokok</th>                                   
              <th class='warning'>Harga Beli @</th>                     
              <th class='warning'>Qty</th>                     
              <th class='warning'>Act</th>
              
              
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
                <td id='id_barang'>$x->id</td>
                <td>$x->nama_barang</td>    
                <td id='qty_awal'>$x->qty</td>    
                <td id='harga_awal'>".rupiah($x->harga_pokok)."</td>    

                <td class='warning'><input class='form-control nomor' name='harga' type='' value='' id='harga'></td>                
                <td class='warning'>
                  <input class='form-control' name='qty' type='number' id='qty'>
                  
                </td>
                <td class='warning'>
                  <button class='btn btn-danger btn-xs' type='button' id='beli' onclick='go_beli($(this))'>Beli</button>
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
<div id="myModal_beli" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form Data</h4>
      </div>
      <div class="modal-body">
          

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

function go_beli(ini)
{
  
    var harga_awal  = buang_titik(ini.parent().parent().find("#harga_awal").text());
    var qty_awal    = buang_titik(ini.parent().parent().find("#qty_awal").text());

    var harga_beli = buang_titik(ini.parent().parent().find("#harga").val());
    var qty = buang_titik(ini.parent().parent().find("#qty").val());
    var id_barang  = ini.parent().parent().find("#id_barang").text();
    //console.log((harga_beli));
    if(harga_beli == "")
    {
      alert("Harga tidak boleh kosong!!!");
      ini.parent().parent().find("#harga").focus();
      return false;
    }

    if(qty == "")
    {
      ini.parent().parent().find("#qty").focus();
      alert("Qty tidak boleh kosong!!!");
      
      return false;
    }

    //$("#myModal_beli").modal('show');

    var hasil = Math.round(((parseInt(harga_beli)*parseInt(qty))+(parseInt(harga_awal)*parseInt(qty_awal)))/(parseInt(qty)+parseInt(qty_awal)));
    console.log(hasil);

    if(confirm("Confirm barang masuk dengan harga pokok : Rp."+formatRupiah(hasil)))
    {
      var ser = {id_barang:id_barang,qty:qty,harga:hasil,harga_beli:harga_beli};
      $.post("<?php echo base_url()?>index.php/"+classnya+"/go_beli",ser,function(x){
        console.log(x);
        eksekusi_controller('<?php echo base_url()?>index.php/'+classnya+'/data_beli',document.title);
      })
    }

}




function formatRupiah(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}


$(document).ready(function(){

  $('#tbl_datanya').dataTable();

});
$("#judul2").html("DataTable "+document.title);
</script>
