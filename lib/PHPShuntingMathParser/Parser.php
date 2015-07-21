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

        public function __construct(){
            $this->_input_queue = new Queue();
            $this->_output_queue = new Queue();
            $this->_operator_stack = new Stack();
        }

    }
}