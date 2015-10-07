<?php

namespace PHPShuntingMathParser {


    /**
     * Class Operator
     * @package PHPShuntingMathParser
     */
    class Operator extends Token
    {
        /**
         * @var
         */
        protected $_precendence;

        /**
         * @var
         */
        protected $_associativity;

        /**
         *
         */
        const LEFT_ASSOC = 1;

        /**
         *
         */
        const RIGHT_ASSOC = 2;

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

        /**
         * @return mixed
         */
        public function getPrecendence()
        {
            return $this->_precendence;
        }

        /**
         * @param mixed $precendence
         * @return Operator
         */
        public function setPrecendence($precendence)
        {
            $this->_precendence = $precendence;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getAssociativity()
        {
            return $this->_associativity;
        }

        /**
         * @return bool
         */
        public function isLeftAssociative(){
            return $this->getAssociativity() == self::LEFT_ASSOC;
        }

        /**
         * @return bool
         */
        public function isRightAssociative(){
            return $this->getAssociativity() == self::RIGHT_ASSOC;
        }

        /**
         * @param mixed $associativity
         * @return Operator
         */
        public function setAssociativity($associativity)
        {
            $this->_associativity = $associativity;
            return $this;
        }

    }

}