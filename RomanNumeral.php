<?php

/**
 * RomanNumeral 
 * 
 * @package RomanNumeral
 * @version 1.0
 * @author Ketema Harris 
 */
class RomanNumeral
{
    /**
     * _integerValue 
     * 
     * @var integer
     */
    private $_integerValue = null;
    /**
     * _romanValue 
     * 
     * @var string
     */
    private $_romanValue = null;
    /**
     * _roman2decimal 
     * 
     * @var array
     */
    private $_roman2decimal = array (
        'M'  => 1000,
        'CM' => 900,
        'D'  => 500,
        'CD' => 400,
        'C'  => 100,
        'XC' => 90,
        'L'  => 50,
        'XL' => 40,
        'X'  => 10,
        'IX' => 9,
        'V'  => 5,
        'IV' => 4,
        'I'  => 1,
        'N'  => 0,
        );
    
    /**
     * __construct 
     * 
     * @return object
     */
    public function __construct ( )
    {
        return $this;
    } //END __construct

    /**
     * parseRoman 
     * 
     * @param mixed $romanNumeral 
     * @return array
     */
    public function parseRoman( $romanNumeral )
    {
        if( empty( $romanNumeral ) )
        {
            return null;
        }
        else
        {
            return str_split( $romanNumeral );
        }
    } //END parseRoman

    /**
     * toInt 
     * 
     * @param mixed $romanNumeral 
     * @return integer
     */
    public function toInt( $romanNumeral )
    {
        $calculated    = 0;
        $last          = 'N';
        $romanNumerals = array_reverse( $this->parseRoman( $romanNumeral ) );
        
        foreach ($romanNumerals as $romanNumeral)
        {
            if( $this->_roman2decimal[$romanNumeral] < $this->roman2decimal[$last] )
            {
                $calculated -= $this->_roman2decimal[$romanNumeral];
            }
            else
            {
                $calculated += $this->_roman2decimal[$romanNumeral];
            }
            $last = $romanNumeral;
        }
        $this->_integerValue = $calculated;
        $this->_romanValue   = $romanNumeral;
        return $calculated;
    } //END toInt

    /**
     * fromInt 
     * 
     * @param integer $integer 
     * @return string
     */
    public function fromInt( $integer )
    {
        //Make sure we have an integer
        $integer      = intval( $integer );
        $romanNumeral = '';

        if ( $integer == 0 ) return 'N';

        foreach( $this->_roman2decimal as $romanIndex => $integerValue )
        {
            while( $integer >= $integerValue && $integerValue != 0 ){
                $integer -= $integerValue;
                $romanNumeral .= $romanIndex;
            }
        }
        
        $this->_romanValue   = $romanNumeral;
        $this->_integerValue = $integer;
        return $romanNumeral;
    } //END fromInt

}
