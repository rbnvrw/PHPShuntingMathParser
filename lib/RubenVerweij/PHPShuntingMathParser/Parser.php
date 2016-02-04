<?php

namespace RubenVerweij\PHPShuntingMathParser {

    /**
     * Class Parser
     * @package PHPShuntingMathParser
     */
    class Parser
    {
        /**
         * @var Queue
         */
        private $_output_queue;
        /**
         * @var OperatorStack
         */
        private $_operator_stack;

        /**
         * Parser constructor.
         */
        public function __construct()
        {
            $this->_output_queue = new Queue();
            $this->_operator_stack = new OperatorStack();
        }

        /**
         * @param $expression
         * @return Queue
         */
        public static function parseExpression($expression){
            $oParser = new Parser();
            return $oParser->parse($expression);
        }

        /**
         * @param $expression
         * @return Queue
         */
        public function parse($expression)
        {
            $oQueue = Tokenizer::tokenizeExpression($expression);

            while ($oQueue->hasItems()) {
                $oCurrentToken = $oQueue->shift();

                $this->_processToken($oCurrentToken);
            }

            while($this->_operator_stack->hasOperators()){
                $oTopOperator = $this->_operator_stack->pop();

                if($oTopOperator instanceof Parenthesis){
                    throw new MismatchingParenthesisException();
                }

                $this->_output_queue->enqueue($oTopOperator);
            }

            return $this->_output_queue;
        }

        /**
         * @param Token $oCurrentToken
         */
        protected function _processToken(Token $oCurrentToken){
            if ($oCurrentToken->isNumeric()) {
                $this->_output_queue->enqueue($oCurrentToken);
                return;
            }

            if ($oCurrentToken instanceof Operator) {
                $this->_processOperatorToken($oCurrentToken);
                return;
            }

            if($oCurrentToken instanceof Parenthesis){
                $this->_processParenthesis($oCurrentToken);
                return;
            }
        }

        /**
         * @param Parenthesis $oCurrentParenthesis
         */
        protected function _processParenthesis(Parenthesis $oCurrentParenthesis){
            if($oCurrentParenthesis->isLeftParenthesis()){
                $this->_operator_stack->enqueue($oCurrentParenthesis);
                return;
            }

            $bMatching = false;
            while($this->_operator_stack->hasOperators()){
                $oTopOperator = $this->_operator_stack->pop();

                if($oTopOperator instanceof Parenthesis && $oTopOperator->isLeftParenthesis()){
                    $bMatching = true;
                }
            }

            if(!$bMatching){
                throw new MismatchingParenthesisException();
            }
        }

        /**
         * @param Operator $oCurrentOperator
         */
        protected function _processOperatorToken(Operator $oCurrentOperator){
            for($i = 0; $i < $this->_operator_stack->getOperatorCount(); $i++){
                $iTopPrecedence = $this->_operator_stack->getTopOperatorPrecedence();

                if($oCurrentOperator->isLeftAssociative() && $oCurrentOperator->getPrecendence() <= $iTopPrecedence){
                    $this->_moveTopOperatorToOutput();
                }elseif($oCurrentOperator->isRightAssociative() && $oCurrentOperator->getPrecendence() < $iTopPrecedence){
                    $this->_moveTopOperatorToOutput();
                }
            }

            $this->_operator_stack->enqueue($oCurrentOperator);
        }

        /**
         * Move top operator to output queue
         */
        protected function _moveTopOperatorToOutput(){
            $oTopOperator = $this->_operator_stack->pop();
            $this->_output_queue->enqueue($oTopOperator);
        }

    }
}