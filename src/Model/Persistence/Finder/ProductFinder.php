<?php


namespace MyApp\Model\Persistence\Finder;


use MyApp\Model\DomainObjects\Product;
use MyApp\Model\Helper\Form\ProductField;
use PDO;

class ProductFinder extends AbstractFinder
{
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
}