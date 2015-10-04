<?php

namespace PHPShuntingMathParser {

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
         * @var Stack
         */
        private $_operator_stack;

        /**
         * Parser constructor.
         */
        public function __construct()
        {
            $this->_output_queue = new Queue();
            $this->_operator_stack = new Stack();
        }

        /**
         * @param $expression
         */
        public function parse($expression)
        {
            $oQueue = Tokenizer::tokenizeExpression($expression);

            while ($oQueue->hasItems()) {
                $oCurrentToken = $oQueue->shift();

                if ($oCurrentToken->isNumeric()) {
                    $this->_output_queue->enqueue($oCurrentToken);
                    continue;
                }

                if ($oCurrentToken instanceof Operator) {

                }
            }
        }

    }
}