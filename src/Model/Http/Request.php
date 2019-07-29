<?php

namespace MyApp\Model\Http;

class Request
{
    public function __construct()
    {
    }

    public function getPost(): array
    {
        return $_POST;
    }

    public function getGet(): array
    {
        return $_GET;
    }



}