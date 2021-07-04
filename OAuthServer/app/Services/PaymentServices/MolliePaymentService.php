<?php


namespace App\Services\PaymentServices;


use App\Services\Contracts\PayService;
use Mollie\Laravel\Facades\Mollie;

class MolliePaymentService implements PayService {


    public function createNewPayment($amount_value, $description,$user_id, $order_id)
    {
        $payment = Mollie::api()->payments()->create([
            "amount"=>[
                "currency"=>"EUR",
                "value"=>$amount_value,
            ],
            "description"=>$description,
            "redirectUrl"=> config('services.mollie.redirect_callback'),
            "webhookUrl"=>config('services.mollie.webhook_callback'),
            "locale"=>'en_US',
            "metadata"=>[
                "user_id"=> $user_id,
                "order_id"=>$order_id
            ],
        ]);
        return $payment->getCheckoutUrl();
    }
}
