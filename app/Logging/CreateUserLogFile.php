<?php

namespace App\Logging;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Carbon\Carbon;

class CreateUserLogFile
{
    public function __invoke(array $config)
    {
        $user = Auth::user();
        $userId = $user ? $user->id : 'guest';
        $currentDate = Carbon::now()->format('Y-m-d');
        $logFile = storage_path("logs/user-$userId/$currentDate.log");

        return new Logger('user - ID: ' . $userId, [
            new StreamHandler($logFile, $config['level'] ?? 'debug'),
        ]);
    }
}
