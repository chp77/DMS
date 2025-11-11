<?php

namespace App\Logging;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Carbon\Carbon;

class CreateOrganizationLogFile
{
    public function __invoke(array $config)
    {
        $user = Auth::user();
        $organizationId = $user ? $user->organization_id : 'guest';
        $currentDate = Carbon::now()->format('Y-m-d');
        $logFile = storage_path("logs/organization-$organizationId/$currentDate.log");

        return new Logger('organization - ID: ' . $organizationId, [
            new StreamHandler($logFile, $config['level'] ?? 'debug'),
        ]);
    }
}
