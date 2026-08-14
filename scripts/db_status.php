<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo 'DB_CONNECTION=' . config('database.default') . PHP_EOL;
echo 'DB_DATABASE=' . config('database.connections.' . config('database.default') . '.database') . PHP_EOL;
echo 'User count=' . App\Models\User::count() . PHP_EOL;
