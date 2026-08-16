<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

$appsDirectory = __DIR__ . '/pages'; 

function buildIndex($dir) {
    $index = [];
    
    $files = glob($dir . '/*.html');
    foreach ($files as $file) {
        $htmlContent = file_get_contents($file);
        
        $doc = new DOMDocument();
        @$doc->loadHTML($htmlContent, LIBXML_NOERROR | LIBXML_NOWARNING);
        $xpath = new DOMXPath($doc);
        
        $title = $xpath->evaluate("string(//meta[@name='app-title']/@content)");
        $description = $xpath->evaluate("string(//meta[@name='app-description']/@content)");
        $image = $xpath->evaluate("string(//meta[@name='app-image']/@content)");
        
        $index[] = [
            'id'          => md5(basename($file)),
            'hash'        => md5_file($file),
            'title'       => $title ?: 'Без названия',
            'description' => $description ?: 'Нет описания',
            'image'       => $image ?: null,
            'url'         => '/pages/' . basename($file)
        ];
    }
    
    return $index;
}

$appList = buildIndex($appsDirectory);

echo json_encode($appList, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);