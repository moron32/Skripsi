<?php 
	include "koneksi.php";
?>
 <div id="page-wrapper" class="gray-bg dashbard-1">
       <div class="content-main">
		    <div class="banner">
				<h2>
					<a href="admin.php">Home</a>
					<i class="fa fa-angle-right"></i>
					<span>Data Surveyor</span>
				</h2>
		    </div>
		<!--//banner-->
		
				<!--graph-->
				<link rel="stylesheet" href="css/graph.css">
				<!--//graph-->
							<script src="js/jquery.flot.js"></script>
		<!--content-->
	<div class="content-top">
		<div class="col-md-12 ">
			<div class="grid-form">
				<div class="grid-form1">
				 	<h3 id="forms-example" class="col-md-12 form-group2 group-mail" style="margin-bottom: 0px;">Add Surveyor</h3>
					<form name="input_data" class="ketua-form" action="proses-add-surveyor.php" method="post" enctype="multipart/form-data">
						<div class="col-md-12 form-group2 group-mail">
							<label class="control-label">Nama Surveyor</label>
							<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Surveyor" required>
						</div>

						<div class="col-md-12 form-group2 group-mail">
						<label class="control-label" for="selector1">Provinsi</label>
						<select name="provinsi" class="form-control" id="provinsi">
							<option>Pilih Provinsi</option>
							<?php
								$provinsi = mysql_query("SELECT * FROM tb_provinsi ORDER BY nama_provinsi");
									while($p=mysql_fetch_array($provinsi)){
										echo "<option value=\"$p[id_provinsi]\">$p[nama_provinsi]</option>\n";
										}
							?>
						</select>
						</div>
						
						<div class="col-md-12 form-group2 group-mail">
							<label class="control-label" for="selector1">Cabang</label>
							<select name="kabupaten" class="form-control" id="kabupaten">
								<option>Pilih Cabang</option>
								<?php
									$kabupaten = mysql_query("SELECT * FROM tb_kabupaten ORDER BY nama_kabupaten");
										while($p=mysql_fetch_array($provinsi)){
											echo "<option value=\"$p[id_kabupaten]\">$p[nama_kabupaten]</option>\n";
											}
								?>
							</select>
						</div>
					
						<div class="col-md-12 form-group2 group-mail">
							<label class="control-label">Username</label>
							<input type="text" class="form-control" name="uname" id="uname" placeholder="Username" required>
						</div>
						<div class="col-md-12 form-group2 group-mail">
							<label class="control-label">Password</label>
							<input type="password" class="form-control password" name="pass" id="pass" placeholder="Password" required>
						</div>
						<div class="col-md-12 form-group2 group-mail">
							<label class="control-label">Confirm Password</label>
							<input type="password" class="form-control repassword" name="cpass" id="cpass" placeholder="Confirm Password" required>
						</div>
						

  						<div class="clearfix"> </div>
  
						<div class="col-md-12 form-group">
							<button class="btn-success btn" name="submit" style="margin-right: 5em;">Submit</button>
							<button onclick="history.back();" type="button" class="btn-danger btn">Back</button>
						</div>
						<div class="clearfix"> </div>
					</form>
				</div>
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
		