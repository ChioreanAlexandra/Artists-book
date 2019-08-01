<?php

namespace MyApp\Model\DomainObjects;

use MyApp\Model\Persistence\PersistenceFactory;

class User
{
    /** @var int */
    private $id;
    /** @var string $name */
    private $name;
    /** @var string $email */
    private $email;
    /** @var string $password */
    private $password;

    public function __construct(string $email, string $password = null, string $name = null, int $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    /** @return int */
    public function getId(): ?int
    {
        return $this->id;
    }

    /** @param int $id */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /** @return string */
    public function getName(): string
    {
        return $this->name;
    }

    /** @param string $name */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /** @return string */
    public function getEmail(): string
    {
        return $this->email;
    }

    /* @param string $email */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /** @return string */
    public function getPassword(): string
    {
        return $this->password;
    }

    /** @param string $password */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    //TODO:getOrders();
    public static function getProducts(int $userId)
    {
        $productMapper=PersistenceFactory::createFinder(Product::class);
        return $productMapper->findByUserId($userId);
    }

    public static function getOrders(int $userId)
    {
        $tierFinder=PersistenceFactory::createFinder(Tier::class);
        return $tierFinder->findByUserId($userId);
    }

    public function __toString(): string
    {
        return sprintf('Email: %s Password: %s Name: %s', $this->email, $this->password, $this->name);
    }
}