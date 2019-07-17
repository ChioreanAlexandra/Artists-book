<?php

function changeSimpleFormat(array $payload, int $widthFormat, int $heightFormat):array
{
    /**
     * @var \Imagick $image
     */
    $image = $payload['image'];
    if (!isset($payload['width']) && !isset($payload['height'])) {
        if ($image->getImageHeight() < $image->getImageWidth()) {
            $image->scaleImage($image->getImageHeight()*$widthFormat/$heightFormat,$image->getImageHeight());
        }
        else
        {
            $image->scaleImage($image->getImageWidth(),$image->getImageWidth()*$heightFormat/$widthFormat);
        }
    }
    $payload['image']=$image;
    return $payload;


}

function changeFormatWithWidth(array $payload, int $widthFormat, int $heightFormat):array
{
    /**
     * @var \Imagick $image
     */
    $image = $payload['image'];
    $image->scaleImage($image->getImageWidth(),$image->getImageWidth()*$heightFormat/$widthFormat);
    $payload['image']=$image;
    return $payload;
}

function changeFormatWithHeight(array $payload, int $widthFormat, int $heightFormat):array
{
    /**
     * @var \Imagick $image
     */
    $image = $payload['image'];
    $image->scaleImage($image->getImageHeight()*$widthFormat/$heightFormat,$image->getImageHeight());
    $payload['image']=$image;
    return $payload;
}

function removeUnnecessaryOperations(array $payload):array
{
    if(isset($payload['width']))
    {
        unset($payload['width']);
    }
    if(isset($payload['height']))
    {
        unset($payload['heighth']);
    }
    if(isset($payload['format']))
    {
        unset($payload['format']);
    }
    return $payload;
}

function executeFormat($payload)
{

    if (!canExecute($payload, "format")) {
        return $payload;
    }
    $formatArray = explode(':', $payload['format']);
    $widthFormat = (int)array_shift($formatArray);
    $heightFormat = (int)array_shift($formatArray);
    if (!isset($payload['width']) && !isset($payload['height'])) {
        $payload=changeSimpleFormat($payload,$widthFormat,$heightFormat);
        return removeUnnecessaryOperations($payload);
    }

    if(isset($payload['width'])&& !isset($payload['height']))
    {
        $payload=changeFormatWithWidth($payload,$widthFormat,$heightFormat);
        return removeUnnecessaryOperations($payload);
    }

    $payload=changeFormatWithHeight($payload,$widthFormat,$heightFormat);
    return removeUnnecessaryOperations($payload);


}