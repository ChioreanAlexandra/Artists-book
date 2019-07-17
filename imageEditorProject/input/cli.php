<?php
const COMMAND_VALUE_PATTERN='/(?<key>\w+-?\w+)=?(?<value>[\w\/\.:]*)?/';
function readArguments(array $argv):array
{
    $payload1=[];

    array_shift($argv);
    foreach($argv as $item)
    {
        preg_match(COMMAND_VALUE_PATTERN,$item,$matches);
        $payload1[$matches['key']]=$matches['value'];
    }

    return $payload1;
}