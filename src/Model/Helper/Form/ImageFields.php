<?php


namespace MyApp\Model\Helper\Form;


class ImageFields
{
    private const IMAGE_TAG='image';
    private const TEMP_FILE_LOCATION ='tmp_name';
    private const IMAGE_FILE_NAME='name';
    public const IMAGES_DIRECTORY='images/';
    public const WATERMARK_FILE='images/watermark/watermark.png';

    public static function getImageTag():string
    {
        return self::IMAGE_TAG;
    }

    public static function getImageTemporaryLocation ():string
    {
       return self::TEMP_FILE_LOCATION;
    }

    public static function getImageFileName ():string
    {
        return self::IMAGE_FILE_NAME;
    }
    public static function getImagesDirectory ():string
    {
        return self::IMAGES_DIRECTORY;
    }


}