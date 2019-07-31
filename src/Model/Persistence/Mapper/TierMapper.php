<?php


namespace MyApp\Model\Persistence\Mapper;


use MyApp\Model\DomainObjects\Tier;
use MyApp\Model\Helper\Form\TierFields;

class TierMapper extends AbstractMapper
{
    public function save(Tier $tier)
    {
        $this->insert($tier);
    }

    private function insert(Tier $tier): int
    {
        //TODO: transform user to array row then prepare an INSERT ($this->getPdo()) and execute
        $row = $this->translateToArray($tier);
        $sql = "INSERT INTO tier (price,path_with_watermark,path_without_watermark,size,product_id) 
                VALUES (:price, :path_with_watermark, :path_without_watermark, :size, :product_id) ";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue(TierFields::getPriceField(), $row[TierFields::getPriceField()]);
        $statement->bindValue(TierFields::getPathWithWMField(), $row[TierFields::getPathWithWMField()]);
        $statement->bindValue(TierFields::getPathWithoutWMField(), $row[TierFields::getPathWithoutWMField()]);
        $statement->bindValue(TierFields::getSizeField(), $row[TierFields::getSizeField()]);
        $statement->bindValue(TierFields::getProductIdField(), $row[TierFields::getProductIdField()]);

        $statement->execute();
        return $this->getPdo()->lastInsertId();
    }

    private function translateToArray(Tier $tier): array
    {
        // TODO: you may extract this array to a constant in this class, the app config, or you can use reflection
        // to obtain all the properties of user dynamically then by convention obtain the columns to map to (next level)
        $row = [
            TierFields::getSizeField() => $tier->getSize(),
            TierFields::getPriceField() => $tier->getPrice(),
            TierFields::getPathWithWMField() => $tier->getPathWithWatermark(),
            TierFields::getPathWithoutWMField() => $tier->getPathWithoutWatermark(),
            TierFields::getProductIdField() => $tier->getProductId(),
            // TODO: handle the rest of fields
        ];
        return $row;
    }
}