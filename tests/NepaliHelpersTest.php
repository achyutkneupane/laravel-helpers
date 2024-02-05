<?php

namespace AchyutN\LaravelHelpers\Tests;

class NepaliHelpersTest extends BaseTestCase
{
    public function test_english_nepali_number()
    {
        $this->assertEquals('1 234567809', english_nepali_number('१ २३४५६७८०९', 'en'));
        $this->assertEquals('123.456.789,00', english_nepali_number('१२३.४५६.७८९,००', 'en'));

        $this->assertEquals('१२३४५६७८९०', english_nepali_number('1234567890'));
        $this->assertEquals('१२:३४:५६ PM', english_nepali_number('12:34:56 PM'));
    }

    public function test_english_nepali()
    {
        $this->assertEquals('test', english_nepali('test', 'टेस्ट', 'en'));
        $this->assertEquals('टेस्ट', english_nepali('', 'टेस्ट', 'en'));

        $this->assertEquals('टेस्ट', english_nepali('test', 'टेस्ट'));
        $this->assertEquals('test', english_nepali('test', ''));
    }
}