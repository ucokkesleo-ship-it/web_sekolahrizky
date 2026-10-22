<?php

$root = dirname(__DIR__);
$viewPath = $root.'/resources/views/web_sekolah.blade.php';
$outputPath = $argv[1] ?? $root.'/_site';
$imageSource = $root.'/public/images';
$imageOutput = rtrim($outputPath, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.'images';

if (! is_file($viewPath)) {
    throw new RuntimeException("Homepage view not found: {$viewPath}");
}

if (! is_dir($imageSource)) {
    throw new RuntimeException("Public images directory not found: {$imageSource}");
}

if (! is_dir($outputPath) && ! mkdir($outputPath, 0775, true) && ! is_dir($outputPath)) {
    throw new RuntimeException("Unable to create output directory: {$outputPath}");
}

$html = file_get_contents($viewPath);

if ($html === false) {
    throw new RuntimeException("Unable to read homepage view: {$viewPath}");
}

$html = preg_replace('/\{\{--.*?--\}\}/s', '', $html);

if ($html === null) {
    throw new RuntimeException('Unable to remove Blade comments from homepage view.');
}

$html = str_replace('/images/', 'images/', $html);
$html = str_replace('<html lang="en">', '<html lang="id">', $html);
$html = preg_replace('/[ \t]+$/m', '', $html);

if ($html === null) {
    throw new RuntimeException('Unable to normalize whitespace in the static homepage.');
}

if (file_put_contents(rtrim($outputPath, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.'index.html', $html) === false) {
    throw new RuntimeException("Unable to write static homepage to: {$outputPath}");
}

if (! is_dir($imageOutput) && ! mkdir($imageOutput, 0775, true) && ! is_dir($imageOutput)) {
    throw new RuntimeException("Unable to create image output directory: {$imageOutput}");
}

foreach (new DirectoryIterator($imageSource) as $file) {
    if (! $file->isFile()) {
        continue;
    }

    $target = $imageOutput.DIRECTORY_SEPARATOR.$file->getFilename();

    if (! copy($file->getPathname(), $target)) {
        throw new RuntimeException("Unable to copy image: {$file->getPathname()}");
    }
}
