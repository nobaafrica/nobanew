<?php

function numberToWord($number)
{
    $digits = new NumberFormatter("en", NumberFormatter::SPELLOUT);
    return $digits->format($number);
}