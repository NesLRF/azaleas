<?php

use App\Models\Monthpayments;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

if (! function_exists('check_payment')) {
    function check_payment($id)
    {
        $currentdate = Carbon::now();
        $payment = Monthpayments::where('direccion_id',$id)->where('capture_month',$currentdate->month)->where('capture_year',$currentdate->year)->get()->count();
        if($payment > 0){
            return " (Ya pagó)";
        }else{
            return " (No ha pagado)";
        }
    }
}