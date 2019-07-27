<?php

namespace MyApp\Model\DomainObjects;

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
    /** TODO: set property type */
    private $tags;
    /** @var string */
    private $cameraSpecs;
    /** @var  \DateTime*/
    private $captureDate;
    /** @var  string*/
    private $thumbnailPath;

    public function __construct(int $userId, string $title, string $description, string $cameraSpecs, \DateTime $captureDate, string $thumbnailPath, int $id=null)
    {
        $this->id=$id;
        $this->userId=$userId;
        $this->title=$title;
        $this->description=$description;
        $this->cameraSpecs=$cameraSpecs;
        $this->captureDate=$captureDate;
        $this->thumbnailPath=$thumbnailPath;
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
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return string
     */
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

    //TODO:getTiers();
}
