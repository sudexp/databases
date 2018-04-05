<?php
/*//Ladataan yhteysmuuttujat taulukkoon
$config=parse_ini_file('../../connect.ini');
//Muodostetaan yhteys tietokantaan
$con=mysqli_connect($config['server'],$confiq['usernmae'],$config['password']);
//Merkistön asettaminen
mysqli_query($con,"set names utf8");

if($con == false) {
    echo "Tietokannan yhteyden muodostus epäonnistui";
}
else {
    mysqli_select_db($con,$config['dbname']) or die ("Tietokannan valitseminen epäonnistui!");
}*/

class DBController {
	// private $host = "mysql.labranet.jamk.fi";
	private $host = "localhost";
	// private $user = "L4062";
	private $user = "root";
	// private $password = "mansikka";
	private $password = "root";
	// private $database = "L4062_3";
	private $database = "tietokanta";
	private $conn;

	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
}
?>
