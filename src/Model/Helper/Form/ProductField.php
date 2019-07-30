<?php


namespace MyApp\Model\Helper\Form;


class ProductField
{
    private const IMAGE_TITLE = 'title';
    private const IMAGE_DESCR = 'description';
    private const CAMERA_SPECS = 'camera_specs';
    private const PRICE_IMAGE = 'price';
    private const CAPTURE_DATE = 'capture_data';
    private const TAG = 'tag';
    private const THUMBNAIL_PATH='thumbnail_path';
    private const USER_ID='user_id';
    private const ID='id';

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
    public static function getThumbnailField(): string
    {
        return self::THUMBNAIL_PATH;
    }
    public static function getUserIdField(): string
    {
        return self::USER_ID;
    }
    public static function getId(): string
    {
        return self::ID;
    }


}