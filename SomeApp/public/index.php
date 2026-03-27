<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Dynamické zjištění základní adresy aplikace
$baseDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
define('BASE_URL', $baseDir);

// Načtení routeru
require_once '../core/App.php';

// Spuštění aplikace
$app = new App();