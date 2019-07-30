<?php


namespace MyApp\Model\Helper\Database;


class Config
{
    private const DSN = 'dsn';
    private const USER = 'user';
    private const PASSWORD = 'password';
    private const DB_CONFIG = '/var/www/artists-book/config.php';
    /** @var array */
    private static $configArray;

    public static function getDsn(): string
    {
        if (!self::$configArray) {
            self::$configArray=include_once "".self::DB_CONFIG."";
        }
        return self::$configArray[self::DSN];
    }

    public static function getUser(): string
    {
        return self::$configArray[self::USER];
    }
    public static  function getPassword(): string
    {
        return self::$configArray[self::PASSWORD];
    }
}