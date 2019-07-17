<?php

function isHelp(array $payload):bool
{
    if(isset($payload['help']))
    {
        return true;
    }
    return false;
}