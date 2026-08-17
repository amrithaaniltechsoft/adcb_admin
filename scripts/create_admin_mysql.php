<?php

use App\Models\User;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Schema;

require __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

if (! Schema::hasTable('users')) {
    echo "users table is missing\n";
    exit(1);
}

$user = User::firstOrCreate(
    ['email' => 'admin@gmail.com'],
    ['name' => 'Admin', 'password' => 'admin123']
);

echo 'User ID: '.$user->id.PHP_EOL;
echo 'Email: '.$user->email.PHP_EOL;
echo 'Password hashed: '.(filled($user->password) ? 'yes' : 'no').PHP_EOL;
