<?php

namespace App\Test\TestCase\Lib\Util;

use App\Lib\Util\StringUtil;
use Cake\TestSuite\TestCase;

class StringUtilTest extends TestCase
{

    /**
     * Test halfwidthKanaTrimConverter method
     */
    public function testHalfwidthKanaTrimConverter()
    {
        $kana = 'ｶﾀｶﾅ';
        $expected = 'カタカナ';
        $result = StringUtil::halfwidthKanaTrimConverter($kana);
        $this->assertEquals($expected, $result);
    }

    /**
     * Test fullwidthKanaTrimConverter method
     */
    public function testFullwidthKanaTrimConverter()
    {
        $kana = 'カタカナ';
        $expected = 'ｶﾀｶﾅ';
        $result = StringUtil::fullwidthKanaTrimConverter($kana);
        $this->assertEquals($expected, $result);
    }

    /**
     * Test fullwidthKanaTrimConverter with half-width value
     */
    public function testFullwidthKanaTrimConverterInHalfwidth()
    {
        $kana = 'ｶﾀｶﾅ';
        $expected = 'ｶﾀｶﾅ';
        $result = StringUtil::fullwidthKanaTrimConverter($kana);
        $this->assertEquals($expected, $result);
    }

    /**
     * Test convertToFullWidth method with a string contain character below:
     * 1) Half-width kana
     * 2) Hiragana
     * 3) Half-width number
     * 4) Full-width number
     * 5) Half-width symbol
     * 6) Half-width space
     * All above converted to Full-width
     */
    public function testConvertToFullWidth()
    {
        $value = 'ﾔや大和YA MATO-1 23. １２３ー・';
        $expected = 'ヤや大和ＹＡ　ＭＡＴＯ－１　２３．　１２３－・';

        $value = StringUtil::convertToFullWidth($value);
        $this->assertEquals($expected, $value);
    }

    /**
     * Test convertToFullWidth with fields option supplied
     * with a string contain character below:
     * 1) Half-width kana
     * 2) Hiragana
     * 3) Half-width number
     * 4) Full-width number
     * 5) Half-width symbol
     * 6) Half-width space
     * All above converted to Full-width
     */
    public function testConvertToFullWidthWithFieldsSupplied()
    {
        $data = [
            'name' => 'はくと',
            'kana' => 'ハクト',
            'zip' => '0123456',
            'addr_city' => 'ﾄｷ ｵｼﾁ',
            'addr_street' => 'ｱﾀﾗｼﾏｴﾜ235',
            'addr_building' => 'ﾃｨｼｲﾌﾁﾞﾝｯ-﹣－−⁻₋‐‑ ‒ – — ―﹘',
            'email' => 'hakuto@example.com',
        ];

        $expected = [
            'name' => 'はくと',
            'kana' => 'ハクト',
            'zip' => '０１２３４５６',
            'addr_city' => 'ﾄｷ ｵｼﾁ',
            'addr_street' => 'アタラシマエワ２３５',
            'addr_building' => 'ティシイフヂンッ－－－－－－－－　－　－　－　－－',
            'email' => 'hakuto@example.com',
        ];

        $value = StringUtil::convertToFullWidth($data, [
            'addr_building',
            'addr_street',
            'zip'
        ]);
        $this->assertEquals($expected, $value);
    }

    /**
     * Test convertToFullWidth method with an array of string contain character below:
     * 1) Half-width kana
     * 2) Hiragana
     * 3) Half-width number
     * 4) Full-width number
     * 5) Half-width symbol
     * 6) Half-width space
     * 7) Full-width space
     * All above converted to Full-width
     */
    public function testConvertArrayValuesForHalfWidthToFullWidth()
    {
        $values = [
            'ﾔや大和YA MATO-1 2‑3. １２３・⦅ｴﾈﾙｷﾞｰﾋﾞﾙ 10⦆',
            'test' => [
                'ﾔや大和YA MATO-1 2‑3. １２３・⦅ｴﾈﾙｷﾞｰﾋﾞﾙ 10⦆'
            ]
        ];
        $expected = [
            0 => 'ヤや大和ＹＡ　ＭＡＴＯ－１　２－３．　１２３・｟エネルギービル　１０｠',
            'test' => [
                0 => 'ヤや大和ＹＡ　ＭＡＴＯ－１　２－３．　１２３・｟エネルギービル　１０｠'
            ],
        ];

        $values = StringUtil::convertToFullWidth($values);
        $this->assertArraySubset($expected, $values);
    }

    /**
     * Test stripAllSpaces method with string containing characters below:
     * 1) Half-width space
     * 2) Full-width space
     */
    public function testStripSpaces()
    {
        $value = 'ハクト　ミナ ミ';
        $expected = 'ハクトミナミ';

        $value = StringUtil::stripAllSpaces($value);
        $this->assertTextEquals($expected, $value);
    }

    /**
     * Test stripSpaces method with an array containing characters below with fields to convert:
     * 1) Half-width space
     * 2) Full-width space
     * Only spaces in specified fields will be stripped
     */
    public function testStripSpacesForArrayWithFields()
    {
        $data = [
            'name' => 'ハクト　ミナ ミ',
            'kana' => 'ハク ト',
            'addr_city' => 'ﾄｷｵｼﾁ',
            'addr_street' => 'アタラシマエワ２３５',
            'addr_building' => 'ﾃｨｼｲﾌﾁﾞﾝｯ-﹣－−⁻₋‐‑ ‒ – — ―﹘',
            'email' => 'hakuto@example.com',
        ];

        $expected = [
            'name' => 'ハクトミナミ',
            'kana' => 'ハクト',
            'addr_city' => 'ﾄｷｵｼﾁ',
            'addr_street' => 'アタラシマエワ２３５',
            'addr_building' => 'ﾃｨｼｲﾌﾁﾞﾝｯ-﹣－−⁻₋‐‑ ‒ – — ―﹘',
            'email' => 'hakuto@example.com',
        ];

        $value = StringUtil::stripSpaces($data, [
            'name',
            'kana',
            'addr_city',
        ]);
        $this->assertEquals($expected, $value);
    }

    /**
     * Test stripSpaces method with an array containing characters below without fields to convert:
     * 1) Half-width space
     * 2) Full-width space
     * All spaces in array data will be stripped
     */
    public function testStripSpacesForArrayWithoutFields()
    {
        $data = [
            'name' => 'ハクト　ミナ ミ',
            'kana' => 'ハク ト',
            'addr_city' => 'ﾄｷｵ ｼﾁ',
            'addr_street' => 'アタラ   シマエワ２３５',
            'addr_building' => 'ﾃｨｼｲﾌﾁﾞﾝｯ-﹣－−⁻₋‐‑ ‒ – — ―﹘',
            'email' => 'hakuto@example.com',
        ];

        $expected = [
            'name' => 'ハクトミナミ',
            'kana' => 'ハクト',
            'addr_city' => 'ﾄｷｵｼﾁ',
            'addr_street' => 'アタラシマエワ２３５',
            'addr_building' => 'ﾃｨｼｲﾌﾁﾞﾝｯ-﹣－−⁻₋‐‑‒–—―﹘',
            'email' => 'hakuto@example.com',
        ];

        $value = StringUtil::stripSpaces($data);
        $this->assertEquals($expected, $value);
    }
}
