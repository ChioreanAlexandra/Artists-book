<?php


namespace MyApp\Model\Persistence\Mapper;


use MyApp\Model\DomainObjects\ProductTag;


class ProductTagMapper extends AbstractMapper
{
    public function save(int $productId, string $tagName)
    {
        $this->insert($productId, $tagName);
    }

    private function translateToArray(ProductTag $productTag): array
    {
        return [
            'product_id' => $productTag->getProductId(),
            'tag_id' => $productTag->getTagId()];
    }
    private function insert(int $productId, string $tagName)
    {
        //TODO: transform user to array row then prepare an INSERT ($this->getPdo()) and execute
       // $row = $this->translateToArray($tier);
        $sql = "insert into product_tag(product_id,tag_id) values(:product_id, (select id FROM tag WHERE tag_name=:tag_name));";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue('product_id',$productId);
        $statement->bindValue('tag_name',$tagName);
        $statement->execute();
    }
    
}