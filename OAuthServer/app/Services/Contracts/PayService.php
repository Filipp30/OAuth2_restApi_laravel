<?php


namespace App\Services\Contracts;


interface PayService{

    public function createNewPayment($amount_value,$description,$user_id,$order_id);

}
