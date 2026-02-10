<?php
header("Content-Type: application/json");
require "db.php";

$f = (int)$_POST['from_person_id'];
$t = (int)$_POST['to_person_id'];
$type = $_POST['connection_type'] ?? 'met';

$stmt = $pdo->prepare(
  "INSERT IGNORE INTO connections (from_person_id, to_person_id, connection_type)
   VALUES (?, ?, ?)"
);
$stmt->execute([$f, $t, $type]);

echo json_encode(["ok" => true]);
