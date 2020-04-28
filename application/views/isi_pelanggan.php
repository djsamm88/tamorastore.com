
<?php     
  $pelanggan = $this->m_pelanggan->m_by_id($this->session->userdata('id_admin'))[0];
  //print_r($pelanggan);
?>
                <canvas id="lineChart" style="height:0px"></canvas>

 <div class="row">
          <div class="col-md-8">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Selamat datang <?php echo $this->session->userdata('nama_admin')?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              Info login:<br>
              
                <div class="row">
                  <div class="col-sm-3">
                      Nama  
                  </div>
                  <div class="col-sm-9">
                    <span class="label label-info"><?php echo $pelanggan->nama_pembeli?></span>
                  </div>

                  <div class="col-sm-3">
                      Email  
                  </div>
                  <div class="col-sm-9">
                    <span class="label label-info"><?php echo $pelanggan->email_pembeli?></span>
                  </div>

                  <div class="col-sm-3">
                      HP  
                  </div>
                  <div class="col-sm-9">
                    <span class="label label-info"><?php echo $pelanggan->hp_pembeli?></span>
                  </div>

                  <div class="col-sm-3">
                      Tgl Dafter  
                  </div>
                  <div class="col-sm-9">
                    <span class="label label-info"><?php echo $pelanggan->tgl_daftar?></span>
                  </div>
                  <div class="col-sm-3">
                      Status  Member
                  </div>
                  <div class="col-sm-9">
                    <span class="label label-success"><?php echo $pelanggan->status?></span>
                  </div>

              
              </div>

            </div>
            <!-- /.box-body -->
          </div>


        <div id="t4_chat_member"></div>

        </div><!-- /col-->

        <div class="col-md-4">
          <!-- Info Boxes Style 2 -->
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-dollar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Saldo</span>
              <span class="info-box-number"><?php echo rupiah($pelanggan->saldo)?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">
                    <?php echo date('Y-m-d H:i:s')?>
                  </span>
            </div>
            <!-- /.info-box-content -->
            </div>



            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Detail Trx Saldo</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                <?php 
                //print_r($this->m_laporan_keuangan->m_jurnal_pelanggan($this->session->userdata('id_admin')));
                $trx_saldo = $this->m_laporan_keuangan->m_jurnal_pelanggan($this->session->userdata('id_admin'));

              $total=0;    
              $tot_debet=0;
              $tot_kredit=0;
                foreach ($trx_saldo as $key) {
                  $total+=$key->saldo;
                  $tot_debet+=$key->debet;
                  $tot_kredit+=$key->kredit;

                    if($key->debet==0)
                    {
                      $deb_kred = rupiah($key->kredit);
                    }

                    if($key->kredit==0){
                      $deb_kred = rupiah($key->debet);
                    }

                  echo "
                    <li class='item'>
                      <div class='product-img'>
                        $key->group_trx
                      </div>
                      <div class='product-info'>
                        <a href='javascript:void(0)' class='product-title'>$key->tanggal
                          <span class='label label-warning pull-right'>$key->saldo </span></a>
                        <span class='product-description'>
                              $key->keterangan
                            </span>
                      </div>
                    </li>
                    ";
                }
                ?>
                <li class="item">
                  <div class="product-img">
                    
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">Total
                      <span class="label label-danger pull-right"><?php echo rupiah($total)?></span></a>
                    <span class="product-description">
                          
                        </span>
                  </div>
                </li>


                <!-- /.item -->
              </ul>
            </div>
            <!-- /.box-body -->
            
            <!-- /.box-footer -->
          </div>
          
          


          
          </div>
          <!-- /.box -->
        

        </div><!-- /row-->


