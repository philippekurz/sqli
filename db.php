<?php
$host = 'localhost';
$dbname = 'test_csrf';
$username = 'root';
$password = '';

$db = new PDO("mysql:dbname=$dbname;host=$host", $username, $password);