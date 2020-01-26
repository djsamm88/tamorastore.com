
<div class="alert alert-info"><b>Form Pembatalan Jamaah</b></div>


<hr>
<form id="form_pembatalannya">
<input type="hidden" name="id_jamaah" value="<?php echo($id_jamaah)?>">
<input type="hidden" name="id_paket" value="<?php echo($id_paket)?>">
<textarea class="form-control" name="keterangan" placeholder="Isikan keterangan pembatalan" required="required"></textarea>

<br>
<div class="row">
	<div class="col-sm-3">
		Pengembalian Uang
	</div>		
	<div class="col-sm-9">
		<input type="text" name="pengembalian_uang" class="form-control nomor" required="required" placeholder="Rp.biaya dikembalikan">
	</div>
</div>

<div style="clear:both"></div><br>

<hr>
<div class="col-sm-12">	
		<input type="submit" value="Simpan" class="btn btn-primary" id="simpan">		
</div>
<div style="clear:both"></div><br>
<div class="col-sm-12">
		<input type="button" value="&larr; Kembali" class="btn btn-warning" id="batal">
	</div>
</form>	

<script type="text/javascript">
	
$("#batal").on("click",function(){
	var id= "<?php echo $id_paket?>";
	table_jamaah(id);
})

hanya_nomor(".nomor");
function table_jamaah(id)
{
  $.get("<?php echo base_url()?>index.php/"+classnya+"/table_jamaah/"+id,function(ev){
      
      $("#bodyModal").html(ev);
      
  })
}

$("#form_pembatalannya").on("submit",function(){

	if(confirm("Anda yakin membatalkan? \nAksi ini akan membatalkan Jamaah"))
	{
		$.post("<?php echo base_url()?>index.php/"+classnya+"/go_pembatalan",$(this).serialize(),function(x){
			console.log(x);
			var id= "<?php echo $id_paket?>";
			table_jamaah(id);
		})
	
	}
	
	return false;
})
</script>