<?php

namespace MyApp\Model\DomainObjects;

class OrderItem
{
    /** @var int */
    private $tierId;
    /** @var int */
    private $userId;
    /** @var DateTime */
    private $createdAt;

    /**
     * OrderItem constructor.
     * @param int $tierId
     * @param int $userId
     * @param DateTime $createdAt
     */
    public function __construct(int $tierId, int $userId, DateTime $createdAt)
    {
        $this->tierId = $tierId;
        $this->userId = $userId;
        $this->createdAt = $createdAt;
    }

    /**
     * @return int
     */
    public function getTierId(): int
    {
        return $this->tierId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }



}