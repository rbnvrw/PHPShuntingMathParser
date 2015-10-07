<?php

namespace PHPShuntingMathParser {

    /**
     * Class Stack
     * @package PHPShuntingMathParser
     */
    class OperatorStack
    {
        /** @var array $_operators */
        private $_operators = [];

        /**
         * @param $operator
         */
        public function enqueue(Operator $operator){
            $this->_operators[] = $operator;
        }

        /**
         * @return mixed
         */
        public function pop(){
            return array_pop($this->_operators);
        }

        /**
         * @return bool
         */
        public function hasOperators(){
            return count($this->_operators) > 0;
        }

        /**
         * @return int
         */
        public function getOperatorCount(){
            return count($this->_operators);
        }

        /**
         * @return mixed
         */
        public function getTopOperatorPrecedence(){
            /** @var Operator $oTopOperator */
            $oTopOperator = end($this->_operators);
            return $oTopOperator->getPrecendence();
        }
    }
}
