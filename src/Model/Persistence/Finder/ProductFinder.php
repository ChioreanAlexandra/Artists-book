<?php


namespace MyApp\Model\Persistence\Finder;


use MyApp\Model\DomainObjects\Product;
use MyApp\Model\DomainObjects\Tier;
use MyApp\Model\Helper\Form\ProductField;
use MyApp\Model\Persistence\PersistenceFactory;
use PDO;

class ProductFinder extends AbstractFinder
{
    public function findAll(): array
    {
        // TODO: you can extract the table name in a constant, or a getter function, or config
        $sql = "select * from product ";
        $statement = $this->getPdo()->prepare($sql);
        $statement->execute();
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        $listOfProducts = [];
        foreach ($row as $product) {
            $listOfProducts[] = $this->translateToProduct($product);
        }
        return $listOfProducts;
    }

    private function translateToProduct(array $row): Product
    {
        $product = new Product($row[ProductField::getUserIdField()],
            $row[ProductField::getImageTitleField()],
            $row[ProductField::getImageDescriptionField()],
            $row[ProductField::getCameraSpecsField()],
            new \DateTime($row[ProductField::getCaptureDate()]),
            $row[ProductField::getThumbnailField()],
            null,
            $row[ProductField::getId()]);
        return $product;
    }

    public function findById(int $id): ?Product
    {
        $sql = "select * from product where id=:id";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue(ProductField::getId(), $id);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        return $this->translateToProduct($row);

    }
    public function getTiersById(int $id):?array
    {
        /** @var TierFinder $tierFinder */
        $tierFinder=PersistenceFactory::createFinder(Tier::class);
        return $tierFinder->findByProductId($id);
    }
    public function findByUserId(int $userId):?array
    {
        $sql = "select * from product where user_id=:user_id";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue(ProductField::getUserIdField(), $userId);
        $statement->execute();
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        $listOfProducts = [];
        foreach ($row as $product) {
            $listOfProducts[] = $this->translateToProduct($product);
        }
        return $listOfProducts;
    }
    public function findBy(string $criteria='title', string $order)
    {
        $sql = "select * from product order by ".$criteria.' '.$order;
        $statement = $this->getPdo()->prepare($sql);

        $statement->execute();
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        $listOfProducts = [];
        foreach ($row as $product) {
            $listOfProducts[] = $this->translateToProduct($product);
        }
        return $listOfProducts;
    }
}