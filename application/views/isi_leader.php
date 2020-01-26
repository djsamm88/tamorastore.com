
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 id="judul">
        Selamat datang di Sistem Informasi Manajemen Umroh
        <small>SimUMROH</small>
      </h1>      
    </section>

    <!-- Main content -->
    <section class="content container-fluid" id="t4_isi">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->    
<!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Sistem Informasi Manajemen UMROH </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
              
          <?php 
          $saldo = 0;
          $byr =0;
          foreach($all as $y)
          {
            $saldo+=$y->fee_leader;
            $byr+=$y->telah_bayar;
          }
          $saldo-=$byr;
         ?>


              <!-- ./col -->
              <div class="col-sm-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3><?php echo count($all)?></h3>

                    <p>Total Jamaah</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-users"></i>
                  </div>
                  
                </div>
              </div>
              <!-- ./col -->
              <div class="col-sm-6">
                <!-- small box -->
                <div class="small-box bg-red">
                  <div class="inner">
                  
                    <h3><?php echo rupiah($saldo)?></h3>

                    <p>Saldo</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-dollar"></i>
                  </div>
                  
                </div>
              </div>
              
            



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
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Pembayaran Fee Anda</h3>

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
        <table id="tbl_datanya1" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
              <thead>
                <tr>
              
              <th width="50px">NO.</th>           
              <th>Id</th>
              <th>No. Identitas</th>
              <th>Nama</th>
              <th>Nama Paket</th>       
              <th>Tgl Umroh</th>        
              <th>Tgl Akhir</th>        
              <th>Harga Paket</th>       
              <th>Fee Leader</th>       
              <th>Dibayar</th>        
                    <th>Action</th>                     
                    
                  
              </tr>
            </thead>
            <tbody>
              <?php         
              $no = 0;
              foreach($all as $x)
              {
               
              if($x->telah_bayar>0 && ($x->telah_bayar>=$x->fee_leader))
              {
                $btn = "<font color='green'>Telah Lunas</font>";
              }else{
                $btn = "<font color='warning'>Belum Lunas</font>";
              }
              $btn .= "<button class='btn btn-warning btn-xs' onclick='detail_jamaah($x->id_jamaah);return false;'>Detail Jamaah</button>"; 
                
                $no++;
                  
               
                  echo (" 
                    
                    <tr>
                      <td>$no</td>
                      <td>$x->id_jamaah</td>
                      <td>$x->no_identitas</td>
                      <td>$x->nama $x->nama_tengah $x->nama_belakang</td>                 
                      <!--<td>$x->id_paket/".bulantahunromawi($x->tgl_umroh)." SNR</td>-->
                      <td>$x->nama_paket</td>
                      <td>".tglindo($x->tgl_umroh)."</td>
                      <td>".tglindo($x->tgl_akhir)."</td>
                      <td>".rupiah($x->harga_paket)."</td>                  
                      <td>".rupiah($x->fee_leader)."</td>                 
                      <td>".rupiah($x->telah_bayar)."</td>                  
                    
                      <td>
                        $btn
                      </td>
                    </tr>
                ");
                
              }
              
              
              ?>
            </tbody>
        </table>
      </div>


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
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Kelengkapan Jamaah Anda</h3>

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
       <table id="tbl_datanya2" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th width="50px">NO.</th>           
                <th>Id</th>
                <!--<th>Id Paket</th>-->
                <th>No. Identitas</th>
                <th>Nama</th>                       
                <th>Tagihan</th>
                <th>Diskon</th>
                <th>Dibayar</th>
                <th>Sisa</th>               
                <th>Barang</th>               
                <th>Pembayaran Lain</th>                
                
              
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        foreach($all_kelengkapan as $x)
        {
          
          
          $barang = $x->jumlah_barang>0?"<font color=green><small>Sudah terima</small></font>":"<font color=warning><small>Belum terima</small></font>";

          $pemasukan_lain = $x->jumlah_pemasukan_lain>0?"<font color=green><small>Sudah bayar</small></font>":"<font color=warning><small>Belum bayar</small></font>";

          $barang_trx = $this->m_barang->m_history($x->id_paket,$x->id_jamaah);

          $kel_barang = "
            <table class='table'>            
          ";
          foreach ($barang_trx as $bar) {
            $kel_barang.="
              <tr>
                <td>$bar->nama_barang</td>                                
                <td>$bar->jumlah</td>                
              </tr>
            ";
          }
          $kel_barang.="</table>";


          $pembayaran_lain_trx = $this->m_pemasukan_lain->m_data_telah_bayar($x->id_paket,$x->id_jamaah);
          $kel_pemb_lain = "
            <table class='table'>            
          ";
          foreach ($pembayaran_lain_trx as $lain) {
            $kel_pemb_lain.="
              <tr>                                
                <td>$lain->nama_pemasukan</td>                                                                
                <td style='text-align: right;'>".rupiah($lain->jumlah)."</td>
              </tr>
            ";
          }
          $kel_pemb_lain.="</table>";

          $no++;
            
         $class = $x->sisa>0?"danger":"";

            echo (" 
              
              <tr class='$class'>
               <td>$no</td>
               <td>$x->id_jamaah</td>
               <!--<td>$x->id_paket/".bulantahunromawi($x->tgl_umroh)." SNR</td>-->
                <td>$x->no_identitas</td>
                <td>$x->nama $x->nama_tengah $x->nama_belakang</td>                       
                <td>".rupiah($x->total_modal)."</td>        
                <td>".rupiah($x->diskon)."</td>        
                <td>".rupiah($x->telah_dibayar)."</td>        
                <td>".rupiah($x->sisa)."</td>       
                <td>$barang $kel_barang</td>        

                <td>$pemasukan_lain $kel_pemb_lain</td>        
                
            
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
  </table>
</div>


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
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Daftar Paket Tersedia</h3>

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
<table id="tbl_datanya3" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th width="50px">NO.</th>           

               <th>Id.Paket</th>       
              <th>Nama paket</th>
              <th>Tgl umroh</th>
              <th>Tgl akhir</th>
              <th>Kuota</th>

              <th>Pesawat</th>
              <th>Jenis Pesawat</th>
              <th>Hotel</th>


              <th>Harga Paket</th>              
              <th>Fee Leader</th> 

              <th>Keterangan</th>
              <th>Itinerary</th>


              <th>Action</th>                     
              
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        foreach($all_paket as $x)
        {
          $btn ="";
          $btn = "<button class='btn btn-warning btn-xs btn-block' onclick='detail_jamaah_paket(\"$x->id\",\"$x->nama_paket\");return false;'>Detail Jamaah</button>
                  ";

          $no++;
            
          $total = $x->harga_paket;
            echo (" 
              
              <tr>
               <td>$no</td>
                <td>$x->id/".bulantahunromawi($x->tgl_umroh)." SNR</td>
               <td>$x->nama_paket</td>
              
              <td>".tglindo($x->tgl_umroh)."</td>
              <td>".tglindo($x->tgl_akhir)."</td>
              
              <td>".($x->kuota)."</td>

              <td>$x->nama_pesawat</td>
              <td>$x->jenis_pesawat</td>
              <td>$x->nama_hotel</td>


              <td>".rupiah($x->harga_paket)."</td>              
              <td>".rupiah($x->fee_leader)."</td>
              <td>$x->keterangan</td>
              <td><a href='".base_url()."uploads/$x->itinerary' target='blank'>$x->itinerary</a></td>
              
                <td>
                  $btn
                </td>
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
  </table>
</div>


    </div>    
  </div>
  <!-- /.box -->
</section>
<!-- /.content -->



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="judul_modal">Form Data</h4>
      </div>
      <div class="modal-body" id="bodyModal">

            <div class="col-sm-4" style="text-align:right">id_jamaah</div>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="id_jamaah" id="id_jamaah" readonly>
            </div> 
            <div style="clear:both"></div><br>


            <div class="col-sm-4" style="text-align:right">No identitas</div>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="no_identitas" id="no_identitas" readonly>
            </div> 
            <div style="clear:both"></div><br>


            <div class="col-sm-4" style="text-align:right">Nama</div>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="nama" id="nama" readonly>
            </div> 
            <div style="clear:both"></div><br>


            <div class="col-sm-4" style="text-align:right">Foto KTP</div>
            <div class="col-sm-8">              
              <span id="foto_ktp"></span>
            </div> 
            <div style="clear:both"></div><br>

            <div class="col-sm-4" style="text-align:right">Foto KK</div>
            <div class="col-sm-8">              
              <span id="foto_kk"></span>
            </div> 
            <div style="clear:both"></div><br>



            <div class="col-sm-4" style="text-align:right">Tempat Lahir</div>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" readonly>
            </div> 
            <div style="clear:both"></div><br>


            <div class="col-sm-4" style="text-align:right">Tgl Lahir</div>
            <div class="col-sm-8">
              <input type="text" class="form-control datepicker" name="tgl_lahir" id="tgl_lahir" readonly>
            </div> 
            <div style="clear:both"></div><br>


            <div class="col-sm-4" style="text-align:right">Kelamin</div>
            <div class="col-sm-8">
              <select class="form-control" name="kelamin" id="kelamin" readonly>
                <option value="M">Laki-laki</option>
                <option value="F">Perempuan</option>
              </select>
            </div> 
            <div style="clear:both"></div><br>


            <div class="col-sm-4" style="text-align:right">No hp</div>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="no_hp" id="no_hp" readonly>
            </div> 
            <div style="clear:both"></div><br>


            <div class="col-sm-4" style="text-align:right">Foto</div>
            <div class="col-sm-8">
              <span id="foto"></span>
            </div> 
            <div style="clear:both"></div><br>


            <div class="col-sm-4" style="text-align:right">Nama ahli waris</div>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="nama_ahli_waris" id="nama_ahli_waris" readonly>
            </div> 
            <div style="clear:both"></div><br>


            <div class="col-sm-4" style="text-align:right">Hub. ahli waris</div>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="hubungan_ahli_waris" id="hubungan_ahli_waris" readonly>
            </div> 
            <div style="clear:both"></div><br>

            


            <div class="col-sm-4" style="text-align:right">No hp ahli waris</div>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="no_hp_ahli_waris" id="no_hp_ahli_waris" readonly>
            </div> 
            <div style="clear:both"></div><br>

            <hr>
            <center><b>Passport</b></center>
              

              

              <div style="clear:both"></div><br>
              <div class="col-sm-4" style="text-align:right">Warga Negara</div>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="warga_negara" id="warga_negara" readonly>
              </div> 
              <div style="clear:both"></div><br>
              
              <div class="col-sm-4" style="text-align:right">No passport</div>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="no_passport" id="no_passport" readonly>
              </div> 
              <div style="clear:both"></div><br>


              <div class="col-sm-4" style="text-align:right">Issued passport</div>
              <div class="col-sm-8">
                <input type="text" class="form-control datepicker" name="issued_passport" id="issued_passport"  readonly>
              </div> 
              <div style="clear:both"></div><br>


              <div class="col-sm-4" style="text-align:right">Expired passport</div>
              <div class="col-sm-8">
                <input type="text" class="form-control datepicker" name="expired_passport" id="expired_passport"  readonly>
              </div> 
              <div style="clear:both"></div><br>


              <div class="col-sm-4" style="text-align:right">Office passport</div>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="office_passport" id="office_passport"  readonly>
              </div> 
              <div style="clear:both"></div><br>




              <div class="col-sm-4" style="text-align:right">id_paket</div>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="id_paket" id="id_paket" value="" readonly>
              </div> 
              

          <div style="clear: both;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>





<!-- Modal -->
<div id="myModal_paket" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="judul_modal_paket">Data Paket</h4>
      </div>
      <div class="modal-body" id="bodyModal_paket">
          

          <div style="clear: both;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script type="text/javascript">  
  function detail_jamaah(id_jamaah)
  {
    console.log(id_jamaah);
    $("#myModal").modal('show');
    $.get("<?php echo base_url()?>index.php/welcome_leader/by_id_paket/"+id_jamaah,function(e){

      console.log(e);
      //$("#bodyModal").html(ev);
      
      $("#bodyModal").find("#id_jamaah").val(e[0].id_jamaah);
      $("#bodyModal").find("#no_identitas").val(e[0].no_identitas);
      $("#bodyModal").find("#nama").val(e[0].nama);
      $("#bodyModal").find("#tempat_lahir").val(e[0].tempat_lahir);
      $("#bodyModal").find("#tgl_lahir").val(e[0].tgl_lahir);
      $("#bodyModal").find("#kelamin").val(e[0].kelamin);
      $("#bodyModal").find("#no_hp").val(e[0].no_hp);      
    $("#bodyModal").find("#foto").html("<a href='<?php echo base_url()?>/uploads/"+e[0].foto+"' target='blank'>foto</a>");
    
    $("#bodyModal").find("#foto_ktp").html("<a href='<?php echo base_url()?>/uploads/"+e[0].foto_ktp+"' target='blank'>foto_ktp</a>");
    
    $("#bodyModal").find("#foto_kk").html("<a href='<?php echo base_url()?>/uploads/"+e[0].foto_kk+"' target='blank'>foto_kk</a>");

      $("#bodyModal").find("#nama_ahli_waris").val(e[0].nama_ahli_waris);
      $("#bodyModal").find("#no_hp_ahli_waris").val(e[0].no_hp_ahli_waris);

      $("#bodyModal").find("#warga_negara").val(e[0].warga_negara);
      $("#bodyModal").find("#no_passport").val(e[0].no_passport);
      $("#bodyModal").find("#issued_passport").val(e[0].issued_passport);
      $("#bodyModal").find("#expired_passport").val(e[0].expired_passport);
      $("#bodyModal").find("#office_passport").val(e[0].office_passport);
      $("#bodyModal").find("#tgl_update").val(e[0].tgl_update);
      $("#bodyModal").find("#id_leader").val(e[0].id_leader);
      $("#bodyModal").find("#id_paket").val(e[0].id_paket);
      $("#bodyModal").find("#status").val(e[0].status);
      $("#bodyModal").find("#hubungan_ahli_waris").val(e[0].hubungan_ahli_waris);
      

      })

  }




function detail_jamaah_paket(id,nama_paket)
{
  $("#judul_modal_paket") .html("Detail `"+nama_paket+"`");
  $("#bodyModal_paket").find("#id_paket_hidden").val(id);
  table_jamaah(id);
  $("#myModal_paket").modal('show');
}


function table_jamaah(id)
{
  $.get("<?php echo base_url()?>index.php/welcome_leader/table_jamaah/"+id,function(ev){
      
      console.log(ev);
      $("#bodyModal_paket").html(ev);
      
  })
}

</script>