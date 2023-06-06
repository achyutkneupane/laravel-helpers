<?php


/**
 * Helpers for Nepali English Conversions
 */

if (!function_exists('numberHelper')) {
    function english_nepali_number($number): string
    {
        $returnNumber = '';
        $numberMap = [
            '1' => '१',
            '2' => '२',
            '3' => '३',
            '4' => '४',
            '5' => '५',
            '6' => '६',
            '7' => '७',
            '8' => '८',
            '9' => '९',
            '0' => '०',
        ];
        if (session()->get('locale') == 'np') {
            $returnNumber = preg_replace_callback('/[0-9]/', function ($matches) use ($numberMap) {
                return $numberMap[$matches[0]];
            }, $number);
        } elseif (session()->get('locale') == 'en') {
            $returnNumber = preg_replace_callback('/[१२३४५६७८९०]/', function ($matches) use ($numberMap) {
                return array_search($matches[0], $numberMap);
            }, $number);
        }
        return $returnNumber;
    }
}

if (!function_exists('english_nepali')) {
    function english_nepali($engVal, $nepVal): string|null
    {
        if (session()->get('locale') == 'np') {
            return !$nepVal || $nepVal == '' ? $engVal : $nepVal;
        } elseif (session()->get('locale') == 'en') {
            return !$engVal || $engVal == '' ? $nepVal : $engVal;
        }
        return '';
    }
}
