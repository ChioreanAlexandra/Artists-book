<?php

/**
 * @param array $payload containing the list of arguments of the command
 * @return bool
 */
function isHelp(array $payload):bool
{
    return isset($payload[HELP]);

}