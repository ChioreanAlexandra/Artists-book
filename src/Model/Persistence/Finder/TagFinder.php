<?php


namespace MyApp\Model\Persistence\Finder;


use PDO;
use MyApp\Model\DomainObjects\Tag;

class TagFinder extends AbstractFinder
{
    private function translateToTag(array $row): Tag
    {
        $tag = new Tag($row['id'],$row['tag_name']);
        return $tag;
    }

    public function findAll(): array
    {
        // TODO: you can extract the table name in a constant, or a getter function, or config
        $sql = "select * from tag ";
        $statement = $this->getPdo()->prepare($sql);
        $statement->execute();
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        $listOfTags = [];
        foreach ($row as $tag) {
            $listOfTags[] = $this->translateToTag($tag);
        }
        return $listOfTags;
    }
    public function findByProductId(int $idProduct):array
    {
        $sql = "select * from tag where tag.id in (select product_tag.tag_id from product_tag inner join product on product_tag.product_id=product.id where product.id=?)";
        $statement = $this->getPdo()->prepare($sql);
        $statement->execute(array($idProduct));
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        $listOfTags = [];
        foreach ($row as $tag) {
            $listOfTags[] = $this->translateToTag($tag);
        }
        return $listOfTags;
    }
}