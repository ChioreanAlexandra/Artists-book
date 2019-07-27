<?php

namespace MyApp\Model\DomainObjects;

class Tier
{
    /** @var int */
    private $id;
    /** @var int */
    private $productId;
    /** @var string */
    private $size;
    /** @var float */
    private $price;
    /** @var string */
    private $pathWithWatermark;
    /** @var string */
    private $pathWithoutWatermark;

    /**
     * Tier constructor.
     * @param int $id
     * @param int $productId
     * @param string $size
     * @param float $price
     * @param string $pathWithWatermark
     * @param string $pathWithoutWatermark
     */
    public function __construct(int $productId, string $size, float $price, string $pathWithWatermark, string $pathWithoutWatermark, int $id=null)
    {
        $this->id = $id;
        $this->productId = $productId;
        $this->size = $size;
        $this->price = $price;
        $this->pathWithWatermark = $pathWithWatermark;
        $this->pathWithoutWatermark = $pathWithoutWatermark;
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
     * @return string
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getPathWithWatermark(): string
    {
        return $this->pathWithWatermark;
    }

    /**
     * @return string
     */
    public function getPathWithoutWatermark(): string
    {
        return $this->pathWithoutWatermark;
    }

    //TODO:getOrders();

}