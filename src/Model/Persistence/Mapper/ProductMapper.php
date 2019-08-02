<?php


namespace MyApp\Model\Persistence\Mapper;


use MyApp\Model\DomainObjects\Product;

class ProductMapper extends AbstractMapper
{
    /**
     * @param Product $product
     * @return int
     */
    public function save(Product $product): int
    {
        return $this->insert($product);
    }

    /**
     * @param Product $product
     * @return int
     */
    private function insert(Product $product): int
    {
        //TODO: transform user to array row then prepare an INSERT ($this->getPdo()) and execute
        //$row = $this->translateToArray();
        $sql = "INSERT INTO product(title, description, camera_specs, capture_data,thumbnail_path,user_id) VALUES(?,?,?,?,?,?);";
        $statement = $this->getPdo()->prepare($sql);
        $statement->execute(array($product->getTitle(),
            $product->getDescription(),
            $product->getCameraSpecs(),
            $product->getCaptureDate()->format('Y-m-d H:i:s'),
            $product->getThumbnailPath(),
            $product->getUserId()));
        return $this->getPdo()->lastInsertId();
    }

}