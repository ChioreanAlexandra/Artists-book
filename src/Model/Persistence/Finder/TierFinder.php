<?php


namespace MyApp\Model\Persistence\Finder;


use MyApp\Model\DomainObjects\Tier;
use MyApp\Model\Helper\Form\TierFields;
use PDO;

class TierFinder extends AbstractFinder
{
    /**
     * @param array $row
     * @return Tier
     */
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

    /**
     * Find tiers of a product
     * @param int $id
     * @return array|null
     */
    public function findByProductId(int $id): ?array
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

    /**
     * Find Tiers of a user
     * @param int $idUser
     * @return array|null
     */
    public function findByUserId(int $idUser): ?array
    {
        $sql = "select * from tier where tier.id in (select order_item.tier_id from order_item inner join user on order_item.user_id=user.id where user.id=?)";
        $statement = $this->getPdo()->prepare($sql);
        $statement->execute(array($idUser));
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        $listOfTiers = [];
        foreach ($row as $tier) {
            $listOfTiers[] = $this->translateToTier($tier);
        }
        return $listOfTiers;
    }

    /**
     * @param int $id
     * @return Tier|null
     */
    public function findById(int $id): ?Tier
    {
        $sql = "select * from tier where tier.id =?";
        $statement = $this->getPdo()->prepare($sql);
        $statement->execute(array($id));
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
       // var_dump($row); die;
        return $this->translateToTier($row);
    }
}