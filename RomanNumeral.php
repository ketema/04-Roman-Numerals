<?php

class RomanNumeral
{
    private $_decimalValue = null;
    private $_romanValue = null;
    private $_lookup = array (
        ''   => 0,    
        'I'  => 1,
        'V'  => 5,
        'X'  => 10,
        'L'  => 50,
        'C'  => 100,
        'D'  => 500,
        'M'  => 1000,
        );
    
    public function __construct ( $romanNumeral = null )
    {
        $this->_romanValue   = $romanNumeral;
        $this->_decimalValue = $this->toInt( $romanNumeral );

    }

    public function parseRoman( $romanNumeral = '' ) {
        if( empty( $romanNumeral ) ){
            return str_split($this->_romanValue );
        }
        else{
            return str_split( $romanNumeral );
        }
    }

    public function toInt( $romanNumeral ) {
        $calculated    = 0;
        $last          = '';
        $romanNumerals = array_reverse( $this->parseRoman( $romanNumeral ) );
        
        foreach ($romanNumerals as $romanNumeral) {
            if( $this->_lookup[$romanNumeral] < $this->_lookup[$last] ){
                $calculated -= $this->_lookup[$romanNumeral];
            }
            else{
                $calculated += $this->_lookup[$romanNumeral];
            }
            $last = $romanNumeral;
        }
        return $calculated;
    }

    public function fromInt( $integer ){
        /**
         * we use our existing lookup array and just flip it locally to be the 
         * lookup array for decimal to roman numeral
         */
        $lookup       = array_flip( $this->_lookup );
        $romanNumeral = '';

        //Make sure we have an integer
        $integer = intval( $integer );

        if ( $integer == 0 ) return ''; //Is there a roman 0 ?
        
        /**
         * The decimal has to be converted to a string then
         * broken down into its positional values
         * once the positional value integers are obtained they
         * have to be multiplied by ten to get their value
         * once we have the value we look it up to get the
         * roman representation the concatenate the string
         * this is totally BS, but is a good place to start
         * I have got it to where for base ten numbers it works but the problem 
         * is that the stupid romans did not use base ten, then have 500 and 5 
         * and 50 and they don't have 0 as far as I can tell I just added it 
         * in. In order to pass the test for the failing data I have to figure 
         * out the logic for these altered bases as well as the subtraction 
         * logic.
         **/

        //Take the integer and turn it into a string then reverse it cause we 
        //use a place holding nubering system with lower vals on the right
        $integer = array_reverse( str_split( $integer ) );

        /**
         * Loop over our integer string array using the index as the positional 
         * place holder, and the value tells us how many time we need that 
         * roman numeral.  This currently does not take into account the 
         * subtraction conditions that the roman system uses
         */
        //@TODO Figure out when to do  subtraction stuff and how to get those 
        //bases that our ten base system does not use, i.e. 500 and 50
        foreach( $integer as $position => $value ){
            $lookupIndex = pow(10, ( $position ) );
            for( $i = 0; $i < $value; $i++ ){
                $romanNumeral .= $lookup[$lookupIndex];
            }
        }
        //We return our roman numeral string in reverse order cause the romans 
        //are even more backward than we are.
        return implode( array_reverse( str_split( $romanNumeral ) ) );
    }

}
