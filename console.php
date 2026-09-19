<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('vicom:health', function () {
    $this->info('VICOM Travel & Safaris API is healthy.');
})->purpose('Check the VICOM API bootstrap');
