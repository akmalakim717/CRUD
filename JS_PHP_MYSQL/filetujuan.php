<?php
$ConnDB = mysqli_connect("localhost", "root", "", "biodata");
parse_str($_POST['dataform'], $hasil);
$action = $_POST['action'];

if ($action == 'insert') {
	$sql = "INSERT INTO data_diri(`Nama_Lengkap`, `Tempat_Lahir`, `Tanggal_Lahir`,  `Anak_Ke`, `Dari`, `Alamat_Domisili`, `Kota`, `Provinsi`, `Zip`, `Alamat_Sekarang`, `Kota_Sekarang`, `Provinsi_Sekarang`, `Zip_Sekarang`,  `email`, `Password`) VALUES ('$hasil[NamaLengkap]','$hasil[TempatLahir]', '$hasil[TanggalLahir]','$hasil[AnakKe]','$hasil[Dari]','$hasil[AlamatDomisili]','$hasil[Kota]','$hasil[Provinsi]','$hasil[Zip]','$hasil[AlamatSekarang]','$hasil[KotaSekarang]','$hasil[ProvinsiSekarang]','$hasil[ZipSekarang]','$hasil[Email]','$hasil[Password]')";

		}

		elseif ($action == 'update') {
			$sql = "UPDATE data_diri SET Nama_Lengkap = '$hasil[NamaLengkap]', Tempat_Lahir = '$hasil[TempatLahir]', Tanggal_Lahir = '$hasil[TanggalLahir]', Anak_Ke = '$hasil[AnakKe]', Dari = '$hasil[Dari]' , Alamat_Domisili = '$hasil[AlamatDomisili]', Kota = '$hasil[Kota]', Provinsi ='$hasil[Provinsi]', Zip = '$hasil[Zip]', Alamat_Sekarang = '$hasil[AlamatSekarang]', Kota_Sekarang = '$hasil[KotaSekarang]', Provinsi_Sekarang = '$hasil[ProvinsiSekarang]', Zip_Sekarang = '$hasil[ZipSekarang]',  email = '$hasil[Email]', Password = '$hasil[Password]' WHERE Nama_Lengkap= '$hasil[NamaLengkap]'";

		}
		elseif ($action == 'delete') {
			$sql = "DELETE FROM data_diri WHERE Nama_Lengkap='$hasil[NamaLengkap]'";
		}
		elseif ($action == 'read') {
			$sql = "SELECT Nama_Lengkap, Tempat_Lahir, Tanggal_Lahir,  Anak_Ke, Dari, Alamat_Domisili, Kota, Provinsi, Zip, Alamat_Sekarang, Kota_Sekarang, Provinsi_Sekarang, Zip_Sekarang,  email, Password FROM data_diri "; 
			
		}
		else {
			echo "ERROR ACTION";
exit();
}

if (mysqli_errno($ConnDB)) {
	echo "Gagal Terhubung ke Database".$ConnDB -> connect_error; 
	exit();
}else{
	//echo "Database Terhubung";	
}

if ($ConnDB -> query($sql) === TRUE) {
	echo "$action Successfully";
}
elseif ($ConnDB->query($sql) === FALSE){
	echo "Error:  $sql" .$ConnDB -> error;
}
else {
	$result = $ConnDB->query($sql); //bukan true false tapi data array asossiasi
	if($result->num_rows > 0){
		echo "<table id='tresult' class='table table-striped table-bordered'>";
		echo "<thead>
					<th>NamaLengkap</th>
					<th>TempatLahir</th>
					<th>TanggalLahir</th>
					<th>AnakKe</th>
					<th>Dari</th>
					<th>AlamatDomisili</th>
					<th>Kota</th>
					<th>Provinsi</th>
					<th>ZIP</th>
					<th>AlamatSekarang</th>
					<th>KotaSekarang</th>
					<th>ProvinsiSekarang</th>
					<th>ZipSekarang</th>
					<th>Email</th>
					<th>Password</th>
			  </thead>";

		//echo "<tbody>";
		while($row = $result->fetch_assoc()) {
			echo 
			"<tr>
				<td>".$row['Nama_Lengkap']."</td>
				<td>". $row['Tempat_Lahir']."</td>
				<td>".$row['Tanggal_Lahir']."</td>
				<td>". $row['Anak_Ke']."</td>
				<td>".$row['Dari']."</td>
				<td>". $row['Alamat_Domisili']."</td>
				<td>".$row['Kota']."</td>
				<td>". $row['Provinsi']."</td>
				<td>".$row['Zip']."</td>
				<td>". $row['Alamat_Sekarang']."</td>
				<td>".$row['Kota_Sekarang']."</td>
				<td>". $row['Provinsi_Sekarang']."</td>
				<td>".$row['Zip_Sekarang']."</td>
				<td>". $row['email']."</td>
				<td>". $row['Password']."</td>
			</tr>";
		}
		echo "</tbody>";
		echo "</table>";
	}
	else{
		echo "Action is Failled";
	}
}
$ConnDB->close();
?>