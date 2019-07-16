<?php

function readArguments(array $argv):array
{
    $payload1=[
        'input-file'=>'',
        'output-file'=>'',
        'width'=>'',
        'height'=>'',
        'format'=>'',
        'help'=>'',
    ];

    array_shift($argv);
    foreach($argv as $item)
    {
        preg_match('/(?<key>\w+-?\w+)=?(?<value>[\w\/\.:]*)?/',$item,$matches);
        $payload1[$matches['key']]=$matches['value'];
    }
    var_dump($payload1);
    return $payload1;
}