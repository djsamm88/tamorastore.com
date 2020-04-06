
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
                  <input type="text"   class="form-control barang" placeholder="Barang" name="nama_barang">
                  <input type="hidden"   class="form-control" name="id_barang" id="id_barang">
                </div>
                <div style="clear: both;"></div><br>
                <div class="col-sm-4">
                  Jumlah
                </div>                
                <div class="col-sm-2" >
                  <input type="number" name="jumlah" class="form-control" placeholder="jumlah barang">
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
                  <input type="text" name="uang_kembali" class="form-control nomor" placeholder="Uang kembali">
                </div>
                <div style="clear: both;"></div><br>


                <div class="col-sm-4">
                  Nama Pelanggan
                </div>                
                <div class="col-sm-8" >
                  <select name="id_pelanggan" class="form-control" required="">
                      <option value="">--- Pilih Pelanggan ---</option>
                      <?php 
                        foreach ($this->m_pelanggan->m_data() as $pel) {
                          echo "<option value='$pel->id_pelanggan'>$pel->nama_pembeli</option>";
                        }
                      ?>
                  </select>
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
              <th>Keterangan</th>                     
              <th>Tgl</th>                     
                                  
              
              
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
                <td>$x->id</td>
                <td>$x->nama_barang</td>                
                <td>$x->jumlah</td>                
                <td>".rupiah($x->uang_kembali)."</td>                
                <td>$x->nama_pembeli</td>                
                <td>$x->hp_pembeli</td>                
                <td>$x->ket</td>                
                <td>$x->tgl_trx</td>                
                
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
  </table>


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
                 

                $(this).val(ui.item.label);
                $("#id_barang").val(ui.item.value);
                return false;
                }



    });


});



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
