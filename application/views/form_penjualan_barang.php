<?php
$all_template = ""; 
$keterangan = ""; 
$saldo = 0;
if(isset($group_penjualan))
{
  $data = $this->m_barang->m_detail_penjualan($group_penjualan);    
  $saldo = rupiah($data[0]->saldo);
  $keterangan = $data[0]->keterangan;
  $z=0;
  foreach ($data as $pend) {
    $sel_retail = $pend->satuan_jual=='retail'?'selected':'';
    $sel_lusin = $pend->satuan_jual=='lusin'?'selected':'';
    $sel_koli = $pend->satuan_jual=='koli'?'selected':'';

    $stok = $this->m_barang->m_stok_by_id_barang(1,$pend->id)->result()[0]->qty;

    $pilihan = "<option value='retail' $sel_retail>Retail</option>
                <option value='lusin'  $sel_lusin>Lusin</option>
                <option value='koli' $sel_koli>Koli</option>
                ";

    $class = $pend->qty_jual>$stok?"class='danger'":"";

    $template = "<tr $class>
                    <td>
                      <input id='jum_per_koli' type='hidden' value='$pend->jum_per_koli'>
                      <input id='jum_per_lusin' type='hidden' value='$pend->jum_per_lusin'>
                      <input id='id_barang' name='id_barang[$z]' type='hidden' value='$pend->id'>
                      $pend->id
                    </td>
                    <td id='stoknya'>$stok</td>
                    <td id='nama_barang'>$pend->nama_barang</td>
                    <td>
                      <select name='satuan_jual[$z]' class='form-control' id='pilihSatuan' onchange='gantiHarga($pend->harga_retail,$pend->harga_lusin,$pend->harga_koli,$pend->jum_per_koli,$pend->jum_per_lusin,$(this))'>
                        $pilihan
                      </select>
                    </td>
                    <td align='right'>
                      <input  id='t4_harga' class='form-control' readonly name='harga_jual[$z]' value='".rupiah($pend->harga_jual)."'>
                    </td>
                    <td>
                      <input class='form-control' type='number' id='jumlah_beli' name='jumlah[$z]'  placeholder='qty' required value='$pend->qty_jual'>
                    </td>
                    <td align='right' id='t4_sub_total'>".rupiah($pend->sub_total_jual)."</td>
                    <td>
                      <button class='btn btn-danger btn-xs' id='remove_order' type='button'>Hapus</button>
                    </td>
                  </tr>";

    $all_template .=$template;

    $z++;
  }

}else{
  $group_penjualan="";
}
?>

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
    <input type="text" name="nama_pembeli" id="nama_pembeli" value="<?php echo @$data[0]->nama_pembeli?>" class="form-control" required placeholder="Nama pembeli">
    <input type="hidden" name="id_pelanggan" id="id_pelanggan" value="<?php echo @$data[0]->id_pelanggan?>">
    <small><i>Nama Pembeli</i></small>
  </div>
  <div class="col-sm-3">
    <input type="text" name="hp_pembeli" id="hp_pembeli" value="<?php echo @$data[0]->hp_pembeli?>" class="form-control" required placeholder="HP pembeli">
    <small><i>HP Pembeli</i></small>
  </div>
  <div class="col-sm-3">
    <input type="text" name="nama_packing" value="<?php echo @$data[0]->nama_packing?>" class="form-control" placeholder="Nama Packing">
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
<div class="table-responsive">
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
        <?php echo $all_template?>
      </tbody>
      <tfoot>

        <tr>
          <td colspan="6" align="right"><b>Saldo</b></td>
          <td  align="right" >
            <input id="t4_saldo" type="text" name="saldo" class="form-control nomor" value="<?php echo $saldo?>" style="text-align:right;" readonly>
          </td>
          <td></td>
        </tr>


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
          <input id="t4_bayar" type="text"  class="form-control nomor" name="bayar" value="" required style="text-align:right;">
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
</div>
  <textarea class="form-control" name="keterangan" placeholder="keterangan"><?php echo $keterangan?></textarea><br>
<div class="col-sm-6" style="text-align: left;">
    <input type="button" value="Pending" class="btn btn-warning" id="simpan_pending"> 
</div>

<div class="col-sm-6" style="text-align: right;">
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
notif(); 

total();

$(function(){

    var semuaPelanggan = function(request,response){
            console.log(request.term);
            var serialize = {cari:request.term};
            $.get("<?php echo base_url()?>index.php/barang/json_pelanggan",serialize,
              function(data){
                /*
                response(data);
                console.log(data);
                */
                response($.map(data, function(obj) {
                    return {
                        label: obj.nama_pembeli,
                        value: obj.id_pelanggan,
                        hp_pembeli: obj.hp_pembeli,
                        saldo: obj.saldo
                    };
                }));
                
            })
          }
  $("#nama_pembeli").autocomplete({
      source:semuaPelanggan,
      minLength:1,
      select:function(ev,ui){
        console.log(ui.item.value);
        $("#id_pelanggan").val(ui.item.value);
        $("#hp_pembeli").val(ui.item.hp_pembeli);
        $("#t4_saldo").val(ui.item.saldo);
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




$( function() {

    var semuaBarang = function(request,response){
            console.log(request.term);
            var serialize = {cari:request.term};
            $.get("<?php echo base_url()?>index.php/barang/json_barang_toko",serialize,
              function(data){
                /*
                response(data);
                console.log(data);
                */
                response($.map(data, function(obj) {
                    return {
                        label: obj.nama_barang,
                        value: obj.id,
                        stok: obj.qty,
                        harga_retail: obj.harga_retail, 
                        harga_lusin: obj.harga_lusin, 
                        harga_koli: obj.harga_koli, 
                        jum_per_koli: obj.jum_per_koli, 
                        jum_per_lusin: obj.jum_per_lusin, 
                        reminder: obj.reminder, 
                    };
                }));
                
            })
          }

    var ii=0;
    $( ".barang" ).autocomplete({
      source: semuaBarang,
      minLength: 2,

      select: function(event, ui) {
        console.log(ui);        
        $(this).val('');

       if(ui.item.stok=="0")
       {
        alert("Stok gudang KOSONG. Item : "+ui.item.label);
        return false;
       }

       if(ui.item.stok<ui.item.reminder)
       {
        //notif();//notif ini dari footer welcome
       }

      var option =   "<option value='retail'>Retail</option>"+
                      "<option value='lusin'>Lusin</option>"+
                      "<option value='koli'>Koli</option>";

      var stok          = parseInt(ui.item.stok);
      var jum_per_lusin = parseInt(ui.item.jum_per_lusin);
      var jum_per_koli  = parseInt(ui.item.jum_per_koli);
      

      if(stok<jum_per_lusin){
        var option =   "<option value='retail'>Retail</option>"+                        
                        "<option value='koli'>Koli</option>";        
      }

      if(stok<jum_per_koli){
        var option =   "<option value='retail'>Retail</option>"+                        
                        "<option value='lusin'>Lusin</option>";
      }

      if(stok<jum_per_koli && stok<jum_per_lusin ){
        var option =   "<option value='retail'>Retail</option>";
      }

      

       
                  
       var pilih_satuan = "<select name='satuan_jual["+ii+"]' class='form-control' id='pilihSatuan' onchange='gantiHarga("+ui.item.harga_retail+","+ui.item.harga_lusin+","+ui.item.harga_koli+","+ui.item.jum_per_koli+","+ui.item.jum_per_lusin+",$(this))'>"+
                          option+
                         "</select>";

        var jum_batas = "<input id='jum_per_koli' type='hidden' value='"+ui.item.jum_per_koli+"'>"+
                        "<input id='jum_per_lusin' type='hidden' value='"+ui.item.jum_per_lusin+"'>"+
                        "<input id='id_barang' name='id_barang["+ii+"]' type='hidden' value='"+ui.item.value+"'>";

        var template = "<tr>"+                
                "<td>"+jum_batas+ui.item.value+"</td><td id='stoknya'>"+ui.item.stok+"</td><td id='nama_barang'>"+ui.item.label+"</td>"+
                "<td>"+pilih_satuan+"</td>"+
                "<td align='right'>"+
                  "<input  id='t4_harga' class='form-control' readonly name='harga_jual["+ii+"]' value='"+formatRupiah(ui.item.harga_retail)+"'>"+
                "</td>"+
                "<td>"+
                "<input class='form-control' type='number' id='jumlah_beli' name='jumlah["+ii+"]'  placeholder='qty' required value='1' >"+
                "</td>"+
                "<td align='right' id='t4_sub_total'>"+ui.item.harga_retail+"</td>"+
                          
                          
                  "<td><button class='btn btn-danger btn-xs' id='remove_order' type='button'>Hapus</button></td></tr>"
                          ;
                  $("#t4_order").append(template);
                  $(".barang").val("");
                  
                  //console.log(template);
              ii++;
              //alert(ii);
              return false;
        }

    });


});

function gantiHarga(a,b,c,d,e,ini)
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
    jumlah_beli.val(e);
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
  total();
  return false;
})


$("#tbl_datanya").on("keydown keyup mousedown mouseup select contextmenu drop","tbody tr td input#jumlah_beli",function(){ 

  console.log($(this).parent().parent().find("#stoknya").html());
  
  var dibeli        = parseInt($(this).val());
  var stoknya       = parseInt($(this).parent().parent().find("#stoknya").html());
  var jum_per_koli  = parseInt($(this).parent().parent().find("#jum_per_koli").val());
  var jum_per_lusin = parseInt($(this).parent().parent().find("#jum_per_lusin").val());

  var pilihSatuan   = $(this).parent().parent().find("#pilihSatuan").val();

  if(dibeli>stoknya)
  {
    console.log('jika dibeli lebih besar dari stok');
    alert("Maksimal stok barang = "+$(this).parent().parent().find("#stoknya").html());
    $(this).val($(this).parent().parent().find("#stoknya").html());
    
  }  

  if(pilihSatuan=='koli' && dibeli<jum_per_koli){
    console.log("jum_per_koli"+jum_per_koli);
    //alert("Minimal beli Koli barang ini = "+jum_per_koli);
    $(this).attr('min',jum_per_koli);
    //$(this).val(jum_per_koli);
  }

  if(pilihSatuan=='lusin' && dibeli<jum_per_lusin){
    console.log("jum_per_koli"+jum_per_lusin);
    //alert("Minimal beli Lusin barang ini = "+jum_per_lusin);
    $(this).attr('min',jum_per_lusin);
    //$(this).val(jum_per_lusin);
  }

  sub_total($(this));  
  

})





$("#t4_diskon,#nama_ekspedisi,#t4_transport_ke_ekspedisi,#t4_ekspedisi,.barang,#nama_pembeli").on("keydown keyup mousedown mouseup select contextmenu drop",function(){
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

  var saldo  = parseInt(buang_titik($("#t4_saldo").val()));
  var diskon = parseInt(buang_titik($("#t4_diskon").val()));
  var harga_ekspedisi = parseInt(buang_titik($("#t4_ekspedisi").val()));
  var transport_ke_ekspedisi = parseInt(buang_titik($("#t4_transport_ke_ekspedisi").val()));
  total+=transport_ke_ekspedisi;
  total+=harga_ekspedisi;
  total-=diskon;
  total-=saldo;
  $("#t4_total").html(formatRupiah(total));

  jika_ada_stok_kurang();
}


function jika_ada_stok_kurang()
{
  var jumlah_baris=0;
  var tidak_cukup =0;
  var beli_minus  =0;
  $('#tbl_datanya > tbody  > tr').each(function(index, tr) {      
     //console.log($(tr).find("#stoknya"));
     jumlah_baris++;
     var stok = parseInt(buang_titik($(tr).find("#stoknya").html()));
     var beli = parseInt(buang_titik($(tr).find("#jumlah_beli").val()));
     
     var nama_barang = $(tr).find("#nama_barang").html();
     console.log(stok+"-"+beli);     

     if(stok<beli)
     {
      alert("Stok "+nama_barang+" tidak cukup!!!");
      tidak_cukup++;
      
     }

     if(beli<0)
     {
        beli_minus++;
     }
  });


  if(jumlah_baris==0 || tidak_cukup>0 || beli_minus>0)
   {
      $("#simpan").hide();
   }else{
      $("#simpan").show();
   }


}

$('#penjualan_barang').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});

$("#penjualan_barang").on("submit",function(){
  if($("#t4_total").html()=="")
  {
    total();
    return false;
  }
  if(confirm("Anda yakin selesai?"))
  {
    /****** hapus dlu pending *******/
    $.get("<?php echo base_url()?>index.php/barang/hapus_pending/<?php echo $group_penjualan?>",function(){});
    /****** hapus dlu pending *******/

    $.post("<?php echo base_url()?>index.php/"+classnya+"/go_jual",$(this).serialize(),function(x){
      console.log(x);
      
        window.open("<?php echo base_url()?>index.php/barang/struk_penjualan/"+x);

        eksekusi_controller('<?php echo base_url()?>index.php/barang/form_penjualan',' Kasir');

        console.log("<?php echo base_url()?>index.php/barang/struk_penjualan/"+x);

        notif();   
    })
  
  }

return false;  
})



$("#simpan_pending").on("click",function(){
  if($("#nama_pembeli").val()=="")
  {
    alert("Nama harus isi");
    $("#nama_pembeli").focus();
    return false;
  }

  console.log($("#penjualan_barang").serialize());
  
  if(confirm("Anda yakin pending penjualan?"))
  {
    /****** hapus dlu pending *******/
    $.get("<?php echo base_url()?>index.php/barang/hapus_pending/<?php echo $group_penjualan?>",function(){});
    /****** hapus dlu pending *******/

    $.post("<?php echo base_url()?>index.php/"+classnya+"/go_pending_jual",$("#penjualan_barang").serialize(),function(x){
      console.log(x);
      
        eksekusi_controller('<?php echo base_url()?>index.php/barang/form_penjualan',' Kasir');

        console.log("<?php echo base_url()?>index.php/barang/struk_penjualan/"+x);

        notif();   
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