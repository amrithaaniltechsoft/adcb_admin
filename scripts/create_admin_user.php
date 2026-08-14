<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@gmail.com',
    'password' => 'admin123',
]);

echo 'Created user ID: ' . $user->id . PHP_EOL;
