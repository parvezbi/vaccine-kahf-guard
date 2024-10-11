<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// every minute for testing
// Schedule::command('app:vaccine-notification')->everyMinute();

// every sunday-friday at 9pm
Schedule::command('app:vaccine-notification')->cron('0 21 * * 0-3,6');
