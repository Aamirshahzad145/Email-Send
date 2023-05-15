<?php
// dd('here');
if (!function_exists('CommaSeparatedValue')) {
    function CommaSeparatedValue($number)
    {
        return number_format($number);
    }
}

if (!function_exists('DollerSign')) {
    function DollerSign()
    {
        return '$';
    }
}

function getCurrencySign()
{
    return '$';
}
function getCurrencyPosition()
{
    return 'before';
}

function addCurrencySign($value, $decimle = 2)
{
    $position = getCurrencyPosition();
    $currencySign = getCurrencySign();
    if ($position == 'before') {
        return $currencySign . formatNumber($value, $decimle);
    } else {
        return formatNumber($value, $decimle) . $currencySign;
    }
}

function getNumberType()
{
    return "US";
}

function formatNumberWitoutDecimal($number, $decimle = 0)
{
    if (getNumberType() == 'US') {
        return number_format($number,  $decimle ,'.', ',');
    } elseif (getNumberType() == 'EU') {
        return number_format($number, $decimle, ',', '.');
    }
}

function formatNumber($number, $decimle = 0)
{
    if (getNumberType() == 'US') {
        return number_format($number, $decimle, '.', ',');
    } elseif (getNumberType() == 'EU') {
        return number_format($number, $decimle, ',', '.');
    }
}

?>