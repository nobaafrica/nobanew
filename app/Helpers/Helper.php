<?php

use Carbon\Carbon;

function numberToWord($number)
{
    $digits = new NumberFormatter("en", NumberFormatter::SPELLOUT);
    return $digits->format($number);
}

function growthPecentage(object $partnership) 
{
    $partnership_duration = $partnership->package->duration * 30;
    $dailyInterest = $partnership->estimatedProfit/$partnership_duration;
    $interestAccrued = $dailyInterest *  Carbon::parse($partnership->created_at)->diffInDays(now());
    return $partnership->amount + round($interestAccrued, PHP_ROUND_HALF_UP);
}

function daysPercentage(object $partnership) :int
{
    $days_elapsed = Carbon::parse($partnership->created_at)->diffInDays(now());
    return $days_elapsed;
}

function completionPercentage(object $partnership)
{
    $number = fdiv(daysPercentage($partnership), $partnership->package->duration * 30);
    $percentage = $number * 100;
    return $percentage;
}

function url_exists($url){
    $ch = curl_init($url);    
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

   return ($code == 200);
}
