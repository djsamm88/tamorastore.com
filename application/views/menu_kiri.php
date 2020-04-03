        <?php 
        if($this->session->userdata('level')=='1')
        {
        ?>

        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/admin/data_admin','Master Admin');return false;">
            <i class="fa fa-lock"></i> <span>Master Admin</span>
          </a>
        </li>




        
        <li class="treeview">
          
          <a href="#"><i class="fa fa-dollar"></i> <span>Modal</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">

            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/form_penambahan_saldo','Penambahan Modal');return false;">
                <i class="fa fa-link"></i> <span>Penambahan Modal</span>
              </a>
            </li>


            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/form_penarikan_saldo','Penarikan Modal');return false;">
                <i class="fa fa-link"></i> <span>Penarikan Modal</span>
              </a>
            </li>


            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/form_koreksi','Koreksi Keuangan');return false;">
                <i class="fa fa-link"></i> <span>Koreksi Keuangan</span>
              </a>
            </li>


            
          </ul>
        </li>



        <li class="treeview">
          
          <a href="#"><i class="fa fa-retweet"></i> <span>Pengeluaran Bulanan</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/pengeluaran_bulanan/data','Master Pengeluaran');return false;">
                <i class="fa fa-link"></i> <span>Data Pengeluaran</span>
              </a>
            </li>

            
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/pengeluaran_bulanan/form_pengeluaran_bulanan','Form Transaksi');return false;">
                <i class="fa fa-link"></i> <span>Transaksi</span>
              </a>
            </li>


             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/pengeluaran_bulanan/trx_pengeluaran_bulanan','Transaksi Pengeluaran');return false;">
                <i class="fa fa-link"></i> <span>Lap.Pengeluaran</span>
              </a>
            </li>

            
          </ul>
        </li>



        


        <li class="treeview">
          
          <a href="#"><i class="fa fa-database"></i> <span>Master Barang</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/data','Master Barang');return false;">
                <i class="fa fa-link"></i> <span>Data Barang</span>
              </a>
            </li>

            
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/data_beli','Pembelian Barang');return false;">
                <i class="fa fa-link"></i> <span>Barang Masuk</span>
              </a>
            </li>


             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/barang_transaksi','Transaksi Barang');return false;">
                <i class="fa fa-link"></i> <span>Lap.Transaksi</span>
              </a>
            </li>


             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/lap_penjualan','Transaksi Penjualan');return false;">
                <i class="fa fa-link"></i> <span>Lap.Penjualan</span>
              </a>
            </li>


            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/return_barang','Return Barang');return false;">
                <i class="fa fa-link"></i> <span>Return Barang</span>
              </a>
            </li>

            
          </ul>
        </li>



        <li class="treeview">
          
          <a href="#"><i class="fa fa-users"></i> <span>Pelanggan</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/Pelanggan/data','Master Pelanggan');return false;">
                <i class="fa fa-link"></i> <span>Data</span>
              </a>
            </li>

            
            
          </ul>
        </li>



        <li class="treeview">
          
          <a href="#"><i class="fa fa-car"></i> <span>Ekspedisi</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/ekspedisi/data','Master Ekspedisi');return false;">
                <i class="fa fa-link"></i> <span>Data</span>
              </a>
            </li>

            
          </ul>
        </li>




        <li class="treeview">
          
          <a href="#"><i class="fa fa-institution"></i> <span>Gudang</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/gudang/data','Master Gudang');return false;">
                <i class="fa fa-link"></i> <span>Data</span>
              </a>
            </li>

            
            
          </ul>
        </li>



        

        <!--
        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/pembatalan/data_paket','Data Pembatalan');return false;">
            <i class="fa fa-remove"></i> <span>Pembatalan</span>
          </a>
        </li>
        -->



        <li class="treeview">
          
          <a href="#"><i class="fa fa-dollar"></i> <span>Laporan Keuangan</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/kas','Saldo');return false;">
                <i class="fa fa-link"></i> <span>Saldo</span>
              </a>
            </li>

           

            
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/laporan_jurnal/?tgl_awal=<?php echo date('Y-m-').'01'?>&tgl_akhir=<?php echo date('Y-m-d',strtotime('+1 days'));?>','Laporan Jurnal');return false;">
                <i class="fa fa-link"></i> <span>Jurnal</span>
              </a>
            </li>


             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/arus_kas','Laporan Arus Kas');return false;">
                <i class="fa fa-link"></i> <span>Arus Kas</span>
              </a>
            </li>



             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/laporan_laba/?tgl_awal=<?php echo date('Y-m-').'01'?>&tgl_akhir=<?php echo date('Y-m-d',strtotime('+1 days'));?>','Laporan Laba Rugi');return false;">
                <i class="fa fa-link"></i> <span>Laba Rugi</span>
              </a>
            </li>



                        
          </ul>
        </li>

        




        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/form_penjualan',' Kasir');return false;">
            <i class="fa fa-shopping-cart"></i> <span>Kasir</span>
          </a>
        </li>


        
        
        <?php 
          }

          if($this->session->userdata('level')=='2')
          {?>

            


        <li class="treeview">
          
          <a href="#"><i class="fa fa-dollar"></i> <span>Laporan Keuangan</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/kas','Saldo');return false;">
                <i class="fa fa-link"></i> <span>Saldo</span>
              </a>
            </li>

           

            
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/laporan_jurnal/?tgl_awal=<?php echo date('Y-m-').'01'?>&tgl_akhir=<?php echo date('Y-m-d',strtotime('+1 days'));?>','Laporan Jurnal');return false;">
                <i class="fa fa-link"></i> <span>Jurnal</span>
              </a>
            </li>


             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/arus_kas','Laporan Arus Kas');return false;">
                <i class="fa fa-link"></i> <span>Arus Kas</span>
              </a>
            </li>





                        
          </ul>
        </li>

        






         <?php 
          }
        ?>




        <?php 
          if($this->session->userdata('level')=='3')
          {?>



        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/form_penjualan',' Kasir');return false;">
            <i class="fa fa-shopping-cart"></i> <span>Kasir</span>
          </a>
        </li>


        

        <?php }?>
        
        
        <li>
          <a href="#">
             &nbsp;
          </a>
        </li>


            
           