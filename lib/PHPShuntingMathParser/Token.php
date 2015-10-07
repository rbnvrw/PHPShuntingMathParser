<?php

namespace PHPShuntingMathParser {

    /**
     * Class Token
     * @package PHPShuntingMathParser
     */
    class Token
    {
        const DECIMAL_POINT = '.';

        private $_raw_input;

        /**
         * @param $raw_input
         */
        public function __construct($raw_input)
        {
            $this->setRawInput($raw_input);
        }

        /**
         * @return bool
         */
        public function isNumericOrDecimalPoint()
        {
            return ($this->isNumeric() || $this->isDecimalPoint());
        }

        /**
         * @return bool
         */
        public function isNumeric()
        {
            return self::isTokenNumeric($this->_raw_input);
        }

        /**
         * @return bool
         */
        public function isDecimalPoint()
        {
            return self::isTokenDecimalPoint($this->_raw_input);
        }

        /**
         * @return bool
         */
        public function isParenthesis()
        {
            return self::isTokenParenthesis($this->_raw_input);
        }

        /**
         * @param Token $token
         * @return $this
         */
        public function append(Token $token)
        {
            $this->setRawInput($this->getRawInput() . $token->getRawInput());
            return $this;
        }

        /**
         * @return mixed
         */
        public function getRawInput()
        {
            return $this->_raw_input;
        }

        /**
         * @param $raw_input
         * @return $this
         */
        public function setRawInput($raw_input)
        {
            $this->_raw_input = $raw_input;
            return $this;
        }

        /**
         * @param $raw_input
         * @return bool
         */
        public static function isTokenNumeric($raw_input){
            return is_numeric($raw_input);
        }

        /**
         * @param $raw_input
         * @return bool
         */
        public static function isTokenNumericOrDecimalPoint($raw_input){
            return self::isTokenNumeric($raw_input) || self::isTokenDecimalPoint($raw_input);
        }

        /**
         * @param $raw_input
         * @return bool
         */
        public static function isTokenDecimalPoint($raw_input){
            return ($raw_input == self::DECIMAL_POINT);
        }

        /**
         * @param $raw_input
         * @return bool
         */
        public static function isTokenParenthesis($raw_input){
            return ($raw_input == Parenthesis::LEFT_PARENTHESIS || $raw_input == Parenthesis::RIGHT_PARENTHESIS);
        }

    }
}