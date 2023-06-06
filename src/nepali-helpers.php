<?php

use Illuminate\Support\Facades\Session;


/**
 * Helpers for Nepali English Conversions
 */

if (!function_exists('numberHelper')) {
    /**
     *
     * Function to convert number to Nepali or English according to locale
     * Pass session locale value to $locale
     * If default locale is not set, it will return numbers in Nepali
     *
     * @param $number numeric|string
     * @param $locale string 'np' or 'en' default 'np'
     * @return string string
     */
    function english_nepali_number(float|int|string $number, string $locale = 'np'): string
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
        if($locale == 'np') {
            $returnNumber = str_replace(array_keys($numberMap), array_values($numberMap), $number);
        } elseif ($locale == 'en') {
            $returnNumber = str_replace(array_values($numberMap), array_keys($numberMap), $number);
        }
        return $returnNumber;
    }
}

if (!function_exists('english_nepali')) {
    /**
     *
     * Function to select Nepali or English value according to locale
     * Pass session locale value to $locale
     * If default locale is not set, it will return Nepali value
     *
     * @param $engVal string
     * @param $nepVal string
     * @param $locale string 'np' or 'en' default 'np'
     * @return string|null
     */
    function english_nepali(string $engVal, string $nepVal, string $locale = 'np'): string|null
    {
        if ($locale == 'np') {
            return !$nepVal || $nepVal == '' ? $engVal : $nepVal;
        } elseif ($locale == 'en') {
            return !$engVal || $engVal == '' ? $nepVal : $engVal;
        }
        return '';
    }
}
