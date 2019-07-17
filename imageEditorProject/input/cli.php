<?php

function readArguments(array $argv):array
{
    $payload1=[];

    array_shift($argv);
    foreach($argv as $item)
    {
        preg_match('/(?<key>\w+-?\w+)=?(?<value>[\w\/\.:]*)?/',$item,$matches);
        $payload1[$matches['key']]=$matches['value'];
    }
    return $payload1;
}