<?php
$dbsever = "localhost";
$user = "root";
$pass = "";
$dbname = "db_catalog";
date_default_timezone_set('Asia/Bangkok');
try {
    $conn = new PDO("mysql:host=$dbsever;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'เชื่อมไม่ได้' . $e->getMessage();
}

@session_start();
function test_data($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

