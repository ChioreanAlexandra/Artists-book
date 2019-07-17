<?php
const PIXEL_PATTERN='/\d+/';
const VALUE_PATTERN='/\d+:\d+/';
const VALIDATE_EXTENSION_PATTERN='/\.(?<ext>\w+)/';
const ARGUMENTS_NAME=['input-file','output-file','width','height','watermark','format','help'];


function validateCommand(array $payload): array
{
    $errors = [];
    if(!validateParameters($payload))
    {
        $errors=['Parameter name'=>'Parameter does not exist. Please check --help'];
        return $errors;
    }
    if (!validatePath($payload['input-file'])) {
        $errors = ['input-file' => 'Your input file path is invalid.'];
    }
    if (!validatePath($payload['output-file'])) {
        $errors = ['output-file' => 'Your output file path is invalid.'];
    }
    if (!validatePixel($payload['width'])) {
        $errors = ['width' => 'The width value must be a number.'];
    }
    if (!validatePixel($payload['height'])) {
        $errors = ['height' => 'The height value must be a number.'];
    }
    if (!validateFormat($payload['format'])) {
        $errors = ['format' => 'The format value must have this format X:Y.'];
    }
    if (!validateExtenstions($payload['input-file'])) {
        $errors['input-file'] = 'The image extansion of the input file is not supported.';
    }
    if (!validateExtenstions($payload['output-file'])) {
        $errors['output-file'] = 'The image extansion of the output file is not supported.';
    }
    return $errors;

}

function validateParameters($payload)
{

    foreach ($payload as $key=>$value)
    {
        if(!in_array($key,ARGUMENTS_NAME))
        {
            return false;
        }
    }
    return true;
}

function validatePath(string $path): bool
{
    return file_exists($path);
}

function validatePixel(string $pixelValue): bool
{
    $a= preg_match(PIXEL_PATTERN,$pixelValue);
    return $a;
}

function validateFormat(string $formatValue): bool
{
    return preg_match(VALUE_PATTERN,$formatValue);
}

function validateExtenstions(string $path): bool
{
    $extension=['jpg','jpeg','png'];
    preg_match(VALIDATE_EXTENSION_PATTERN,$path,$matches);
    return in_array($matches['ext'],$extension);
}