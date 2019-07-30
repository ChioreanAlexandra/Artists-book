<?php



namespace MyApp\Model\Persistence;

use MyApp\Model\Persistence\Finder\AbstractFinder;
use MyApp\Model\Persistence\Finder\UserFinder;
use MyApp\Model\Persistence\Mapper\AbstractMapper;
use MyApp\Model\Persistence\Mapper\UserMapper;
use PDO;
use MyApp\Model\Helper\Database\Config;

class PersistenceFactory
{

    private static $mappers = [];

    private static $finders = [];

    private static $pdo;

    /**
     * Returns PDO instance to use in mappers and finders.
     *
     * @return PDO
     */
    private static function createPdo()
    {
        // we ensure we create a single connection per request
        if (self::$pdo === null) {
            // taking config from global variable: not pretty but for now does the job
            self::$pdo = new PDO(Config::getDsn(), Config::getUser(), Config::getPassword());
        }
        return self::$pdo;
    }
    /**
     * Entity mapper factory
     *
     * @param string $entityClass
     *
     * @return AbstractMapper
     */
    public static function createMapper(string $entityClass): AbstractMapper
    {
        $mapperClass = self::getMapperClassName($entityClass);
        // we ensure we create a single mapper instance of this type per request
       // var_dump($mapperClass);
        if (!isset(self::$mappers[$mapperClass])) {
            self::$mappers[$mapperClass] = new $mapperClass(self::createPdo());
        }
        var_dump(self::$mappers[$mapperClass]);
       return  self::$mappers[$mapperClass];
    }

    /**
     * Entity finder factory
     *
     * @param string $entityClass
     *
     * @return AbstractFinder
     */
    public static function createFinder(string $entityClass): AbstractFinder
    {
        $finderClass = self::getFinderClassName($entityClass);
        // we ensure we create a single finder instance of this type per request
        if (!isset(self::$finders[$finderClass])) {
            self::$finders[$finderClass] = new $finderClass(self::createPdo());
        }
        return self::$finders[$finderClass];
    }

    private static function getMapperClassName(string $entityClass): string
    {
        // TODO: transform by convention an entity class name to its mapper class name
        $path=explode('\\',$entityClass);
        preg_match_all('/(?<path>\w+\\\)/',AbstractMapper::class,$match);
        $mapperClassPath=implode('',$match['path']);
        $mapperClassName=sprintf('%s%sMapper',$mapperClassPath,end($path));
        var_dump($mapperClassName);
        return $mapperClassName;
    }


    private static function getFinderClassName(string $entityClass): string
    {
        // TODO: transform by convention an entity class name to its mapper class name
        $path=explode('\\',$entityClass);
        preg_match_all('/(?<path>\w+\\\)/',AbstractFinder::class,$match);
        $finderClassPath=implode('',$match['path']);
        $finderClassName=sprintf('%s%sFinder',$finderClassPath,end($path));
        return $finderClassName;
    }

}