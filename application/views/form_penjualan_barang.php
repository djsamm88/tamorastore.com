

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 id="judul">
        Kasir
        
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
          <h3 class="box-title" id="judul2">Penjualan</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">


<form id="penjualan_barang">
  <div class="row">
  
  <div class="col-sm-3">
    <input type="text" name="nama_pembeli" id="nama_pembeli" value="" class="form-control" required placeholder="Nama pembeli">
    <input type="hidden" name="id_pelanggan" id="id_pelanggan">
    <small><i>Nama Pembeli</i></small>
  </div>
  <div class="col-sm-3">
    <input type="text" name="hp_pembeli" id="hp_pembeli" value="" class="form-control" required placeholder="HP pembeli">
    <small><i>HP Pembeli</i></small>
  </div>
  <div class="col-sm-3">
    <input type="text" name="nama_packing" value="" class="form-control" placeholder="Nama Packing">
    <small><i>Nama Packing</i></small>
  </div>
  <div class="col-sm-3">
    <input type="text" name="tgl_trx_manual" value="<?php echo date('Y-m-d H:i:s')?>" class="form-control datepicker">
    <small><i>Format Y-m-d H:i:s</i></small>
    <input type="hidden" name="grup_penjualan" value="<?php echo date('ymdHis')?>" class="form-control " readonly>
  </div>

</div>
  <div style="clear: both;"></div>
  <br>
<input type="text"   class="form-control barang" placeholder="Barang">
<br>
<table id="tbl_datanya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th width="10px">Id</th>           
              <th width="10px">Stok</th>                                   
              <th>Barang</th>                                   
              <th>Satuan</th>                                   
              <th>Harga</th>                                                 
              <th>Qty</th>
              <th>Sub Total</th>
              <th>-</th>                                          
                              
              
              
        </tr>
      </thead>
      <tbody id="t4_order">
        
      </tbody>
      <tfoot>
        <tr>
          <td colspan="6" align="right"><b>Diskon</b></td>
          <td  align="right" >
            <input id="t4_diskon" type="text" name="diskon" class="form-control nomor" value="0" style="text-align:right;">
          </td>
          <td></td>
        </tr>

        <td colspan="6" align="right"><b>Biaya ke ekspedisi</b></td>
          <td  align="right" >
            <input id="t4_transport_ke_ekspedisi" type="text" name="transport_ke_ekspedisi" class="form-control nomor" value="0" style="text-align:right;">
          </td>
          <td></td>
        </tr>
        
        <tr>
          <td colspan="6" align="right"><b>Ekspedisi</b></td>
          <td id="" align="right" >
            <div class="row">
            <div class="col-sm-6">
            <select name="nama_ekspedisi" class="form-control" id="nama_ekspedisi">
                <option value="">--Pilih---</option>
                <?php 
                  foreach ($eksepedisi as $eks) {
                    echo "<option value='$eks->nama_ekspedisi'>$eks->nama_ekspedisi</option>";
                  }
                ?>
              </select>
            </div>
            <div class="col-sm-6">
              <input id="t4_ekspedisi" type="text" name="harga_ekspedisi" class="form-control nomor" value="0" style="text-align:right;">
            </div>
            </div>
          </td>              
          <td></td>
        </tr>



        <tr>
          <td colspan="6" align="right"><b>Total</b></td>
          <td id="t4_total" align="right" style="font-weight: bold;"></td><td></td>
        </tr>

        <tr>
          <td colspan="6" align="right"><b>Bayar</b></td>
          <td  align="right" >
          <input id="t4_bayar" type="text"  class="form-control nomor" name="bayar" required style="text-align:right;">
          </td>
          <td></td>
        </tr>



        <tr>
          <td colspan="6" align="right"><b>Selisih</b></td>
          <td  align="right" id="t4_kembali">
          
          </td>
          <td></td>
        </tr>

      </tfoot>
  </table>

  <textarea class="form-control" name="keterangan" placeholder="keterangan"></textarea><br>
<div class="col-sm-12" style="text-align: right;">
    <input type="submit" value="Bayar" class="btn btn-primary" id="simpan"> 
</div>
<div style="clear: both;"></div>





</form>


      </div>
      <!-- /.box -->

</section>
    <!-- /.content -->





<script type="text/javascript">
var classnya = "<?php echo $this->router->fetch_class();?>";
$(".barang").focus();

$('.datepicker').datepicker({
  autoclose: true,
  format: 'yyyy-mm-dd <?php echo date('H:i:s')?>' 
})

<?php 
  $p = '';
  foreach ($pelanggan as $pp) {
    $p.='{value:"'.$pp->id_pelanggan.'",label:"'.htmlentities($pp->nama_pembeli).'",hp_pembeli:"'.htmlentities($pp->hp_pembeli).'"},';
  }
?>
$(function(){
  var semuaPelanggan = [<?php echo $p?>];
  $("#nama_pembeli").autocomplete({
      source:semuaPelanggan,
      minLength:1,
      select:function(ev,ui){
        console.log(ui.item.value);
        $("#id_pelanggan").val(ui.item.value);
        $("#hp_pembeli").val(ui.item.hp_pembeli);
        $(this).val(ui.item.label);
        return false;
      }
  })
})


$("#nama_ekspedisi").on("change",function(){
  if($(this).val()=="")
  {
    $("#t4_ekspedisi").val("0");
  }
  $.get("<?php echo base_url()?>index.php/ekspedisi/by_nama/"+encodeURI($(this).val()),function(e){
      console.log(e);
      
      $("#t4_ekspedisi").val(e[0].harga_ekspedisi);
      total();

  })
})




<?php
$o=''; 
foreach($all as $barang)
{
 $o.='{value:"'.$barang->id.'",label:"'.htmlentities($barang->nama_barang).'",stok:"'.htmlentities($barang->qty).'",harga_retail:"'.htmlentities($barang->harga_retail).'",harga_lusin:"'.htmlentities($barang->harga_lusin).'",harga_koli:"'.htmlentities($barang->harga_koli).'",jum_per_koli:"'.htmlentities($barang->jum_per_koli).'"},';
} 
?>

$( function() {
    var semuaBarang = [
      <?php echo $o?>
    ];
    $( ".barang" ).autocomplete({
      source: semuaBarang,
                      minLength: 1,
                select: function(event, ui) {
                  console.log(ui);
                  $(this).val('');

                  
                  var pilih_satuan = "<select name='satuan_jual["+ui.item.value+"]' class='form-control' id='pilihSatuan' onchange='gantiHarga("+ui.item.harga_retail+","+ui.item.harga_lusin+","+ui.item.harga_koli+","+ui.item.jum_per_koli+",$(this))'>"+
                                        "<option value='retail'>Retail</option>"+
                                        "<option value='lusin'>Lusin</option>"+
                                        "<option value='koli'>Koli</option>"+
                                     "</select>";


        var template = "<tr>"+
                "<td>"+ui.item.value+"</td><td>"+ui.item.stok+"</td><td>"+ui.item.label+"</td>"+
                "<td>"+pilih_satuan+"</td>"+
                "<td align='right'>"+
                  "<input  id='t4_harga' class='form-control' readonly name='harga_jual["+ui.item.value+"]' value='"+formatRupiah(ui.item.harga_retail)+"'>"+
                "</td>"+
                "<td>"+
                "<input class='form-control' type='number' id='jumlah_beli' name='jumlah["+ui.item.value+"]'  placeholder='qty' required>"+
                "</td>"+
                "<td align='right' id='t4_sub_total'></td>"+
                          
                          
                  "<td><button class='btn btn-danger btn-xs' id='remove_order' type='button'>Hapus</button></td></tr>"
                          ;
                  $("#t4_order").append(template);
                  $(".barang").val("");
                  
                return false;
                }



    });


});

function gantiHarga(a,b,c,d,ini)
{

  var t4_harga = ini.parent().parent().find("#t4_harga");
  var t4_sub_total = ini.parent().parent().find("#t4_sub_total");
  var jumlah_beli = ini.parent().parent().find("#jumlah_beli");



  $("#t4_total").html('');


  jumlah_beli.val("");
  t4_sub_total.html("");

  var ret;
  if(ini.val()=="retail")
  {
    ret = a;
  }

  if(ini.val()=="lusin")
  {
    ret = b;
    jumlah_beli.val('12');
  }

  if(ini.val()=="koli")
  {
    ret = c;
    jumlah_beli.val(d);
  }  


  t4_harga.val(formatRupiah(ret));

  sub_total(jumlah_beli);
  
}

$("#tbl_datanya").on("click","tbody tr td button#remove_order",function(x){
  $(this).parent().parent().remove();
  
  return false;
})


$("#tbl_datanya").on("keydown keyup mousedown mouseup select contextmenu drop","tbody tr td input#jumlah_beli",function(){ 
  sub_total($(this));
})





$("#t4_diskon,#nama_ekspedisi,#t4_transport_ke_ekspedisi,#t4_ekspedisi").on("keydown keyup mousedown mouseup select contextmenu drop",function(){
    total();
})


$("#t4_bayar").on("keydown keyup mousedown mouseup select contextmenu drop",function(){
    var tot = parseInt(buang_titik($("#t4_total").text()));
    var bayar = parseInt(buang_titik($(this).val()));

    var kembalian = bayar - tot;
    $("#t4_kembali").html(formatRupiah(kembalian));
    console.log(tot);

})

function sub_total(ini)
{
    var qty = ini.val();
    if(qty=="")
    {
      qty=0;
    }
    var harga = buang_titik(ini.parent().parent().find("#t4_harga").val());

    var sub_total = parseInt(qty)*parseInt(harga);

    ini.parent().parent().find("#t4_sub_total").html(formatRupiah(sub_total));  
    
    total();
}


function total()
{
  var total=0;
  $("tbody#t4_order tr td#t4_sub_total").each(function(){
     total+= parseInt(buang_titik($(this).text()));

  })
  console.log(total);

  var diskon = parseInt(buang_titik($("#t4_diskon").val()));
  var harga_ekspedisi = parseInt(buang_titik($("#t4_ekspedisi").val()));
  var transport_ke_ekspedisi = parseInt(buang_titik($("#t4_transport_ke_ekspedisi").val()));
  total+=transport_ke_ekspedisi;
  total+=harga_ekspedisi;
  total-=diskon;
  $("#t4_total").html(formatRupiah(total));
}

$("#penjualan_barang").on("submit",function(){

  if(confirm("Anda yakin selesai?"))
  {
    $.post("<?php echo base_url()?>index.php/"+classnya+"/go_jual",$(this).serialize(),function(x){
      console.log(x);
      
        window.open("<?php echo base_url()?>index.php/barang/struk_penjualan/"+x);

        eksekusi_controller('<?php echo base_url()?>index.php/barang/form_penjualan',' Kasir');

        console.log("<?php echo base_url()?>index.php/barang/struk_penjualan/"+x);

      
    })
  
  }

return false;  
})


hanya_nomor(".nomor");
function buang_titik(mystring)
{
  return (mystring.replace(/\./g,''));
}

function formatRupiah(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}


</script>