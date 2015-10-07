<?php

namespace PHPShuntingMathParser {


    /**
     * Class Tokenizer
     * @package PHPShuntingMathParser
     */
    class Tokenizer
    {
        /**
         * @var string
         */
        private $_expression = '';

        /**
         * Tokenizer constructor.
         * @param $expression
         */
        public function __construct($expression)
        {
            $this->setExpression($expression);
        }

        /**
         * @return string
         */
        public function getExpression()
        {
            return $this->_expression;
        }

        /**
         * @param mixed $expression
         * @return Tokenizer
         */
        public function setExpression($expression)
        {
            $this->_expression = $expression;

            return $this;
        }

        /**
         * @return Queue
         */
        public function getQueue()
        {
            $aParts = str_split($this->_expression);
            $oQueue = new Queue();

            foreach($aParts as $sPart){
                if(Token::isTokenNumericOrDecimalPoint($sPart)) {
                    if($oQueue->hasItems()){
                        if($oQueue->isLastTokenNumeric()){
                            $oQueue->appendToLastToken(new Token($sPart));
                        }
                    }
                    $oQueue->enqueue(new Token($sPart));
                }elseif(Token::isTokenParenthesis($sPart)){
                    $oQueue->enqueue(new Parenthesis($sPart));
                }else{
                    $oQueue->enqueue(new Operator($sPart));
                }
            }

            return $oQueue;
        }

        /**
         * @param $expression
         * @return Queue
         */
        public static function tokenizeExpression($expression){
            $oTokenizer = new Tokenizer($expression);
            return $oTokenizer->getQueue();
        }

    }

}