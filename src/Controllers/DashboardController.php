<?php

namespace DridiHaythem\OrangeSMSTunisia\Controllers;

use DridiHaythem\OrangeSMSTunisia\Models\Log;
use DridiHaythem\OrangeSMSTunisia\Services\OrangeSMSTunisiaService;

class DashboardController
{

    public function index(OrangeSMSTunisiaService $service)
    {
        $logs = Log::orderBy('id', 'desc')->paginate(10);

        $availableUnits =  $service->getAvailableUnits();

        $log_enabled = config('orange_sms_tunisia.enable_log');

        return view('orange-sms-tunisia::dashboard', ['logs' => $logs, 'availableUnits' => $availableUnits, 'log_enabled' => $log_enabled]);
    }
}
