<?php


namespace MyApp\Model\Persistence\Finder;


use MyApp\Model\DomainObjects\Product;
use MyApp\Model\DomainObjects\Tier;
use MyApp\Model\Helper\Form\ProductField;
use MyApp\Model\Persistence\PersistenceFactory;
use PDO;

class ProductFinder extends AbstractFinder
{
    /**
     * @param array $row
     * @return Product
     * @throws \Exception
     */
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

    /**
     * Find product by id
     * @param int $id
     * @return Product|null
     * @throws \Exception
     */
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

    /**
     * @param int $id
     * @return array|null
     */
    public function getTiersById(int $id): ?array
    {
        /** @var TierFinder $tierFinder */
        $tierFinder = PersistenceFactory::createFinder(Tier::class);
        return $tierFinder->findByProductId($id);
    }

    /**
     * Get products for a given user
     * @param int $userId
     * @return array|null
     * @throws \Exception
     */
    public function findByUserId(int $userId): ?array
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

    /**
     * Find all products with filters
     *
     * @param string $criteria
     * @param string $order
     * @param string|null $search
     * @return array|null
     * @throws \Exception
     */
    public function findBy(string $criteria = 'title', string $order, string $search = null): ?array
    {
        $sql = $search !== null ? "select * from product where title like '%" . $search . "%' order by " . $criteria . " " . $order
            : "select * from product order by " . $criteria . " " . $order;
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