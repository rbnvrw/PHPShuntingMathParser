<?php

namespace PHPShuntingMathParser {

    /**
     * Class Token
     * @package PHPShuntingMathParser
     */
    class Token
    {
        private $_raw_input;

        /**
         * @param $raw_input
         */
        public function __construct($raw_input){
            $this->setRawInput($raw_input);
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
         * @return bool
         */
        public function isNumeric(){
            return is_numeric($this->_raw_input);
        }

        /**
         * @param Token $token
         * @return $this
         */
        public function append(Token $token){
            $this->setRawInput($this->getRawInput().$token->getRawInput());
            return $this;
        }

    }
}