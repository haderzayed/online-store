<?php 

namespace App\Helpers;

use NumberFormatter;

class Currency{

    public static function format($mount, $currency = null){
       $formatter= new NumberFormatter(config('app.locale'),NumberFormatter::CURRENCY);
       if($currency === null){
          $currency = config('app.currency','USD');
       }
       return $formatter->formatCurrency($mount,$currency); 
    }
}