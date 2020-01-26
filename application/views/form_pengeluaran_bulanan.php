
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
              
            <form id="form_pengeluarannya">
            <div class="col-sm-4" style="text-align:right">Pilih pengeluaran</div>
            <div class="col-sm-8">
              <select class="form-control" name="nama_pengeluaran" id="nama_pengeluaran" required>
                
                <?php 
                  foreach ($all as $key) {
                    echo "<option value='$key->nama_pengeluaran'>$key->nama_pengeluaran</option>";
                  }
                ?>
              </select>
            </div> 
            <div style="clear:both"></div><br>


            <div class="col-sm-4" style="text-align:right">Jumlah Pengeluaran</div>
            <div class="col-sm-8">
              <input type="text" class="form-control nomor" name="jumlah" id="jumlah" required>
            </div> 
            <div style="clear:both"></div><br>



            <div class="col-sm-4" style="text-align:right">Keterangan Pengeluaran</div>
            <div class="col-sm-8">
              <textarea type="text" class="form-control" name="keterangan" id="keterangan" required></textarea>
            </div> 
            <div style="clear:both"></div><br>


            
            <div class="col-sm-12">
                <div id="t4_info_form"></div>
                <input type="submit" value="Simpan" class="btn btn-primary" id="simpan">  
            </div>
          </form>


</div>

</div>
<!-- /.box -->

</section>
    <!-- /.content -->


<script>

console.log("<?php echo $this->router->fetch_class();?>");
var classnya = "<?php echo $this->router->fetch_class();?>";

$('.datepicker').datepicker({
  autoclose: true,
  format: 'yyyy-mm-dd' 
})
hanya_nomor(".nomor");



$("#form_pengeluarannya").on("submit",function(){
  var ser = $(this).serialize();

  $.post("<?php echo base_url()?>index.php/"+classnya+"/simpan_pengeluaran_bulanan",ser,function(x){
    console.log(x);
    if(x=='1')
    {
      $("#t4_info_form").html("<div class='alert alert-success'>Berhasil.</div>").fadeIn().delay(3000).fadeOut();

      setTimeout(function(){
        eksekusi_controller('<?php echo base_url()?>index.php/'+classnya+'/trx_pengeluaran_bulanan',document.title);
      },3000);
    }
  })

  return false;
})


$("#judul2").html("DataTable "+document.title);
</script>
