<?php
require_once('vendor/autoload.php');

$oParser = new PHPShuntingMathParser\Parser();
$oQueue = $oParser->parse('3+4');

var_dump($oQueue);