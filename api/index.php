<?php

require __DIR__ . '/../public/index.php';

// Ensure database is created and migrated for serverless
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

try {
    // Create database if it doesn't exist
    if (!file_exists('/tmp/database.sqlite')) {
        touch('/tmp/database.sqlite');
    }

    // Run migrations
    $kernel->call('migrate', ['--force' => true]);

    // Seed the database
    $kernel->call('db:seed', ['--force' => true]);

} catch (Exception $e) {
    // Log error but don't break the app
    error_log('Database setup error: ' . $e->getMessage());
}
