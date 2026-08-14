<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

if (!Illuminate\Support\Facades\Schema::hasTable('users')) {
    echo "users table is missing\n";
    exit(1);
}

$user = App\Models\User::firstOrCreate(
    ['email' => 'admin@gmail.com'],
    ['name' => 'Admin', 'password' => 'admin123']
);

echo 'User ID: ' . $user->id . PHP_EOL;
echo 'Email: ' . $user->email . PHP_EOL;
echo 'Password hashed: ' . (filled($user->password) ? 'yes' : 'no') . PHP_EOL;
