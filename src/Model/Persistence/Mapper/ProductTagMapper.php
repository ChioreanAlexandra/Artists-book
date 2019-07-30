<?php


namespace MyApp\Model\Persistence\Mapper;


use MyApp\Model\DomainObjects\ProductTag;


class ProductTagMapper
{
    public function save(ProductTag $product)
    {
        $this->insert($product);
    }

    private function translateToArray(ProductTag $productTag): array
    {
        return [
            'product_id' => $productTag->getProductId(),
            'tag_id' => $productTag->getTagId()];
    }
    
}