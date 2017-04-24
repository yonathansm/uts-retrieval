<p align='center'>
<?php
$host='localhost';
$user='root';
$pass='';
$database='dbstbi';

$conn=($GLOBALS["___mysqli_ston"] = mysqli_connect($host, $user, $pass));
mysqli_select_db($GLOBALS["___mysqli_ston"], $database);
//hitung index
mysqli_query($GLOBALS["___mysqli_ston"], "TRUNCATE TABLE tbindex");
$resn = mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `tbindex`(`Term`, `DocId`, `Count`) SELECT `token`,`namafile`,count(*) FROM `dokumen` group by `namafile`,token");
//$n = mysql_num_rows($resn);
	

//berapa jumlah DocId total?, n
	$resn = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT DISTINCT DocId FROM tbindex");
	$n = mysqli_num_rows($resn);
	
	//ambil setiap record dalam tabel tbindex
	//hitung bobot untuk setiap Term dalam setiap DocId
	$resBobot = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM tbindex ORDER BY Id");
	$num_rows = mysqli_num_rows($resBobot);
	print("Terdapat " . $num_rows . " Term yang diberikan bobot. <br />");

	while($rowbobot = mysqli_fetch_array($resBobot)) {
		//$w = tf * log (n/N)
		$term = $rowbobot['Term'];		
		$tf = $rowbobot['Count'];
		$id = $rowbobot['Id'];
		
		//berapa jumlah dokumen yang mengandung term tersebut?, N
		$resNTerm = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT Count(*) as n FROM tbindex WHERE Term = '$term'");
		$rowNTerm = mysqli_fetch_array($resNTerm);
		$NTerm = $rowNTerm['n'];
		
		$w = $tf * log($n/$NTerm);
		
		//update bobot dari term tersebut
		$resUpdateBobot = mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE tbindex SET Bobot = $w WHERE Id = $id");		
  	} //end while $rowbobot


?>
</p>