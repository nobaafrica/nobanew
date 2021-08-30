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
    $dailyInterest = $partnership->percentageProfit/$partnership_duration;
    $interestAccrued = $dailyInterest *  Carbon::parse($partnership->created_at)->diffInDays(now());
    return round($interestAccrued, PHP_ROUND_HALF_UP);
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