<?php
header("Content-Type: application/json");
require "db.php";

$people = $pdo->query("SELECT * FROM people")->fetchAll();
$edges = $pdo->query("SELECT from_person_id, to_person_id FROM connections")->fetchAll();

$adj = [];
foreach ($edges as $e) {
  $adj[$e['from_person_id']][] = $e['to_person_id'];
}

$queue = new SplQueue();
$gen = [];

foreach ($people as $p) {
  if ($p['is_core']) {
    $gen[$p['id']] = 0;
    $queue->enqueue($p['id']);
  }
}

while (!$queue->isEmpty()) {
  $cur = $queue->dequeue();
  foreach ($adj[$cur] ?? [] as $nxt) {
    if (!isset($gen[$nxt])) {
      $gen[$nxt] = $gen[$cur] + 1;
      $queue->enqueue($nxt);
    }
  }
}

$out = [];
foreach ($people as $p) {
  $p['generation'] = $gen[$p['id']] ?? 1;
  $out[] = $p;
}

echo json_encode([
  "people" => $out,
  "max_generation" => max(array_column($out, 'generation'))
]);
