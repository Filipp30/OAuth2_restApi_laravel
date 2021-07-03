<?php

namespace App\Providers;

use App\Services\Contracts\PayService;
use App\Services\PaymentServices\MolliePaymentService;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(PayService::class,MolliePaymentService::class);
    }


    public function boot()
    {
        //
    }
}
