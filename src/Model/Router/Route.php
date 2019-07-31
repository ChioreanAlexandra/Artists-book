<?php


namespace MyApp\Model\Router;


class Route
{
    /**
     * @var string
     */
    private $host;
    private $controller;
    private $param;
    private $action;

    /**
     * Route constructor.
     * @param string $host
     * @param $controller
     * @param $param
     * @param $action
     */
    private function __construct(string $host, $controller, $action, $param)
    {
        $this->host = $host;
        $this->controller = $controller;
        $this->param = $param;
        $this->action = $action;
    }

    public static function createFromString(string $path):self
    {
        $parts = explode('/', $path);
        return new self($parts[0], $parts[1] ?? null, $parts[2] ?? null, $parts[3] ?? null);
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return mixed
     */
    public function getParam()
    {
        return $this->param;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }


}