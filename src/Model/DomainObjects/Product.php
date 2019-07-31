<?php

namespace MyApp\Model\DomainObjects;
use MyApp\Model\Persistence\PersistenceFactory;

class Product
{
    /** @var int */
    private $id;
    /** @var int */
    private $userId;
    /** @var string */
    private $title;
    /** @var string */
    private $description;
    /** @var array */
    private $tags;
    /** @var string */
    private $cameraSpecs;
    /** @var  \DateTime*/
    private $captureDate;
    /** @var  string*/
    private $thumbnailPath;

    public function __construct(int $userId, string $title, string $description, string $cameraSpecs, \DateTime $captureDate, string $thumbnailPath, array $tags=null, int $id=null)
    {
        $this->id=$id;
        $this->userId=$userId;
        $this->title=$title;
        $this->description=$description;
        $this->cameraSpecs=$cameraSpecs;
        $this->captureDate=$captureDate;
        $this->thumbnailPath=$thumbnailPath;
        $this->tags=$tags;
    }

    /** @return int */
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id):int
    {
        $this->id=$id;
    }

    /**@return int */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**@return string */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return string
     */
    public function getCameraSpecs(): string
    {
        return $this->cameraSpecs;
    }

    /**
     * @return \DateTime
     */
    public function getCaptureDate(): \DateTime
    {
        return $this->captureDate;
    }

    /**
     * @return string
     */
    public function getThumbnailPath(): string
    {
        return $this->thumbnailPath;
    }

    public function getTiers()
    {
        $productFinder = PersistenceFactory::createFinder(Product::class);
        return $productFinder->getTiersById($this->id);
    }
}
