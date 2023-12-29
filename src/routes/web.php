<?php

use DridiHaythem\OrangeSMSTunisia\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

if (config('orange_sms_tunisia.dashboard.enable')) {

    Route::middleware(config('orange_sms_tunisia.dashboard.middleware'))->get(config('orange_sms_tunisia.dashboard.route'), [DashboardController::class, 'index']);
}
