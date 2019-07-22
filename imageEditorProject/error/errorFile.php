<?php
/**
 * @param array $errors
 * @return string
 */
function convertsErrorArrayToString(array $errors): string
{
    $errorArea = '';
    foreach ($errors as $key => $value) {
        $errorArea .= sprintf("Error at %s => %s ", $key, $value) . PHP_EOL;
    }
    return $errorArea;
}
