
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
          <h3 class="box-title" id="judul2">Form penambahan Kas</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
             
             <div id="div_form">
             <form id="form_penambahan_kas">            
            <div style="clear: both;"></div><br>
            <div class="col-sm-3">Jumlah</div>
            <div class="col-sm-9">
                <input type="text" name="jumlah" class="form-control nomor" required="required">
            </div>
            <div style="clear: both;"></div><br>

            <div class="col-sm-3">Keterangan</div>
            <div class="col-sm-9">
                <input type="text" name="keterangan" class="form-control" required="required">
            </div>

            <div style="clear: both;"></div><br>
            <div class="col-sm-3"></div>
            <div class="col-sm-9">
                <input type="submit"  class="btn btn-success" value="Tambah Kas">
            </div>
            <div style="clear: both;"></div><br>
            </form>
            </div>

            <div id="info_form"></div>
        </div>
      </div>

</section>
    <!-- /.content -->

<script type="text/javascript">
  hanya_nomor(".nomor");
  $("#form_penambahan_kas").on("submit",function(){

    if(confirm("Anda yakin melakukan aksi ini?\nAkan mempengaruhi Kas!"))
    {
      $.post("<?php echo base_url()?>index.php/laporan_keuangan/go_tambah_kas",$(this).serialize(),function(x){

        $("#info_form").html("<div class='alert alert-success'>Berhasil ditambahkan.</div>");
        $("#div_form").remove();
      })
    }

    return false;
  })


  $("html, body").animate({ scrollTop: 0 }, "slow");
</script>