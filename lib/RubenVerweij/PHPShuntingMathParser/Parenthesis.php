<?php

namespace RubenVerweij\PHPShuntingMathParser {


    /**
     * Class Parenthesis
     * @package PHPShuntingMathParser
     */
    class Parenthesis extends Operator
    {
        /**
         *
         */
        const LEFT_PARENTHESIS = '(';

        /**
         *
         */
        const RIGHT_PARENTHESIS = ')';

        /**
         * @return bool
         */
        public function isLeftParenthesis(){
            return $this->getRawInput() == self::LEFT_PARENTHESIS;
        }

        /**
         * @return bool
         */
        public function isRightParenthesis(){
            return $this->getRawInput() == self::RIGHT_PARENTHESIS;
        }

        /**
         * @return bool
         */
        public function isOperator(){
            return false;
        }
    }

}