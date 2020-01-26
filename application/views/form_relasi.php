
<div class="alert alert-info"><b>Form Relasi Jamaah</b></div>

Atur keterangan untuk : <b> <?php echo $nama?></b><br>
<hr>
<form id="simpan_relasi">
<input type="hidden" name="id_jamaah_asli" value="<?php echo($id_jamaah)?>">
<textarea class="form-control" name="keterangan" placeholder="Isikan keterangan, misalnya Leader, atau suami istri anak" required="required"></textarea>

<br>
Pilih daftar relasi
<table class="table">
	<?php 
		foreach ($all as $key) {
			echo "<tr><td>$key->id_jamaah</td><td><input type='checkbox' name='id_jamaah[]' value='$key->id_jamaah'> $key->nama</td></tr>";
		}
	?>
</table>


<div style="clear:both"></div><br>

<hr>
<div class="col-sm-12">
	<div class="col-sm-6">
		<input type="submit" value="Simpan" class="btn btn-primary" id="simpan">
	</div>
	<div class="col-sm-6">
		<input type="button" value="Batal" class="btn btn-warning" id="batal">
	</div>
</div>
</form>	

<script type="text/javascript">
	
$("#batal").on("click",function(){
	var id= "<?php echo $id_paket?>";
	table_jamaah(id);
})
function table_jamaah(id)
{
  $.get("<?php echo base_url()?>index.php/"+classnya+"/table_jamaah/"+id,function(ev){
      
      $("#bodyModal").html(ev);
      
  })
}

$("#simpan_relasi").on("submit",function(){
	$.post("<?php echo base_url()?>index.php/"+classnya+"/go_simpan_relasi",$(this).serialize(),function(x){
		console.log(x);
		var id= "<?php echo $id_paket?>";
		table_jamaah(id);
	})

	return false;
})
</script>