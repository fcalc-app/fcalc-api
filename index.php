<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate');

$appsDirectory = __DIR__ . '/pages';

function buildIndex($dir) {
    $index = [];

    $files = glob($dir . '/*.html');
    if (!$files) {
        return $index;
    }

    sort($files);

    foreach ($files as $file) {
        $name = basename($file);
        $index[] = [
            'id'   => md5($name),
            'hash' => md5_file($file),
            'url'  => '/pages/' . rawurlencode($name)
        ];
    }

    return $index;
}

echo json_encode(buildIndex($appsDirectory), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);