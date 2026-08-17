<?php

use App\Models\User;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

$user = User::create([
    'name' => 'Admin',
    'email' => 'admin@gmail.com',
    'password' => 'admin123',
]);

echo 'Created user ID: '.$user->id.PHP_EOL;
