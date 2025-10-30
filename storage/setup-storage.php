<?php

// Script untuk setup storage di Vercel
$storagePath = '/tmp/storage';

if (!is_dir($storagePath)) {
    mkdir($storagePath, 0755, true);
    mkdir($storagePath.'/app', 0755, true);
    mkdir($storagePath.'/framework', 0755, true);
    mkdir($storagePath.'/framework/cache', 0755, true);
    mkdir($storagePath.'/framework/sessions', 0755, true);
    mkdir($storagePath.'/framework/views', 0755, true);
    mkdir($storagePath.'/logs', 0755, true);
}

echo "Storage setup completed!";
