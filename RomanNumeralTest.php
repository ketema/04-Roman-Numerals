<?php
require_once 'PHPUnit/Framework.php';

require_once 'RomanNumeral.php';

class MainTest
extends PHPUnit_Framework_TestCase
{

    public function provide_numerals ( )
    {
        return array(
            array( 1, 'I' ),
            array( 2, 'II' ),
            array( 3, 'III' ),
            array( 4, 'IIII' ),
            array( 4, 'IV' ),
            array( 5, 'V'),
            array( 6, 'VI'),
            array( 7, 'VII'),
            array( 8, 'VIII'),
            array( 9, 'VIIII'),
            array( 9, 'IX' ),
            array( 10, 'X'),
            array( 20, 'XX'),
            array( 40, 'XL'),
            array( 49, 'XLIX'),
            array( 50, 'L'),
            array( 100, 'C'),
            array( 500, 'D'),
            array( 1000, 'M'),
            array( 1234, 'MCCXXXIV' ),
        ); // END datasets
    }

    public function provide_decimals(){
        return array(
            array( '', 0 ),
            array( 'I', 1 ),
            array( 'II', 2 ),
            array( 'III', 3 ),
            array( 'IV', 4 ),
            array( 'V', 5 ),
            array( 'IX', 9 ),
            array( 'X', 10 ),
            array( 'XI', 11 ),
            array( 'XII', 12 ),
            array( 'XIV', 14 ),
            array( 'XIX', 19 ),
            array( 'XXX', 30 ),
            array( 'XL', 40 ),
            array( 'L', 50 ),
            array( 'C', 100 ),
            array( 'D', 500 ),
            array( 'M', 1000 ),
            array( 'MCCXXXIV', 1234 ),
        );
    } //END provide_decimals

    public function provide_parsables(){
        return array(
            array(array('I'), 'I'),
            array(array('I', 'I'), 'II'),
            array(array('I', 'I', 'I'), 'III'),
            array(array('I', 'I', 'I', 'I'), 'IIII'),
            array(array('V'), 'V'),
        );
    }

    public function setup(){
        $this->fixture = new RomanNumeral;
        $this->assertTrue( ($this->fixture instanceof RomanNumeral), 'This is not a roman numeral' );
    } //END setup

    /**
     * @dataProvider provide_parsables
     * @param integer $expected
     * @param string $numeral
     */
    public function test_parse( $expected, $RomanNumeral ){
        $this->assertEquals($expected, $this->fixture->parseRoman( $RomanNumeral ));
    }


     /**
     * @dataProvider provide_numerals
     * @param integer $expected
     * @param string $romanNumeral
     */
    public function test_toInt( $expected, $romanNumeral ) {
        $this->assertEquals($expected, $this->fixture->toInt( $romanNumeral ) );
    }


     /**
     * @dataProvider provide_decimals
     * @param string $expected
     * @param integer $integer
     */
    public function test_fromInt( $expected, $integer ){
        $this->assertEquals( $expected, $this->fixture->fromInt( $integer ) );
    } //END test_fromDecimal 

} // END RomanNumeralTest

