<?php
header('Content-Type: application/json; charset=utf-8');
require __DIR__.'/db.php';
echo json_encode(['connected'=>true,'database'=>$pdo->query('SELECT DATABASE()')->fetchColumn()]);