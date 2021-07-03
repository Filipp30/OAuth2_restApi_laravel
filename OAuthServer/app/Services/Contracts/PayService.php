<?php


namespace App\Services\Contracts;


interface PayService{

    public function createNewPayment($amount_value,$order,$order_id);

}
