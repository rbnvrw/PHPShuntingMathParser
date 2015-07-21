<?php

namespace PHPShuntingMathParser {

    /**
     * Class Stack
     * @package PHPShuntingMathParser
     */
    class Stack
    {
        /** @var array $_items */
        private $_items = [];

        /**
         * @param $token
         */
        public function enqueue(Token $token){
            $this->_items[] = $token;
        }

        /**
         * @return mixed
         */
        public function pop(){
            return array_pop($this->_items);
        }
    }
}
