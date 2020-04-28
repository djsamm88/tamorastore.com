<div class="col-md-6">
      <!-- USERS LIST -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Latest Members</h3>

          <div class="box-tools pull-right">
            <span class="label label-danger"><?php echo count($all)?> New Members</span>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <ul class="users-list clearfix">
            <?php 
              foreach ($all as $mem) {
                echo "
                  <li>
                    <img src='".base_url()."dist/img/avatar2.png' alt='User Image'>
                    <a class='users-list-name' href='#' onclick='chat($mem->id_pelanggan,\"$mem->nama_pembeli\")'>$mem->nama_pembeli</a>
                    <span class='users-list-date'>$mem->tgl_daftar</span>
                  </li>            
                ";
              }
            ?>
            
          </ul>
          <!-- /.users-list -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center">
          <a href="javascript:void(0)" class="uppercase">View All Users</a>
        </div>
        <!-- /.box-footer -->
      </div>
      <!--/.box -->
    </div>
    <!-- /.col -->


<script type="text/javascript">
function chat(kpd_id,kpd_nama)
{
  /*
  $("#t4_chat_kasir").html("");
  $("#t4_chat_kasir").empty();
  $.get("<?php echo base_url()?>index.php/chat/chat_kasir?kpd_id="+kpd_id+"&kpd_nama="+kpd_nama,function(e){
    $("#t4_chat_kasir").html(e);
  })
  */
  window.open("<?php echo base_url()?>index.php/chat/?kpd_id="+kpd_id+"&kpd_nama="+kpd_nama,"_self");


}  
</script>