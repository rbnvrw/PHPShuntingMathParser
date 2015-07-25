<?php

namespace PHPShuntingMathParser {

    /**
     * Class Parser
     * @package PHPShuntingMathParser
     */
    class Parser {
        private $_input_queue;
        private $_output_queue;
        private $_operator_stack;

        private $_expression;

        public function __construct(){
            $this->_input_queue = new Queue();
            $this->_output_queue = new Queue();
            $this->_operator_stack = new Stack();
        }

        /**
         * @param $expression
         * @return float
         */
        public static function evaluate($expression)
        {
            $oParser = new Parser();
            return $oParser->parse($expression);
        }

        /**
         * @param $expression
         * @return float
         */
        public function parse($expression)
        {
            $this->setExpression($expression);

            $tokens = $this->_tokenize($expression);

            return 0.0;
        }

        /**
         * @param $expression
         * @return array
         */
        private function _tokenize($expression)
        {
            $characters = str_split($expression);

            $tokens = [];

            foreach ($characters as $character) {
                $token = new Token($character);

                if ($token->isNumericOrDecimalPoint()) {
                    /** @var Token $last_token */
                    $last_token = end($tokens);
                    if ($last_token->isNumericOrDecimalPoint()) {
                        $last_token->append($token);
                        continue;
                    }
                }

                $tokens[] = $token;
            }

            return $tokens;
        }

        /**
         * @return mixed
         */
        public function getExpression()
        {
            return $this->_expression;
        }

        /**
         * @param $expression
         * @return $this
         */
        public function setExpression($expression)
        {
            $this->_expression = $expression;
            return $this;
        }

    }
}