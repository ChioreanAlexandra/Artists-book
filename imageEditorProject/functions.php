<?php

function castIntType(string $value):int
{
    return (int) $value;
}

function canExecute(array $payload,$option):bool
{
    if(!isset($payload[$option]))
    {
        return false;
    }
    return true;
}