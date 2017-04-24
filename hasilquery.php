<html>
<body>
<form enctype="multipart/form-data" method="POST" action="?menu=hasilquery">
<h3>Keyword : </h3><br>
<input type="text" name="katakunci"><br>
<input type=submit>
</form>
</body>
 <?php
 //https://dev.mysql.com/doc/refman/5.5/en/fulltext-boolean.html
 //ALTER TABLE dokumen
//ADD FULLTEXT INDEX `FullText` 
//(`token` ASC, 
 //`tokenstem` ASC);
$host='localhost';
$user='root';
$pass='';
$database='dbstbi';
// Create connection
   $conn = new mysqli($host, $user, $password, $database);
//  $conn = mysql($host, $user, $password, $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$hasil=$_POST['katakunci'];
$sql = "SELECT distinct namafile,token,tokenstem,tokenstem2 FROM `dokumen` where token like '%$hasil%'";
//$sql = "SELECT distinct nama_file,token,tokenstem FROM `dokumen` WHERE MATCH (token,tokenstem) AGAINST ('$hasil' IN BOOLEAN MODE)";


//echo $sql;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo " Hasil: " . $row["token"]. " " . $row["tokenstem"]. " " . $row["tokenstem2"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();

///

?>
</html>