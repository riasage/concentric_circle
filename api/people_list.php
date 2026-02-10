<?php
header("Content-Type: application/json");
require "db.php";

$rows = $pdo->query(
  "SELECT id, display_name, quadrant, is_core
   FROM people ORDER BY is_core DESC, display_name"
)->fetchAll();

echo json_encode(["ok" => true, "people" => $rows]);
