<?php

function canExecute(array $payload, string $option):bool
{
    return isset($payload[$option]);
}