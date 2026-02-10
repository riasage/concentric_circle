<?php
header("Content-Type: application/json");
require "db.php";

$name = trim($_POST['display_name'] ?? '');
$quadrant = $_POST['quadrant'] ?? 'study';
$is_core = isset($_POST['is_core']) ? 1 : 0;
$locality = $_POST['locality'] ?? null;

if (!$name) {
  echo json_encode(["ok" => false]);
  exit;
}

$stmt = $pdo->prepare(
  "INSERT INTO people (display_name, locality, quadrant, is_core)
   VALUES (?, ?, ?, ?)"
);
$stmt->execute([$name, $locality, $quadrant, $is_core]);

echo json_encode(["ok" => true]);
