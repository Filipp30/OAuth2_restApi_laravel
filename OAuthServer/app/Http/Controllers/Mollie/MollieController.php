<?php

namespace App\Http\Controllers\Mollie;

use App\Http\Controllers\Controller;
use App\Services\Contracts\PayService;
use Illuminate\Http\Request;


class MollieController extends Controller{

    public function createOrder(Request $request){
        $order_payment = app(PayService::class);
        $pay_redirect_url = $order_payment->createNewPayment(
        $request['amount'],$request['description'],$request['user_id'],$request['order_id']);
        return response([
            'redirect_uri'=>$pay_redirect_url,
        ],201);
    }

    public function redirectCallBack(Request $request){
        dd('Payment mollie !!! check webhook.');
    }

    public function webhookCallBack(Request $request){
        $paymentId = $request->input('id');
        $mollie_request = Mollie()->payments->get($paymentId);

        $status = $mollie_request->status;
        $payment = new Payment($mollie_request);
        $saved = $payment->save_or_update();

        logs()->info('time : '.time().
            '--status : '.$status.' '.
            ' --mollie_id : '.$mollie_request->id.
            ' --profile_id : '.$mollie_request->profileId.
            ' --saved : '.$saved,
        );

        return response('ok',200);
    }
}
