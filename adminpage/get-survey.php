<style type="text/css">
	#plg{
		padding: 0px !important;
	}
</style>
<?php	 
	include 'koneksi.php';
		$id = $_REQUEST['id'];
		$sql = mysql_query("SELECT tb_kredit.*, tb_survey.*,
			tb_harga.harga_cash, tb_harga.id_det_motor, tb_det_motor.nama_det_motor, 
			tb_warna.warna, tb_dealer.nama_dealer, tb_jawu.jangka_waktu, tb_bunga.biaya_tambahan FROM tb_survey 
			INNER JOIN tb_kredit ON tb_survey.`id_kredit`=tb_kredit.`id_kredit`
			INNER JOIN tb_harga ON tb_harga.`id_harga`=tb_kredit.`id_harga`
			INNER JOIN tb_jawu ON tb_jawu.`id_jawu`=tb_kredit.`id_jawu`
			INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
			INNER JOIN tb_warna ON tb_warna.`id_warna`=tb_kredit.`id_warna`
			INNER JOIN tb_dealer ON tb_dealer.`id_dealer`=tb_harga.`id_dealer` 
			INNER JOIN tb_det_motor ON tb_det_motor.`id_det_motor`=tb_harga.`id_det_motor` WHERE id_survey = '$id'");
	   	$row=mysql_fetch_array($sql);
		$idt=$row['id_kredit'];
		$idp=$row['id_pelanggan'];
		$idj = $row['id_jawu'];
		$idh = $row['id_harga'];
		$wrn = $row['warna'];
		$jawu = $row['jangka_waktu'];
		$mtor = $row['nama_det_motor'];
		$namad = $row['nama_dealer'];
		$jns = $row['jenis'];
		$bitam = $row['biaya_tambahan'];
		if ($jns==1) {
			$bng = "Bunga Tetap";
		}else{
			$bng = "Bunga Menurun";
		}
		$ang = $row['angsuran'];
		$angpok = $row['angsuran_pokok'];
		$umuka = $row['uang_muka'];

		$umur = $row['umur_p'];
		$namape=$row['nama_penjamin'];
		$hubpe = $row['hubungan_penjamin'];
		if ($hubpe==1) {
			$hub="Orang Tua";
		}else if ($hubpe==2) {
			$hub="Suami";
		}else if ($hubpe==3) {
			$hub="Istri";
		}else if ($hubpe==4) {
			$hub="Anak";
		}else{
			$hub = "Menantu";
		}
		$ktppe=$row['no_ktp'];
		$telppe=$row['telepon'];
		$klm_pe=$row['jk_pe'];
		$kecpe = $row['id_kec_pe'];
		$sql3=mysql_query("select tb_kecamatan.nama_kecamatan, tb_kabupaten.nama_kabupaten, tb_provinsi.nama_provinsi from tb_kecamatan inner join tb_kabupaten on tb_kecamatan.id_kabupaten=tb_kabupaten.id_kabupaten
			inner join tb_provinsi on 
			tb_kabupaten.id_provinsi=tb_provinsi.id_provinsi
			where tb_kecamatan.id_kecamatan=$kecpe");
		$row3=mysql_fetch_array($sql3);
		$alamatpe = $row['alamat'];

		
		$tgl = date("d F Y H:i:s", strtotime($row['tgl_survey']));
		
		$harga = $row['harga_cash'];
		$sql1=mysql_query("select * from tb_pelanggan where id_pelanggan=$idp");
		$row1=mysql_fetch_array($sql1);
		$nama=$row1['nama_pelanggan'];
		$alamat=$row1['alamat'];
		$nktp=$row1['No_KTP'];
		$telp=$row1['telp'];
		$sts = $row1['jenis_kelamin'];
		$kec=$row1['id_kecamatan'];
		$sql2=mysql_query("select tb_kecamatan.nama_kecamatan, tb_kabupaten.nama_kabupaten, tb_provinsi.nama_provinsi from tb_kecamatan inner join tb_kabupaten on tb_kecamatan.id_kabupaten=tb_kabupaten.id_kabupaten
			inner join tb_provinsi on 
			tb_kabupaten.id_provinsi=tb_provinsi.id_provinsi
			where tb_kecamatan.id_kecamatan=$kec");
		$row2=mysql_fetch_array($sql2);
			
?>
	<div class="modal-header"> 
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
        <h2 class="modal-title">Detail Kredit  </h2>
        <small style="float: right;"> No Kredit:  <span><?php echo"".$idt; ?></span></small>
        <h5 class="modal-title"><?php echo "$tgl" ; ?></h5> 
    </div> 
    
	<div class="modal-body"> 
		<div id="modal-loader" style="display: none; text-align: center;">
			<img src="ajax-loader.gif">
		</div>
	                        
		<div>
			<?php
			 	$idl=$_SESSION['idl'];
			 	
			 	$sql=mysql_query("select tb_harga.harga_cash,tb_harga.id_det_motor, tb_det_motor.nama_det_motor, tb_warna.warna, tb_dealer.nama_dealer from tb_harga 
			 		inner join tb_warna on tb_warna.id_warna = tb_det_transaksi.id_warna 
			 		inner join tb_det_motor on tb_harga.id_det_motor = tb_det_motor.id_det_motor 
			 		inner join tb_dealer on tb_dealer.id_dealer = tb_harga.id_dealer where tb_det_transaksi.id_transaksi = $idt ");
			 	$i=1;
			 	$total=0;
			?>
			<div class='cart-header col-md-12'>
				<?php
				 	 
				 	
						/*echo "<div class='cart-header col-md-6'>
					
					 <div class='cart-sec col-md-12'>
							<div class='cart-item cyc' style='width:40%'>
								 <img class='img-responsive'src='$bar[gambar]'/>
							</div>
						   <div class='cart-item-info' style='width:45%; border-bottom:0px;'>
								 <h3>$bar[nama_det_motor]<span>Dealer: $bar[nama_dealer]</span></h3>
								 <h4 style='display:block;margin-right:10px;'><span>Rp </span>$hrg</h4>
								 <p class='qty'>Jumlah ::<p class='qty'>$jumlah</p></p>
								 <p class='qty'>Warna ::<p class='qty'>$bar[warna]</p></p>
								 
								 
						   </div>
						   <div class='clearfix'></div>
										
					  	</div>
				 	</div>
				 	";*/
				 
				 	
			 	?>
			 	<table class="table table-bordered">
			 		<thead>
			 			<tr>
			 				<th>No</th>
			 				<th>Nama Barang</th>
			 				<th>Nama Dealer</th>
			 				<th>Warna</th>
			 				<th>Jangka Waktu</th>
			 				<th>Jenis Angsuran</th>
			 				<th>Harga</th>
			 			</tr>
			 		</thead>
			 		<tbody>
 				<?php
 					$i=1;
 					
				 		$jumlah=$bar['jumlah'];
						$jumlah_harga = $bar['harga_cash'] *  $jumlah;
	        			$total = $jumlah_harga + $total;
				 		$unik = $harga - $total; 

						$hrg=number_format($jumlah_harga, 0, ".", ".");
						
				?>
			 			<tr>
			 				<td><?php echo $i; ?></td>
			 				<td><?php echo $mtor; ?></td>
			 				<td><?php echo $namad; ?></td>
			 				<td><?php echo $wrn; ?></td>
			 				<td><?php echo $jawu; ?> Bulan</td>
			 				<td><?php echo $bng; ?></td>
			 				<td style="width: 143px; text-align: right;"><?php echo number_format($harga); ?></
			 			</tr>
			 			
			 		</tbody>
			 		<table class="table table-bordered">
			 			<tbody>
			 			<tr>
			 				<th style="text-align: center;">Uang Muka</th>
			 				
			 				<th style="width: 143px; text-align: right;"><?php echo number_format($umuka); ?></th>
			 			</tr>
			 		</tbody>
			 		</table>

			 		<table class="table table-bordered">
			 			<tbody>
			 			<tr>
			 				<th style="text-align: center;">Biaya Tambahan</th>
			 				
			 				<th style="width: 143px; text-align: right;"><?php echo number_format($bitam); ?></th>
			 			</tr>
			 		</tbody>
			 		</table>

			 		<table class="table table-bordered">
			 			<tbody>
			 			<tr>
			 				<th style="text-align: center;">Angsuran Pokok</th>
			 				
			 				<th style="width: 143px; text-align: right;"><?php echo number_format($angpok); ?></th>
			 			</tr>
			 		</tbody>
			 		</table>

			 		<table class="table table-bordered">
			 			<tbody>
			 			<tr>
			 				<th style="text-align: center;">Angsuran</th>
			 				
			 				<th style="width: 143px; text-align: right;"><?php echo number_format($ang); ?></th>
			 			</tr>
			 		</tbody>
			 		</table>
			 		
			 	</table>
			 	
		 	</div>
			<div class="price-details col-md-6" style="border-bottom: 0px;" >
				<h4 style="font-weight: bold; margin-top: 1em; margin-bottom: 1em;">Data Pemohon</h4>
				<table class="table">
					<tr>
						<td id="plg">Nama</td>
						<td id="plg">:</td>
						<td id="plg"><?php echo "$nama"; ?></td>
					</tr>
					<tr>
						<td id="plg">No. KTP</td>
						<td id="plg">:</td>
						<td id="plg"><?php echo "$nktp"; ?></td>
					</tr>
					<tr>
						<td id="plg">Telp</td>
						<td id="plg">:</td>
						<td id="plg"><?php echo "$telp"; ?></td>
					</tr>
					<tr>
						<td id="plg">Umur</td>
						<td id="plg">:</td>
						<td id="plg"><?php echo "$umur"; ?> Tahun</td>
					</tr>
					<tr>
						<td id="plg">Alamat</td>
						<td id="plg">:</td>
						<td id="plg"><?php echo "$alamat"; ?></td>
					</tr>
					<tr>
						<td id="plg">Kecamatan</td>
						<td id="plg">:</td>
						<td id="plg"><?php echo "$row2[nama_kecamatan]"; ?></td>
					</tr>
					<tr>
						<td id="plg">Kabupaten</td>
						<td id="plg">:</td>
						<td id="plg"><?php echo "$row2[nama_kabupaten]"; ?></td>
					</tr>
					<tr>
						<td id="plg">Provinsi</td>
						<td id="plg">:</td>
						<td id="plg"><?php echo "$row2[nama_provinsi]"; ?></td>
					</tr>
					<tr>
						<td id="plg">Jenis Kelamin</td>
						<td id="plg">:</td>
						<td id="plg"><?php if($sts==1){
							echo "Pria";}else{echo "Wanita";} ?></td>
					</tr>
				</table>
				
				<div class="clearfix"></div>				 
			</div>

			<div class="price-details col-md-6" style="border-bottom: 0px;" >
				<h4 style="font-weight: bold; margin-top: 1em; margin-bottom: 1em;">Data Penjamin</h4>
				<table class="table">
					<tr>
						<td id="plg">Nama</td>
						<td id="plg">:</td>
						<td id="plg"><?php echo "$namape"; ?></td>
					</tr>
					<tr>
						<td id="plg">Hubungan Penjamin</td>
						<td id="plg">:</td>
						<td id="plg"><?php echo "$hub"; ?></td>
					</tr>
					<tr>
						<td id="plg">No. KTP</td>
						<td id="plg">:</td>
						<td id="plg"><?php echo "$ktppe"; ?></td>
					</tr>
					<tr>
						<td id="plg">Telp</td>
						<td id="plg">:</td>
						<td id="plg"><?php echo "$telppe"; ?></td>
					</tr>
					<tr>
						<td id="plg">Alamat</td>
						<td id="plg">:</td>
						<td id="plg"><?php echo "$alamatpe"; ?></td>
					</tr>
					<tr>
						<td id="plg">Kecamatan</td>
						<td id="plg">:</td>
						<td id="plg"><?php echo "$row3[nama_kecamatan]"; ?></td>
					</tr>
					<tr>
						<td id="plg">Kabupaten</td>
						<td id="plg">:</td>
						<td id="plg"><?php echo "$row3[nama_kabupaten]"; ?></td>
					</tr>
					<tr>
						<td id="plg">Provinsi</td>
						<td id="plg">:</td>
						<td id="plg"><?php echo "$row3[nama_provinsi]"; ?></td>
					</tr>
					<tr>
						<td id="plg">Jenis Kelamin</td>
						<td id="plg">:</td>
						<td id="plg"><?php if($klm_pe==1){
							echo "Pria";}else{echo "Wanita";} ?></td>
					</tr>
				</table>
				
				<div class="clearfix"></div>				 
			</div>

			<div class="col-md-12">
				<h4 style="font-weight: bold; margin-top: 1em; margin-bottom: 1em;">Data Penghasilan</h4>
			</div>
			<div class="clearfix"></div>
		</div>
	     
	</div> 

    <div class="modal-footer"> 
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
    </div> 
		
			
		