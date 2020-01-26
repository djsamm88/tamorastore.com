
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


<div class="table-responsive">
<table id="tbl_datanya2" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th width="50px">NO.</th>           
              	<th>Id</th>        				
        				<th>Diskon</th>				
        				<th>Status</th>                
                <th>Paket</th>
        				<th>Harga Paket</th>        				
                <th>Nama Jamaah</th>               
                <th>No. ID Jamaah</th>                
        				<th>Alasan</th>								
                <th>Update</th>
              <th>Action</th>                     
              
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        foreach($all as $x)
        {
          $btn = $x->status=='0'?"<button class='btn btn-danger btn-xs' onclick='setujui($x->id,$x->id_paket,\"$x->diskon\",\"$x->id_jamaah\");return false;'>Setujui</button>":"Telah disetujui";
          
          $no++;
            
         $class = $x->status=='0'?"warning":"";

            echo (" 
              
              <tr class='$class'>
               <td>$no</td>
               <td>$x->id</td>                
                <td>".rupiah($x->diskon)."</td>
                <td>$x->status</td>                                                
                <td>$x->nama_paket</td>
                <td>".rupiah($x->total_modal)."</td>                                
                <td>$x->nama_jamaah</td>                
                <td>$x->no_identitas</td>
                <td>$x->alasan</td>
                <td>".tglindo($x->tgl_update)."</td>
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
<!-- /.box -->

</section>
<!-- /.content -->


<script type="text/javascript">
var classnya = "<?php echo $this->router->fetch_class();?>";
function setujui(id,id_paket,diskon,id_jamaah)
{
  if(confirm("Anda yakin menyetujui diskon ini? \nTindakan akan mempengaruhi KAS"))
  {
    $.post("<?php echo base_url()?>index.php/"+classnya+"/go_approve_diskon",{id:id,id_paket:id_paket,diskon:diskon,id_jamaah:id_jamaah},function(){

        eksekusi_controller('<?php echo base_url()?>index.php/pembayaran/approve_diskon','Data Diskon');

    })
  }

  return false;
}



$(document).ready(function(){

  $('#tbl_datanya2').dataTable();

});
</script>