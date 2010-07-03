<?php

class RomanNumeral
{
    public function __construct ( $numeral )
    {
        $this->_value = $numeral;
        $this->_lookup = array (
        ''  => 0,    
        'I' => 1,
        'V' => 5,
        'X' => 10,
        'L' => 50,
        'C' => 100,
        'D' => 500,
        'M' => 1000,
        );

    }

    public function toInt ( )
    {
        return $this->addEmUp($this->parse());
    }

    public function parse() {
        return str_split($this->_value );
    }

    public function addEmUp($numerals) {
        $calculated = 0;
        $last       = '';
        $numerals   = array_reverse($numerals);
        
        foreach ($numerals as $numeral) {
            if( $this->_lookup[$numeral] < $this->_lookup[$last] ){
                $calculated -= $this->_lookup[$numeral];
            }
            else{
                $calculated += $this->_lookup[$numeral];
            }
            $last = $numeral;
        }
        return $calculated;
    }

}
