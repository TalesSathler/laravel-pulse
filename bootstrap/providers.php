<?php

use App\Providers\AppServiceProvider;
use App\Providers\FortifyServiceProvider;
use App\Providers\HorizonServiceProvider;

$providers = [
    AppServiceProvider::class,
    FortifyServiceProvider::class,
    HorizonServiceProvider::class,
];

if (app()->environment('local')) {
    $providers[] = App\Providers\TelescopeServiceProvider::class;
}

return $providers;
