<?php

declare(strict_types=1);
$dbHost     = "j5zntocs2dn6c3fj.chr7pe7iynqr.eu-west-1.rds.amazonaws.com:3306";
$dbUsername = "y3p4bsywft2j9q45";
$dbPassword = "ujum4j4b30dg6hcr";
$dbName     = "q333xdd1huxfl0hq";

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


return [
    'db' => [
        // It's just jawsDB for herokuapp. Nothing confidential :D.
        'host' => 'j5zntocs2dn6c3fj.chr7pe7iynqr.eu-west-1.rds.amazonaws.com:3306',
        'database' => 'q333xdd1huxfl0hq',
        'user' => 'y3p4bsywft2j9q45',
        'password' => 'ujum4j4b30dg6hcr'
    ]
];