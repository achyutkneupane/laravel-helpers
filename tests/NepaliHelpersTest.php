<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class NepaliHelpersTest extends TestCase
{
    public function test_english_nepali_number()
    {
        session()->put('locale', 'np');
        $this->assertEquals('1234567890', english_nepali_number('१२३४५६७८९०'));
        $this->assertEquals('123.456.789,00', english_nepali_number('१२३.४५६.७८९,००'));

        session()->put('locale', 'en');
        $this->assertEquals('१२३४५६७८९०', english_nepali_number('1234567890'));
        $this->assertEquals('१२:३४:५६ PM', english_nepali_number('12:34:56 PM'));
    }

    public function test_english_nepali()
    {
        session()->put('locale', 'np');
        $this->assertEquals('test', english_nepali('test', 'टेस्ट'));
        $this->assertEquals('टेस्ट', english_nepali('', 'टेस्ट'));

        session()->put('locale', 'en');
        $this->assertEquals('test', english_nepali('test', 'टेस्ट'));
        $this->assertEquals('टेस्ट', english_nepali('', 'टेस्ट'));
    }
}