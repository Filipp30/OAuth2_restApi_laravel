<?php

namespace App\Http\Controllers\Mollie;

use App\Models\MolliePayments;

class Payment{

    private $user_id;
    private $order_id;
    private $mollie_call_id;
    private $profile_id;
    private $amount_value;
    private $amount_currency;
    private $status;

    public function __construct($mollie_request){

        $this->user_id = $mollie_request->metadata->user_id;
        $this->order_id = $mollie_request->metadata->order_id;
        $this->mollie_call_id = $mollie_request->id;
        $this->profile_id = $mollie_request->profileId;
        $this->amount_value = $mollie_request->amount->value;
        $this->amount_currency = $mollie_request->amount->currency;
        $this->status = $mollie_request->status;
    }

    public function save_or_update(){
        $data = [
            'user_id'=>$this->user_id,
            'order_id'=>$this->order_id,
            'mollie_call_id'=>$this->mollie_call_id,
            'profile_id'=>$this->profile_id,
            'amount_value'=>$this->amount_value,
            'amount_currency'=>$this->amount_currency,
            'status'=>$this->status,
        ];
        return MolliePayments::query()->create($data);
    }
}
