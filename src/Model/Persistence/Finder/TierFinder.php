<?php


namespace MyApp\Model\Persistence\Finder;


use MyApp\Model\DomainObjects\Tier;
use MyApp\Model\Helper\Form\TierFields;
use PDO;

class TierFinder extends AbstractFinder
{
    private function translateToTier(array $row): Tier
    {
        $tier = new Tier(
            $row[TierFields::getProductIdField()],
            $row[TierFields::getSizeField()],
            $row[TierFields::getPriceField()],
            $row[TierFields::getPathWithWMField()],
            $row[TierFields::getPathWithoutWMField()],
            $row[TierFields::getIdField()]
            );
        return $tier;
    }
    public function findByProductId(int $id): array
    {
        $sql = "select * from tier where product_id=:id";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue('id', $id);
        $statement->execute();
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        $listOfTiers = [];
        foreach ($row as $tier) {
            $listOfTiers[$tier['size']] = $this->translateToTier($tier);
        }
        return $listOfTiers;

    }
}