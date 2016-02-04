<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 3-11-15
 * Time: 21:27
 */

namespace RubenVerweij\PHPShuntingMathParser;


class ParseTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test simple expressions
     */
    public function testParseSimpleExpression(){
        $oOutputQueue = Parser::parseExpression('1+1');

        $this->assertCount(3, $oOutputQueue->getItems());
    }

}