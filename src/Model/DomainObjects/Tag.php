<?php


namespace MyApp\Model\DomainObjects;


class Tag
{
    private $id;
    private $tagName;

    public function __construct(int $id, string $tagName)
    {
        $this->id=$id;
        $this->tagName=$tagName;

    }
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTagName(): string
    {
        return $this->tagName;
    }


}