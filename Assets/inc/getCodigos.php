<?php

include_once '../../Config/connectPOO.php';

$campo = $_POST["nom_materia"];
$param = '%'.$campo.'%';

$query = "SELECT * FROM materia WHERE clave LIKE '$param' OR nombre LIKE '$param' ORDER BY nombre ASC LIMIT 0, 10";
$result = $connection->query($query);

$html = "";
while ($row = $result->fetch_array(MYSQLI_ASSOC) ) {
	$html .= "<li class=\"list-group-item list-group-item-action\" onclick=\"mostrar('".$row["id_materia"]."','".$row["clave"]."','".$row["nombre"]."')\">" . $row["clave"] . " - " . $row["nombre"] . "</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
