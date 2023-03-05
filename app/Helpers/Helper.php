<?php

namespace App\Helpers;

//use Carbon\Carbon;


class Helper
{

    public static function convertPriceToDh($price)
    {
        $usdToMADRate = 9.87; 
    $priceInDirhams = $price * $usdToMADRate;
    return number_format($priceInDirhams, 2);
    }

    public static function displayPrice($price)
    {
        $price = $price.' $';
        return $price;
    }
    public static function displayPrice_Dh($price)
    {
        $price = $price.' DH';
        return $price;
    }


}