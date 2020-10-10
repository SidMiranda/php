<?php
include 'config_db.php';
$conn = new mysqli($servidor, $usuario, $senha, $banco);
$dia = $_GET['dia'];
$mes = $_GET['mes'];
$ano = $_GET['ano'];
$sql = "SELECT hora FROM agendamento WHERE dia = '$dia' and mes = '$mes' and ano = '$ano'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$horas = array();
	while($row = $result->fetch_assoc()) {
		array_push($horas, $row[hora]);
	}
	horaVaga($horas);
} else {echo 0;}	

$conn->close();	
function horaVaga($horas) {
	$hv = array("8","10","12","14","16","18", "20");
	foreach($horas as $hora){
		$key = array_search($hora, $hv);
		unset($hv[$key]);
	}
	
	foreach($hv as $hora) {
		echo "<option value='$hora'>$hora:00H</option>";
	}
}
?>
