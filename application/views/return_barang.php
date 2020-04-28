
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 id="">
        Form Return Barang        
      </h1>      
    </section>

    <!-- Main content -->
    <section class="content container-fluid" >

      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title" id="">Form Return</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
              
              
              <form id="form_return">
                
                <div class="col-sm-4">
                  Nama Barang
                </div>                
                <div class="col-sm-8" id="t4_nama_barang">
                  <input type="text"   class="form-control barang" placeholder="Barang" name="nama_barang" required>
                  <input type="hidden"   class="form-control" name="id_barang" id="id_barang">
                </div>
                <div style="clear: both;"></div><br>
                <div class="col-sm-4">
                  Jumlah
                </div>                
                <div class="col-sm-2" >
                  <input type="number" name="jumlah" value="1" id="jumlah_barang" class="form-control" placeholder="jumlah barang">
                </div>
                <div style="clear: both;"></div><br>

                <div class="col-sm-4">
                  Kondisi
                </div>                
                <div class="col-sm-8" >
                  <select name="kondisi" class="form-control" required="">
                      <option value="">--- Pilih Kondisi ---</option>
                      <option value="rusak">Rusak</option>
                      <option value="baik">Baik</option>
                  </select>
                </div>
                <div style="clear: both;"></div><br>


                <div class="col-sm-4">
                  Gudang
                </div>                
                <div class="col-sm-8" >
                  <select name="id_gudang" class="form-control" required="">
                      <option value="">--- Pilih Gudang ---</option>
                      <?php 
                        foreach ($this->m_gudang->m_data() as $gud) {
                          echo "<option value='$gud->id_gudang'>$gud->nama_gudang</option>";
                        }
                      ?>
                  </select>
                </div>
                <div style="clear: both;"></div><br>

                

                <div class="col-sm-4">
                  Total Uang Kembali
                </div>
                <div class="col-sm-8" >
                  <input type="text" name="uang_kembali" id="uang_kembali" class="form-control nomor" placeholder="Uang kembali">
                </div>
                <div style="clear: both;"></div><br>


                <div class="col-sm-4">
                  Nama Pelanggan
                </div>                
                <div class="col-sm-8" >
                  <input  class="form-control id_pelanggan" required>
                  <input type="hidden"   class="form-control" name="id_pelanggan" id="id_pelanggan">
                  
                </div>
                <div style="clear: both;"></div><br>


                <div class="col-sm-4">
                  Keterangan                
                </div>
                <div class="col-sm-8" >
                  <textarea name="ket" class="form-control" required="" placeholder="Keterangan pengembalian"></textarea>
                </div>
                <div style="clear: both;"></div><br>
                
             <button type="submit" class="btn btn-warning">Return</button>

            </form>
     

    </div>
    
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->




    <!-- Main content -->
    <section class="content container-fluid" >

      <!--------------------------
        | Your Page Content Here |
        -------------------------->    
<!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title" id="judul2">History Return</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
              






<br>

<table id="tbl_datanya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>
              <th width="10px">Id Barang</th>           
              <th>Barang</th>                                           
              <th>Jumlah</th>                     
              <th>Total Uang kembali</th>                     
              <th>Dari</th>                     
              <th>No HP</th>                     
              <th>Kondisi</th>                     
              <th>Gudang</th>                     
              <th>Keterangan</th>                     
              <th>Tgl</th>
              <th>Action</th>                     
                                  
              
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        foreach($all as $x)
        {
          $no++;
            $btn = $x->kondisi=='rusak'?"<button class='btn btn-xs btn-warning' onclick='kembalikan($x->id_ret)'>Kembalikan ke Suplier</button>":"";
            echo (" 
              
              <tr>
                <td>$no</td>
                <td>$x->id</td>
                <td>$x->nama_barang</td>                
                <td>$x->jumlah</td>                
                <td>".rupiah($x->uang_kembali)."</td>                
                <td>$x->nama_pembeli</td>                
                <td>$x->hp_pembeli</td>                
                <td>$x->kondisi</td>                
                <td>$x->nama_gudang</td>                
                <td>$x->ket</td>                
                <td>$x->tgl_trx</td>                
                <td>$btn</td>                
                
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
  </table>


<div class="text-left col-sm-6">
<a href="<?php echo base_url()?>index.php/barang/print_return_barang/" class="btn btn-primary" target="blank">Print Semua</a>
<a href="<?php echo base_url()?>index.php/barang/print_return_barang/rusak" class="btn btn-danger" target="blank">Print Rusak</a>
<a href="<?php echo base_url()?>index.php/barang/print_return_barang/baik" class="btn btn-success" target="blank">Print Baik</a>
</div>



<div class="text-right col-sm-6">
<a href="<?php echo base_url()?>index.php/barang/return_barang_xl/" class="btn btn-primary" target="blank">Semua Excel</a>
<a href="<?php echo base_url()?>index.php/barang/return_barang_xl/rusak" class="btn btn-danger" target="blank">Rusak Excel</a>
<a href="<?php echo base_url()?>index.php/barang/return_barang_xl/baik" class="btn btn-success" target="blank">Baik Excel</a>
</div>



</div>
</div>
<!-- /.box -->
</section>
    <!-- /.content -->



<script>
console.log("<?php echo $this->router->fetch_class();?>");
var classnya = "<?php echo $this->router->fetch_class();?>";


<?php
$o=''; 
foreach($all_barang as $barang)
{
 $o.='{
        value:"'.$barang->id.'",
        label:"'.htmlentities($barang->nama_barang).'",
        stok:"'.htmlentities($barang->qty).'",
        harga_retail:"'.htmlentities($barang->harga_retail).'",
        harga_lusin:"'.htmlentities($barang->harga_lusin).'",
        harga_koli:"'.htmlentities($barang->harga_koli).'",
        jum_per_koli:"'.htmlentities($barang->jum_per_koli).'"
      },';
} 
?>


<?php
$p=''; 
foreach($this->m_pelanggan->m_data() as $pelanggan)
{
 $p.='{
        value:"'.$pelanggan->id_pelanggan.'",
        label:"'.htmlentities($pelanggan->nama_pembeli).'"
      },';
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
                 

                $(this).val(ui.item.label);
                $("#id_barang").val(ui.item.value);
                $("#uang_kembali").val(ui.item.harga_retail);
                return false;
                }



    });


});



$( function() {
    var semuaPelanggan = [
      <?php echo $p?>
    ];
    $( ".id_pelanggan" ).autocomplete({
      source: semuaPelanggan,
                      minLength: 1,
                select: function(event, ui) {
                  console.log(ui);
                 

                $(this).val(ui.item.label);
                $("#id_pelanggan").val(ui.item.value);                
                return false;
                }



    });


});

function kembalikan(id)
{
  if(confirm("Anda yakin mengembalikan ke Suplier?"))
  {
    $.get("<?php echo base_url()?>index.php/barang/return_barang_ke_suplier/"+id,function(e){
        eksekusi_controller('<?php echo base_url()?>index.php/barang/return_barang','Return Barang');
        console.log(e);

    })
  }
  return false;
}


$("#jumlah_barang").on("keydown keyup mousedown mouseup select contextmenu drop",function(){
    var jum   = parseInt(buang_titik($(this).val()));
    var uang  = parseInt(buang_titik($("#uang_kembali").val()));

    console.log(jum);
    console.log(uang);
    var hasil_kali = jum*uang;

    console.log(hasil_kali);
    //$("#uang_kembali").val(hasil_kali);
})

$("#form_return").on("submit",function(){
  console.log($(this).serialize());
  if(confirm("Anda yakin?"))
  {
    $.post("<?php echo base_url()?>index.php/barang/go_return_barang",$(this).serialize(),function(){
      eksekusi_controller('<?php echo base_url()?>index.php/barang/return_barang','Return Barang');
    })
  }
  return false;
})


$(document).ready(function(){

  $('#tbl_datanya').dataTable();

});

hanya_nomor(".nomor");

</script>
