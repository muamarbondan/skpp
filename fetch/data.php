<?php
header('Content-Type: application/json');
require_once('../config.php');
require_once('db.php');

$sqlQuery = "SELECT * FROM rangking WHERE id_user='$_COOKIE[id]' AND nama='TPA-TBI' LIMIT 5";
$stmt = $db->prepare($sqlQuery);
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

echo json_encode($data);
?>