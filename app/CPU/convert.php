<?php

namespace App\CPU;


use App\Model\BusinessSetting;
use App\Model\Currency;

class Convert
{
    public static function usd($amount)
    {
        $default = Currency::find(BusinessSetting::where(['type' => 'system_default_currency'])->first()->value);
        $usd = Currency::where('code', 'USD')->first()->exchange_rate;
        $rate = $default['exchange_rate'] / $usd;
        $value = floatval($amount) / floatval($rate);
        return $value;
    }

    public static function default($amount)
    {
        $default = Currency::find(BusinessSetting::where(['type' => 'system_default_currency'])->first()->value);
        $usd = Currency::where('code', 'USD')->first()->exchange_rate;
        $rate = $default['exchange_rate'] / $usd;
        $value = floatval($amount) * floatval($rate);
        return round($value,2);
    }

    public static function bdtTousd($amount)
    {
        $bdt = Currency::where(['code' => 'BDT'])->first()->exchange_rate;
        $usd = Currency::where('code', 'USD')->first()->exchange_rate;
        $rate = $bdt / $usd;
        $value = floatval($amount) / floatval($rate);
        return $value;
    }

    public static function usdTobdt($amount)
    {
        $bdt = Currency::where(['code' => 'BDT'])->first()->exchange_rate;
        $usd = Currency::where('code', 'USD')->first()->exchange_rate;
        $rate = $usd / $bdt;
        $value = floatval($amount) / floatval($rate);
        return $value;
    }

    public static function usdTomyr($amount)
    {
        $myr = Currency::where(['code' => 'MYR'])->first()->exchange_rate;
        $usd = Currency::where('code', 'USD')->first()->exchange_rate;
        $rate = $usd / $myr;
        $value = floatval($amount) / floatval($rate);
        return $value;
    }

    public static function usdTozar($amount)
    {
        $zar = Currency::where(['code' => 'ZAR'])->first()->exchange_rate;
        $usd = Currency::where('code', 'USD')->first()->exchange_rate;
        $rate = $usd / $zar;
        $value = floatval($amount) / floatval($rate);
        return $value;
    }

    public static function usdToinr($amount)
    {
        $inr = Currency::where(['code' => 'INR'])->first()->exchange_rate;
        $usd = Currency::where('code', 'USD')->first()->exchange_rate;
        $rate = $usd / $inr;
        $value = floatval($amount) / floatval($rate);
        return $value;
    }
}
