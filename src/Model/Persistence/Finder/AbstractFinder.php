<?php

namespace MyApp\Model\Persistence\Finder;

use PDO;

class AbstractFinder
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * AbstractMapper constructor.
     *
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return PDO
     */
    protected function getPdo(): PDO
    {
        return $this->pdo;
    }

    // TODO extract here what esle is common to all finders

}