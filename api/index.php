<?php

// Pindahkan folder storage Laravel ke folder /tmp bawaan Vercel yang writable
$storagePath = '/tmp/storage';
if (!is_dir($storagePath)) {
    mkdir($storagePath . '/framework/views', 0755, true);
    mkdir($storagePath . '/framework/cache', 0755, true);
    mkdir($storagePath . '/framework/sessions', 0755, true);
}

// Set variabel environment agar Laravel menggunakan folder tmp tersebut
$_ENV['APP_STORAGE'] = $storagePath;
putenv("APP_STORAGE={$storagePath}");

require __DIR__ . '/../public/index.php';
