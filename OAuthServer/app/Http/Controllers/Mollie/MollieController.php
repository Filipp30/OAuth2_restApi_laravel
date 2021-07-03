<?php

namespace App\Http\Controllers\Mollie;

use App\Http\Controllers\Controller;
use App\Services\Contracts\PayService;
use Illuminate\Http\Request;


class MollieController extends Controller{

    public function createOrder(Request $request){
        $order_payment = app(PayService::class);
        $pay_redirect_url = $order_payment->createNewPayment($request['amount'],$request['order'],$request['user_id']);
        return response([
            'redirect_uri'=>$pay_redirect_url,
        ],201);
    }

    public function redirectCallBack(Request $request){
        dd($request);
    }

    public function webhookCallBack(Request $request){
        $paymentId = $request->input('id');
        $payment = Mollie()->payments->get($paymentId);
        var_dump($payment);

//        if ($payment->isPaid())
//        {
//            echo 'Payment received.';
//        }
    }

}
