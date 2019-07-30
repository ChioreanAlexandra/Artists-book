<?php


namespace MyApp\Model\DomainObjects;


class ProductTag
{
    /** @var int  */
    private $id;
    /** @var int  */
    private $productId;
    /** @var int  */
    private $tagId;

    /**
     * ProductTag constructor.
     * @param $id
     * @param $userId
     * @param $tagId
     */
    public function __construct( int $productId, int $tagId,int $id = null)
    {
        $this->id = $id;
        $this->productId = $productId;
        $this->tagId = $tagId;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @return int
     */
    public function getTagId(): int
    {
        return $this->tagId;
    }


}