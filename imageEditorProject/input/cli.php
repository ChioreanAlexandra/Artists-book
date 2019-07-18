<?php
const COMMAND_VALUE_PATTERN='/(?<key>-*?\w+-?\w+)=?(?<value>[\w\/\.:]*)?/';

/**
 * @param array $argv
 * @return array containing parameters name and its values
 */
function readArguments(array $argv):array
{
    $payload1=[];
    array_shift($argv); // removes the name of the app

    foreach($argv as $item)
    {
        preg_match(COMMAND_VALUE_PATTERN,$item,$matches);
        $payload1[$matches['key']]=$matches['value'];
    }

    return $payload1;
}