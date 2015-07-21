<?php

namespace PHPShuntingMathParser {

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
            if($token->isNumeric()){
                if($this->isLastTokenNumeric()){
                    return $this->appendToLastToken($token);
                }
            }

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
         * @return bool
         */
        protected function isLastTokenNumeric(){
            /** @var Token $last_token */
            $last_token = end($this->_items);
            return $last_token->isNumeric();
        }

        /**
         * @param Token $token
         * @return Token
         */
        protected function appendToLastToken(Token $token){
            /** @var Token $last_token */
            $last_token = end($this->_items);
            $last_token->append($token);
            unset($token);
            return $last_token;
        }
    }
}
