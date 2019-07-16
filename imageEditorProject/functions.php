<?php

function castFloatType(string $value):float
{
    return (float) $value;
}

function canExecute(array $payload,$option):bool
{
    //$image->adaptiveResizeImage(10,10);
    if(empty($payload[$option]))
    {
        return false;
    }
    return true;
}