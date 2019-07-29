<?php


namespace MyApp\Model\Helper\Form;


class ProductField
{
    private const IMAGE_TITLE = 'imageTitle';
    private const IMAGE_DESCR = 'imageDescription';
    private const CAMERA_SPECS = 'cameraSpecs';
    private const PRICE_IMAGE = 'imagePrice';
    private const CAPTURE_DATE = 'captureDate';
    private const TAG = 'tag';

    public static function getImageTitleField(): string
    {
        return self::IMAGE_TITLE;
    }
    public static function getImageDescriptionField(): string
    {
        return self::IMAGE_DESCR;
    }
    public static function getCameraSpecsField(): string
    {
        return self::CAMERA_SPECS;
    }
    public static function getImagePriceField(): string
    {
        return self::PRICE_IMAGE;
    }
    public static function getCaptureDate(): string
    {
        return self::CAPTURE_DATE;
    }
    public static function getTagField(): string
    {
        return self::TAG;
    }

}