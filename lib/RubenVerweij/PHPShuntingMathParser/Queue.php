<?php

namespace RubenVerweij\PHPShuntingMathParser {

    /**
     * Class Queue
     * @package PHPShuntingMathParser
     */
    class Queue
    {
        /** @var array $_items */
        private $_items = [];

        /**
         * @param Token $token
         * @return Token
         */
        public function enqueue(Token $token){
            $this->_items[] = $token;
            return $token;
        }

        /**
         * @return Token
         */
        public function shift(){
            return array_shift($this->_items);
        }

        /**
         * @return array
         */
        public function getItems()
        {
            return $this->_items;
        }

        /**
         * @param array $items
         * @return Queue
         */
        public function setItems($items)
        {
            $this->_items = $items;

            return $this;
        }

        /**
         * @return bool
         */
        public function hasItems(){
            return count($this->_items) > 0;
        }

        /**
         * @return bool
         */
        public function isLastTokenNumeric(){
            if(!$this->hasItems()){
                return false;
            }
            /** @var Token $last_token */
            $last_token = end($this->_items);
            return $last_token->isNumeric();
        }

        /**
         * @param Token $token
         * @return Token
         */
        public function appendToLastToken(Token $token){
            if(!$this->hasItems()){
                return false;
            }
            /** @var Token $last_token */
            $last_token = end($this->_items);
            $last_token->append($token);
            unset($token);
            return $last_token;
        }
    }
}
