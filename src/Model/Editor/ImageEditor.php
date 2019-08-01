<?php
namespace MyApp\Model\Editor;

class ImageEditor
{
    public $command;

    public function __construct(string $command)
    {
        $this->command=$command;
    }
    public function execute()
    {
        system($this->command);
    }

}