
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
<table id="tbl_datanya" class="table  table-striped table-borded"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>
              <th width="10px">Id Barang</th>                         
              <th>Barang</th>                     
              <th>Stok Awal</th>                                   
              <th>Harga Beli Awal</th>                                   
              <th>Harga Beli</th>                                   
              <th>Atur Harga Jual</th>                                   
              
              <th>Qty Masuk</th>                     
              <th>Gudang</th>                     
              <th>Tgl Masuk</th>                     
              <th>Act</th>
              
              
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

                <td class=''>
                  <input class='form-control nomor' name='harga_beli' value='$x->harga_pokok' id='harga_beli'>
                </td>  

                 <td class=''>                  
                  <small><i>Harga Jual Retail</i></small>
                  <input class='form-control nomor' name='harga_retail' value='$x->harga_retail' id='harga_retail'>
                  <br>
                  <small><i>Harga Jual Lusin</i></small>
                  <input class='form-control nomor' name='harga_lusin' value='$x->harga_lusin' id='harga_lusin'>
                  <br>
                  <small><i>Harga Jual Koli</i></small>
                  <input class='form-control nomor' name='harga_koli' value='$x->harga_koli' id='harga_koli'>
                </td>  
                

                <td>
                  <input class='form-control' name='qty' type='number' id='qty' value='$x->masuk' readonly>
                </td>
                
                <td>
                    $x->nama_gudang 
                    <input name='id_gudang' type='hidden' id='id_gudang' value='$x->id_gudang'>
                    <input name='id_barang_masuk' type='hidden' id='id_barang_masuk' value='$x->id_barang_masuk'>

                </td>

                <td>$x->tgl_masuk</td>

                <td>
                  <button class='btn btn-danger btn-xs' type='button' id='beli' onclick='go_beli($(this))'>Simpan</button>
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

    var harga_beli = buang_titik(ini.parent().parent().find("#harga_beli").val());
    var harga_retail = buang_titik(ini.parent().parent().find("#harga_retail").val());
    var harga_lusin = buang_titik(ini.parent().parent().find("#harga_lusin").val());
    var harga_koli = buang_titik(ini.parent().parent().find("#harga_koli").val());

    var qty = buang_titik(ini.parent().parent().find("#qty").val());
    var id_barang  = ini.parent().parent().find("#id_barang").text();
    var id_gudang = ini.parent().parent().find("#id_gudang").val();
    var id_barang_masuk = ini.parent().parent().find("#id_barang_masuk").val();


    //console.log((harga_beli));
    if(harga_beli == "")
    {
      alert("Harga tidak boleh kosong!!!");
      ini.parent().parent().find("#harga_beli").focus();
      return false;
    }

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

    /*ini jika harga otomatis*/
    /*
    var hasil = Math.round(((parseInt(harga_beli)*parseInt(qty))+(parseInt(harga_awal)*parseInt(qty_awal)))/(parseInt(qty)+parseInt(qty_awal)));
    console.log(hasil);
    */
    /*ini jika harga otomatis*/


    if(confirm("Anda akan menyimpan data. Anda yakin?"))
    {
      var ser = {
                  id_barang:id_barang,
                  qty:qty,
                  harga_beli:harga_beli,
                  harga_retail:harga_retail,
                  harga_lusin:harga_lusin,
                  harga_koli:harga_koli,
                  id_gudang:id_gudang,
                  id_barang_masuk:id_barang_masuk
                };
      console.log(ser);
      
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
