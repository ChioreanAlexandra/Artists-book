<?php


namespace MyApp\Model\Helper\Form;


class TierFields
{
    private const SIZE_LARGE = 'large';
    private const SIZE_MEDIUM = 'medium';
    private const SIZE_SMALL = 'small';
    private const PRICE_LARGE_TIER = 'priceLargeTier';
    private const PRICE_MEDIUM_TIER = 'priceMediumTier';
    private const PRICE_SMALL_TIER = 'priceSmallTier';
    private const ID = 'id';
    private const PRICE = 'price';
    private const PATH_WITH_WW = 'path_with_watermark';
    private const PATH_WITHOUT_WM = 'path_without_watermark';
    private const SIZE = 'size';
    private const PRODUCT_ID = 'product_id';


    public static function getSizeLarge(): string
    {
        return self::SIZE_LARGE;
    }

    public static function getSizeMedium(): string
    {
        return self::SIZE_MEDIUM;
    }

    public static function getSizeSmall(): string
    {
        return self::SIZE_SMALL;
    }

    public static function getPriceLarge(): string
    {
        return self::PRICE_LARGE_TIER;
    }

    public static function getPriceMedium(): string
    {
        return self::PRICE_MEDIUM_TIER;
    }

    public static function getPriceSmall(): string
    {
        return self::PRICE_SMALL_TIER;
    }

    public static function getIdField(): string
    {
        return self::ID;
    }

    public static function getPriceField(): string
    {
        return self::PRICE;
    }

    public static function getSizeField(): string
    {
        return self::SIZE;
    }

    public static function getPathWithWMField(): string
    {
        return self::PATH_WITH_WW;
    }
    public static function getPathWithoutWMField():string
    {
        return self::PATH_WITHOUT_WM;
    }
    public static function getProductIdField():string
    {
        return self::PRODUCT_ID;
    }



}