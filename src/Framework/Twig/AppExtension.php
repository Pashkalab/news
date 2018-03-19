<?php

namespace Framework\Twig;

use Framework\Router;

class AppExtension extends \Twig_Extension
{
    private $router;
    
    public function __construct(Router $router)
    {
        $this->router = $router;
    }
    
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('path', [$this, 'getUri'])
        );
    }
    
    public function getUri($name, array $parameters = [])
    {
        return $this->router->generateUrl($name, $parameters);
    }
}