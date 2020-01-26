
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
          <h3 class="box-title" id="judul2">Form Koreksi Kas</h3>

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
             <form id="form_penarikan_kas">            
            

            <div style="clear: both;"></div><br>
            <div class="col-sm-3">Tanggal</div>
            <div class="col-sm-6">
                <input type="text" name="tanggal_kesalahan" id="tanggal_kesalahan" class="form-control datepicker" required="required">
                <small><i>Masukkan tanggal transaksi yang salah.</i></small>
            </div>
            <div class="col-sm-3"><button type="button" class="btn btn-info" id="cari_tanggal">Cari</button></div>
            <div style="clear: both;"></div><br>

            <div id="t4_select" style="display: none;">
            <div class="col-sm-3">Transaksi</div>
            <div class="col-sm-9">
                <select class="form-control" name="trx_lama" id="trx_lama" required="required">
                  
                </select>
                <small><i>Pilih transaksi yang salah.</i></small>
            </div>
            <div style="clear: both;"></div><br>
            </div>


            <div id="show_kedua" style="display: none;">
              <div class="col-sm-3">Jumlah</div>
              <div class="col-sm-9">
                  <input type="number" name="jumlah" class="form-control" required="required">
                  <small><i><b>Nb.</b> Masukkan nilai dengan minus (-) Untuk mengurangi selisih (Kredit).</i></small>
              </div>
              <div style="clear: both;"></div><br>

              <div class="col-sm-3">Keterangan</div>
              <div class="col-sm-9">
                  <textarea type="text" name="keterangan" id="keterangan" class="form-control" required="required"></textarea>
                  <small><i><b>Nb.</b> Input keterangan sejelas mungkin agar laporan keuangan mudah dibaca.</i></small>                
              </div>

              <div style="clear: both;"></div><br>
              <div class="col-sm-3"></div>
              <div class="col-sm-9">
                  <input type="submit"  class="btn btn-success" value="Simpan Transaksi">
              </div>
              <div style="clear: both;"></div><br>
            </div>
            </form>
            </div>

            <div id="info_form"></div>
        </div>
      </div>

</section>
    <!-- /.content -->

<script type="text/javascript">

$('.datepicker').datepicker({
  autoclose: true,
  format: 'yyyy-mm-dd' 
})
  hanya_nomor(".nomor");

$("#cari_tanggal").on("click",function(){

    var tgl = $("#tanggal_kesalahan").val();
    if(tgl=="")
    {
      $("#tanggal_kesalahan").focus();
      return false;
    }
    $("#trx_lama").empty();
    $("#trx_lama").html("<option value=''>--- Pilih Transaksi ---</option>");
    $.get("<?php echo base_url()?>index.php/laporan_keuangan/by_tgl/"+tgl,function(e){
      console.log("<?php echo base_url()?>index.php/laporan_keuangan/by_tgl/"+tgl);
      $.each(e,function(a,b){
        
        console.log(b);
        $("#trx_lama").append("<option value='"+b.id+"'>"+b.id+"."+b.keterangan+" </option>");

      })
    })
    $("#t4_select, #show_kedua").fadeIn();
    
    console.log(tgl);

    return false;
})

$("#trx_lama").on("change",function(){

  var textnya = $("#trx_lama option:selected").text();
  console.log(textnya);
  $("#keterangan").val("[Koreksi]"+textnya);
})

  $("#form_penarikan_kas").on("submit",function(){

    if(confirm("Anda yakin melakukan aksi ini?\nAkan mempengaruhi Kas!"))
    {
      $.post("<?php echo base_url()?>index.php/laporan_keuangan/go_koreksi",$(this).serialize(),function(x){

        $("#info_form").html("<div class='alert alert-success'>Berhasil melakukan koreksi keuangan.</div>");
        $("#div_form").remove();
      })
    }

    return false;
  })

  $("html, body").animate({ scrollTop: 0 }, "slow");
</script>