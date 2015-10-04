<?php

namespace PHPShuntingMathParser {


    /**
     * Class Operator
     * @package PHPShuntingMathParser
     */
    class Operator extends Token
    {
        /**
         * @return bool
         */
        public function isOperator(){
            return true;
        }

        /**
         * @return bool
         */
        public function isNumeric()
        {
            return false;
        }
    }

}