<?php
const PIXEL_PATTERN='/^\d+$/';
const VALUE_PATTERN='/\d+:\d+/';
const VALIDATE_EXTENSION_PATTERN='/\.(?<ext>\w+)/';
const ARGUMENTS_NAME=['--input-file','--output-file','--width','--height','--watermark','--format','--help'];
const PATH_PATTERN='/(?<path>.*\/)/';

/**
 * @param array $payload
 * @return array
 */

function validateCommand(array $payload): array
{
    $errors = [];
    if(!validateParameters($payload))
    {
        $errors['Parameters name']='Parameter does not exist. Please check --help';
        return $errors;
    }
    if(!isset($payload[INPUT_FILE]) && !isset($payload[OUTPUT_FILE]))
    {
        $errors['Mandatory parameters']='Input and output files are mandatory';
        return $errors;
    }
    if (!validatePath($payload[INPUT_FILE])) {
        $errors[INPUT_FILE] = 'Your input file path is invalid.';
    }
    /*
     * because the output file may not exist we check only the path of it.
     */
    preg_match(PATH_PATTERN,$payload[OUTPUT_FILE],$match);
    if (isset($match['path']) && !validatePath($match['path'])) {
        $errors[OUTPUT_FILE] = 'Your output file path is invalid.';
    }
    if (isset($payload[WATERMARK]) &&!validatePath($payload[WATERMARK])) {
        $errors[WATERMARK] = 'Your watermark file path is invalid.';
    }
    if (isset($payload[WIDTH]) &&!validatePixel($payload[WIDTH])) {
        $errors[WIDTH] = 'The width value must be a number.';
    }
    if (isset($payload[HEIGHT]) &&!validatePixel($payload[HEIGHT])) {
        $errors[HEIGHT] = 'The height value must be a number.';
    }
    if (isset($payload[FORMAT]) && !validateFormat($payload[FORMAT])) {
        $errors[FORMAT ]= 'The format value must have this format X:Y.';
    }
    if (!validateFileType($payload[INPUT_FILE])) {
        $errors['input-file-extesion'] = 'The image extansion of the input file is not supported.';
    }
    if (isset($payload[WATERMARK]) &&!validateFileType($payload[WATERMARK])) {
        $errors['watermark-extension'] = 'Your watermark file type is invalid.';
    }
    if (!validateOutputExtension($payload[OUTPUT_FILE])) {
        $errors['output-file-extension'] = 'The image extansion of the output file is not supported.';
    }
    return $errors;

}

/**
 * Check if the arguments given are valid arguments
 *
 * @param $payload
 * @return bool
 */
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

/**
 *Check if the given path is a valid one
 *
 * @param string $path
 * @return bool
 */
function validatePath(string $path): bool
{
    return file_exists($path);
}

/**
 * Check if the value for width and height is a number
 *
 * @param string $pixelValue
 * @return bool
 */
function validatePixel(string $pixelValue): bool
{
    return preg_match(PIXEL_PATTERN,$pixelValue)==1;
}

/**
 * Check if the given format is valid (x:y)
 *
 * @param string $formatValue
 * @return bool
 */
function validateFormat(string $formatValue): bool
{
    return preg_match(VALUE_PATTERN,$formatValue)==1;
}

/**
 * Check if the file given is an image with the accepted extenstions.
 * @param string $path
 * @return bool
 */
function validateFileType(string $path): bool
{
    if(!file_exists($path))
    {
        return false;
    }
    $type=mime_content_type($path);
    preg_match('/image\/(?<type>\w+)/',$type,$match);
    if(!empty($match['type']))
        return validateExtension($match['type']);
    return false;
}

/**
 * Check if the extension given is accepted
 *
 * @param string $extension
 * @return bool
 */
function validateExtension(string $extension):bool
{
    $extensionType=['jpg','jpeg','png'];
    return in_array($extension,$extensionType);
}

/**
 * Check is the output file has a proper extension.
 *
 * @param string $path
 * @return bool
 */
function validateOutputExtension(string $path)
{
    preg_match(VALIDATE_EXTENSION_PATTERN,$path,$match);
    return validateExtension($match['ext']);
}