<script language="javascript" src="include/cal3.js"></script>
<script language="javascript" src="include/cal_conf3.js"></script>

<script src="js/input/fancyInput.js" type="text/javascript" language="javascript"></script> 
<script src="js/jquery-scanner/jquery.scannerdetection.js" type="text/javascript" language="javascript"></script> 
<link href='js/input/fancyInput.css' rel="stylesheet" type="text/css">
<link href='js/input/styles.css' rel="stylesheet" type="text/css">

<script type="text/javascript">
function startjam(){
	var d = new Date();
	var curr_hour = d.getHours();
	var curr_min = d.getMinutes();
	var curr_sec = d.getSeconds();
	document.getElementById('start_daftar').value=(curr_hour + ":" + curr_min+ ":" + curr_sec);
}

jQuery(document).scannerDetection({
	onComplete: function(code){
		if(code.length == 6) {

			jQuery("#bpjs_nomr").val(code);
			var strs = code;
			var ress = strs.split(""); 
			var teks="";
			jQuery.each(ress, function() {
				 teks=teks+"<span>"+this+"</span>";
			});
			jQuery(".fancyInput [data-placeholder='Masukkan NO RM ...']").removeClass("empty");
			jQuery(".fancyInput [data-placeholder='Masukkan NO RM ...']").html(teks + "<b class=\"caret\">​</b>");

			jQuery("#bpjs_nomr").trigger('blur');

			// jQuery('#nomor_rm').focus();
			// jQuery('#nomor_rm').val(code);
			console.log(code);
		}
	}
});

// JavaScript Document
jQuery(document).ready(function(){
	// 	jQuery('#tr_nomr').hide();
	
	jQuery('.keren').fancyInput();
	
	
	jQuery('.loader').hide();
	<?php if($_REQUEST['xNOMR'] == ''): ?> 
	jQuery('#NOMR').attr('disabled','disabled').val('-automatic-');
	<? endif; ?>
	
	jQuery('.statuspasien').change(function(){
		var status_val	= jQuery(this).val();
		if(status_val == 1){
			jQuery('#NOMR').attr('disabled','disabled').val('-automatic-');
			jQuery('#PASIENBARU').val(1);
			jQuery('#NAMA').val('');
			jQuery('#TEMPAT').val('');
			jQuery('#TGLLAHIR').val('');
			//jQuery('#umur').val(newdata[5]);
			jQuery('#ALAMAT').val('');
			jQuery('#ALAMAT_KTP').val('');
			jQuery('#KELURAHAN').val('');
			jQuery('#KECAMATAN').val('');
			jQuery('#KOTA').val('');
			jQuery('#KDPROVINSI').val('');
			jQuery('#notelp').val('');
			jQuery('#NOKTP').val('');
			jQuery('#SUAMI_ORTU').val('');
			jQuery('#PEKERJAAN').val('');
			//jQuery('#nama_penanggungjawab').val(newdata[14]);
			//jQuery('#hubungan_penanggungjawab').val(newdata[15]);
			//jQuery('#alamat_penanggungjawab').val(newdata[16]);
			//jQuery('#phone_penanggungjawab').val(newdata[17]);
			jQuery('#JENISKELAMIN_'+newdata[5]).removeAttr('checked');
			jQuery('#status_'+newdata[15]).removeAttr('checked');
			jQuery('#PENDIDIKAN_'+newdata[17]).removeAttr('checked');
			jQuery('#AGAMA_'+newdata[16]).removeAttr('checked');
			jQuery('#carabayar_'+newdata[18]).removeAttr('checked');
			jQuery('.loader').hide();
		}else{
			jQuery('#NOMR').removeAttr('disabled').val('');
			jQuery('#PASIENBARU').val(0);
		}
	});
	
	jQuery('#TGLLAHIR').blur(function(){
		var tgl = jQuery(this).val();						  
		if(tgl == ('0000/00/00') || tgl == ('0000-00-00') || tgl == ('00-00-0000') || tgl == ('00/00/0000')  ){
			alert('Tanggal Lahir Tidak Boleh 00-00-0000');
			jQuery(this).val('');
		}
	});
	
	jQuery('#NOMR').blur(function(){
		var nomr	= jQuery(this).val();
		if(nomr != ''){
			jQuery('.loader').show();
			jQuery.get('<?php echo _BASE_; ?>include/process.php?psn='+nomr,function(data){
				newdata	= data.split("|");
				//jQuery('#STATUSPASIEN_'+newdata[0]).attr('checked','checked');
				if(newdata[0] == 1){
					//jQuery('#NOMR').attr('disabled','disabled');
				}
				jQuery('#NAMA').val(newdata[2]);
				jQuery('#TEMPAT').val(newdata[3]);
				var tahun = newdata[4].substr(0,4);
				var bulan = newdata[4].substr(5,2);
				var hari = newdata[4].substr(8,2);
				jQuery('#dp1').val(hari+"/"+bulan+"/"+tahun);
				//jQuery('#umur').val(newdata[5]);
				jQuery('#ALAMAT').val(newdata[6]);
				jQuery('#ALAMAT_KTP').val(newdata[19]);
				jQuery('#KELURAHAN').val(newdata[7]);
				jQuery('#KECAMATAN').val(newdata[8]);
				jQuery('#KELURAHANHIDDEN').val(newdata[7]);
				jQuery('#KECAMATANHIDDEN').val(newdata[8]);
				jQuery('#KOTAHIDDEN').val(newdata[9]);
				jQuery('#KDPROVINSI').val(newdata[10]).change();
				jQuery('#KOTA').val(newdata[9]).change();
				jQuery('#notelp').val(newdata[11]);
				jQuery('#NOKTP').val(newdata[12]);
				jQuery('#SUAMI_ORTU').val(newdata[13]);
				jQuery('#PEKERJAAN').val(newdata[14]);
				jQuery('#umur').val(newdata[20]);
				//jQuery('#CALLER option[value='+newdata[21]+']').attr('selected', 'selected');
				//jQuery('#CALLER').val(newdata[21]);
				jQuery('#CALLER option[value="' +newdata[21]+ '"]').prop('selected', true);

				jQuery('#nama_penanggungjawab').val(newdata[22]);
				jQuery('#hubungan_penanggungjawab').val(newdata[23]);
				jQuery('#alamat_penanggungjawab').val(newdata[24]);
				jQuery('#phone_penanggungjawab').val(newdata[25]);
				
				jQuery('#JENISKELAMIN_'+newdata[5]).attr('checked','checked');
				jQuery('#status_'+newdata[15]).attr('checked','checked');
				jQuery('#PENDIDIKAN_'+newdata[17]).attr('checked','checked');
				jQuery('#AGAMA_'+newdata[16]).attr('checked','checked');
				jQuery('#carabayar_'+newdata[18]).attr('checked','checked');
				
				if(newdata[18]==10){
					
					jQuery('#kartu1').show().addClass('required');
					jQuery('#trno').attr("style","display:;");
					jQuery('#NOKARTU').show().addClass('required');
					jQuery('#nosep').attr("style","display:;");
					
					
					
					if(newdata[26] == ''){
						jQuery('#kartu1').val("000");
					}else{
						jQuery('#kartu1').val(newdata[26]);
					}
					
					if(newdata[27] == ''){
						jQuery('#NOKARTU').val("1133R001");
					}else{
						jQuery('#NOKARTU').val(newdata[27]);
					}
					
				}else if(newdata[18]==20){
					
					jQuery('#kartu1').show().addClass('required');
					jQuery('#trno').attr("style","display:;");
					jQuery('#NOKARTU').show().addClass('required');
					jQuery('#nosep').attr("style","display:;");
					
					if(newdata[26] == ''){
						jQuery('#kartu1').val("000");
					}else{
						jQuery('#kartu1').val(newdata[26]);
					}
					
					if(newdata[27] == ''){
						jQuery('#NOKARTU').val("1133R001");
					}else{
						jQuery('#NOKARTU').val(newdata[27]);
					}
					
					jQuery('#nokelas').show().addClass('required');
					jQuery('#kelas').attr("style","display:;");
					
				}else if(newdata[18]==1){
					
					jQuery('#kartu1').hide().removeClass('required');
					jQuery('#trno').attr("style","display:none;");
					jQuery('#NOKARTU').hide().removeClass('required');
					jQuery('#nosep').attr("style","display:none;");
					
					jQuery('#nokelas').hide().removeClass('required');
					jQuery('#kelas').attr("style","display:none;");
					
				}else{
					jQuery('#kartu1').show().addClass('required');
					jQuery('#trno').attr("style","display:;");
					jQuery('#NOKARTU').hide().removeClass('required');
					jQuery('#nosep').attr("style","display:none;");
					jQuery('#kartu1').val(newdata[26]);
					jQuery('#nokelas').hide().removeClass('required');
					jQuery('#kelas').attr("style","display:none;");
				}
				jQuery('.loader').hide();
			});
		}
	});
	
	jQuery('#bpjs_nomr').blur(function(){
		var nomr	= jQuery(this).val();
		if(nomr != ''){
			jQuery('.loader').show();
			
			
			jQuery.get('<?php echo _BASE_; ?>include/process.php?psn='+nomr,function(data){
				newdata	= data.split("|");
				//jQuery('#STATUSPASIEN_'+newdata[0]).attr('checked','checked');
				if(newdata[0] == 1){
					//jQuery('#NOMR').attr('disabled','disabled');
				}
				jQuery('#NAMA').val(newdata[2]);
				jQuery('#TEMPAT').val(newdata[3]);
				var tahun = newdata[4].substr(0,4);
				var bulan = newdata[4].substr(5,2);
				var hari = newdata[4].substr(8,2);
				jQuery('#dp1').val(hari+"/"+bulan+"/"+tahun);
				//jQuery('#umur').val(newdata[5]);
				jQuery('#ALAMAT').val(newdata[6]);
				jQuery('#ALAMAT_KTP').val(newdata[19]);
				jQuery('#KELURAHAN').val(newdata[7]);
				jQuery('#KECAMATAN').val(newdata[8]);
				jQuery('#KELURAHANHIDDEN').val(newdata[7]);
				jQuery('#KECAMATANHIDDEN').val(newdata[8]);
				jQuery('#KOTAHIDDEN').val(newdata[9]);
				jQuery('#KDPROVINSI').val(newdata[10]).change();
				jQuery('#KOTA').val(newdata[9]).change();
				jQuery('#notelp').val(newdata[11]);
				jQuery('#NOKTP').val(newdata[12]);
				jQuery('#SUAMI_ORTU').val(newdata[13]);
				jQuery('#PEKERJAAN').val(newdata[14]);
				jQuery('#umur').val(newdata[20]);
				//jQuery('#CALLER option[value='+newdata[21]+']').attr('selected', 'selected');
				//jQuery('#CALLER').val(newdata[21]);
				jQuery('#CALLER option[value="' +newdata[21]+ '"]').prop('selected', true);

				jQuery('#nama_penanggungjawab').val(newdata[22]);
				jQuery('#hubungan_penanggungjawab').val(newdata[23]);
				jQuery('#alamat_penanggungjawab').val(newdata[24]);
				jQuery('#phone_penanggungjawab').val(newdata[25]);
				
				jQuery('#JENISKELAMIN_'+newdata[5]).attr('checked','checked');
				jQuery('#status_'+newdata[15]).attr('checked','checked');
				jQuery('#PENDIDIKAN_'+newdata[17]).attr('checked','checked');
				jQuery('#AGAMA_'+newdata[16]).attr('checked','checked');
				jQuery('#carabayar_'+newdata[18]).attr('checked','checked');
				
				if(newdata[18]==10){
					
					jQuery('#kartu1').show().addClass('required');
					jQuery('#trno').attr("style","display:;");
					jQuery('#NOKARTU').show().addClass('required');
					jQuery('#nosep').attr("style","display:;");
					
					
					
					if(newdata[26] == ''){
						jQuery('#kartu1').val("000");
					}else{
						jQuery('#kartu1').val(newdata[26]);
					}
					
					if(newdata[27] == ''){
						jQuery('#NOKARTU').val("1133R001");
					}else{
						jQuery('#NOKARTU').val(newdata[27]);
					}
					
				}else if(newdata[18]==20){
					
					jQuery('#kartu1').show().addClass('required');
					jQuery('#trno').attr("style","display:;");
					jQuery('#NOKARTU').show().addClass('required');
					jQuery('#nosep').attr("style","display:;");
					
					if(newdata[26] == ''){
						jQuery('#kartu1').val("000");
					}else{
						jQuery('#kartu1').val(newdata[26]);
					}
					
					if(newdata[27] == ''){
						jQuery('#NOKARTU').val("1133R001");
					}else{
						jQuery('#NOKARTU').val(newdata[27]);
					}
					
					jQuery('#nokelas').show().addClass('required');
					jQuery('#kelas').attr("style","display:;");
					
				}else if(newdata[18]==1){
					
					jQuery('#kartu1').hide().removeClass('required');
					jQuery('#trno').attr("style","display:none;");
					jQuery('#NOKARTU').hide().removeClass('required');
					jQuery('#nosep').attr("style","display:none;");
					
					jQuery('#nokelas').hide().removeClass('required');
					jQuery('#kelas').attr("style","display:none;");
					
				}else{
					jQuery('#kartu1').show().addClass('required');
					jQuery('#trno').attr("style","display:;");
					jQuery('#NOKARTU').hide().removeClass('required');
					jQuery('#nosep').attr("style","display:none;");
					jQuery('#kartu1').val(newdata[26]);
					jQuery('#nokelas').hide().removeClass('required');
					jQuery('#kelas').attr("style","display:none;");
				}
				
			});
		}
			
			
			//untuk riwayat
				
				
			var kartu=jQuery('#bpjs_noKartu').val();
			if(kartu != ''){
				jQuery('#kartu1').show().addClass('required');
				jQuery('#trno').attr("style","display:;");
				jQuery('#NOKARTU').show().addClass('required');
				jQuery('#nosep').attr("style","display:;");
				
				jQuery('#kartu1').val("000");
				jQuery('#NOKARTU').val("1133R001");
				
				var url2=  "<?php echo _BASE_ ;?>bpjs/riwayat.php";
			
			
					jQuery.ajax({
						url: url2 + "?q=" + kartu,
						dataType: 'json',
						success:  function (data) {
							console.log(data);
							
							if(data.metadata.code=='404' || data["response"]["count"] == '0'){
								// alert("Data Tidak Tersedia");
								jQuery("#info_riwayat").html("Tidak ada riwayat pelayanan.");
								jQuery("#info_riwayat").attr("style","color:white;");
								jQuery("#detail_riwayat").attr("style","display:none;height:0;");
								var isis=jQuery("#detail_riwayat").html();
								var gos="<table id=\"detail_riwayat\" width=\"100%\" border=\"1\" style=\"color:#000;\">" + isis + "</table>";;
								jQuery("#rujukan_pojok").html(gos);
								jQuery('.loadingcool').hide();
							}else if(data["response"]["count"] == '1'){
								var detail= data.response.list["0"];
								console.log(detail);
								var tbl_body = "";
								var tr=1;
								var url3=  "<?php echo _BASE_ ;?>bpjs/datasep.php";
								url3 = 'proxy.php?url='+url3;
								var tbl_row = "";
								var tbl_body = "";
								jQuery.ajax({
									async: false,
									url: url3 + "?q=" +detail.noSEP,
									dataType: 'json',
									success:  function (datasep) {
										console.log(datasep);
										tbl_row += "<td>"+datasep.response.jnsPelayanan+"</td>";
										tbl_row += "<td>"+datasep.response.noSep+"</td>";
										tbl_row += "<td>"+datasep.response.diagAwal.kdDiag+"</td>";
										tbl_row += "<td>"+datasep.response.poliTujuan.kdPoli+"</td>";
										tbl_row += "<td>"+datasep.response.tglPulang+"</td>";
										tbl_row += "<td>"+datasep.response.tglSep+"</td>";
										
									}
								});
								tbl_body = "<tr class='tr-1'>"+tbl_row+"</tr>";
								jQuery("#detail_riwayat tbody").html(tbl_body);
								var isis=jQuery("#detail_riwayat").html();
								var gos="<table id=\"detail_riwayat\" width=\"100%\" border=\"1\" style=\"color:#000;\">" + isis + "</table>";;
								jQuery("#rujukan_pojok").html(gos);
								jQuery("#info_riwayat").attr("style","display:none;height:0;");
								jQuery("#scroll_riwayat").attr("style","");
								jQuery("#detail_riwayat").attr("style","");
								// jQuery("#detail_riwayat").attr("border","1");
								jQuery('.loadingcool').hide();
							}else{
								var detail= data.response.list;
								var tbl_body = "";
								var tr=1;
								jQuery.each(detail, function() {
									var tbl_row = "";
									var no=1;
									jQuery.each(this, function(k , v) {
										console.log("iki " +k);
										
										if(v == "[object Object]" ){
											if(v.nmPoli == "[object Object]" ){
												tbl_row += "<td>Unknown Poly</td>";
											}else{
												tbl_row += "<td>"+v.nmPoli+"</td>";
											}
											
										}else{
											tbl_row += "<td>"+v+"</td>";
										}
										//console.log(v);
										
										if(k== 'noSEP'){
											var url3=  "<?php echo _BASE_ ;?>bpjs/datasep.php";
											url3 = 'proxy.php?url='+url3;
											jQuery.ajax({
												async: false,
												url: url3 + "?q=" + v,
												dataType: 'json',
												success:  function (datasep) {
													//console.log(datasep);
													tbl_row += "<td>"+datasep.response.diagAwal.kdDiag+"</td>";
													
												}
											});
										}
										
										no++;
									})
									tbl_body += "<tr class='tr-"+tr+"'>"+tbl_row+"</tr>";    
									tr++;
								});
								jQuery("#detail_riwayat tbody").html(tbl_body);
								jQuery("#detail_riwayat thead").html("<tr><th colspan='8'>Detail Riwayat Pasien</tr>");
								var isis=jQuery("#detail_riwayat").html();
								var gos="<table id=\"detail_riwayat\" width=\"100%\" border=\"1\" style=\"color:#000;\"><tr><th colspan='8'>Detail Riwayat Pasien</tr>" + tbl_body + "</table>";;
								jQuery("#rujukan_pojok").html(gos);
								jQuery("#info_riwayat").attr("style","display:none;height:0;");
								jQuery("#scroll_riwayat").attr("style","");
								jQuery("#detail_riwayat").attr("style","");
								// jQuery("#detail_riwayat").attr("border","1");
								jQuery('.loadingcool').hide();
							}
						}
					});
					jQuery('.loader').hide();
			}
			
			
		
	});
	
	jQuery('#NOKTP').blur(function(){
		var nomr	= jQuery(this).val();
		var kdpoly= jQuery("#kdpoly").val();
		var nama= jQuery("#NAMA").val();
		if(  nama == "" ){
			jQuery('.loader').show();
			jQuery.get('<?php echo _BASE_; ?>include/process.php?nik='+nomr,function(data){
				newdata	= data.split("|");
				//jQuery('#STATUSPASIEN_'+newdata[0]).attr('checked','checked');
				if(newdata[0] == 1){
					//jQuery('#NOMR').attr('disabled','disabled');
				}
				jQuery("#NOMR").removeAttr('disabled');
				jQuery('#NOMR').val(newdata[1]);
				jQuery('#NAMA').val(newdata[2]);
				jQuery('#TEMPAT').val(newdata[3]);
				var tahun = newdata[4].substr(0,4);
				var bulan = newdata[4].substr(5,2);
				var hari = newdata[4].substr(8,2);
				jQuery('#dp1').val(hari+"/"+bulan+"/"+tahun);
				//jQuery('#umur').val(newdata[5]);
				jQuery('#ALAMAT').val(newdata[6]);
				jQuery('#ALAMAT_KTP').val(newdata[19]);
				jQuery('#KELURAHAN').val(newdata[7]);
				jQuery('#KECAMATAN').val(newdata[8]);
				jQuery('#KELURAHANHIDDEN').val(newdata[7]);
				jQuery('#KECAMATANHIDDEN').val(newdata[8]);
				jQuery('#KOTAHIDDEN').val(newdata[9]);
				jQuery('#KDPROVINSI').val(newdata[10]).change();
				jQuery('#KOTA').val(newdata[9]).change();
				jQuery('#notelp').val(newdata[11]);
				jQuery('#NOKTP').val(newdata[12]);
				jQuery('#SUAMI_ORTU').val(newdata[13]);
				jQuery('#PEKERJAAN').val(newdata[14]);
				jQuery('#umur').val(newdata[20]);
				jQuery('#CALLER option[value='+newdata[21]+']').attr('selected', 'selected');

				jQuery('#nama_penanggungjawab').val(newdata[22]);
				jQuery('#hubungan_penanggungjawab').val(newdata[23]);
				jQuery('#alamat_penanggungjawab').val(newdata[24]);
				jQuery('#phone_penanggungjawab').val(newdata[25]);
				jQuery('#JENISKELAMIN_'+newdata[5]).attr('checked','checked');
				jQuery('#status_'+newdata[15]).attr('checked','checked');
				jQuery('#PENDIDIKAN_'+newdata[17]).attr('checked','checked');
				jQuery('#AGAMA_'+newdata[16]).attr('checked','checked');
				jQuery('#carabayar_'+newdata[18]).attr('checked','checked');
				
				if(newdata[18]==10){
					
					jQuery('#kartu1').show().addClass('required');
					jQuery('#trno').attr("style","display:;");
					jQuery('#NOKARTU').show().addClass('required');
					jQuery('#nosep').attr("style","display:;");
					if(newdata[26] == ''){
						jQuery('#kartu1').val("000");
					}else{
						jQuery('#kartu1').val(newdata[26]);
					}
					
					if(newdata[27] == ''){
						jQuery('#NOKARTU').val("1133R001");
					}else{
						jQuery('#NOKARTU').val(newdata[27]);
					}
					
					
				}else if(newdata[18]==20){
					
					jQuery('#kartu1').show().addClass('required');
					jQuery('#trno').attr("style","display:;");
					jQuery('#NOKARTU').show().addClass('required');
					jQuery('#nosep').attr("style","display:;");
					if(newdata[26] == ''){
						jQuery('#kartu1').val("000");
					}else{
						jQuery('#kartu1').val(newdata[26]);
					}
					
					if(newdata[27] == ''){
						jQuery('#NOKARTU').val("1133R001");
					}else{
						jQuery('#NOKARTU').val(newdata[27]);
					}
					
					jQuery('#nokelas').show().addClass('required');
					jQuery('#kelas').attr("style","display:;");
					
				}else if(newdata[18]==1){
					
					jQuery('#kartu1').hide().removeClass('required');
					jQuery('#trno').attr("style","display:none;");
					jQuery('#NOKARTU').hide().removeClass('required');
					jQuery('#nosep').attr("style","display:none;");
					
					jQuery('#nokelas').hide().removeClass('required');
					jQuery('#kelas').attr("style","display:none;");
					
				}else{
					jQuery('#kartu1').show().addClass('required');
					jQuery('#trno').attr("style","display:;");
					jQuery('#NOKARTU').hide().removeClass('required');
					jQuery('#nosep').attr("style","display:none;");
					jQuery('#kartu1').val(newdata[26]);
					jQuery('#nokelas').hide().removeClass('required');
					jQuery('#kelas').attr("style","display:none;");
				}
				
				jQuery('.loader').hide();
			});
		}
	});
	
	jQuery('#NOKARTU').blur(function(){
		var nomr	= jQuery("#NOMR").val();
		var kartu	= jQuery(this).val();
		jQuery.post('<?php echo _BASE_;?>include/uploadkartu.php',{nomr:nomr,kartu:kartu,apa:"sep"},function(data){
			
		});
	});
	
	jQuery('#kartu1').blur(function(){
		var nomr	= jQuery("#NOMR").val();
		var kartu	= jQuery(this).val();
		jQuery.post('<?php echo _BASE_;?>include/uploadkartu.php',{nomr:nomr,kartu:kartu,apa:"no"},function(data){
			
		});
	});
	
	
	//jQuery('#carabayar_lain').hide();
	//jQuery('#kdrujuk_lain').hide();
	
	jQuery('.carabayar').click(function(){
		var val = jQuery(this).val();
		if(val == 5){
			jQuery('#carabayar_lain').show().addClass('required');
			jQuery('#kartu1').show().addClass('required');
			jQuery('#NOKARTU').hide().removeClass('required');
			jQuery('#nosep').attr("style","display:none;");
			
			jQuery('#nokelas').hide().removeClass('required');
			jQuery('#kelas').attr("style","display:none;");
		}else if(val == 1){
			jQuery('#kartu1').hide().removeClass('required');
			jQuery('#trno').attr("style","display:none;");
			jQuery('#NOKARTU').hide().removeClass('required');
			jQuery('#nosep').attr("style","display:none;");
			jQuery('#carabayar_lain').hide().removeClass('required');
			
			jQuery('#nokelas').hide().removeClass('required');
			jQuery('#kelas').attr("style","display:none;");
		}else if(val == 10 ){
			jQuery('#carabayar_lain').hide().removeClass('required');
			jQuery('#kartu1').show().addClass('required');
			jQuery('#trno').attr("style","display:;");
			jQuery('#NOKARTU').show().addClass('required');
			jQuery('#nosep').attr("style","display:;");
			
			jQuery('#nokelas').hide().removeClass('required');
			jQuery('#kelas').attr("style","display:none;");
		}else if(val==20){
			jQuery('#carabayar_lain').hide().removeClass('required');
			jQuery('#kartu1').show().addClass('required');
			jQuery('#trno').attr("style","display:;");
			jQuery('#NOKARTU').show().addClass('required');
			jQuery('#nosep').attr("style","display:;");
			
			jQuery('#nokelas').show().addClass('required');
			jQuery('#kelas').attr("style","display:;");
		}else{
			jQuery('#carabayar_lain').hide().removeClass('required');
			jQuery('#kartu1').show().addClass('required');
			jQuery('#trno').attr("style","display:;");
			jQuery('#NOKARTU').hide().removeClass('required');
			jQuery('#nosep').attr("style","display:none;");
			
			jQuery('#nokelas').hide().removeClass('required');
			jQuery('#kelas').attr("style","display:none;");
		}
		
		
		

		
		
	});
	
	jQuery('.kdrujuk').click(function(){
		var val = jQuery(this).val();
		if(val != '1' && val != '5' && val != '2'){
			jQuery('#kdrujuk_lain').show().addClass('required');
		}
		
		else{
			jQuery('#kdrujuk_lain').hide().removeClass('required');
		}
	});
	
	<?php 
		$noKartu=!empty($_GET['noKartu']) ? mysql_real_escape_string($_GET['noKartu']) : "";
		$nos=!empty($_GET['noKartu']) ? mysql_real_escape_string($_GET['noKartu']) : "Masukkan Nomor Kartu... ✌";
		$nomr=!empty($_GET['nomr']) ? mysql_real_escape_string($_GET['nomr']) : "";
	?>
	jQuery('#bpjs_kartu').blur(function(){
		alert("OK");
		var url=  "<?php echo _BASE_ ;?>bpjs/darikartu.php";
		var url2=  "<?php echo _BASE_ ;?>bpjs/riwayat.php";
		url = 'proxy.php?url='+url;
		url2 = 'proxy.php?url='+url2;
		var kartu	= jQuery(this).val();
		if(kartu != ''){
			jQuery('.loader').show();
			jQuery('.loadingcool').show();
			
			jQuery.get('<?php echo _BASE_; ?>bpjs/carinomor.php?kartu='+kartu,function(data){
				jQuery("#bpjs_nomr").val(data);
				jQuery("#bpjs_nomr").attr("placeholder",data);
				jQuery("#bpjs_nomr").attr("style","color:#fff;");
				<?php
					if($nomr!=''){
						?>
						jQuery("#bpjs_nomr").val("<?php echo $nomr;?>");
						var strs = "<?php echo $nomr;?>";
						var ress = strs.split(""); 
						var teks="";
						jQuery.each(ress, function() {
							 teks=teks+"<span>"+this+"</span>";
						});
						jQuery(".fancyInput [data-placeholder='Masukkan NO RM ...']").removeClass("empty");
						jQuery(".fancyInput [data-placeholder='Masukkan NO RM ...']").html(teks + "<b class=\"caret\">​</b>");
						<?php
					}
				?>
				
			});
			
			jQuery.ajax({
				url: url + "?q=" + kartu,
				dataType: 'json',
				success:  function (data) {
					console.log(data);
					var detail= data.response.peserta;
					var message=data.metaData.message;
					if(data.metaData.code == '200'){
						jQuery("#detail_nama").html(detail.nama);
						
						jQuery("#detail_nik").html(detail.nik);
						jQuery("#detail_kartu").html(detail.noKartu);
						jQuery("#detail_sex").html(detail.sex);
						jQuery("#detail_lahir").html(detail.tglLahir);
						jQuery("#detail_kelas").html(detail.hakKelas.keterangan);
						jQuery("#detail_jenis").html(detail.jenisPeserta.keterangan);
						// jQuery("#detail_pelayanan").html(detail.tglPelayanan);
						// jQuery("#detail_tiket").html(detail.tktPelayanan);
						
						jQuery(".bpjs_noKartu").val(detail.noKartu);
						
						jQuery("#bpjs_kelas").val(detail.hakKelas.kode);
						jQuery("#detail_all").attr("style","display:block;height:auto;");
						jQuery('.loadingcool').hide();
						
						
					}else{
						alert(message);
						jQuery("#detail_all").attr("style","display:none;height:0;");
						jQuery('.loadingcool').hide();
						baleknos();
					}
				}
			});
			
			
			
			// 
			rubah();
		}else{
			if(jQuery("#bpjs_nik").val() == ''){
				jQuery(".bpjs_noKartu").val("");
				jQuery("#detail_all").attr("style","display:none;");
			}
			
			
		}
	});
	
	
	jQuery('#bpjs_kartu').focus(function(){
		if(jQuery(this).val() == 'Masukkan Nomor Kartu... ✌'){
			jQuery(this).val("");
			jQuery(".fancyInput [data-placeholder='Masukkan Nomor Kartu ...']").addClass("empty");
			jQuery(".fancyInput [data-placeholder='Masukkan Nomor Kartu ...']").html("<b class=\"caret\">​</b>");
			// jQuery(this).focus();
		}
	});
	jQuery('#bpjs_nik').focus(function(){
		if(jQuery("#bpjs_kartu").val() == 'Masukkan Nomor Kartu... ✌'){
			jQuery("#bpjs_kartu").val("");
			jQuery(".fancyInput [data-placeholder='Masukkan Nomor Kartu ...']").addClass("empty");
			jQuery(".fancyInput [data-placeholder='Masukkan Nomor Kartu ...']").html("<b class=\"caret\">​</b>");
			// jQuery(this).focus();
		}
	});
	jQuery('#bpjs_nomr').focus(function(){
		if(jQuery("#bpjs_kartu").val() == 'Masukkan Nomor Kartu... ✌'){
			jQuery("#bpjs_kartu").val("");
			jQuery(".fancyInput [data-placeholder='Masukkan Nomor Kartu ...']").addClass("empty");
			jQuery(".fancyInput [data-placeholder='Masukkan Nomor Kartu ...']").html("<b class=\"caret\">​</b>");
			// jQuery(this).focus();
			;
		}else{
			
			if(jQuery(this).val().length == 6){
				
				
				jQuery(this).off('keyup');
			}
			
		}
	});
	
	jQuery(document).bind('afterClose.facebox', balekno);
	
	function rubah(){
		jQuery("#kiwo").attr("style","width:70%;float:left;");
		jQuery("#tengen").attr("style","width:30%;float:right;");
		jQuery("#kiwo input").attr("style","width:70%");
		
	}
	function balekno(){
			var noKartu=jQuery("#bpjs_noKartu").val();
			var nomr=jQuery("#bpjs_nomr").val();
			
			location.href='index.php?link=2&noKartu='+noKartu+'&nomr='+nomr;
		
	}
	function baleknos(){
		
			jQuery("#kiwo").attr("style","width:100%");
			jQuery("#tengen").attr("style","");
			jQuery(document).trigger('close.facebox');
	}
	
	function init(str){
			var input = jQuery('section input').val('')[0],
				s = '<?php echo $nos;?>'.split('').reverse(),
				len = s.length-1,
				e = jQuery.Event('keypress');
				
				input.nextElementSibling.className = '';
			
			var	initInterval = setInterval(function(){
					if( s.length ){
						var c = s.pop();
						fancyInput.writer(c, input, len-s.length).setCaret(input);
						input.value += c;
						//e.charCode = c.charCodeAt(0);
						//input.trigger(e);
						
					}
					else clearInterval(initInterval);
			},20);
		}
		
	init();
	<?php
		if($noKartu!=''){
			?>
			jQuery('#bpjs_kartu').focus();
			<?php
		}
		if($nomr!=''){
			?>
			// jQuery( "body" ).off( "keyup#bpjs_nomr" );
			// jQuery("#bpjs_nomr").length(0);
			var strs = "<?php echo $nomr;?>";
			var ress = strs.split(""); 
			var teks="";
			jQuery.each(ress, function() {
				 teks=teks+"<span>"+this+"</span>";
			});
			jQuery("#bpjs_nomr").val("<?php echo $nomr;?>");
			jQuery(".fancyInput [data-placeholder='Masukkan NO RM ...']").removeClass("empty");
			jQuery(".fancyInput [data-placeholder='Masukkan NO RM ...']").html(teks + "<b class=\"caret\">​</b>");
			<?php
		}
	?>
	
	jQuery('#bpjs_nik').blur(function(){
		var url=  "<?php echo _BASE_ ;?>bpjs/darinik.php";
		var url2=  "<?php echo _BASE_ ;?>bpjs/riwayat.php";
		url = 'proxy.php?url='+url;
		url2 = 'proxy.php?url='+url2;
		var kartu	= jQuery(this).val();
		var sebenarnya="";
		if(kartu != ''){
			jQuery('.loader').show();
			jQuery('.loadingcool').show();
			
			jQuery.get('<?php echo _BASE_; ?>bpjs/carinomor.php?nik='+kartu,function(data){
				jQuery("#bpjs_nomr").val(data);
				jQuery("#bpjs_nomr").attr("placeholder",data);
				jQuery("#bpjs_nomr").attr("style","color:#fff;");
				<?php
					if($nomr!=''){
						?>
						jQuery("#bpjs_nomr").val("<?php echo $nomr;?>");
						var strs = "<?php echo $nomr;?>";
						var ress = strs.split(""); 
						var teks="";
						jQuery.each(ress, function() {
							 teks=teks+"<span>"+this+"</span>";
						});
						jQuery(".fancyInput [data-placeholder='Masukkan NO RM ...']").removeClass("empty");
						jQuery(".fancyInput [data-placeholder='Masukkan NO RM ...']").html(teks + "<b class=\"caret\">​</b>");
						<?php
					}
				?>
			});
			
			jQuery.ajax({
				url: url + "?q=" + kartu,
				dataType: 'json',
				success:  function (data) {
					console.log(data);
					var detail= data.response.peserta;
					if(data.metaData.code=='404'){
						alert("Data Tidak Tersedia");
						jQuery("#detail_all").attr("style","display:none;height:0;");
						jQuery('.loadingcool').hide();
						baleknos();
					}else{
						jQuery("#detail_nama").html(detail.nama);
						jQuery("#detail_nik").html(detail.nik);
						jQuery("#detail_kartu").html(detail.noKartu);
						jQuery("#detail_sex").html(detail.sex);
						jQuery("#detail_lahir").html(detail.tglLahir);
						jQuery("#detail_kelas").html(detail.hakKelas.keterangan);
						jQuery("#detail_jenis").html(detail.jenisPeserta.keterangan);
						// jQuery("#detail_pelayanan").html(detail.tglPelayanan);
						// jQuery("#detail_tiket").html(detail.tktPelayanan);
						
						jQuery(".bpjs_noKartu").val(detail.noKartu);
						
						jQuery("#bpjs_kelas").val(detail.hakKelas.kode);
						jQuery("#detail_all").attr("style","display:block;height:auto;");
						sebenarnya=detail.noKartu;
						// selanjutnya
						
						//untuk riwayat
						jQuery.ajax({
							url: url2 + "?q=" + sebenarnya,
							dataType: 'json',
							success:  function (data) {
								console.log(data);
								
								if(data.metadata.code=='404' || data["response"]["@attributes"]["count"] == '0'){
									// alert("Data Tidak Tersedia");
									jQuery("#info_riwayat").html("Tidak ada riwayat pelayanan.");
									jQuery("#info_riwayat").attr("style","color:white;");
									jQuery("#detail_riwayat").attr("style","display:none;height:0;");
									jQuery('.loadingcool').hide();
								}else{
									var detail= data.response.list.sep;
									var tbl_body = "";
									var tr=1;
									jQuery.each(detail, function() {
										var tbl_row = "";
										var no=1;
										jQuery.each(this, function(k , v) {
											console.log(v);
											
											if(v == "[object Object]" ){
												if(v.nmPoli == "[object Object]" ){
													tbl_row += "<td>Unknown Poly</td>";
												}else{
													tbl_row += "<td>"+v.nmPoli+"</td>";
												}
												
											}else{
												tbl_row += "<td>"+v+"</td>";
											}
											
											if(no==2){
												var url3=  "<?php echo _BASE_ ;?>bpjs/datasep.php";
												url3 = 'proxy.php?url='+url3;
												jQuery.ajax({
													async: false,
													url: url3 + "?q=" + v,
													dataType: 'json',
													success:  function (datasep) {
														console.log(datasep);
														tbl_row += "<td>"+datasep.response.sep.diagAwal.kdDiag+"</td>";
														
													}
												});
											}
											
											no++;
										})
										tbl_body += "<tr class='tr-"+tr+"'>"+tbl_row+"</tr>";    
										tr++;
									});
									jQuery("#detail_riwayat tbody").html(tbl_body);
									jQuery("#info_riwayat").attr("style","display:none;height:0;");
									jQuery("#scroll_riwayat").attr("style","");
									jQuery("#detail_riwayat").attr("style","");
									// jQuery("#detail_riwayat").attr("border","1");
									jQuery('.loadingcool').hide();
								}
							}
						});
					}
				}
			});
			
			
			
			rubah();
		}else{
			if(jQuery("#bpjs_kartu").val() == ''){
				jQuery(".bpjs_noKartu").val("");
				jQuery("#detail_all").attr("style","display:none;");
			}
			
		}
	});

	jQuery('#bpjs_nomr').blur(function(){
		var nomr	= jQuery(this).val();
		if(nomr != ''){
			jQuery('.loader').show();
			jQuery('.loadingcool').show();
			
			jQuery("#PASIENBARU").val("0");
			jQuery("#NOMR").removeAttr("disabled");
			
			jQuery("#NOMR").attr( "value" , nomr );
			
			jQuery.get('<?php echo _BASE_; ?>include/process.php?psn='+nomr,function(data){
				newdata	= data.split("|");
				
				if(newdata[2] != ''){
					
					inisialisasi();
					//end
				}else{
					alert("Tidak ada data");
					return false;
					jQuery('.loadingcool').hide();
				}
				
				jQuery('input:radio[name=STATUSPASIEN]:nth(1)').attr('checked',true);
				
				//jQuery('#STATUSPASIEN_'+newdata[0]).attr('checked','checked');
				if(newdata[0] == 1){
					//jQuery('#NOMR').attr('disabled','disabled');
				}
				jQuery('#NAMA').val(newdata[2]);
				
				
				
				jQuery('#TEMPAT').val(newdata[3]);
				var tahun = newdata[4].substr(0,4);
				var bulan = newdata[4].substr(5,2);
				var hari = newdata[4].substr(8,2);
				jQuery('#dp1').val(hari+"/"+bulan+"/"+tahun);
				//jQuery('#umur').val(newdata[5]);
				jQuery('#ALAMAT').val(newdata[6]);
				jQuery('#ALAMAT_KTP').val(newdata[19]);
				jQuery('#KELURAHAN').val(newdata[7]);
				jQuery('#KECAMATAN').val(newdata[8]);
				jQuery('#KELURAHANHIDDEN').val(newdata[7]);
				jQuery('#KECAMATANHIDDEN').val(newdata[8]);
				jQuery('#KOTAHIDDEN').val(newdata[9]);
				jQuery('#KDPROVINSI').val(newdata[10]).change();
				jQuery('#KOTA').val(newdata[9]).change();
				jQuery('#notelp').val(newdata[11]);
				jQuery('#NOKTP').val(newdata[12]);
				jQuery('#SUAMI_ORTU').val(newdata[13]);
				jQuery('#PEKERJAAN').val(newdata[14]);
				jQuery('#umur').val(newdata[20]);
				//jQuery('#CALLER option[value='+newdata[21]+']').attr('selected', 'selected');
				//jQuery('#CALLER').val(newdata[21]);
				jQuery('#CALLER option[value="' +newdata[21]+ '"]').prop('selected', true);

				jQuery('#nama_penanggungjawab').val(newdata[22]);
				jQuery('#hubungan_penanggungjawab').val(newdata[23]);
				jQuery('#alamat_penanggungjawab').val(newdata[24]);
				jQuery('#phone_penanggungjawab').val(newdata[25]);
				
				jQuery('#JENISKELAMIN_'+newdata[5]).attr('checked','checked');
				jQuery('#status_'+newdata[15]).attr('checked','checked');
				jQuery('#PENDIDIKAN_'+newdata[17]).attr('checked','checked');
				jQuery('#AGAMA_'+newdata[16]).attr('checked','checked');
				jQuery('#carabayar_'+newdata[18]).attr('checked','checked');
				
				if(newdata[18]==10){
					
					jQuery('#kartu1').show().addClass('required');
					jQuery('#trno').attr("style","display:;");
					jQuery('#NOKARTU').show().addClass('required');
					jQuery('#nosep').attr("style","display:;");
					
					
					
					if(newdata[26] == ''){
						jQuery('#kartu1').val("000");
					}else{
						jQuery('#kartu1').val(newdata[26]);
					}
					
					if(newdata[27] == ''){
						jQuery('#NOKARTU').val("1133R001");
					}else{
						jQuery('#NOKARTU').val(newdata[27]);
					}
					
				}else if(newdata[18]==20){
					
					jQuery('#kartu1').show().addClass('required');
					jQuery('#trno').attr("style","display:;");
					jQuery('#NOKARTU').show().addClass('required');
					jQuery('#nosep').attr("style","display:;");
					
					if(newdata[26] == ''){
						jQuery('#kartu1').val("000");
					}else{
						jQuery('#kartu1').val(newdata[26]);
					}
					
					if(newdata[27] == ''){
						jQuery('#NOKARTU').val("1133R001");
					}else{
						jQuery('#NOKARTU').val(newdata[27]);
					}
					
					jQuery('#nokelas').show().addClass('required');
					jQuery('#kelas').attr("style","display:;");
					
				}else if(newdata[18]==1){
					
					jQuery('#kartu1').hide().removeClass('required');
					jQuery('#trno').attr("style","display:none;");
					jQuery('#NOKARTU').hide().removeClass('required');
					jQuery('#nosep').attr("style","display:none;");
					
					jQuery('#nokelas').hide().removeClass('required');
					jQuery('#kelas').attr("style","display:none;");
					
				}else{
					jQuery('#kartu1').show().addClass('required');
					jQuery('#trno').attr("style","display:;");
					jQuery('#NOKARTU').hide().removeClass('required');
					jQuery('#nosep').attr("style","display:none;");
					jQuery('#kartu1').val(newdata[26]);
					jQuery('#nokelas').hide().removeClass('required');
					jQuery('#kelas').attr("style","display:none;");
				}
				jQuery('.loader').hide();
				
				
				
			});
			
			
			
			jQuery('.loadingcool').hide();
		}else{
			inisialisasi();
			jQuery('.loadingcool').hide();
			jQuery('.loader').hide();
			jQuery("#NOMR").attr("disabled",true);
			
			jQuery("#NOMR").attr("value"," -- Otomatis -- ");
			jQuery("#NAMA").attr("value",jQuery("#detail_nama").html());
			
			var isi=jQuery("#detail_lahir").html();
			var isi2=jQuery("#bpjs_noKartu").val();
			if(isi!='' || isi2!=''){
				var res = isi.split(" "); 
				var kedua= res[0].split("-");
				var terakhir=kedua[2]+"/"+kedua[1]+"/"+kedua[0];
				jQuery("#dp1").attr("value",terakhir);
			}
			
			jQuery(".denganbpjs input").removeClass("required");
			
			
		}
		
		
	});
	
	
	jQuery('#bpjs_nomr').keyup(function(e){
        var nomr=jQuery(this).val();
		
		if(nomr.length == '6'){
			
			jQuery('.loader').show();
			jQuery('.loadingcool').show();
			
			jQuery("#PASIENBARU").val("0");
			jQuery("#NOMR").removeAttr("disabled");
			
			jQuery("#NOMR").attr( "value" , nomr );
			
			jQuery.get('<?php echo _BASE_; ?>include/process.php?psn='+nomr,function(data){
				newdata	= data.split("|");
				
				if(newdata[2] != ''){
					
					inisialisasi();
					//end
				}else{
					alert("Tidak ada data");
					return false;
					jQuery('.loadingcool').hide();
				}
				
				jQuery('input:radio[name=STATUSPASIEN]:nth(1)').attr('checked',true);
				
				//jQuery('#STATUSPASIEN_'+newdata[0]).attr('checked','checked');
				if(newdata[0] == 1){
					//jQuery('#NOMR').attr('disabled','disabled');
				}
				jQuery('#NAMA').val(newdata[2]);
				
				
				
				jQuery('#TEMPAT').val(newdata[3]);
				var tahun = newdata[4].substr(0,4);
				var bulan = newdata[4].substr(5,2);
				var hari = newdata[4].substr(8,2);
				jQuery('#dp1').val(hari+"/"+bulan+"/"+tahun);
				//jQuery('#umur').val(newdata[5]);
				jQuery('#ALAMAT').val(newdata[6]);
				jQuery('#ALAMAT_KTP').val(newdata[19]);
				jQuery('#KELURAHAN').val(newdata[7]);
				console.log(newdata[7]);
				jQuery('#KECAMATAN').val(newdata[8]);
				jQuery('#KELURAHANHIDDEN').val(newdata[7]);
				jQuery('#KECAMATANHIDDEN').val(newdata[8]);
				jQuery('#KOTAHIDDEN').val(newdata[9]);
				jQuery('#KDPROVINSI').val(newdata[10]).change();
				jQuery('#KOTA').val(newdata[9]).change();
				jQuery('#notelp').val(newdata[11]);
				jQuery('#NOKTP').val(newdata[12]);
				jQuery('#SUAMI_ORTU').val(newdata[13]);
				jQuery('#PEKERJAAN').val(newdata[14]);
				jQuery('#umur').val(newdata[20]);
				//jQuery('#CALLER option[value='+newdata[21]+']').attr('selected', 'selected');
				//jQuery('#CALLER').val(newdata[21]);
				jQuery('#CALLER option[value="' +newdata[21]+ '"]').prop('selected', true);

				jQuery('#nama_penanggungjawab').val(newdata[22]);
				jQuery('#hubungan_penanggungjawab').val(newdata[23]);
				jQuery('#alamat_penanggungjawab').val(newdata[24]);
				jQuery('#phone_penanggungjawab').val(newdata[25]);
				
				jQuery('#JENISKELAMIN_'+newdata[5]).attr('checked','checked');
				jQuery('#status_'+newdata[15]).attr('checked','checked');
				jQuery('#PENDIDIKAN_'+newdata[17]).attr('checked','checked');
				jQuery('#AGAMA_'+newdata[16]).attr('checked','checked');
				jQuery('#carabayar_'+newdata[18]).attr('checked','checked');
				
				if(newdata[18]==10){
					
					jQuery('#kartu1').show().addClass('required');
					jQuery('#trno').attr("style","display:;");
					jQuery('#NOKARTU').show().addClass('required');
					jQuery('#notelp').addClass('required');
					jQuery('#nosep').attr("style","display:;");
					
					
					
					if(newdata[26] == ''){
						jQuery('#kartu1').val("000");
					}else{
						jQuery('#kartu1').val(newdata[26]);
					}
					
					if(newdata[27] == ''){
						jQuery('#NOKARTU').val("1133R001");
					}else{
						jQuery('#NOKARTU').val(newdata[27]);
					}
					
				}else if(newdata[18]==20){
					
					jQuery('#kartu1').show().addClass('required');
					jQuery('#trno').attr("style","display:;");
					jQuery('#NOKARTU').show().addClass('required');
					jQuery('#notelp').addClass('required');
					jQuery('#nosep').attr("style","display:;");
					
					if(newdata[26] == ''){
						jQuery('#kartu1').val("000");
					}else{
						jQuery('#kartu1').val(newdata[26]);
					}
					
					if(newdata[27] == ''){
						jQuery('#NOKARTU').val("1133R001");
					}else{
						jQuery('#NOKARTU').val(newdata[27]);
					}
					
					jQuery('#nokelas').show().addClass('required');
					jQuery('#kelas').attr("style","display:;");
					
				}else if(newdata[18]==1){
					
					jQuery('#kartu1').hide().removeClass('required');
					jQuery('#trno').attr("style","display:none;");
					jQuery('#NOKARTU').hide().removeClass('required');
					jQuery('#nosep').attr("style","display:none;");
					
					jQuery('#nokelas').hide().removeClass('required');
					jQuery('#kelas').attr("style","display:none;");
					
				}else{
					jQuery('#kartu1').show().addClass('required');
					jQuery('#trno').attr("style","display:;");
					jQuery('#NOKARTU').hide().removeClass('required');
					jQuery('#nosep').attr("style","display:none;");
					jQuery('#kartu1').val(newdata[26]);
					jQuery('#nokelas').hide().removeClass('required');
					jQuery('#kelas').attr("style","display:none;");
				}
				jQuery('.loader').hide();
				
				
				
			});
			
			
			
			jQuery('.loadingcool').hide();
		}
    }); 
});
	
	function inisialisasi(){
		jQuery.facebox.settings.closeImage = '/include/face/closelabel.png'
		jQuery.facebox.settings.loadingImage = '/include/face/loading.gif'
		jQuery.facebox({ div: '#pendaftaran_hidden' }, 'my-groovy-style'); 
		
		var isi=jQuery("#pendaftaran_hidden").html();
		jQuery("#pendaftaran_hidden").remove();
		jQuery("<div id='pendaftaran_hidden'>" + isi + "</div>").insertAfter( "#facebox" );
		
		var asal = jQuery("#asal_rujukan").val();
		//aktifkan pojokan
		var isis=jQuery("#bpjs_noKartu").val();

		if(isis != '' && isis != ' '){
			jQuery("#rujukan_pojok").html("<div style='width:100%;text-align:center;'><img style='width:90%;height:auto;' src='img/loadinggangnam.gif' title='Loading...' alt='Loading...'></div>");
			jQuery("#rujukan_pojok").css("display","block");
			jQuery("#rujukan_pojok").css("overflow-y","scroll");
			jQuery("#rujukan_pojok table").css("color","#000");
			
		}
		
		//end aktifkan pojokan
		
		//baruuu
		jQuery("#myform").validate();
		
		jQuery("#asal_rujukan").change(function(){
			// alert("ok");
			// alert(jQuery(this).val());
			jQuery("#asal_rujukan_val").val(jQuery(this).val());

				var asal_rujukan = jQuery(this).val();

		jQuery("#ppkRujukan").autocomplete(

			"bpjs/ppkRujukan.php?tipe="+asal_rujukan, {
			width: 260,
		});

			// localStorage.setItem('asal_rujukan',jQuery(this).val());
		});
		jQuery('#kdpoly, .kdpoly').change(function(){
			var val	= jQuery(this).val();
			jQuery('#loader_namadokter').show();
			jQuery.post('<?php echo _BASE_;?>include/ajaxload.php',{kdpoly:val,load_dokterjaga:'true'},function(data){
				//var n = data.split("|");
				//jQuery('#kddokter').val(n[0]);
				jQuery('#listdokter_jaga').empty().append(data);
				//jQuery('#loader_namadokter').hide();
			});
			
			jQuery.get( "bpjs/poli.php?q=" + val, function( data ) {
				jQuery( "#bpjs_poli" ).val( data );
				console.log(data);
			});
		});
		
		jQuery("#diagAwal").autocomplete("bpjs/daftardiagnosa.php", {
			width: 260,
			selectFirst: true
		});
	
		// jQuery("#ppkRujukan").autocomplete({
		// 	source: function(req,res){

		// 		$.ajax({
		// 			url: "bpjs/ppkRujukan.php",
		// 			data:{
		// 				tipe: $("#asal_rujukan").val(),
		// 			},
		// 			success:function(res){
		// 				con
		// 			}
		// 		})

  //   // $.getJSON("bpjs/ppkRujukan.php", { tipe: $('#asal_rujukan').val() }, 
  //   //           response);

		// 	},
		// 	width: 260,
		// 	selectFirst: true


		// });

// console.log($("#asal_rujukan").val());



// 		$("#product").autocomplete({
//   source: function(request, response) {
//     $.getJSON("product_auto_complete.php", { postcode: $('#zipcode').val() }, 
//               response);
//   },
//   minLength: 2,
//   select: function(event, ui){
//     //action
//   }
// });
		
		jQuery('#dp1').datepicker({
			format: 'dd/mm/yyyy'
			
		}) .on('changeDate', function(ev){
				var iki = jQuery(this).val();
				calage1(iki,'umur');
			
		
		});
		
		jQuery('#tglRujukan').datepicker({
			format: 'yyyy-mm-dd'
			
		}) .on('changeDate', function(ev){});
		
		var noKartu = jQuery("#bpjs_noKartu").val();
		if(noKartu == ''){
			jQuery(".denganbpjs,#cetaksep").attr("style","display:none;");
			jQuery(".denganbpjs input").removeClass("required");
			jQuery('input[name=KDCARABAYAR]').each(function(){
				var val=jQuery(this).val();
				// if(val=='10' || val=='20'){
					// jQuery(this).attr("disabled",true);
				// }else{
					// jQuery(this).attr("disabled",false);
				// }
			});
		}else{
			jQuery(".denganbpjs,#cetaksep").attr("style","display:;");
			jQuery(".denganbpjs input").addClass("required");
			jQuery('input[name=KDCARABAYAR]').each(function(){
				var val=jQuery(this).val();
				if(val=='10' || val=='20'){
					jQuery(this).attr("disabled",false);
				}else{
					jQuery(this).attr("disabled",true);
				}
			});
		}
		
		jQuery("#cetaksep").click(function() {
			jQuery.post("bpjs/kirimdata.php", jQuery("#myform").serialize()) 
			.done(function(data) {
				var json = jQuery.parseJSON(data);
				if(json.metaData.code == '200'){
					jQuery("#hasilsep").html("<a href='bpjs/cetaksep.php?q="+ json.response  +"' target='_blank' >Data Berhasil dikirim. Klik untuk cetak</a>");
				}else{
					jQuery("#hasilsep").html("Gagal. Error terjadi saat pengiriman. Kontak Server");
				}
				console.log(json.metaData.code);
			});
			return false;
		})
		
	}
//alert("Data Telah Disimpan. \n Nama Pasien : <?php echo $NAMADATA; ?> \n No MR <?php echo $nomr; ?>");
</script>


<style type="text/css">
.my-groovy-style{
	width:900px !important;
}


#tengen table tr td{
	vertical-align:top;
}

.loader{background:url(js/loading.gif) no-repeat; width:16px; height:16px; float:right; margin-right:30px;}
input.error{ border:1px solid #F00;}
label.error{ color:#F00; font-weight:bold;}
#NAMA,#ALAMAT,#ALAMAT_KTP{
	text-transform:uppercase;
}

#myforms{
	background: radial-gradient(#205983, #0a2742) repeat scroll 0 0 rgba(0, 0, 0, 0);
    height: 100%;
    min-width: 600px;
    overflow: hidden;
    position: relative;
}

#detail_all,#detail_riwayat{
	color:#fff;
	width:700px;
	padding:5px;
	margin-top:10px;
}

#scroll_riwayat{
	
	overflow-y: scroll; 
	height:200px;
	margin:0 10px 10px 0;
}



#detail_riwayat{
	padding:0;
	margin-bottom:10px;
	margin-right:10px;
}
#detail_riwayat thead tr td{
	text-align:center;
}

#detail_riwayat td{
	padding:5px;
}

#detail_riwayat tbody {
 width: 100%;

 overflow: auto;
}

#pendaftaran_hidden{display:none;}

.denganbpjs input{
	margin:5px 0 0;
}
</style>

<div align="center">


  <div id="frame">
  <div id="frame_title"><h3 align="left">IDENTITAS PASIEN</h3>
</div>

<div name="myform" id="myforms" >
<br />
<section class="input" >
	<div id="kiwo" style="width:100%;">
		<br>
		<div class="fancyInput">
			<input autocomplete="off" id="bpjs_kartu" class='keren' type="text" placeholder="Masukkan Nomor Kartu ..." style="width: 723px;" >
			</div>
		<br><br>
		<div class="fancyInput">
			<input autocomplete="off" id="bpjs_nik" class='keren' type="text" placeholder="Masukkan NIK ..." style="width: 723px;">
		</div>
		<br><br>
		<div class="fancyInput">
			<input autocomplete="off" id="bpjs_nomr" class='keren' type="text" placeholder="Masukkan NO RM ..." style="width: 723px;" >
		</div>
		<br><br>
	</div>
	<div id="tengen" style="">
		<div style=''>
			<table width='100%' style='height:0;color:#fff;display:none;' id="detail_all">
				<tr>
					<td width='43%'>Nama </td>
					<td>: </td>
					<td width='45%' id='detail_nama'> </td>
				</tr>
				<tr>
					<td>NIK </td>
					<td>: </td>
					<td id='detail_nik'> </td>
				</tr>
				<tr>
					<td>No. Kartu </td>
					<td>: </td>
					<td id='detail_kartu'> </td>
				</tr>
				<tr>
					<td width='43%'>Jenis Peserta </td>
					<td>: </td>
					<td width='45%' id='detail_jenis'> </td>
				</tr>
				<tr>
					<td>Jenis Kelamin</td>
					<td>: </td>
					<td id='detail_sex'> </td>
				</tr>
				<tr>
					<td>Tanggal Lahir </td>
					<td>: </td>
					<td id='detail_lahir'></td>
				</tr>
				<tr>
					<td>Kelas </td>
					<td>: </td>
					<td id='detail_kelas'> </td>
				</tr>
				
			</table>
			<div id="info_riwayat" style='height:0;color:#fff;display:none;'></div>
			<div id="scroll_riwayat" style="height:0;color:#fff;display:none;">
				<table border="1" width='100%' style='height:0;color:#fff;display:none;' id="detail_riwayat">
					<thead>
						<tr>
							<td>Jns Pel</td>
							<td>No. SEP</td>
							<td>Diagnosa</td>
							<td>Poli</td>
							<td>Tgl. Plg</td>
							<td>Tgl. Sep</td>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
	<br><br>
</section>

<div id="pendaftaran_hidden">
<form name="myform" id="myform" action="models/pendaftaran.php" method="post">

<input type="hidden" name="bpjs_poli" id="bpjs_poli">
<input type="hidden" name="bpjs_noKartu" id="bpjs_noKartu" class='bpjs_noKartu'>
<input type="hidden" name="bpjs_kelas" id="bpjs_kelas">

<fieldset class="fieldset ">

<?
unset($_SESSION['register_nomr']);
unset($_SESSION['register_nama']);
#  echo $pmb -> begin_round("100%","FFF","CCC","CCC"); //  (width, fillcolor, edgecolor, shadowcolor)
?>
<table width="100%" border="0" style="background:none;" title=" From Ini Berfungsi Sebagai Form Pendaftaran Baru.">
	<tr>
		<td width="0" rowspan="6" valign="top">&nbsp;</td>
		<td width="20%">Shift</td>
		<td width="60%">
			<input type="radio" name="SHIFT" class="required" title="*" value="1" <? if($t_pendaftaran->SHIFT=="1" || $_GET['SHIFT']=="1")echo "Checked";?>/>
			1
			<input type="radio" name="SHIFT" class="required" title="*" value="2" <? if($t_pendaftaran->SHIFT=="2" || $_GET['SHIFT']=="2")echo "Checked";?>/>
			2
			<input type="radio" name="SHIFT" class="required" title="*" value="3" <? if($t_pendaftaran->SHIFT=="3" || $_GET['SHIFT']=="3")echo "Checked";?>/>
			3
		</td>
		<td width="20%">
			<input type="checkbox" name="aps" id="aps">&nbsp; APS
		</td>
    </tr>
	</tr>
      <tr>
        
        <td>Status Pasien</td>
        <td>
        	<div id="psn" >
            <script src="js/custom-js.js" language="JavaScript" type="text/javascript"></script>
            <input type="hidden" name="PASIENBARU" id="PASIENBARUS" value="1"><? 
			if(!isset($_GET['PASIENBARU'])){
				echo '<input type="hidden" name="PASIENBARU" id="PASIENBARU" value="1">';
				?>
				<input type="radio"  name="STATUSPASIEN" id="STATUSPASIEN_1" class="statuspasien" value="1" <?php if($_GET['PASIENBARU'] != '0'): echo'checked="checked"'; endif; ?>> Pasien Baru
				<input type="radio"  name="STATUSPASIEN" id="STATUSPASIEN_0" class="statuspasien" value="0" <?php if($_GET['PASIENBARU'] == '0'): echo'checked="checked"'; endif; ?>> Pasien Lama
			<?php
			}else{
				echo '<input type="hidden" name="PASIENBARU" id="PASIENBARU" value="'.$_GET['PASIENBARU'].'">';
				?>
				<input type="radio"  name="STATUSPASIEN" id="STATUSPASIEN_1" class="statuspasien" value="1" <?php if($_GET['PASIENBARU'] != '0'): echo'checked="checked"'; endif; ?>> Pasien Baru
				<input type="radio"  name="STATUSPASIEN" id="STATUSPASIEN_0" class="statuspasien" value="0" <?php if($_GET['PASIENBARU'] == '0'): echo'checked="checked"'; endif; ?>> Pasien Lama
				<?php
			}
			?>
			</div></td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr id="tr_nomr">
        <td width="16%">Nomor Rekam Medis <?php #echo nomr("1");?></td>
       <td width="20%"><input class="text" type="text" name="NOMR" id="NOMR" size="25" value="<?php echo $_REQUEST['xNOMR']; ?>" /><div class="loader"></div></td>
        
      <tr>
        <td>Poli / dokter yang dituju </td>
        <td colspan="2">
        	<select name="KDPOLY" id="kdpoly" class="kdpoly selectbox text required" title="*" style="float:left; margin-right:20px;">
            	<option value=""> - Pilih Poliklinik - </option>
            	<?php 
					$sql	= mysql_query('select * from m_poly order by nama asc');
					while($data	= mysql_fetch_array($sql)){
						if($_GET['KDPOLY'] == $data['kode']): $zx = 'selected="selected"'; else: $zx = ''; endif;
						echo '<option value="'.$data['kode'].'" '.$zx.'>'.$data['nama'].'</option>';
					}
				?>
            </select>
            <div id="listdokter_jaga">
            	<?php
            	if($_GET['KDPOLY'] != ''){
					$sqldokter	= mysql_query('select a.kddokter, b.NAMADOKTER from m_dokter_jaga a join m_dokter b on a.KDDOKTER = b.kddokter where a.kdpoly = "'.$_GET['KDPOLY'].'"');
					if(mysql_num_rows($sqldokter) > 0){
						echo '<select name="KDDOKTER" id="dokter">';
						while($datadok = mysql_fetch_array($sqldokter)){
							if($_GET['KDDOKTER'] == $datadok['kddokter']): $sel = 'selected="selected"'; else: $sel = ''; endif;
							echo '<option value="'.$datadok['kddokter'].'" '.$sel.'>'.$datadok['NAMADOKTER'].'</option>';
						}
						echo '</select>';
					}else{
						echo 'Tidak ada dokter jaga di poli tersebut';
					}
					#echo getDokterName($_GET['KDDOKTER']);
				}
				?>
            </div>
            
		</td>
        </tr>
		
        <tr style=""><td></td></tr>
      <tr>
        <td>Tanggal Daftar : </td>
        <td><input type="text" name="TGLREG" id='TGLREG' class="text" value="<?php if(!empty($_GET['TGLREG'])){ echo $_GET['TGLREG']; }else{ echo date("Y-m-d"); } ?>" size="20"/>
        		<input type='hidden' name='start_daftar' id='start_daftar' /></td>
        <td align="right">
          
</td>
      </tr>
      <tr><td></td><td>Cara Bayar</td><td colspan="2">
	  <?php
	  $ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');
	  while($ds = mysql_fetch_array($ss)){
		if($_GET['KDCARABAYAR'] == $ds['KODE']): $sel = "Checked"; else: $sel = ''; endif;
		echo '<input type="radio" name="KDCARABAYAR" id="carabayar_'.$ds['KODE'].'" title="*" class="carabayar required" '.$sel.' value="'.$ds['KODE'].'" /> '.$ds['NAMA'].'&nbsp;';
	  }
	  
		$cssb ='style="display:none;"';
		if($_GET['KETBAYAR'] != ''): 
			$cssb = 'style="display:inline;"';
		endif;
		?>
<input type="text" name="KETBAYAR" title="*" id="carabayar_lain" <?php echo $cssb;?> value="<?php echo $_REQUEST['KETBAYAR']; ?>" class="text"/></td></tr>
	<!--<tr style='display:none;' id='trno'>
		<td></td>
		<td>No Peserta</td>
		<td colspan='2'>
			<input title="*" class="text" type="text" name="kartu1" id="kartu1" size="30" value="000"  />
		</td>
	</tr>
	<tr style='display:none;' id="nosep">
        <td>&nbsp;</td>
        <td>NO SEP</td>
        <td colspan="2">
<input type="text" name="NOKARTU" title="*" id="NOKARTU" <?php echo $cssb;?> value="1133R001" class="text"/></td></tr>
     
	  -->
	  <?php
		if($_SESSION['ROLES']=="3"){
			?>
			 <tr  class='denganbpjs'>
				<td>&nbsp;</td>
				<td>Jenis Kunjungan</td>
				<td colspan="2">
					<select name='jeniskunjungan'>
						<option value='1'>Rawat Inap</option>
						<option value='2'>Rawat Jalan</option>
					</select>
					</td></tr>
			<?php
		}
	  ?>
     
		<tr  class='denganbpjs'>
        <td>&nbsp;</td>
        <td>Diagnosa Awal</td>
        <td colspan="2">
			<input type="text" name="diagAwal" id="diagAwal" class="required" title="*">
			</td></tr>
      <tr class='denganbpjs'>
        <td>&nbsp;</td>
        <td>Tanggal Rujukan</td>
        <td colspan="2">
			<input type="text" name="tglRujukan" id="tglRujukan" class="required" title="*">
			</td></tr>
	<tr  class='denganbpjs'>
        <td>&nbsp;</td>
        <td>No. Rujukan</td>
        <td colspan="2">
			<input type="text" name="noRujukan" id="noRujukan" class="required" title="*">
			</td></tr>
		<tr  class='denganbpjs'>
        <td>&nbsp;</td>
        <td>Asal Rujukan</td>
        <td colspan="2">
        <input type="hidden" name="" id="asal_rujukan_val">
	<select name="asal_rujukan" id="asal_rujukan" class="asal_rujukan selectbox text required" title="*" style="float:left; margin-right:20px;">
            	<option value="0"> - Pilih Asal Rujukan - </option>

           <option data-id="1" value="1">Puskesmas, Klinik, Praktek Dokter</option>
           <option data-id="2" value="2">Rumah Sakit</option>
            </select>

			</td></tr>
		<tr  class='denganbpjs'>
        <td>&nbsp;</td>
        <td>PPK. Rujukan</td>
        <td colspan="2">
			<input type="text" name="ppkRujukan" id="ppkRujukan" class="required" title="*">
			</td></tr>
      <tr>
        <td>&nbsp;</td>
        <td>Asal Pasien </td>
        <td colspan="2">
         <?php
		  $ss	= mysql_query('select * from m_rujukan order by ORDERS ASC');
		  while($ds = mysql_fetch_array($ss)){
			if($_GET['KDRUJUK'] == $ds['KODE']): $sel = "Checked"; else: $sel = ''; endif;
			echo '<input type="radio" name="KDRUJUK" id="asal'.$ds['KODE'].'" title="*" class="kdrujuk required" '.$sel.' value="'.$ds['KODE'].'" /> '.$ds['NAMA'].'&nbsp;';
		  }
		
		$css ='style="display:none; float:left;"';
		if($_GET['KETRUJUK'] != ''): 
			$css = 'style="display:inline;"';
		endif;
		?>
        <input type="text" title="*" name="KETRUJUK" <?php echo $css; ?> value="<?php echo $_GET['KETRUJUK'];?>" id="kdrujuk_lain" class="text" />
        
          </td>
        </tr>


    </table>
<? 
  #echo $pmb -> end_round();
?>    
    </fieldset>

   <div id="all">	
     <? include("include/view_prosess.php");?>
  </div>
       </div>

  </div>
  </div>
